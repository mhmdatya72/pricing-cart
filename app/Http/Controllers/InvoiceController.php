<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
        // Display products to the user
        public function showProducts()
        {
            $products = Product::all(); // Retrieve all products from the database
            return view('invoice', compact('products'));
        }

        // Handle invoice calculation
        public function generateInvoice(Request $request)
        {
            // Fetch selected products
            $selectedProductIds = $request->input('product_ids');
            $products = Product::whereIn('id', $selectedProductIds)->get();

            // Initialize variables
            $subtotal = 0;
            $shipping = 0;
            $discounts = 0;
            $vatRate = 0.14;
            $maxShippingDiscount = 10;

            // Process each product
            foreach ($products as $product) {
                $subtotal += $product->price;
                $shipping += ($product->weight * 100) * $product->shipping_rate;
            }

            // Apply discounts (e.g., 10% off shoes)
            foreach ($products as $product) {
                if ($product->name == 'Shoes') {
                    $discounts += ($product->price * 0.1);
                }
            }

            // Apply shipping discount if applicable
            if (count($products) > 1) {
                $discounts += $maxShippingDiscount;
            }

            // Calculate VAT
            $vat = $subtotal * $vatRate;

            // Calculate final total
            $total = ($subtotal + $shipping + $vat) - $discounts;

            // Return response as JSON for the frontend
            return response()->json([
                'subtotal' => round($subtotal, 2),
                'shipping' => round($shipping, 2),
                'vat' => round($vat, 2),
                'discounts' => round($discounts, 2),
                'total' => round($total, 2),
            ]);
        }
}