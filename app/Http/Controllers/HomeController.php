<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function default()
    {
        return view('default');
    }
}
