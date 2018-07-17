<?php 
namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;

class NoticeController extends Controller
{
	public function index()
	{
		return view('admin/notice/notice');
	}
}