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
<h1>肉確認</h1>
<div class="btn_container">
    <form action="" method="post" id="js-fruitConfirm">
        <button type="button">一覧画面に戻る</button>
        <button type="button" id="js-RegisterFruitPerson">登録</button>
    </form>
</div>

<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    {{--$('#js-RegisterFruitPerson').on('click', function (){--}}
    {{--    $('#js-fruitConfirm').attr('action', '{{ route("meat.create_confirm") }}').submit();--}}
    {{--});--}}
</script>
</body>
</html>
