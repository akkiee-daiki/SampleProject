<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン画面</title>
</head>
<body>
    <div class="container">
        <form action="{{ route('login.authenticate') }}" method="post">
            @csrf
            <label for="email">メールアドレス：</label>
            <input type="text" name="email">
            <label for="password">パスワード：</label>
            <input type="password" name="password">
            <button type="submit">ログイン</button>
        </form>
    </div>
</body>
</html>
