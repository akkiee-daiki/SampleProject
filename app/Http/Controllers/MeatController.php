<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeatRequest;
use App\Repository\MeatRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function create(Request $request) {
        $itemList = [
            '1' => 'animal',
            '2' => 'cooking',
            '3' => 'part'
        ];
        return view('meat.create')->with([
            'itemList' => $itemList
        ]);
    }

    public function create_confirm(Request $request) {
        $input = $request->only([
            'cond'
        ]);

        $meatReq = new MeatRequest();
        $validator = Validator::make($input, $meatReq->rules(), $meatReq->messages(), $meatReq->attributes());
        if ($validator->fails()) {
            return redirect()
                ->route('meat.create')
                ->withErrors($validator)
                ->withInput($input);
        }


        $itemList = [
            '1' => 'animal',
            '2' => 'cooking',
            '3' => 'part'
        ];
        $input = $request->except(['_token']);
        dd($input);
        return view('meat.create_confirm');
    }

    public function getSelects(Request $request) {
        $input = $request->only([
            'itemId'
        ]);

        if ($input['itemId'] === '1') {
            $selects = ['1' => 'aa', '2' => 'bb', '3' => 'cc'];
        } elseif ($input['itemId'] === '2') {
            $selects =  ['p' => 'pp', 'q' => 'qq', 'r' => 'RR'];
        } elseif ($input['itemId'] === '3') {
            $selects = ['x' => 'xxx', 'y' => 'yyy', 'z' => 'zzz'];
        } else {
            $selects = [];
        }
        return response()->json(['selects' => $selects]);
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
