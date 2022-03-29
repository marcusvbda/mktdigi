<?php

namespace App\Http\Controllers;

use App\Http\Models\Pixel;
use App\Http\Models\ShortUrlClick;
use App\Http\Resources\Pixels;
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
		$query = Pixel::where("id", ">", 0);
		$todayCount = ((new Pixels)->getPresetDateFilter())->apply($query, 'hoje')->count();
		return  [Pixel::count(), $todayCount];
	}

	protected function getClickQty()
	{
		$query = ShortUrlClick::where("id", ">", 0);
		$todayCount = ((new Pixels)->getPresetDateFilter())->apply($query, 'hoje')->count();
		return  [ShortUrlClick::count(), $todayCount];
	}
}
