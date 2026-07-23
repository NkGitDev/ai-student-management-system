<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class Receipt extends Component
{
    public $student;
    public $receipt_number;

    public function render()
    {
        return view('livewire.receipt');
    }

    public function payFees($studentId)
    {
        $student = Student::find($studentId);
        if ($student) {
            /*
            $student->payment_status = 'paid';
            $student->save();
            */

            // Student ID ko session me store karen
            session(['student_id_for_enroll' => $student->id]);
            session(['studentData' => $student]);
            session(['payment_authenticated' => false]);
            //dd('payFees studentData :', $student);

            session()->flash('message', 'Payment status updated successfully.');
        } else {
            session()->flash('error', 'Student not found.');
        }

        //return redirect()->route('payment-login-process');
        return redirect()->route('payment-process');
    }
}
