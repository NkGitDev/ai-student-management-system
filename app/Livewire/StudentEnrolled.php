<?php

namespace App\Livewire;

use Livewire\Component;

class StudentEnrolled extends Component
{
    public $student;
    public $studentData;

    /*
    // mount is usefull for big data size
    public function mount($student, $studentData)
    {
        $this->student = $student;
        $this->studentData = $studentData;
    }
    */

    public function render()
    {
        return view('livewire.student-enrolled');
    }

    public $enrolledConfirm = true;

    public function showEnrollConfirm(){
        return view('livewire.student-enrolled');
        
    }
    
    public function finish(){
        //dd('finis is working');
        // Saare session variables clear karne ke liye
        // session()->flush();

        // Ya specific session variables ko forget karne ke liye
        session()->forget('student_name');
        session()->forget('enrollment_number');
        session()->forget('receipt_number');
        session()->forget('payment_authenticated');
        session()->forget('student_id_for_enroll');
        session()->forget('studentData');
        session()->forget('student_data');
        session()->forget('step');

        return redirect('/students');
    }
}

