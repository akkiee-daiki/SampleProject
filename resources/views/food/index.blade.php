<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
    <title>multiple Selectの練習</title>　
</head>
<body>
<h1>multiplelistリスト</h1>
<div class="food_list_container">
    <select id="js-select1" name="select2" multiple required>
        <option value="1">First</option>
        <option value="2">Second</option>
        <option value="3">Third</option>
        <option value="4">Fourth</option>
        </select>
    </select>
    <form action="" method="post" id="js-loverList">
        @csrf

        <div class="form-group row js-pullDownRow">
            <label class="col-sm-2">
                Multiple Select
            </label>
            <select name="narrow" id="js-narrowSelect">
                <option value="1">Arteta</option>
                <option value="2">Pep</option>
                <option value="3">Krop</option>
            </select>

        </div>

        <div class="btn_container">
            <button type="button" id="js-export">エクスポート</button>
        </div>
    </form>
</div>
<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('/js/multiple-select.js') }}"></script>
<script>
    $(document).$('#js-select1').multipleSelect();
    $('#js-narrowSelect').on('change', function () {
        let html = '';
        html += '<select id="js-select1" name="select2" multiple required>';
        html += '<option value="1">First</option>';
        html += '<option value="2">Second</option>';
        html += '<option value="3">Third</option>';
        html += '<option value="4">Fourth</option>';
        html += '</select>';

        $(this).parent().append(html);

    });
    $('#js-export').on('click', function () {
        $('#js-loverList').attr('action', '{{ route('fruit.export_csv') }}').submit();


    });
</script>
</body>
</html>
