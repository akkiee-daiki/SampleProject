<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryContrller extends Controller
{
    public function index(){
        $vegetableList = DB::table('vegetable')
            ->select('vegetable_id', 'name', 'color')
            ->get();

        return view('query.index')->with([
            'vegetablesList' => $vegetableList
        ]);
    }

//    public function create(Request $request) {
//        $input = $request->except(['_token']);
//        try {
//            DB::beginTransaction();
//
//            DB::table(' vegetable')->insert([
//                'name' =>
//            ]);
//
//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollBack();
//        }
//    }


    public function vegetableIndex(Request $request) {

        return view('query.vegetable');
    }

    public function store(Request $request) {

        $input = $request->except(['_token']);
        DB::table('vegetable')->insert([
            'name' => $input['name'],
            'color' => $input['color']
        ]);
//        dd($input);
//        try {
//            DB::beginTransaction();
//
//            DB::table(' vegetable')->insert([
//                'name' => $input['name'],
//                'color' => $input['color']
//            ]);
//
//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollBack();
//            $error_code = $e->getMessage();
//            var_dump($error_code);
//        }
        return redirect()
            ->route('query.vegetableIndex');
    }
}
