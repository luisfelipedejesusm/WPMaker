<?php

namespace Test\Http\Controllers;

use Test\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function preview()
    {
        $data = DB::table('page')->orderBy('id','desc')->first();
        $page = null;
        if($data)
            $page = base64_decode($data->page);
        return view('preview',compact('page'));
    }
    public function index()
    {
        $data = DB::table('page')->orderBy('id','desc')->first();
        $page = null;
        if($data)
        	$page = base64_decode($data->page);
        return view('index2',compact('page'));
    }
    public function save(Request $request)
    {
        DB::insert("insert into page (page) values(?)",[base64_encode($request->page)]);
        return response()->json(["message"=>"success"]);
    }
}
