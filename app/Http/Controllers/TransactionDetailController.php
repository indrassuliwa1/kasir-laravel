<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function index()
    {
        $details = TransactionDetail::with(['item', 'transaction'])->get();
        return view('transaction_details.index', compact('details'));
    }
}
