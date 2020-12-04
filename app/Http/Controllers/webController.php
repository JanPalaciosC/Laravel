<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class webController extends Controller
{
    public function contact()
    {
    	$name = 'Sergio';
    	$lastname = 'Rojas';
    	$parrafo = 'No me funciona el lorem';
    	return view('contact', compact('name', 'lastname', 'parrafo'));
    }
}
