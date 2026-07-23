<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentAuth
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $paymentAuth = session('payment_authenticated') === true;
        $studentData = session()->has('studentData');
        $studentId = $request->input('student_id');

        if (($paymentAuth && $studentData) || ($paymentAuth && $studentId)) {
            return $next($request);
        }

        return redirect()->route('payment-login-page');
    }
    
    


}
