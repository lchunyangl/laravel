<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function nav()
    {
        return view('nav');
    }

    public function main()
    {
        return view('main');
    }
}
