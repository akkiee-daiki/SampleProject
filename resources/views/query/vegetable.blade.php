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
    <form action="{{ route('query.store') }}" method="post">
        @csrf
        <label for="">名前</label>
        <input type="text" name="name">
        <label for="">色</label>
        <input type="text" name="color">
        <button type="submit">登録</button>
    </form>
</body>
</html>
