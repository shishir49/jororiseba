<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;

class Main extends Controller
{
    public function frontPage(){
        return view('welcome');
    }

    public function dashboard() {
        $hospitals = Hospital::get();
        $hospital_number = count($hospitals);

        return response()->json($hospital_number, 200);
    }
}
