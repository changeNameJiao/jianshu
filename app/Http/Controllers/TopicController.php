<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show()
    {
    	return view('topic/show');
    }

    public function submit()
    {

    }
}
