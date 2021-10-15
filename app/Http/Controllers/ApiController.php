<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Detailkpr;
class ApiController extends Controller
{
    public function dataKpr($status)
    {

        if ($status == 0) {
            $data = DB::table('kpr')->where('status',0)->paginate(15);
        }elseif ($status == 1) {
            $data = DB::table('kpr')->where('status',1)->paginate(15);
        }elseif ($status == 2) {
            $data = DB::table('kpr')->where('status',2)->paginate(15);
        }elseif ($status == 3) {
            $data = DB::table('kpr')->where('status',3)->paginate(15);
        }elseif ($status == 4) {
            $data = DB::table('kpr')->where('status',4)->paginate(15);
        }elseif ($status == 5) {
            $data = DB::table('kpr')->where('status',5)->paginate(15);
        }elseif ($status == "all") {
            $data = DB::table('kpr')->paginate(15);
        }else{
            $data = ["Tidak ada yang sesuai dengan parameter ini"];
        }


        return response()->json(['data'=>$data], 200);
    }

    public function index()
    {
        $rum = DB::table('rumah')->get();

        return view('kpr.index',['rumah'=>$rum]);
    }


    public function detail($id)
    {
        $rum = DB::table('rumah')->where('id',$id)->first();

        return view('kpr.detail',['rumah'=>$rum]);
    }
}
