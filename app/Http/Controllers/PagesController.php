<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function contact()
    {
    	$header="To jest nagłowek strony kontakt";
    	$data=date('y-m-d');
    	$wizyty=324;
    	return view('pages.contact',compact('header','data','wizyty'));
    }
    public function about()
    {
    	return view('pages.about');
    }
}
