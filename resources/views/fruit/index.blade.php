<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>果物好きな人の一覧</title>　
</head>
<body>
<h1>果物好きリスト</h1>
<div class="fruit_list_container">
    <form action="" method="post" id="js-loverList">
        @csrf

        <table>
            <tr>
                <th class="id_th">人ID</th>
                <th>名前</th>
                <th>果物</th>
                <th>品種</th>
                <th>色</th>
                <th>メモ</th>
            </tr>
            @foreach($list ?? [] as $v)
                <tr>
                    <td>{{ $v->fruit_lover_id }}</td>
                    <td>{{ $v->fruit_lover_name }}</td>
                    <td>{{ $v->fruit_name }}</td>
                    <td>{{ $v->fruit_breed_name }}</td>
                    <td>{{ $v->fruit_breed_color }}</td>
                    <td>{{ $v->fruit_lover_memo }}</td>
                </tr>
            @endforeach
        </table>
        <div class="btn_container">
            <button type="button" id="js-export">エクスポート</button>
            <button onclick="location.href='{{ route('fruit.create') }}'">新規追加する</button>
        </div>
    </form>
</div>
<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    $('#js-export').on('click', function () {
       $('#js-loverList').attr('action', '{{ route('fruit.export_csv') }}').submit();
    });
</script>
</body>
</html>
