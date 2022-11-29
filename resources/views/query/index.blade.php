<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>クエリビルダ関連</title>
</head>
<body>
    <h1>DBの学習</h1>
    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>日本語</th>
                <th>出身</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vegetablesList as $index => $vegetableInfo)
                <tr>
                    <td>{{ $vegetableInfo->vegetable_id }}</td>
                    <td>{{ $vegetableInfo->name }}</td>
                    <td>{{ $vegetableInfo->color }}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" id="button1" value="button1" onclick="{{ route('query.index') }}">fafa</button>
    <form method="post" action="{{ route('topics.index') }}" id="form">
        @csrf
        <input type="text" value="aaaa" name="over">
        <input type="text" name="abcd">
        <input type="button" name="btn" id="btn" value="提出">
    </form>


{{--        モーダル部分--}}
            <div id="div1" style="display: none; background-color: #003eff;">
                <p>message</p>
            </div>


    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script>
        $('#btn').click(function() {
            $('#div1').dialog({
                modal: true,
                title: 'テストダイアログ',
                buttons: {
                    'ok': function() {
                        $(this).dialog('close');
                        $('#form').submit();
                    },
                    'いいえ': function() {
                        $(this).dialog('close');
                    }
                }
            });
        });
    </script>
</body>
</html>
