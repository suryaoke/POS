<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => $products
        ]);
    }


    public function store(Request $request) {}

    public function show(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
    public function showByBarcode($barcode)

    {
        $product  = Product::where('barcode', $barcode)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $product
        ]);
    }
}
