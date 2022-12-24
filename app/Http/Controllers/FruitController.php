<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitRequest;
use App\Repository\FruitRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FruitController extends Controller
{
    private $fruitRepository;

    public function __construct(FruitRepository $fruitRepository) {
        $this->fruitRepository = $fruitRepository;
    }

    public function index() {
        $fruits = $this->fruitRepository->getFruits();
        $list = [];
        return view('fruit.index')->with([
            'fruits' => $fruits
        ]);
    }

    public function create() {
        $fruits = $this->fruitRepository->getFruits();
        return view('fruit.create')->with([
            'fruits' => $fruits
        ]);
    }

    /**
     * プルダウンで選択されたフルーツがDBに存在するか確認
     * @return
     */
    public function checkFruit() {
        return true;
    }

    /**
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
