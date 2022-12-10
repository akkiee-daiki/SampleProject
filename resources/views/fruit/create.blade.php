<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>果物好きの人の登録</title>　
</head>
<body>
<h1>果物リスト</h1>
<form action="" method="post">
    @csrf
    <input type="text" name="name">
    <select name="fruit" id="js-fruitSelectBox">
        <option value="">選択してください</option>
        @foreach($fruits as $fruit)
            <option value="{{ $fruit->fruit_id }}">{{ $fruit->name }}</option>
        @endforeach
    </select>
    <select name="test2Name" id="js-breedSelectBox">
        <option value="">-</option>
    </select>
    <button type="button" id="js-RegisterFruitPerson">登録</button>
</form>

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
                html +=  '<option value="">選択してください</option>';
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

</script>
</body>
</html>
