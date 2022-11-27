<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>連動プルダウンの練習</title>
</head>
<body>
    <h1>テスト用のページ</h1>
    <p>何かを作るわけでなく、色々な機能を試すためのページの一つ</p>
    <h2>ajaxの練習</h2>
    <h3>DBからプルダウンを作る</h3>
    <select name="array" id="">
        @foreach($array as $value)
            <option value="{{ $value->id }}">{{ $value->memo }}</option>
        @endforeach
    </select>
    <h3>配列から連動プルダウンを作る</h3>
    <h3>DBのデータから連動プルダウンを作る</h3>
    <button id="bt">ajaxボタン</button>
    <div class="ajax_container">

    </div>
    <script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
    <script>
        // うまく行かなかった↓
        // $("#bt").click(function () {
        //     $.ajax({
        //         type: "get", //HTTP通信の種類
        //         url: "/getDataAsync",
        //         dataType: "json",
        //     })
        //         //通信が成功したとき
        //         .done((res) => { // resの部分にコントローラーから返ってきた値 $users が入る
        //         $.each(res, function (getDataAsync, value) {
        //             html = `
        //                         <div="user-list">
        //                             <td class="col-xs-2">ユーザー名：${value.name}</td>
        //                         </div>
        //             `;
        //         $(".ajax_container").append(html); //できあがったテンプレートを user-tableクラスの中に追加
        //         });
        //         })
        //         //通信が失敗したとき
        //         .fail((error) => {
        //         console.log(error.statusText);
        //         })phpphp;
        // });

        $('#bt').click(function (){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'sample/getDataAsync/',
                dataType: 'json',
                data: {
                    uid: 100,
                    subject: 'テスト',
                    from: 'テストfrom',
                    body: 'テストbody',
                },
            })
                // 通信が成功したとき
                .then((res) => {
                    console.log(res);
                    $.each(res, function(index, value) {
                        html = '<p style="color: red">' + value.id + value.name + '</p>';
                        $('.ajax_container').append(html);
                    })

                })
                .fail((error) => {
                    console.log(error.statusText);
                })
        });
    </script>
</body>
</html>
