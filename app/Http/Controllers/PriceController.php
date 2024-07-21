<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Product;

class PriceController extends Controller
{
    public function createProductAndPrice(Request $request)
    {

        dd("???");
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|integer|min:0',
            'currency' => 'required|string|max:3',
            'interval' => 'required|string|in:day,week,month,year'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        $price = Price::create([
            'unit_amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'recurring' => ['interval' => $validated['interval']],
            'product' => $product->id,
        ]);

        return response()->json(['product' => $product, 'price' => $price]);
    }

    public function updatePrice(Request $request)
    {
        $validated = $request->validate([
            'price_id' => 'required|string',
            'amount' => 'required|integer|min:0',
            'currency' => 'required|string|max:3',
            'interval' => 'required|string|in:day,week,month,year'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Stripe no permite actualizar precios, así que se crea uno nuevo
        $price = Price::create([
            'unit_amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'recurring' => ['interval' => $validated['interval']],
            'product' => $validated['product_id'],
        ]);

        return response()->json(['price' => $price]);
    }
}