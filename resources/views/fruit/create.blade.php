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
<h1>果物リスト</h1>

<form action="" method="post" id="js-fruitForm">
    @csrf
    <label for="name">名前</label>
    <input type="text" name="name" maxlength="255">
    @error('name')
        <p class="error_message">{{ $message }}</p>
    @enderror
    <label for="fruitId">果物</label>
    <select name="fruitId" id="js-fruitSelectBox">
        <option value="" selected>選択してください</option>
        @foreach($fruits as $fruit)
            <option value="{{ $fruit->fruit_id }}">{{ $fruit->name }}</option>
        @endforeach
    </select>
    @error('fruitId')
        <p class="error_message">{{ $message }}</p>
    @enderror
    <label for="breedId">品種</label>
    <select name="breedId" id="js-breedSelectBox">
        <option value="">-</option>
    </select>
    @error('breedId')
        <p class="error_message">{{ $message }}</p>
    @enderror
    <label for="memo">メモ</label>
    <textarea name="memo" cols="30" rows="1" maxlength="255"></textarea>
    @error('memo')
        <p class="error_message">{{ $message }}</p>
    @enderror
    <button type="button" id="js-RegisterFruitPerson">登録</button>
</form>
<div class="btn_container">
    <button onclick="location.href='{{ route('fruit.index') }}' ">一覧画面に戻る</button>
</div>

<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    $('#js-fruitSelectBox').on('change', function() {
        let fruitId = $(this).val();
        console.log(fruitId);
        $.ajax({
            type: 'POST',
            url: '{{ route("fruit.get_breed") }}',
            dataType: 'json',
            data: { 'fruitId': fruitId },
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
        }).done((d) => {
            $('#js-breedSelectBox').empty();
            let html = '';
            if (Object.keys(d.breeds).length > 0) {
                html +=  '<option value="" selected>選択してください</option>';
                $.each(d.breeds, function(index, value) {
                    html += '<option value="' + value.breed_id +  '">' + value.name + '</option>';
                });
            } else {
                html += '<option value="">-</option>';
            }
            $('#js-breedSelectBox').append(html);


        }).fail((error) => {
            alert('エラーが発生しました。やり直してください');
            });
    });

    $('#js-RegisterFruitPerson').on('click', function (){
       $('#js-fruitForm').attr('action', '{{ route("fruit.store") }}').submit();
    });

</script>
</body>
</html>
