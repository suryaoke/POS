<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment = PaymentMethod::all();

        return response()->json([
            'success' => true,
            'message' => 'Sukses Menampilkan Data',
            'data' => $payment
        ]);
    }
}
