<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('enrollment_number')->unique()->nullable();
            $table->string('receipt_number')->unique()->nullable();
            $table->string('full_name');
            $table->string('gender')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mobile_number', 15);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('pincode', 10);
            $table->string('address', 250);
            $table->date('date_of_birth');
            $table->string('photo_path')->nullable();
            $table->string('course_name');
            $table->integer('course_fees');
            $table->boolean('with_laptop')->default(false);
            $table->integer('laptop_charge');
            $table->boolean('earning_placement_support')->default(false);
            $table->integer('support_fee');
            $table->integer('total_fees');
            $table->string('payment_status')->default('unpaid');
            $table->date('admission_date');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            // Agar 'users' table hai toh foreign key bhi add kar sakte hain
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}