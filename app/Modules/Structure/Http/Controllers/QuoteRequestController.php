<?php

namespace App\Modules\Structure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Structure\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'product' => 'required|array|min:1',
            'product.*' => 'required|string|max:255',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $items = [];
        $products = $request->input('product', []);
        $quantities = $request->input('quantity', []);
        foreach ($products as $index => $product) {
            $qty = $quantities[$index] ?? null;
            if ($product !== null && $qty !== null) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $qty,
                ];
            }
        }

        QuoteRequest::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'items' => $items,
        ]);

        return redirect()->back()->with('quote_success', 'تم استلام طلبك بنجاح! سنتواصل معك قريباً.');
    }
}
