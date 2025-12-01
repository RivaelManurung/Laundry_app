<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;

class FinanceController extends Controller
{
    public function cashFlow()
    {
        $finances = Finance::latest()->get();
        return view('finance.cash-flow', compact('finances'));
    }
}
