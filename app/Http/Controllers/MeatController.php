<?php

namespace App\Http\Controllers;

use App\Repository\MeatRepository;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MeatController extends Controller
{
    private $meatRepository;

    public function __construct(MeatRepository $meatRepository) {
        $this->meatRepository = $meatRepository;
    }

    /**
     * 一覧画面
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $list = $this->meatRepository->getList();

        return view('meat.index')->with([
            'list' => $list
        ]);
    }

    /**
     * csvファイル作成・ダウンロード
     * @return StreamedResponse
     */
    public function export_csv() {

        $response = new StreamedResponse(function () {
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            $list = $this->meatRepository->getCsvData();

            $head = [
                '料理名',
                '種類',
                '部位',
                '国',
                'メモ'
            ];

            fputcsv($stream, $head);
            foreach ($list as $row) {
                fputcsv($stream, [
                    $row->meat_cooking_name,
                    $row->meat_animal_name,
                    $row->meat_part_name,
                    $row->country,
                    $row->memo
                ]);
            }
            fclose($stream);
        });

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="meat_cooking.csv"');

        return $response;
    }
}
