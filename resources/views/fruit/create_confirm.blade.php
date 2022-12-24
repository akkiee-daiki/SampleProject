<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>果物好きの人の登録</title>　
</head>
<body>
<h1>果物好き確認</h1>
<label for="name">名前</label>
<p>田中太郎</p>
<label for="fruitId">果物</label>
<p>りんご</p>
<label for="breedId">品種</label>
<p>サンつがる</p>
<label for="memo">メモ</label>
<p>メモ内容</p>
<div class="btn_container">
    <form action="" method="post" id="js-fruitConfirm">
        <button type="button">一覧画面に戻る</button>
        <button type="button" id="js-RegisterFruitPerson">登録</button>
    </form>
</div>

<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    $('#js-RegisterFruitPerson').on('click', function (){
        $('#js-fruitConfirm').attr('action', '{{ route("fruit.store") }}').submit();
    });
</script>
</body>
</html>
