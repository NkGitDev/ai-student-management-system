@extends('layouts.payment')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="col-lg-12 col-md-12">
        <!-- Success Message -->
        <div class="alert alert-success text-center mb-4" role="alert">
            <h2 class="mb-2">Login Successful!</h2>
            <p class="mb-0">Thank you for logging in. Please review your payment details below.</p>
        </div>

        <!-- Payment Details Card -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 text-center">Payment Details</h3>
            </div>
            <div class="card-body bg-white rounded">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-end">Fees Amount:</th>
                                <td class="text-start">
                                    @if($studentData['total_fees'] && $studentData['total_fees'] != '₹ 0.00')
                                        {{ '₹ ' . $studentData['total_fees'] }}
                                    @elseif(session()->has('student_amount'))
                                        {{ '₹ ' . session('student_amount') }}
                                    @else
                                        ₹ 0.00
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Pay By:</th>
                                <td class="text-start">{{ $studentData['full_name'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Transaction ID:</th>
                                <td class="text-start">{{ $paymentDetails['transactionId'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Payment Date & Time:</th>
                                <td class="text-start">{{ $paymentDetails['paymentDate'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Account Number:</th>
                                <td class="text-start">{{ $paymentDetails['accountNumber'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Account Holder Name:</th>
                                <td class="text-start">{{ $paymentDetails['accountHolderName'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Payment Method:</th>
                                <td class="text-start">{{ $paymentDetails['paymentMethod'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Confirmation Button -->
        <div class="text-center mt-4">
            <form method="POST" action="{{ route('enroll-confirm') }}">
                @csrf
                @if($studentData && (is_array($studentData) || is_object($studentData)))
                    @foreach($studentData as $key => $value)
                        <input type="hidden" name="student_data[{{ $key }}]" value="{{ is_array($value) ? json_encode($value) : $value }}">
                    @endforeach
                @endif
                <button type="submit" class="btn btn-success btn-lg px-4">Confirm Payment</button>
            </form>
        </div>
    </div>
</div>
@endsection
