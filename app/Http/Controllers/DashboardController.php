<?php

namespace App\Http\Controllers;

use App\Http\Models\Pixel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		return view('admin.index');
	}

	public function getData($action, Request $request)
	{
		return $this->{$action}($request);
	}

	protected function getPixelQty()
	{
		return  Pixel::count();
	}
}
