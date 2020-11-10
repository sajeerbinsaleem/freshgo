<?php

namespace App\Http\Controllers\admin_panel;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sale;
use Illuminate\Support\Facades\Session;

class dashboardController extends Controller
{
    public function index(){
        return session()->all();
        $sales =  sale::all();
        return view('admin_panel.dashboard.index')
        ->with('sales',$sales);
    }
}
