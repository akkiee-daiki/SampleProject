<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller {
    /**
     * show top page
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        var_dump($request->all());
        $a = DB::table('test')->get();
        return view('sample')->with(['array' => $a ?? []]);
    }

    /**
     * set first pulldown options when clicked 'ajax button'.
     * @return \Illuminate\Support\Collection
     */
    public function getDataAsync() {
        $asyncData = DB::table('test')->get();
        return $asyncData;
    }

    /**
     * set second pulldown options when selected first pulldown.
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getDataAsyncDetail(Request $request) {
        // get data from ajax
        $parentId = $request->input('parentId');
        $outputData = DB::table('test2')
            ->where('test1_id', '=', $parentId)
            ->get();
        return $outputData;
    }
}
