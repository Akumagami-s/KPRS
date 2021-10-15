<?php

namespace App\Http\Controllers\User;

use App\Detailkpr;
use App\Http\Controllers\Controller;

class RegisterUser extends Controller
{
    public function index()
    {
        $pangkats = Detailkpr::select('pangkat')->groupBy('pangkat')->get()->toArray();
        $pangkat = array_values(array_filter($pangkats, 'array_filter'));
        
        return view('auth.register', compact('pangkat'));
    }

}
