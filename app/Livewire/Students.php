<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Traits\Highlightable;

class Students extends Component
{
    use WithPagination;
    use Highlightable; // for search text highlight

    // Student form fields
    public $full_name, $gender, $father_name, $mobile_number, $date_of_birth, $address, $addmission_date, $course;
    public $photo; // for file upload
    public $photoPreview; // for preview image
    public $withLaptop = false; // checkbox
    public $totalAmount = 0; // total fee
    public $courseFee = 0;
    public $laptopCharge = 0;

    public $filterPaymentStatus = ''; // Payment status filter
    public $filterCourse = '';        // Course filter
    public $filterGender = '';        // Gender filter
    public $totalStudents = 0;

    
    protected $queryString = [
        'filterPaymentStatus' => ['except' => ''],
        'filterCourse' => ['except' => ''],
        'filterGender' => ['except' => ''],
    ];


    

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = '';
    public $perPage = 5;
    public $studentIdToDelete = null;


    // updated render function
    public function render()
    {
        $this->calculateFees();

        // Base query
        $query = Student::query()
            ->where('user_id', Auth::user()->id)
            ->where('is_deleted', 0);

        // Search filter
        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('full_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('mobile_number', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('address', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('enrollment_number', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('course_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('gender', 'like', '%' . $this->searchTerm . '%');
            });
        }

        // **Filter by Payment Status**
        if ($this->filterPaymentStatus) {
            $query->where('payment_status', $this->filterPaymentStatus);
        }

        // **Filter by Course Name**
        if ($this->filterCourse) {
            $query->where('course_name', $this->filterCourse);
        }


        // **Filter by Gender**
        if ($this->filterGender) {
            $query->where('gender', $this->filterGender);
        }

        // Count total students after filters
        $this->totalStudents = $query->count();

        // Paginate filtered results
        $students = $query->paginate($this->perPage);

        return view('livewire.students', [
            'students' => $students,
        ]);
    }

    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->photoPreview = $this->photo->temporaryUrl();
        }
    }

    public function calculateFees()
    {
        // Course fee based on selected course
        $this->courseFee = 0;
        if($this->course) {
            $this->courseFee = [
                'Fullstack' => 50000,
                'Backend' => 30000,
                'Frontend' => 20000,
            ][$this->course] ?? 0;
        }

        // Laptop charge
        $this->laptopCharge = $this->withLaptop ? 15000 : 0;

        // Total amount
        $this->totalAmount = $this->courseFee + $this->laptopCharge;
    }

    public function updated($propertyName)
    {
        if(in_array($propertyName, ['course', 'withLaptop'])) {
            $this->calculateFees();
        }
    }


    public function resetForm()
    {
        $this->reset(); // form reset
        $this->calculateFees(); // fees bhi reset
    }
    

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }



    // Handle delete popup modal
    public $id;
    // public $full_name;
    public function deleteStudentPopup($id)
    {
        // $this->studentIdToDelete = $id;
        // $this->dispatch('studentpopupshow'); // Trigger modal show


        $student = Student::where('id', $id)->first();
        if ($student) {
            $this->id = $id;
            $this->full_name = $student->full_name;
        } 
        $this->dispatch('studentpopupshow'); // Trigger modal show

    }

    // Soft delete student
    public function deleteStudent()
    {
        $student = Student::where('id', $this->id)->first();
        if ($student) {
            // Assuming you have an 'is_deleted' column for soft delete
            $student->is_deleted = 1;
            $student->save();

            // Set the deleted_party_id session variable
            session()->put('deleted_student_id', $this->id);

            // session()->flash('success', 'Student deleted successfully');

            if ($student->is_deleted == 1) {
                session()->flash('success', 'Student deleted successfully');
            } else {
                session()->flash('error', 'Failed to delete student');
            }

        } else {
            session()->flash('error', 'Student not found');
        }
        return view('livewire.students');
        
        // $this->studentIdToDelete = null; // Reset
        // $this->dispatch('studentpopuphide'); // Close modal
    }

    // Restore student
    public function undoDeleteStudent()
    {
        
        // $student = Student::where('id', $this->studentIdToDelete)->first();
        // if ($student) {
        //     $student->is_deleted = 0;
        //     $student->save();
        //     session()->flash('success', 'Student restored successfully');
        // } else {
        //     session()->flash('error', 'Student not found');
        // }



        $deletedStudentId = session('deleted_student_id'); // Retrieve the deleted student ID from the session
        if ($deletedStudentId) {
            $student = Student::find($deletedStudentId); // Find the student by ID

            if ($student) {
                $student->is_deleted = 0; // Restore the student by setting is_deleted to 0
                $student->save(); // Save the changes

                session()->forget('deleted_student_id'); // Remove the deleted_student_id session variable

                session()->flash('success', 'Student restored successfully');
            } else {
                session()->flash('error', 'Student not found');
            }
        } else {
            session()->flash('error', 'No student ID found to restore');
        }


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