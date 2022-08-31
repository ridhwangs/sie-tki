<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'attribute' => Attribute::where('status', 3)->get(),
        ];
        return view('_dashboard.index', $data);
    }
}
