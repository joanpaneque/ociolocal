<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Http;

use Inertia\Inertia;

class TestController extends Controller
{
    public function index() {

        $stripe = new \Stripe\StripeClient('sk_test_51O7MZuBIVxWAo0D7mOV2JpasY4O9P2oLQpiHEzOmop2krO2gLg4yhUeS1lxNRfsj3aHvHt6iYpiWcDyKjqEy1UHt00Ae2bA1Mt');

        $product = $stripe->products->create([
            'name' => 'Prueba de PHP',
        ]);

        $stripe->products->update(
            $product->id,
            ['name' => 'Conchas de playa']
        );

        $price = $stripe->prices->create([
            'currency' => 'eur',
            'unit_amount' => 50,
            'product' => $product->id
        ]);

        $paymentLink = $stripe->paymentLinks->create([
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => 20,
                ],
            ],
        ]);

        dd($paymentLink);

        // get the product
        dd($stripe->products->retrieve(
            "prod_QW3tmSkcwqzLhT",
            []
        ));

        // get the payment link
        
        
        


        // dd("Producto creado");
    }
}
