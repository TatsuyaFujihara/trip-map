{{-- 作成途中 --}}
@extends('layouts.app')

@section('content')

  {{-- ⭐️お気に入りの投稿 --}}
  <div class="title-box mt-5">
    <h3 class="ml-3 mb-3">〜⭐️お気に入りの投稿〜</h3>
    <a href="/trip/myfavorite" class="Everyone">お気に入りの投稿を見る></a>
  </div>

  <div class="card-group">
    @foreach ($myfavorite as $favo)
      <div class="card">
        <a href="">
          @foreach($favo->images as $image) 
              <img class="mb-3" width="100%" height="180" src="{{Storage::disk('s3')->url($image->name)}}">
          @endforeach
            <div>
              <p class="card-text ml-3">場所 : {{$favo->trip->locals}}</p>
              <p class="card-text ml-3">ジャンル : {{$favo->trip->genres}}</p>
              <p class="card-text ml-3">コスト : {{$favo->trip->cost}}</p>
              <p class="card-text ml-3">{{$favo->trip->content}}</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </a>
      </div>
    @endforeach
    
  </div>


  {{-- 過去の投稿 --}}
  <div class="title-box mt-5">
    <h3 class="ml-3 mb-3">〜過去の投稿〜</h3>
    <a href="/trip/allmypost" class="Everyone">過去の投稿を見る></a>
  </div>
  
  <div class="card-group">
    
    @foreach ($trips as $trip)
      <div class="card">
        <a href="">
          @foreach($trip->images as $image) 
              <img class="mb-3" width="100%" height="180" src="{{Storage::disk('s3')->url($image->name)}}">
          @endforeach
            <div>
              <p class="card-text ml-3">場所 : {{$trip->locals}}</p>
              <p class="card-text ml-3">ジャンル : {{$trip->genres}}</p>
              <p class="card-text ml-3">コスト : {{$trip->cost}}</p>
              <p class="card-text ml-3">{{$trip->content}}</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </a>
      </div>
    @endforeach
    
  </div>

  {{-- 過去の旅行先　マップ表示 --}}
  <table id="clickable_map" cellspacing="1" class="ml-3 mt-3">
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('北海道', $map))
        <td colspan=2 id="hokkaido" class="char3">
          <a href="" class="hokkaido">北<br>海<br>道
            <input type="button" name="genre[]" autocomplete="off"/>
          </a>
        </td>
      @else
        <td colspan=2 id="hokkaido" class="char3"><a class="not_go">北<br>海<br>道</a></td>
      @endif
    </tr>
    <tr>
      <td id="dummy" colspan=13 style="height:2px; line-height:2px;"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('青森', $map))
      <td colspan=2 class="colspan_2"><a href=""　class="touhoku">青<br>森</a></td>
      @else
      <td colspan=2 class="colspan_2"><a class="not_go">青<br>森</a></td>
      @endif
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('秋田', $map))
      <td colspan=2><a href="" class="touhoku">秋<br>田</a></td>
      @else
      <td colspan=2><a class="not_go">秋<br>田</a></td>
      @endif
      @if (in_array('岩手', $map))
      <td colspan=2><a href="" class="touhoku">岩<br>手</a></td>
      @else
      <td colspan=2><a class="not_go">岩<br>手</a></td>
      @endif
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('石川', $map))
      <td rowspan=2 class="rowspan_2"><a href="" class="chubu">石<br>川</a></td>
      @else
      <td rowspan=2 class="rowspan_2"><a class="not_go">石<br>川</a></td>
      @endif
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('山形', $map))
      <td colspan=2 class="colspan_2"><a href="" class="touhoku">山<br>形</a></td>
      @else
      <td colspan=2 class="colspan_2"><a class="not_go">山<br>形</a></td>
      @endif
      @if (in_array('宮城', $map))
      <td colspan=2 class="colspan_2"><a href="" class="touhoku">宮<br>城</a></td>
      @else
      <td colspan=2 class="colspan_2"><a class="not_go">宮<br>城</a></td>
      @endif
    </tr>
    <tr>
      @if (in_array('沖縄', $map))
      <td><a href="" class="kyushu">沖<br>縄</a></td>
      @else
      <td><a class="not_go">沖<br>縄</a></td>
      @endif
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('富山', $map))
      <td><a href="" class="chubu">富<br>山</a></td>
      @else
      <td><a class="not_go">富<br>山</a></td>
      @endif
      @if (in_array('新潟', $map))
      <td colspan=2 class="colspan_2"><a href="" class="chubu">新<br>潟</a></td>
      @else
      <td colspan=2 class="colspan_2"><a class="not_go">新<br>潟</a></td>
      @endif
      @if (in_array('福島', $map))
      <td colspan=2 class="colspan_2"><a href="" class="touhoku">福<br>島</a></td>
      @else
      <td colspan=2 class="colspan_2"><a class="not_go">福<br>島</a></td>
      @endif
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('福井', $map))
      <td><a href="" class="chubu">福<br>井</a></td>
      @else
      <td><a class="not_go">福<br>井</a></td>
      @endif
      @if (in_array('岐阜', $map))
      <td rowspan=2 class="rowspan_2"><a href="" class="chubu">岐<br>阜</a></td>
      @else
      <td rowspan=2 class="rowspan_2"><a class="not_go">岐<br>阜</a></td>
      @endif
      @if (in_array('長野', $map))
      <td rowspan=2 class="rowspan_2"><a href="" class="chubu">長<br>野</a></td>
      @else
      <td rowspan=2 class="rowspan_2"><a class="not_go">長<br>野</a></td>
      @endif
      @if (in_array('群馬', $map))
      <td><a href="" class="kantou">群<br>馬</a></td>
      @else
      <td><a class="not_go">群<br>馬</a></td>
      @endif
      @if (in_array('栃木', $map))
      <td><a href="" class="kantou">栃<br>木</a></td>
      @else
      <td><a class="not_go">栃<br>木</a></td>
      @endif
      @if (in_array('茨城', $map))
      <td><a href="" class="kantou">茨<br>城</a></td>
      @else
      <td><a class="not_go">茨<br>城</a></td>
      @endif
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('島根', $map))
      <td><a href="" class="chugoku">島<br>根</a></td>
      @else
      <td><a class="not_go">島<br>根</a></td>
      @endif
      @if (in_array('鳥取', $map))
      <td><a href="" class="chugoku">鳥<br>取</a></td>
      @else
      <td><a class="not_go">鳥<br>取</a></td>
      @endif
      @if (in_array('兵庫', $map))
      <td rowspan=2 class="rowspan_2"><a href="" class="kinki">兵<br>庫</a></td>
      @else
      <td rowspan=2 class="rowspan_2"><a class="not_go">兵<br>庫</a></td>
      @endif
      @if (in_array('京都', $map))
      <td><a href="" class="kinki">京<br>都</a></td>
      @else
      <td><a class="not_go">京<br>都</a></td>
      @endif
      @if (in_array('滋賀', $map))
      <td><a href="" class="kinki">滋<br>賀</a></td>
      @else
      <td><a class="not_go">滋<br>賀</a></td>
      @endif
      @if (in_array('山梨', $map))
      <td><a href="" class="chubu">山<br>梨</a></td>
      @else
      <td><a class="not_go">山<br>梨</a></td>
      @endif
      @if (in_array('埼玉', $map))
      <td><a href="" class="kantou">埼<br>玉</a></td>
      @else
      <td><a class="not_go">埼<br>玉</a></td>
      @endif
      @if (in_array('千葉', $map))
      <td rowspan=2 class="rowspan_2"><a href="" class="kantou">千<br>葉</a></td>
      @else
      <td rowspan=2 class="rowspan_2"><a class="not_go">千<br>葉</a></td>
      @endif
    </tr>
    <tr>
      @if (in_array('佐賀', $map))
      <td><a href="" class="kyushu">佐<br>賀</a></td>
      @else
      <td><a class="not_go">佐<br>賀</a></td>
      @endif
      @if (in_array('福岡', $map))
      <td><a href="" class="kyushu">福<br>岡</a></td>
      @else
      <td><a class="not_go">福<br>岡</a></td>
      @endif
      @if (in_array('山口', $map))
      <td><a href="" class="chugoku">山<br>口</a></td>
      @else
      <td><a class="not_go">山<br>口</a></td>
      @endif
      @if (in_array('広島', $map))
      <td><a href="" class="chugoku">広<br>島</a></td>
      @else
      <td><a class="not_go">広<br>島</a></td>
      @endif
      @if (in_array('岡山', $map))
      <td><a href="" class="chugoku">岡<br>山</a></td>
      @else
      <td><a class="not_go">岡<br>山</a></td>
      @endif
      @if (in_array('大阪', $map))
      <td><a href="" class="kinki">大<br>阪</a></td>
      @else
      <td><a class="not_go">大<br>阪</a></td>
      @endif
      @if (in_array('奈良', $map))
      <td><a href="" class="kinki">奈<br>良</a></td>
      @else
      <td><a class="not_go">奈<br>良</a></td>
      @endif
      @if (in_array('愛知', $map))
      <td><a href="" class="chubu">愛<br>知</a></td>
      @else
      <td><a class="not_go">愛<br>知</a></td>
      @endif
      @if (in_array('静岡', $map))
      <td><a href="" class="chubu">静<br>岡</a></td>
      @else
      <td><a class="not_go">静<br>岡</a></td>
      @endif
      @if (in_array('神奈川', $map))
      <td class="char3"><a href="" class="kantou">神<br>奈<br>川</a></td>
      @else
      <td class="char3"><a class="not_go">神<br>奈<br>川</a></td>
      @endif
      @if (in_array('東京', $map))
      <td><a href="" class="kantou">東<br>京</a></td>
      @else
      <td><a class="not_go">東<br>京</a></td>
      @endif
    </tr>
    <tr>
      @if (in_array('長崎', $map))
      <td><a href="" class="kyushu">長<br>崎</a></td>
      @else
      <td><a class="not_go">長<br>崎</a></td>
      @endif
      @if (in_array('大分', $map))
      <td><a href="" class="kyushu">大<br>分</a></td>
      @else
      <td><a class="not_go">大<br>分</a></td>
      @endif
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      @if (in_array('和歌山', $map))
      <td class="char3"><a href="" class="kinki">和<br>歌<br>山</a></td>
      @else
      <td class="char3"><a class="not_go">和<br>歌<br>山</a></td>
      @endif
      @if (in_array('三重', $map))
      <td><a href="" class="chubu">三<br>重</a></td>
      @else
      <td><a class="not_go">三<br>重</a></td>
      @endif
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      @if (in_array('熊本', $map))
      <td><a href="" class="kyushu">熊<br>本</a></td>
      @else
      <td><a class="not_go">熊<br>本</a></td>
      @endif
      @if (in_array('宮崎', $map))
      <td><a href="" class="kyushu">宮<br>崎</a></td>
      @else
      <td><a class="not_go">宮<br>崎</a></td>
      @endif
      <td></td>
      @if (in_array('愛媛', $map))
      <td><a href="" class="shikoku">愛<br>媛</a></td>
      @else
      <td><a class="not_go">愛<br>媛</a></td>
      @endif
      @if (in_array('香川', $map))
      <td><a href="" class="shikoku">香<br>川</a></td>
      @else
      <td><a class="not_go">香<br>川</a></td>
      @endif
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      @if (in_array('鹿児島', $map))
      <td colspan=2 class="colspan_2 char3"><a href="" class="kyushu">鹿<br>児<br>島</a></td>
      @else
      <td colspan=2 class="colspan_2 char3"><a class="not_go">鹿<br>児<br>島</a></td>
      @endif
      <td></td>
      @if (in_array('高知', $map))
      <td><a href="" class="shikoku">高<br>知</a></td>
      @else
      <td><a class="not_go">高<br>知</a></td>
      @endif
      @if (in_array('徳島', $map))
      <td><a href="" class="shikoku">徳<br>島</a></td>
      @else
      <td><a class="not_go">徳<br>島</a></td>
      @endif
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    </table>
  @endsection