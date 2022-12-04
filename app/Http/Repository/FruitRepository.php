<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class FruitRepository {

    public function getFruits() {
        return DB::table('fruit')
            ->select('fruit_id', 'name')
            ->get();
    }

    public function getBreeds($fruitId) {
        $query =  DB::table('fruit_breed')
            ->select('breed_id', 'name')
            ->where('fruit_id', '=', $fruitId)
            ->get();
        $list = [];
        foreach ($query as $v) {
            $list['breed_id'] = $v->breed_id;
            $list['name'] = $v->name;
        }
        return $list;

    }
}
