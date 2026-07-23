<?php

// PaymentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha; // captcha facade
use Illuminate\Support\Str;
use App\Models\Student;

date_default_timezone_set('Asia/Kolkata');

class PaymentController extends Controller
{
    protected $username;

    public function __construct()
    {
        $this->middleware('auth');
    }
        

    // Show login form with captcha
    public function showLoginForm()
    {
        
        //dd('showLoginForm is working');
        //$request->input('student_id');
        session(['payment_authenticated' => true]);
        //dd(session()->all());
        return view('payment.login'); // Create this Blade view
    }

    
    
    // Process login
    public function processLogin(Request $request)
    {    

        
        //dd('processLogin is working');
        //$studentId = $request->input('student_id');
        $request->input('student_id');
        session(['payment_authenticated' => true]);
        //dd(session()->all());
        
        
        
        // Get current logged-in user
        //dd('Helloo2');
        $user = auth()->user();

        if (!$user) {
            return back()->withErrors(['user' => 'User not logged in'])->withInput();
        }
             
        //dd('Request payload:', $request->all());

        // Extract Input values
        $inputUserName = $request->input('userName');
        $inputPassword = $request->input('password');


        $this->username = auth()->user()->name;
        $lowerCaseUsername = strtolower($this->username);

        // remove space
        $expectedUserName = str_replace(' ', '', $lowerCaseUsername);

        $firstTwoLetters = substr($this->username, 0, 2); // pehle do akshar nikalna
        $currentYear = date('Y'); // current year, jaise 2025

        //$expectedPassword = $firstTwoLetters . $currentYear;
        $expectedPassword = '1234';
        
        // Validate username
        if ($inputUserName !== $user->name) {
            return back()->withErrors(['userName' => 'Invalid username'])->withInput();
        }

        if ($inputPassword !== $expectedPassword) {
            return back()->withErrors(['password' => 'Invalid password'])->withInput();
        }

        // Validate CAPTCHA
        $messages = [
            'loginCaptchaValue.required' => 'Please enter the CAPTCHA code.',
            'loginCaptchaValue.captcha' => 'Please enter a valid CAPTCHA code.',
        ];
        
        $request->validate([
            'loginCaptchaValue' => 'required|captcha'
        ], $messages);

        // Validation successful - set session flag for payment authentication
        //dd('payment_authenticated in processLogin');
        //session()->put('payment_authenticated', true);
        

        return $this->showPaymentProcess($request);

    }


    public function showPaymentProcess(Request $request)
    { 
        //dd('showPaymentProcess is working');
        

        $studentData = $request->session()->get('studentData', []);
        //dd('Student Data...2 : ', $studentData);

        //session()->flush();
        
        
        if (!$studentData) {
            return redirect()->back()->with('error', 'Student data missing.');
        }

        
        // Initialize amount
        $amount = 0;

        $formattedAmount = number_format($amount, 2, '.', ',');
        //$transactionId = 'TXN' . Str::uuid();
        $randomString = Str::random(15);
        $upperCaseString = strtoupper($randomString);
        $transactionId = 'TXN' . $upperCaseString;
        $loginSuccess = true;
        $paymentDetails = [
            'amount' => $formattedAmount,
            'transactionId' => $transactionId,
            'paymentDate' => date('d-m-Y h:i:s A'),
            'accountNumber' => '248877661200',
            'accountHolderName' => auth()->user()->name,
            'paymentMethod' => 'Net Banking',
        ];

        //dd(session('studentData'));
        //dd('Student Data. :-', $studentData);

        return view('payment.process', compact(['loginSuccess', 'studentData', 'paymentDetails']));
    }

    /*
    private function calculateAmountByStudentId($studentId)
    {
        //dd('calculat amount is working');
        // Example: Fetch student record and get amount
        $student = Student::find($studentId);
        if ($student) {
            //dd($student->total_fees);
            return $student->total_fees; // ya koi aur property
        }
        return 0;
    }
    */
    

    public function refreshCaptcha()
    {
        // Return CAPTCHA image HTML or URL
        return response()->json([
            'captcha' => captcha_img('flat')
        ]);
    }
    
   
}
