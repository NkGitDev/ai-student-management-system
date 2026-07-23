<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public $enrollmentNumber;
    public $receiptNumber;
    public $studentName;
    public $enrolledConfirm = false;
    public $paymentStatus = 'paid';


    public function __construct()
    {
        $this->middleware('auth');
    }

    // Function to load students
    public function manageStudents(Request $request)
    {       
        // Get all students data with specific columns, apply search if provided
        $students = Student::where('user_id', auth()->user()->id)
            ->with('user')
            ->select(
                'id',
                'user_id',
                'full_name',
                'mobile_number',
                'address',
                'date_of_birth',
                'enrollment_number',
                'course',
                'admission_date',
                'is_deleted',
                'created_at'
            );

        // Optional: add search/filter logic here

        return view('student.manage', compact('students'));
    }

    // Function to load add student view
    public function addStudent(Request $request)
    {
        $course = $request->query('course', '');

        //return view('student.add', compact('course'));
        
        // Pehle yeh test karte hain ki kya controller bina view ke respond karta hai
        return "Controller is working fine!";
    }
    


    // next more modify
    public function showEnrollConfirm(Request $request)
    {
        

        $studentData = $request->session()->get('studentData', []);
        //dd('Student data in showEnrollConfirm :', $studentData);

        // Student ke options ko true/false me convert karna
        $studentData['with_laptop'] = isset($studentData['with_laptop']) && $studentData['with_laptop'] == '1' ? true : false;
        $studentData['earning_placement_support'] = isset($studentData['earning_placement_support']) && $studentData['earning_placement_support'] == '1' ? true : false;

        $studentId = session('student_id_for_enroll');
        $student = null;

        if ($studentId) {
            $student = Student::find($studentId);
        }

        $currentYear = date('Y');
        $yearSuffix = Carbon::now()->format('y');

        if ($student) {
            // Agar student ke paas enrollment number nahi hai, toh generate karo
            if (!$student->enrollment_number && !$student->receipt_number) {
                // Check karo ki session me enrollment number hai ya nahi
                if (!session()->has('enrollment_number') && !session()->has('receipt_number')) {
                    $student->enrollment_number = $this->generateEnrollmentNumber($currentYear);
                    $student->receipt_number = $this->generateReceiptNumber($yearSuffix);

                    session(['enrollment_number' => $student->enrollment_number]);
                    session(['receipt_number' => $student->receipt_number]);
                } else {
                    $student->enrollment_number = session('enrollment_number');
                    $student->receipt_number = session('receipt_number');
                }
                $student->save();
            }
            // Payment update
            $this->updatePaymentStatus($student);
        } else {
            // Naya student ke liye
            if (!session()->has('enrollment_number') && !session()->has('receipt_number')) {
                $enrollmentNumber = $this->generateEnrollmentNumber($currentYear);
                $receiptNumber = $this->generateReceiptNumber($yearSuffix);

                session(['enrollment_number' => $enrollmentNumber]);
                session(['receipt_number' => $receiptNumber]);

            } else {
                $enrollmentNumber = session('enrollment_number');
                $receiptNumber = session('receipt_number');
            }

            // Student create karte waqt, check karo ki duplicate na ho
            // Agar same enrollment_number ke saath record already hai, toh usko update karo ya reuse karo
            $existingStudent = Student::where('enrollment_number', $enrollmentNumber)
                                        ->where('receipt_number', $receiptNumber)->first();
            if ($existingStudent) {
                // Student already exists, usko reuse karo
                $student = $existingStudent;
            } else {
                // Naya student create karo
                // Generate receipt number only for new student
                //$studentData['receipt_number'] = $this->generateReceiptNumber();

                session(['student_name' => $studentData['full_name'] ?? '']);
                $studentData['enrollment_number'] = $enrollmentNumber;
                $studentData['receipt_number'] = $receiptNumber;
                $studentData['payment_status'] = 'paid';
                
                $student = Student::create($studentData);

                //$studentDataArray = $studentData->toArray(); // Agar object hai
                //$student = Student::create($studentDataArray);

                session(['student_id_for_enroll' => $student->id]);
            }
        }

        // Clear student ID session after processing
        session()->forget('student_id_for_enroll');

        $this->enrollmentNumber = $student->enrollment_number;
        $this->receiptNumber = $student->receipt_number;

        $this->studentName = $student->full_name ?? '';
        $this->enrolledConfirm = true;

        return view('student.enrolled', [
            'student' => $student,
            'studentData' => $studentData,
            'successMessage' => 'Student enrolled successfully.',
            'enrolledConfirm' => true,
        ]);
    }

    // Helper method to generate enrollment number
    private function generateEnrollmentNumber($year)
    {
        $latestStudent = Student::where('enrollment_number', 'like', $year . '%')
                                ->orderBy('enrollment_number', 'desc')
                                ->first();

        if ($latestStudent && $latestStudent->enrollment_number) {
            $lastNumber = intval(substr($latestStudent->enrollment_number, 4));
            $newNumber = $lastNumber + 1;
            
        } else {
            $newNumber = 1;
        }

        return $year . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

   
    // Helper method to generate receipt number
    private function generateReceiptNumber($year)
    {
        // 'year' me sirf last 2 digits aa rahe hain, jaise '25'
        $latestStudent = Student::where('receipt_number', 'like', 'REC' . $year . '%')
                                ->orderBy('receipt_number', 'desc')
                                ->first();

        if ($latestStudent && $latestStudent->receipt_number) {
            // Receipt number format: REC + year + 4 digit number
            // Example: REC250001
            // Start position for numeric part: length of 'REC' + year (2 digits)
            $lastNumber = intval(substr($latestStudent->receipt_number, 5)); // 'REC' (3 chars) + year (2 chars) = 5
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'REC' . $year . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }



    // Helper method to update payment status
    private function updatePaymentStatus($student)
    {
        $student->payment_status = 'paid';
        $student->save();
    }



    // Function to load edit student view
    public function editStudent($student_id)
    {
        $student = Student::where('id', $student_id)->where('user_id', auth()->id())->firstOrFail();
        return view('student.edit', compact('student'));
    }

    // Function to update student data
    public function updateStudent($id, Request $request)
    {
        // Validations
        $request->validate([
            'full_name' => 'required|string|min:2|max:50',
            'mobile_number' => 'required|numeric|digits:10',
            'address' => 'required|max:250',
            'date_of_birth' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo validation

        ]);

        /*
        $student = Student::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $student->update($request->all());

        return redirect()->route('manage-students')->withStatus('Student updated successfully');
        */



        // modify code
        $student = Student::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $data = $request->all();

        // Handle photo upload if file is present
        if ($request->hasFile('photo')) {
            // Optionally, delete old photo file if exists
            if ($student->photo_path && Storage::disk('public')->exists($student->photo_path)) {
                Storage::disk('public')->delete($student->photo_path);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo_path'] = $path; // Save new path
        }

        // Update student record
        $student->update($data);

        return redirect()->route('manage-students')->with('status', 'Student updated successfully');
    
    }

    

    public function printStudentDetails($student_id)
    {
        $student = Student::where('id', $student_id)->where('is_deleted', 0)->with('user')->first();

        if (!$student) {
            abort(404, 'Student not found');
        }

        // Fee details (aapke data ke hisaab se)
        //$admission_fee = 0; // Example
        //$tuition_fee = 0; // Example
        //$library_fee = 0; // Example
        //$other_charges = 0; // Example
        //$total_amount = $admission_fee + $tuition_fee + $library_fee + $other_charges;

        // Sabhi variables ko view me pass karo
        return view('student.print', compact(
            'student'
        ));
    }


}