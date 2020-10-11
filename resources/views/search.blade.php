{{ Form::open(['method' => 'get']) }}
{{-- キーワード検索機能 --}}
    <div class='form-group'>
        {{ Form::label('keyword', 'キーワード:') }}
        {{ Form::text('keyword', $keyword, ['class' => 'form-control']) }}
    </div>

{{-- ジャンルで絞り込み --}}
@php
    $GENRES = ['アクティブ', 'グルメ', '観光', '体験', '芸術観賞', 'サンプル'];
@endphp
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <h3 class="ml-3 mb-3">ジャンルで絞り込み</h3>
            <div class="row items-collection">
                @foreach ($GENRES as $GENRE)
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="info-block block-info clearfix">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default page-link text-dark d-inline-block">
                            <div class="itemcontent">
                                <input
                                type="checkbox"
                                name="genre[]"
                                autocomplete="off"
                                value={{$GENRE}}
                                {{in_array($GENRE, $genres) ? 'checked' : null }}
                                />
                                <h5>{{$GENRE}}</h5>
                            </div>
                            </label>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- スポットで絞り込み --}}
        <div class="col-sm-12 col-lg-6">
            <div class="japan_map">
                <img class="map_img" src="{{asset('img/collor_map.png')}}" alt="日本地図">
                <span class="area_btn area1" data-area="1">北海道・東北</span>
                <span class="area_btn area2" data-area="2">関東</span>
                <span class="area_btn area3" data-area="3">中部</span>
                <span class="area_btn area4" data-area="4">近畿</span>
                <span class="area_btn area5" data-area="5">中国・四国</span>
                <span class="area_btn area6" data-area="6">九州・沖縄</span>
                
                <div class="area_overlay"></div>
                <div class="pref_area">
                    <div class="pref_list" data-list="1">
                        <div data-id="1">北海道</div>
                        <div data-id="2">青森県</div>
                        <div data-id="3">岩手県</div>
                        <div data-id="4">宮城県</div>
                        <div data-id="5">秋田県</div>
                        <div data-id="6">山形県</div>
                        <div data-id="7">福島県</div>
                        <div></div>
                    </div>
                    
                    <div class="pref_list" data-list="2">
                        <div data-id="8">茨城県</div>
                        <div data-id="9">栃木県</div>
                        <div data-id="10">群馬県</div>
                        <div data-id="11">埼玉県</div>
                        <div data-id="12">千葉県</div>
                        <div data-id="13">東京都</div>
                        <div data-id="14">神奈川県</div>
                        <div></div>
                    </div>
                    
                    <div class="pref_list" data-list="3">
                        <div data-id="15">新潟県‎</div>
                        <div data-id="16">富山県‎</div>
                        <div data-id="17">石川県‎</div>
                        <div data-id="18">福井県‎</div>
                        <div data-id="19">山梨県‎</div>
                        <div data-id="20">長野県‎</div>
                        <div data-id="21">岐阜県</div>
                        <div data-id="22">静岡県</div>
                        <div data-id="23">愛知県‎</div>
                        <div></div>
                    </div>
                    
                    <div class="pref_list" data-list="4">
                        <div data-id="24">三重県</div>
                        <div data-id="25">滋賀県</div>
                        <div data-id="26">京都府</div>
                        <div data-id="27">大阪府</div>
                        <div data-id="28">兵庫県</div>
                        <div data-id="29">奈良県</div>
                        <div data-id="30">和歌山県</div>
                        <div></div>
                    </div>
                    
                    <div class="pref_list" data-list="5">
                        <div data-id="31">鳥取県</div>
                        <div data-id="32">島根県</div>
                        <div data-id="33">岡山県</div>
                        <div data-id="34">広島県</div>
                        <div data-id="35">山口県</div>
                        <div data-id="36">徳島県</div>
                        <div data-id="37">香川県</div>
                        <div data-id="38">愛媛県</div>
                        <div data-id="39">高知県</div>
                        <div></div>
                    </div>
                    
                    <div class="pref_list" data-list="6">
                        <div data-id="40">福岡県</div>
                        <div data-id="41">佐賀県</div>
                        <div data-id="42">長崎県</div>
                        <div data-id="43">熊本県</div>
                        <div data-id="44">大分県</div>
                        <div data-id="45">宮崎県</div>
                        <div data-id="46">鹿児島県</div>
                        <div data-id="47">沖縄県</div>
                    </div>

                    
                </div>
            </div>
                            <select name="pref_id" class="mt-0">
                                <option value="" selected>都道府県を選択</option>
                                    @foreach(config('pref') as $index => $name)
                                    <option>{{$name}}</option>
                                    @endforeach
                            </select>
        </div>
    </div>
</div>

{{-- 検索ボタン --}}
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href='/trip/genre'>クリア</a>
    </div>
{{ Form::close() }}