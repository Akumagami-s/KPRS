<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PositionController extends Controller
{
    public function index(Request $request)
    {


        return view('locate.index');
    }

    function categorySearch($lat,$lon,$cat,$rad)
    {   
    // {https://api.tomtom.com/search/2/poiSearch/Residential%20Estate.json?lat=-6.656400218590892&lon=106.8198985712469&radius=5000&categorySet=7303004&key=*****
        $response = Http::get("https://api.tomtom.com/search/2/poiSearch/housing%20area.json?lat={-6.642802328577677}&lon=106.78393607648908&radius=3000&key=biSgAVxXP9cafi17oYztHXFFdnrybDj7");
        return response()->json(['res'=>$response->json()], 200);
    }
}
