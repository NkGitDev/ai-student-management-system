<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Agar table ka naam default 'students' nahi hai, toh yeh uncomment karein
    // protected $table = 'students';

    // Table name
    protected $table = "students";

    // Primary key
    protected $primaryKey = "id";

    // Fillable properties (jo fields mass assignment ke liye allow hain)
    protected $fillable = [
        'user_id',
        'enrollment_number',
        'receipt_number',
        'full_name',
        'gender',
        'father_name',
        'mobile_number',
        'state', 'city', 'pincode',
        'address',
        'date_of_birth',
        'photo_path',
        'course_name',
        'course_fees',
        'with_laptop',
        'laptop_charge',
        'earning_placement_support',
        'support_fee',
        'total_fees',
        'payment_status',
        'admission_date',
        'is_deleted', // optional, agar soft delete ke liye
    ];

    // Agar soft deletes use karna chahte hain toh
    // use Illuminate\Database\Eloquent\SoftDeletes;
    // protected $dates = ['deleted_at'];


    // App\Models\Student.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}