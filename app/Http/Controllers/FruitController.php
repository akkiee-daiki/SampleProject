<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitRequest;
use App\Repository\FruitRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FruitController extends Controller
{
    private $fruitRepository;

    public function __construct(FruitRepository $fruitRepository) {
        $this->fruitRepository = $fruitRepository;
    }

    /**
     * 一覧画面
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $list = $this->fruitRepository->getList();

        return view('fruit.index')->with([
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

            $list = $this->fruitRepository->geCsvData();

            $head = [
                '人ID',
                '名前',
                '果物',
                '品種',
                '色',
                'メモ'
            ];

            fputcsv($stream, $head);
            foreach ($list as $row) {
                fputcsv($stream, [
                    $row->fruit_lover_id,
                    $row->fruit_lover_name,
                    $row->fruit_name,
                    $row->fruit_breed_name,
                    $row->fruit_breed_color,
                    $row->fruit_lover_memo
                ]);
            }
            fclose($stream);
        });

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="fruit_lover.csv"');

        return $response;
    }

    /**
     * 入力画面
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        $fruits = $this->fruitRepository->getFruits();
        return view('fruit.create')->with([
            'fruits' => $fruits
        ]);
    }

    /**
     * 果物の存在チェック
     * @return
     */
    public function checkFruit() {
        return true;
    }

    /**
     * 品種の取得
     * @param FruitRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_breed(Request $request) {
        $input = $request->except('_token');

//        if (!$this->checkFruit()) {
//        }
        $breeds = $this->fruitRepository->getBreeds($input);
        return response()->json(['breeds' => $breeds]);
    }

    /**
     * データ登録
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $input = $request->except(['_token']);
        $input['breeds'] = $this->fruitRepository->getBreeds($input);

        $fruitReq = new FruitRequest();
        $validator = Validator::make($input, $fruitReq->rules(), $fruitReq->messages(), $fruitReq->attributes());
        if ($validator->fails()) {
            return redirect()
                ->route('fruit.create')
                ->withErrors($validator)
                ->withInput($input);
        }

        if (!$this->fruitRepository->insertRow($input)) {
            abort(500);
        }

        return redirect()->route('fruit.index');
    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }


}
