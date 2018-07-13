<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function show()
    {
    	return view('notice/show');
    }
}
