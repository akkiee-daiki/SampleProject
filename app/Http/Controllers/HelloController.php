<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller {
    public function index(Request $request) {
        $a = DB::table('test')->get();
        var_dump($a);
        return view('sample')->with(['array' => $a ?? []]);
    }

    public function getDataAsync() {
        $asyncData = DB::table('test')->get();
        return $asyncData;
    }
}
