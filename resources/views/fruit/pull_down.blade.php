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
    <h1>DBを使ってプルダウンを表示させる</h1>
    <div id="js-narrowSearchContainer">
        <div class="pull_down_row js-pullDownRow">
            <button type="button" class="add_narrow_search js-addNarrowSearch">+</button>
            <div class="narrowSearchDiv js-narrowSearchDiv">
                <select name="narrowSearch" class="narrowSearch">
                    <option value="">選択してください</option>
                    @foreach($narrowSearchList as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>



<script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script>
    {{-- プルダウン追加 --}}
    $('.js-addNarrowSearch').on('click', function (){
        console.log($(this).text());
        $(this).parent().find('.js-narrowSearchDiv').show();

        $(this).text('-');
        $(this).addClass('js-deleteSearch').removeClass('js-addNarrowSearch');

        let html = '';
        html += '<div class="pull_down_row js-pullDownRow">';
        html +=     '<button type="button" class="add_narrow_search js-addNarrowSearch">+</button>';
        html += '   <div class="narrowSearchDiv js-narrowSearchDiv">';
        html += '       <select name="narrowSearch" class="narrowSearch">';
        html += '           <option value="">選択してください</option>';
        @foreach($narrowSearchList as $k => $v)
            html += '<option value="{{ $k }}">{{ $v }}</option>';
        @endforeach
        html += '       </select>';
        html += '   </div>';
        html += '</div>';

        $('#js-narrowSearchContainer').append(html);
    });

    {{-- プルダウン削除 --}}
    $('.js-deleteSearch').on('click', function (){
        $(this).parent();
    });
</script>
</body>
</html>
