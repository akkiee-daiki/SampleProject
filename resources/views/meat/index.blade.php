<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>肉料理の一覧</title>　
</head>
<body>
<h1>肉料理リスト</h1>
<div class="fruit_list_container">
    <form action="" method="post" id="js-loverList">
        @csrf

        <table>
            <tr>
                <th>料理名</th>
                <th>種類</th>
                <th>部位</th>
                <th>国</th>
                <th>メモ</th>
            </tr>
            @foreach($list ?? [] as $v)
                <tr>
                    <td>{{ $v->meat_cooking_name }}</td>
                    <td>{{ $v->meat_animal_name }}</td>
                    <td>{{ $v->meat_part_name }}</td>
                    <td>{{ $v->country }}</td>
                    <td>{{ $v->memo }}</td>
                </tr>
            @endforeach
        </table>
        <div class="btn_container">
            <button type="button" id="js-export">エクスポート</button>
{{--            <button onclick="location.href='{{ route('fruit.create') }}'">新規追加する</button>--}}
        </div>
    </form>
</div>
<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    $('#js-export').on('click', function () {
        $('#js-loverList').attr('action', '{{ route('meat.export_csv') }}').submit();
    });
</script>
</body>
</html>
