<?php 
namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;

class TopicController extends Controller
{
	public function index()
	{
		return view('admin/topic/topic');	
	}
}
