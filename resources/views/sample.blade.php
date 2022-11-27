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
    <button id="bt">ajax button</button>
    <div class="ajax_container">
        <select name="testName" id="ajaxSelectBox1">
            <option value="">-</option>
        </select>
        <select name="test2Name" id="ajaxSelectBox2"></select>

    </div>
    <script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
    <script>
        $('#bt').click(function (){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // type: 'POST',
                type: 'GET',
                url: 'sample/getDataAsync/',
                dataType: 'json',
            })
            // 通信が成功したとき
            .then((res) => {
                $('#ajaxSelectBox1').empty();
                $('#ajaxSelectBox2').empty();
                $.each(res, function(index, value) {
                    html = '<option value="' + value.id +  '">' + value.name + '</option>'
                    $('#ajaxSelectBox1').append(html);
                })

            })
            .fail((error) => {
                console.log(error.statusText);
            })
        });

        $('#ajaxSelectBox1').change(function(){
            let parentId = $(this).val();
            console.log(parentId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // type: 'POST',
                type: "GET",
                url: 'sample/getDataAsyncDetail/',
                dataType: 'json',
                data: {
                    'parentId' : parentId
                },
            })
            .then((res) => {
                $('#ajaxSelectBox2').empty();
                $.each(res, function(index, value) {
                    html = '<option value="' + value.id + '">' + value.name + '</option>'
                    $('#ajaxSelectBox2').append(html);
               })
            })
            .fail((error) => {
                console.log(error.statusText);
            })
        });
    </script>
</body>
</html>
