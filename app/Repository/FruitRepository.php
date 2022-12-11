<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class FruitRepository {

    public function getFruits() {
        return DB::table('fruit')
            ->select('fruit_id', 'name')
            ->get();
    }

    public function getBreeds($input) {
        $query =  DB::table('fruit_breed')
            ->select('breed_id', 'name')
            ->where('fruit_id', '=', $input['fruitId'])
            ->get();
        $list = [];
        foreach ($query as $k => $v) {
            $list[$k]['breed_id'] = $v->breed_id;
            $list[$k]['name'] = $v->name;
        }
        return $list;

    }

    public function insertRow($input) {
        DB::beginTransaction();
        try {
            DB::table('fruit_lover')->insert([
                'name' => $input['name'],
                'fruit_id' => $input['fruitId'],
                'breed_id' => $input['breedId'],
                'memo' => $input['memo']
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }
}
