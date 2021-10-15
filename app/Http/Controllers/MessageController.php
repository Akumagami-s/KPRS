<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Events\SendGlobalNotification;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('push.index');
    }

    public function __construct()
    {
       $this->middleware('auth');
    }

    public function post(Request $request)
    {
        event(new SendGlobalNotification(Auth::user(), $request->get('message')));
    }

}
