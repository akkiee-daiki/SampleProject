<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class MeatRepository {

    /**
     * 一覧表示
     * @return \Illuminate\Support\Collection
     */
    public function getList() {
        return DB::table('meat_view')
            ->select(
                'meat_animal_name',
                'meat_part_name',
                'meat_cooking_name',
                'country',
                'memo'
            )
            ->get();
    }

    /**
     * 一覧取得（条件つけるかも）
     * @return \Illuminate\Support\Collection
     */
    public function getCsvData() {
        $list = DB::table('meat_view')
            ->select(
                'meat_animal_name',
                'meat_part_name',
                'meat_cooking_name',
                'country',
                'memo'
            )
            ->get();

        return $list;
    }
}
