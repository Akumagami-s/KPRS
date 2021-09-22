<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detailkpr;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class RekapanbtnController extends Controller
{
    public function index(){
        dd('ada');

       // $rekapbtn = Detailkpr::where('status', 3)->get()
        //->all();
        //return response()->json([
          // 'rekapan.index' => $rekapbtn
        //]);
    }
}
