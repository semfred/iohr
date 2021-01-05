<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    protected $ips = [
        '119.93.126.150'
    ];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        var_dump($this->isValidIp(request()->ip()));

        return redirect()->route('web.dashboard.index');
    }

    protected function isValidIp($ip)
    {
        return in_array($ip, $this->ips);
    }
}
