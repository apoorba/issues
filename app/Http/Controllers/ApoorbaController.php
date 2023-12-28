<?php

namespace App\Http\Controllers;

use App\Models\Apoorba;
use Illuminate\Http\Request;

class ApoorbaController extends Controller
{
    //
    public function view(Request $request){
       $data = Apoorba::all();
       return response()->json($data);
    }
}
