<div>

    <style>
    @media print {
        @page {
            /* size: A4; */
            margin: 0mm;
        }
        body {
            margin: 0;
            padding: 0;
        }
    }
    </style>

    @if($student->payment_status != 'paid')
        <div class="alert alert-warning text-center mt-4 p-3" style="font-size: 18px;">
            Payment is not completed. Receipt cannot be generated.
        </div>
        <div class="d-flex justify-content-center">
            <a href="javascript:history.back()" class="btn btn-warning mr-3">Back</a>
            
            <button type="submit" wire:click="payFees({{ $student->id }})" class="btn btn-primary">Pay Fees & Print Details</button>
        </div>
        @else
        <!-- <button type="button" class="btn btn-primary" wire:click="makePayment">Make Payment</button> -->

    <div class="container my-5 d-flex justify-content-center">
        <div class="card p-4" style="min-width: 900px; width: 100%; position: relative; font-family: 'Arial', sans-serif;">
            {{-- Watermark based on payment status --}}
            @if ($student->payment_status == 'paid')
                <div class="watermark">PAID</div>
            @elseif ($student->payment_status == 'unpaid')
                <div class="watermark unpaid">UNPAID</div>
            @endif

            {{-- Header Section --}}
            <div class="text-center mb-3">
                <h1 class="fw-bold mb-1">Student Receipt</h1>
                <h4 class="mb-0" style="color: #007bff;">{{ config('app.name') ?: 'Courses' }} of Learning</h4>
                <!-- <p class="text-muted mb-2">Bikaner, Rajasthan, India</p> -->
                <div class="border-top pt-2 mt-2"></div>
            </div>

            {{-- Receipt Number & Date --}}
            <div class="d-flex mb-3 px-3">
                <div class="col-md-6">
                    <p class="mb-1"><b>Receipt No.:</b> {{ $student->receipt_number }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-1"><b>Date:</b> {{ \Carbon\Carbon::now('Asia/Kolkata')->format('d F Y') }}</p>
                </div>
            </div>

            {{-- Personal Info Section --}}
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-2 bg-primary text-white fw-bold">
                    Personal Information
                </div>
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="col-lg-6 mb-2">
                            <p class="mb-1"><b>Enrollment No.:</b> {{ $student->enrollment_number }}</p>
                            <p class="mb-1"><b>Student Name:</b> {{ $student->full_name }}</p>
                            <p class="mb-1"><b>Father Name:</b> {{ $student->father_name }}</p>
                            <p class="mb-1"><b>Gender:</b> {{ $student->gender }}</p>
                            <!-- <p class="mb-1"><b>student id:</b> {{ $student->id }}</p> -->
                            <p class="mb-1"><b>Date of Birth:</b> {{ \Carbon\Carbon::parse($student->date_of_birth)->format('d F Y') }}</p>
                        </div>
                        <div class="col-lg-3 mb-2">
                            <p class="mb-1"><b>Mobile Number:</b> {{ $student->mobile_number }}</p>
                            <p class="mb-1"><b>Address:</b> {{ $student->address }}</p>
                            <p class="mb-1"><b>State:</b> {{ $student->state }}</p>
                            <p class="mb-1"><b>City:</b> {{ $student->city }}</p>
                            <p class="mb-1"><b>Pincode:</b> {{ $student->pincode }}</p>
                        </div>
                        <div class="col-lg-3 mb-2">
                            <img src="{{ $student->photo_path ? asset('storage/' . $student->photo_path) : asset('assets/images/users/Guest-user.png') }}" alt="Image" style="height:124px; width:110px; border-radius:10px"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Course & Admission Details --}}
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-2 bg-success text-white fw-bold">
                    Course & Admission Details
                </div>
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><b>Course Name:</b> {{ $student->course_name }}</p>
                            <p class="mb-1"><b>Admission Date:</b> {{ \Carbon\Carbon::parse($student->admission_date)->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><b>Course Fees:</b> ₹{{ $student->course_fees }}</p>
                            <p class="mb-1"><b>Total Fees:</b> ₹{{ $student->total_fees }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fee Breakdown Table --}}
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-2 bg-warning text-dark fw-bold">
                    Fee Breakdown
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Particulars</th>
                                    <th class="text-end">Amount (₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Course Fees</td>
                                    <td class="text-end">{{ $student->course_fees }}</td>
                                </tr>
                                @if($student->with_laptop)
                                <tr>
                                    <td>Laptop Charge</td>
                                    <td class="text-end">{{ $student->laptop_charge }}</td>
                                </tr>
                                @endif
                                @if($student->earning_placement_support)
                                <tr>
                                    <td>Support Fees</td>
                                    <td class="text-end">{{ $student->support_fee }}</td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr class="table-primary fw-bold">
                                    <td>Total</td>
                                    <td class="text-end">{{ $student->total_fees }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-2 bg-info text-white fw-bold">
                    Payment Details
                </div>
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><b>Payment Status:</b> {{ ucfirst($student->payment_status) }}</p>
                            <p class="mb-1"><b>Total Paid:</b> ₹{{ $student->total_fees }}</p>                        
                        </div>
                        <div class="col-md-6 mb-2">                        
                            <p class="mb-1"><b>Payment Method:</b> Online</p>
                            <p class="mb-1"><b>Payment Date:</b> {{ \Carbon\Carbon::parse($student->payment_date ?? now())->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Signature & Footer --}}
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <div class="text-center">
                    <p class="mb-2">Authorized Signatory</p>
                    <div style="height: 50px;">______________________</div>
                </div>
                <div class="text-center">
                    <p>Thank you for choosing {{ config('app.name') ?: 'Our Course.' }}</p>
                </div>
            </div>

            {{-- Buttons for Print & Back --}}
            <div class="mt-2 d-flex justify-content-end gap-3 d-print-none">
                <a href="javascript:history.back()" class="btn btn-warning mr-3">
                    <i class="mdi mdi-arrow-left"></i> Back
                </a>
                <a href="javascript:window.print()" class="btn btn-primary">
                    <i class="mdi mdi-printer"></i> Print
                </a>
            </div>
        </div>
    </div>

    @endif

</div>
