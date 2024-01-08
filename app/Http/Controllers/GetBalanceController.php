<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Customer;

class GetBalanceController extends Controller
{   

    public function getBalance()
    {
        $secretKey = env('XENDIT_SECRET_KEY');
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($secretKey . ':'),
        ])->get('https://api.xendit.co/balance');

        return $response->json();
    }

    public function checkOut()
    {
        $harga = 90000;
        $admin = 4000;
        $total = $harga + $admin;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(env('XENDIT_SECRET_KEY') . ':'),
        ])->post('https://api.xendit.co/v2/invoices', [
            'external_id' => 'payment-link-example',
            'amount' => $total,
            'available_banks' => [
                [
                    'bank_code'=> 'BCA',
                    'collection_type'=> 'POOL',
                    'transfer_amount'=> $total,
                    'bank_branch'=> 'Virtual Account',
                    'account_holder_name' => 'KAIA'
                ]
            ],
            'items' => [
                [
                    'name' => 'Air Conditioner',
                    'quantity' => 1,
                    'price' => 90000,
                    'category' => 'Electronic',
                    'url' => 'https://yourcompany.com/example_item',
                ]
            ],
            'success_redirect_url' => 'http://127.0.0.1:8000/',
            'fees' => [
                [
                    'type' => 'ADMIN',
                    'value' => $total
                ]
            ]
        ]);

        Customer::create([
            'invoice_id' => $response['id'],
            'url' => $response['invoice_url'],
            'status' => $response['status']
        ]);

        return redirect($response['invoice_url']);

        // dd($response->json());
        
    }

    public function handleCallback(Request $request)
    {
        return response()->json(['success' => true]);
    }
}
