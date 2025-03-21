<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to TestProject';
        return view('pages.index', compact('title'));
    }
    public function about(){
        $title = 'You are on : About Page';
        return view('pages.about')->with('title', $title);
    }
    public function services(){

        $data = array(
            "title" => 'You are on : Services Page',
            "services" => ["UI/UX", "Website Design", "Social Media Marketing"]
        );
        
        return view('pages.services')->with($data);
    }
}
