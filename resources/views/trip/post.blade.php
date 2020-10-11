@extends('layouts.app')

@section('content')
{{-- ページタイトル --}}
<div class="container">
    
    <h1 class="text-center border-bottom border-primary">〜 新規投稿 〜</h1>
    
    {{-- エラー内容表示 --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="/post/create" method="post" enctype="multipart/form-data">
        
        {{-- セキュリティ対策 --}}
        @csrf　
        
        {{-- 場所のセレクトボックス --}}
        <div class="form-group">
            <label for="locals">場所</label>
            <select id="locals" class="form-control" name="locals">
                <option selected>場所を選択</option>
                @foreach(config('pref') as $index => $name)
                <option>{{$name}}</option>
                @endforeach
            </select>
        </div>
        
        {{-- ジャンルのセレクトボックス --}}
        <div class="form-group">
            <label for="genres">ジャンル</label>
            <select id="genres" class="form-control" name="genres">
                <option selected>ジャンルを選択</option>
                <option>観光</option>
                <option>芸術観賞</option>
                <option>体験</option>
                <option>アクティブ</option>
                <option>グルメ</option>
                <option>温泉　宿z</option>
                <option>...</option>
            </select>
        </div>
        
        {{-- コスト --}}
        <div class="form-group">
            <label for="cost">予算</label>
            <input class="form-control" type="number" name="cost" placeholder="予算" id="cost">
        </div>
        
        {{-- 投稿内容のタイトル --}}
        <div class="form-group">
            <label for="title">タイトル</label>
            <input class="form-control" type="text" name="title" placeholder="タイトル" id="title">
        </div>
        
        {{-- 写真投稿toukou --}}
        <div class="form-group">
            <label for="image">画像</label>
            <input
            type="file"
            name="image"
            class="form-control-file"
            accept="image/*"
            id="image"
            onChange="imgPreview(event, 'preview')"
            />
        </div>
        <div id="preview"></div>

        {{-- 投稿内容 --}}
        <div class="form-group">
            <label for="content">投稿内容</label>
            <textarea class="form-control" cols="50" rows="5" name="content" placeholder="投稿内容" id="content"></textarea>
        </div>
        <div><button class=" btn btn-outline-primary">投稿</button></div>
    </form>
</div>

<script>
    function imgPreview(event, id) {
        let file = event.target.files[0];
        let reader = new FileReader();
        let preview = document.getElementById(id);

        // すでにプレビュー画像がある場合
        if (preview.lastElementChild) {
          // プレビュー画像を削除
          preview.lastElementChild.remove();
        }

        reader.onload = function(event) {
          let img = document.createElement("img");
          img.setAttribute("src", reader.result);
          img.setAttribute("class", "preview-img");
          preview.appendChild(img);
        };

        reader.readAsDataURL(file);
    }
</script>
    @endsection