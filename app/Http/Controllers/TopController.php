<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $page_name = 'Top';
        return view('tops.index', ['page_name' => $page_name]);
    }
}
