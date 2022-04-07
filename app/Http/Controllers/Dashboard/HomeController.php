<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_num  = Subscriber::all()->count();
        $active_num = Subscriber::where('status', 1)->count();
        $deactive_num = Subscriber::where('status', 0)->count();
        return view('home', compact('total_num', 'active_num', 'deactive_num'));
    }
}
