<?php

// namespace App\Http\Livewire;
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class StudentRegistration extends Component
{
    use WithFileUploads;

    
    // Properties
    public $studentDetails = [];
    public $first_name, $last_name, $gender, $father_name, $mobile_number, $date_of_birth, $photo, $photoPreview, $address, $admission_date, $course, $withLaptop = false, $withPlacementSupport = false;

    public $courseFee = 0;
    public $laptopCharge = 15000;
    public $placementSupportFee = 5000;
    public $totalAmount = 0;
    public $paymentStatus = 'unpaid';

    public $step = 1;
    public $paymentMethod = ''; // default empty
    public $netBankingUserId;
    public $netBankingPassword;

    public $courseOptions = [
        'Fullstack' => 17000,
        'Backend' => 12000,
        'Frontend' => 9000,
    ];

    public function setCourse($courseName)
    {
        $this->course = $courseName;
        return redirect()->route('add-student');
        //return redirect()->route('/student/add');
    }

    // Testing code
    protected $queryString = [
        'admission_date' => ['except' => ''],
        'course' => ['except' => ''],
        'withLaptop' => ['except' => ''],
        'withPlacementSupport' => ['except' => ''],

    ];
    

    // First section ke rules
    public $rulesSectionOne = [
        'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
        'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
        'gender' => 'required|string',
        'photo' => 'required|image|max:1024',
        'father_name' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
        'mobile_number' => 'required|numeric|digits:10',
        'date_of_birth' => 'required|date',
        'address' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
        'addressField.state' => 'required|string|max:100',
        'addressField.city' => 'required|string|max:100',
        'addressField.pincode' => 'required|numeric|digits_between:5,10',
    ];

    // Second section ke rules
    public $rulesSectionTwo = [
        'admission_date' => 'required|date',
        'course' => 'required|string',
    ];



    // Custom error messages
    public $messagesSectionOne = [
        'first_name.required' => 'First name is required.',
        'first_name.regex' => 'First name should contain only alphabets and spaces.',
        'first_name.max' => 'First name should not exceed 255 characters.',
        'last_name.required' => 'Last name is required.',
        'last_name.string' => 'Last name should contain only alphabets and spaces.',
        'last_name.max' => 'Last name should not exceed 255 characters.',

        'mobile_number.required' => 'Mobile number is required.',
        'mobile_number.numeric' => 'Mobile number should contain only digits.',

        'gender.required' => 'Gender is required.',

        'photo.required' => 'Photo is required.',

        'date_of_birth.required' => 'Date of birth is required.',
        
        'father_name.required' => 'Father name is required.',
        'father_name.regex' => 'Father name should contain only alphabets and spaces.',
        'father_name.max' => 'Father name should not exceed 255 characters.',
        'address.required' => 'Address is required.',
        'address.string' => 'Address should contain only alphabets and spaces.',
        'address.max' => 'Address should not exceed 255 characters.',

        'addressField.state.required' => 'State is required.',
        'addressField.city.required' => 'City is required.',
        'addressField.pincode.required' => 'Pincode is required.',
        'addressField.pincode.numeric' => 'The pincode must be a number.',
        'addressField.pincode.digits_between' => 'The pincode must be between 5 and 10 digits.',
    ];

    
    public function updatedPhoto()
    {
        $this->validate(['photo' => 'nullable|image|max:1024']);
        if ($this->photo) {
            $this->photoPreview = $this->photo->temporaryUrl();
        }
    }
    

    /*
    public function updatedAddressField($value, $field)
    {
        $this->validateOnly($field, $this->rulesSectionOne);
    }
    */
    
    //public $countries = ['India'];
    public $states = [];
    public $cities = [];

    //public $selectedCountry = 'India';
    public $selectedState = '';
    public $selectedCity = '';

    public $addressField = [
        'state' => '',
        'city' => '',
        'pincode' => ''
    ];
    
    public function mount()
    {
        //$this->course = $course;
        //dd($this->course);

        $this->step = request()->query('step', 1);
        $this->course = '';
        $this->calculateCourseFee();
        $this->calculateTotal();
        $this->paymentMethod = '';

        $this->fetchStates();
        //$this->selectedState;

    }
    
    
    public function fetchStates()
    {
        $jsonPath = public_path('data/countries+states+cities.json');

        // File check to prevent Fatal Server Error on Linux
        if (!file_exists($jsonPath)) {
            \Log::warning('JSON file missing at: ' . $jsonPath);
            $this->states = [];
            return;
        }

        $jsonContent = @file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true) ?? [];

        // India ke data ko dhundhna
        $india = collect($data)->firstWhere('name', 'India'); 

        if ($india && isset($india['states'])) {
            $this->states = $india['states'];
        } else {
            $this->states = [];
        }
    }

    public function fetchCities()
    {
        try {
            if (!$this->selectedState) {
                $this->cities = [];
                return;
            }

            $jsonPath = public_path('data/countries+states+cities.json');

            if (!file_exists($jsonPath)) {
                $this->cities = [];
                return;
            }

            $jsonContent = @file_get_contents($jsonPath);
            $data = json_decode($jsonContent, true) ?? [];

            $india = collect($data)->firstWhere('name', 'India');

            if ($india && isset($india['states'])) {
                $state = collect($india['states'])->firstWhere('name', $this->selectedState);
                
                if ($state && isset($state['cities'])) {
                    $this->cities = $state['cities'];
                } else {
                    $this->cities = [];
                }
            } else {
                $this->cities = [];
            }
        } catch (\Exception $e) {
            \Log::error('Fetch Cities Error: ' . $e->getMessage());
            $this->cities = [];
        }
    }
    
    
    public function updatedSelectedState()
    {
        
        //$this->fetchCities();
        //$this->selectedCity = '';
        
        $this->addressField['state'] = $this->selectedState;
        $this->fetchCities();
        $this->selectedCity = '';
        $this->addressField['city'] = '';
    }

    
    public function updatedSelectedCity()
    {
        $this->addressField['city'] = $this->selectedCity;
    }


    
    public function updatedCourse()
    {
        $this->calculateCourseFee();
        $this->calculateTotal();
    }

    public function updatedWithLaptop()
    {
        $this->calculateTotal();
    }

    public function updatedWithPlacementSupport()
    {
        $this->calculateTotal();
    }
    
    
    

    public function calculateCourseFee()
    {
        $fees = [
            'Fullstack' => 17000,
            'Backend' => 12000,
            'Frontend' => 9000,
        ];
        $this->courseFee = $fees[$this->course] ?? 0;
    }

    public function calculateTotal()
    {
        $this->totalAmount = $this->courseFee;
        if ($this->withLaptop) {
            $this->totalAmount += $this->laptopCharge;
        }
        if ($this->withPlacementSupport) {
            $this->totalAmount += $this->placementSupportFee;
        }

        // Total amount stored in session
        session(['total_amount' => $this->totalAmount]);

    }



    public function nextStep()
    {
        $this->validate($this->rulesSectionOne, $this->messagesSectionOne);
        $this->step++;
        session(['step' => $this->step]);
    }
    
    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
            session(['step' => $this->step]);
        } else {
            // If step is 1 or less, forget the 'step' in session
            session()->forget('step');
        }
    }


    public function goToStep($stepNumber)
    {
        $this->step = $stepNumber;
    }


    public function selectPaymentMethod($method) {
        $this->paymentMethod = $method;
    }



    // Modify the code to handle the form submission
    // Class level property
    protected $studentData = [];

    public function prepareStudentData()
    {
        
        // 1. Photo upload aur path prepare karne ka code
        if ($this->photo) {
            $photoPathForData = $this->photo->store('student_photos', 'public');  
        }


        // 2. Prepare student data array
        $this->studentData = [
            //'user_id' => auth()->id(),
            'user_id' => auth()->user()->id,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'father_name' => $this->father_name,
            'mobile_number' => $this->mobile_number,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'photo_path' => $photoPathForData,
            'course_name' => $this->course,
            'course_fees' => $this->courseFee,
            'with_laptop' => $this->withLaptop,
            'laptop_charge' => $this->laptopCharge,
            'earning_placement_support' => $this->withPlacementSupport,
            'support_fee' => $this->placementSupportFee,
            'total_fees' => $this->totalAmount,
            'paymen_status' => $this->paymentStatus,
            'admission_date' => $this->admission_date,
            'gender' => $this->gender,
            'state' => $this->selectedState,
            'city' => $this->selectedCity,
            'pincode' => $this->addressField['pincode'],
        ];

        // Store in session if needed
        session(['studentData' => $this->studentData]);
        session(['payment_authenticated' => false]);
    }

    public function saveStudent()
    {
        // Call this after prepareStudentData() to save data
        Student::create($this->studentData);
    }

    public function submit()
    {
        
        $this->validate($this->rulesSectionTwo);
        
        $this->prepareStudentData();

        //dd(session('studentData'));

        session()->forget('step');
       
        // Redirect to payment login process route
        return redirect()->route('payment-process');
    }

    public function payLater()
    {
        $this->validate($this->rulesSectionTwo);

        $this->prepareStudentData();

        // Save student data
        $this->saveStudent();

        session()->forget('studentData');
        session()->forget('payment_authenticated');
        session()->forget('step');
        
        return redirect('/students');
    }



    public function resetForm()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->gender = null;
        $this->father_name = null;
        $this->mobile_number = null;
        $this->date_of_birth = null;
        $this->photo = null;
        $this->photoPreview = null;
        $this->address = null;
        $this->admission_date = null;
        $this->course = null;
        $this->withLaptop = false;
        $this->withPlacementSupport = false;

        // Reset fee calculations
        $this->courseFee = 0;
        $this->totalAmount = 0;

        // Reset location selections
        $this->selectedState = '';
        $this->selectedCity = '';

        // Reset address fields
        $this->addressField['state'] = '';
        $this->addressField['city'] = '';
        $this->addressField['pincode'] = '';

    }

    
 


    public function render()
    {   /*
        // Optional Testing Live changes implementation form lagging issue
        // Photo preview update
        $this->photoPreview = null; // default
        if ($this->photo) {
            $this->photoPreview = $this->photo->temporaryUrl();
        }

        $this->totalAmount = $this->courseFee;
        if ($this->withLaptop) {
            $this->totalAmount += $this->laptopCharge;
        }
        if ($this->withPlacementSupport) {
            $this->totalAmount += $this->placementSupportFee;
        }
        session(['total_amount' => $this->totalAmount]);

        // --- States and Cities Data Loading ---
        $jsonPath = public_path('data/countries+states+cities.json');
        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);

        // India ke data ko dhundhna
        $india = collect($data)->firstWhere('name', 'India');

        // Initialize states and cities
        $this->states = [];
        $this->cities = [];

        if ($india && isset($india['states'])) {
            $this->states = $india['states'];

            // Selected state ke basis pe cities load karo
            if ($this->selectedState) {
                $state = collect($this->states)->firstWhere('name', $this->selectedState);
                if ($state && isset($state['cities'])) {
                    $this->cities = $state['cities'];
                }
            }
        }
        */

        if (session()->has('step')) {
            $this->step = session('step');
        }
        return view('livewire.student-registration');
    }

    
    public function paymentSuccess()
    {
        session()->flash('payment_success', true);
        
    }


    // Handle payment service popup modal
    public function paymentUnavailableModal()
    {
        //dd('paymentUnavailableModal is working');
       
        $this->dispatch('paymentUnavailablePopupShow'); // Trigger modal show

    }
    
        

}