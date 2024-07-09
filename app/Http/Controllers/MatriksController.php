<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatriksController extends Controller
{
    public function index()
    {
        return view('matriks');
    }

    public function index2(Request $request)
    {
        return view('matrix');
    }
}
