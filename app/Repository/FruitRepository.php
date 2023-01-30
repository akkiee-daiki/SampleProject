<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FruitRepository {

    /**
     * 一覧表示
     * @return \Illuminate\Support\Collection
     */
    public function getList() {
        $list = DB::table('fruit_lover')
            ->select(
                'fruit_lover.fruit_lover_id',
                'fruit_lover.name AS fruit_lover_name',
                'fruit.name AS fruit_name',
                'fruit_breed.name AS fruit_breed_name',
                'fruit_breed.color AS fruit_breed_color',
                'fruit_lover.memo AS fruit_lover_memo'
            )
            ->join('fruit', function ($join) {
                $join->on('fruit_lover.fruit_id', '=', 'fruit.fruit_id')
                    ->whereNull('fruit.deleted_at');
            })
            ->join('fruit_breed', function ($join) {
                $join->on('fruit_lover.breed_id', '=', 'fruit_breed.breed_id')
                    ->whereNull('fruit_breed.deleted_at');
            })
            ->whereNull('fruit_lover.deleted_at')
            ->get();

        return $list;
    }

    /**
     * 一覧全情報取得
     * @return \Illuminate\Support\Collection
     */
    public function geCsvData($input) {

        $list = DB::table('fruit_lover')
            ->select(
                'fruit_lover.fruit_lover_id',
                'fruit_lover.name AS fruit_lover_name',
                'fruit.name AS fruit_name',
                'fruit_breed.name AS fruit_breed_name',
                'fruit_breed.color AS fruit_breed_color',
                'fruit_lover.memo AS fruit_lover_memo'
            )
            ->join('fruit', function ($join) {
                $join->on('fruit_lover.fruit_id', '=', 'fruit.fruit_id')
                    ->whereNull('fruit.deleted_at');
            })
            ->join('fruit_breed', function ($join) {
                $join->on('fruit_lover.breed_id', '=', 'fruit_breed.breed_id')
                    ->whereNull('fruit_breed.deleted_at');
            })
            ->whereNull('fruit_lover.deleted_at')
            ->whereIn('fruit_lover.fruit_lover_id', $input['fruit_lover_id'])
            ->get();

        return $list;
    }

    /**
     * 果物の取得（複数）
     * @return \Illuminate\Support\Collection
     */
    public function getFruits() {

        return DB::table('fruit')
            ->select('fruit_id', 'name')
            ->get();
    }

    /**
     * 品種の取得（複数）
     * @param array $input
     * @return array
     */
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

    /**
     * フルーツ好きのデータの登録
     * @param array $input
     * @return bool
     */
    public function insertRow($input) {

        DB::beginTransaction();
        try {

            DB::table('fruit_lover')->insert([
                'name' => $input['name'],
                'fruit_id' => $input['fruitId'],
                'breed_id' => $input['breedId'],
                'memo' => $input['memo'] ?? '',
                'product_area' => $input['product_area'] ?? null
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {

            DB::rollBack();
            return false;
        }

    }
}
