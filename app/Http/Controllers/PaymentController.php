<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // tampilan halaman pembayaran
    public function show(Request $request)
    {
        $orderId = $request->session()->get('order_id');
        $totalPrice = $request->session()->get('total_price');

        // Retrieve the order details (if needed)
        $order = Order::find($orderId);

        return view('pembeli.pesanan.payment', compact('order', 'totalPrice'), ['title' => 'Payment', 'active' => 'pesanan']);
    }

    // fungsi untuk kondirmasi pembayaran
    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $order = Order::find($validatedData['order_id']);

        if (!$order) {
            return back()->withErrors(['message' => 'Order tidak ditemukan.']);
        }

        $path = $request->file('payment_proof')->store('public/payment_proofs');

        // Update the order with payment proof and change the status
        $order->update([
            'payment_proof' => $path,
            'status' => 'pending_confirmation', // Assuming you have a status field
        ]);

        return redirect('/success')->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}
