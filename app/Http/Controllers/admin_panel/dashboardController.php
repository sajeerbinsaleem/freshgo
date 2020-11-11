<?php

namespace App\Http\Controllers\admin_panel;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sale;
use Illuminate\Support\Facades\Session;

class dashboardController extends Controller
{
    public function index(Request $request){
        $token = $request->token;
        $user = Admin::where('token',$token)->select('name','username')->first();
        $sales =  sale::all();
        return view('admin_panel.dashboard.index')
        ->with(['sales' => $sales, 'user' => $user]);
    }
}
