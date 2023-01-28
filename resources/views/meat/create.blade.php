<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>肉好きの人の登録</title>　
</head>
<body>
<h1>肉好き入力</h1>
<form action="" method="post" id="js-form">
    @csrf
    <div class="row" style="padding: 30px">
        <label for="cond[0][tgtA]">項目</label>
        <select name="cond[0][tgtA]" class="js-itemSelectBox">
            <option value="" selected>選択してください</option>
            @foreach($itemList as $key => $value)
                <option value="{{ $key }}" @if((old('itemId') ?? '') === (string)$key) selected @endif>{{ $value }}</option>
            @endforeach
        </select>

        <label for="cond[0][tgtB]">絞り込み</label>
        <select name="cond[0][tgtB]" class="js-search">
            <option value="" selected>選択してください</option>
        </select>
    </div>

    <div class="row" style="padding: 30px">
        <label for="cond[1][tgtA]">項目</label>
        <select name="cond[1][tgtA]" class="js-itemSelectBox">
            <option value="" selected>選択してください</option>
            @foreach($itemList as $key => $value)
                <option value="{{ $key }}" @if((old('itemId') ?? '') === (string)$key) selected @endif>{{ $value }}</option>
            @endforeach
        </select>

        <label for="cond[1][tgtB]">絞り込み</label>
        <select name="cond[1][tgtB]" class="js-search">
            <option value="" selected>選択してください</option>
        </select>
    </div>


    <button type="button" id="js-submit">確認画面へ</button>

</form>
<div class="btn_container">
    <button onclick="location.href='{{ route('meat.index') }}' ">一覧画面に戻る</button>
</div>

<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    $('.js-itemSelectBox').on('change', function() {
        let itemId = $(this).val();
        console.log(itemId);
        $.ajax({
            type: 'POST',
            url: '{{ route("meat.get_selects") }}',
            dataType: 'json',
            data: { 'itemId': itemId },
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
        }).done((d) => {
            $(this).parent().find('.js-search').empty();
            let html = '';

            html +=  '<option value="" selected>選択してください</option>';
            $.each(d.selects, function(index, value) {
                html += '<option value="' + index +  '">' + value + '</option>';
            });

            $(this).parent().find('.js-search').append(html);


        }).fail((error) => {
            alert('エラーが発生しました。やり直してください');
        });
    });

    $('#js-submit').on('click', function (){
        $('#js-form').attr('action', '{{ route("meat.create_confirm") }}').submit();
    });

</script>
</body>
</html>
