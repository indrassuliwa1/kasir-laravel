<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Cart;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pay_total' => 'required|numeric|min:1',
        ]);

        $carts = Cart::with('item')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });

        if ($request->pay_total < $total) {
            return back()->with('error', 'Uang kurang dari total.');
        }

        $transaction = Transaction::create([
            'user_id'   => Auth::id(),
            'total'     => $total,
            'pay_total' => $request->pay_total,
        ]);

        foreach ($carts as $cart) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'item_id'        => $cart->item_id,
                'quantity'       => $cart->quantity,
                'subtotal'       => $cart->item->price * $cart->quantity,
            ]);

            // Kurangi stok item
            $cart->item->decrement('stock', $cart->quantity);
        }

        // Kosongkan keranjang
        Cart::truncate();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil.');
    }
}
