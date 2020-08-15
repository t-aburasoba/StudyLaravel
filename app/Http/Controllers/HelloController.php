<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HelloRequest;

class HelloController extends Controller
{
    public function index()
    {
        return view('hello');
    }

    public function show($id)
    {
        return view('test', compact('id'));
    }

    public function post(Request $request)
    {
        $msg  = $request->msg;
        $msg2 = $request->msg2;
        return view('msg', compact('msg', 'msg2'));
    }
}
