@extends('layouts.app')

@section('content')
    <div class="card border border-0">
        <div class="row g-0">
        <div class="col-md-2 d-flex">
            <img src="{{ asset('storage/'.$edit_data->profile_image) }}" alt="プロフィール画像"  id="non" class="rounded" style="width: 150px; height: 150px;">
            <canvas id='out' width='150' height='150' class="rounded"></canvas>
        </div>
            <div class="col-md-10 custom-file mt-5">
                <form action="{{ asset('list-image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="id" id="id" class="form-control" value="{{ $edit_data->id }}">
                    <input type="file" class="" name="profile_image" id="profile_image" onchange="trimming(this)" data-bs-toggle="modal" data-bs-target="#exampleModal"><br />
                    <input class="btn btn-secondary btn-sm mt-2" type="submit" value="アップロード">
                    <input type="hidden" name="imagefileobj" id="imagefileobj">
                </form>
            </div>
            <form method="POST" action="{{asset('/edit-list.update')}}" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-12 mt-3">
                    　　<h3>基本情報</h3>
                    </div>
                    <p>
                        <input type="hidden" name="id" id="id" class="form-control" value="{{ $edit_data->id }}">
                    </p>
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight:bold">名前 :</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ $edit_data->name }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight:bold">かな :</label>
                        <input type="text" class="form-control" name="kana" id="kana" placeholder="" value="{{ $edit_data->kana }}">
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-check">
                            <label class="form-label" style="font-weight:bold">性別 :</label>
                              <select class="form-control w-75" name="gender" id="gender" value="{{ $edit_data->gender }}">
                                  @if( $edit_data->gender == 1)
                                      <option value="0">未選択</option>
                                      <option value="1" selected>男性</option>
                                      <option value="2">女性</option>
                                  @elseif( $edit_data->gender == 2)
                                      <option value="0">未選択</option>
                                      <option value="1">男性</option>
                                      <option value="2" selected>女性</option>
                                  @else
                                    　<option value="0">未選択</option>
                                      <option value="1">男性</option>
                                      <option value="2">女性</option>
                                  @endif
                              </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">生年月日 :</label>
                        <input type="date" class="form-control w-25" name="birthday" id="birthday" placeholder="" value="{{ $edit_data->birthday }}">
                    </div>
                     <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">Email :</label>
                        <input type="email" class="form-control w-50" name="email" id="email" placeholder="" value="{{ $edit_data->email }}">
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label" style="font-weight:bold">郵便番号 :</label>
                        <div class="d-flex">
                        <input type="text" class="form-control w-50" name="post_code" id="input" placeholder="" value="{{ $edit_data->post_code }}" >
                        <button id="search" type="button" class="btn btn-secondary mx-3">検索</button>

                        </div>
                        <p id="error"></p>
                    </div>
                    <div class="col-md-8 mt-3">
                        <label class="form-label" style="font-weight:bold">住所 :</label>
                        <input type="text" class="form-control w-75" name="address" id="address" placeholder="" value="{{ $edit_data->address }}">
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label" style="font-weight:bold">電話番号 :</label>
                        <input type="text" class="form-control" name="office_tell" id="office_tell" placeholder="" value="{{ $edit_data->office_tell }}">
                    </div>
                    <div class="col-md-8 mt-3">
                        <label class="form-label" style="font-weight:bold">緊急連絡先 :</label>
                        <input type="text" class="form-control w-50" name="home_tell" id="home_tell" placeholder="" value="{{ $edit_data->home_tell }}">
                    </div>
                    <div class="col-md-12 mt-3">
                    　 <h3>管理情報</h3>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label" style="font-weight:bold">社員No :</label>
                        <input type="text" class="form-control w-75" name="user_id" id="user_id" placeholder="" value="{{ $edit_data->user_id }}">
                    </div>
                    <div class="col-md-4 align-self-center">
                        <div class="form-check">
                            <label class="form-label mt-4" style="font-weight:bold">在籍区分 :</label>
                            @if( $edit_data->status == 0)
                              <label><input class="mx-3 " type="radio" name="status" value="0" checked>在籍</label>
                            @else
                              <label><input class="mx-3" type="radio" name="status" value="0">在籍</label>
                            @endif
                            @if( $edit_data->status == 1)
                              <label><input class="mx-3" type="radio" name="status" value="1" checked>退職</label>
                            @else
                              <label><input class="mx-3" type="radio" name="status" value="1">退職</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 align-self-center">
                    @if($login_user->role == 1)
                        <div class="form-check">
                            <label class="form-label mt-4" style="font-weight:bold">権限 :</label>
                            @if( $edit_data->role == 0)
                              <label><input class="mx-3 " type="radio" name="role" value="0" checked>メンバー</label>
                            @else
                              <label><input class="mx-3" type="radio" name="role" value="0">メンバー</label>
                            @endif
                            @if( $edit_data->role == 1)
                              <label><input class="mx-3" type="radio" name="role" value="1" checked>管理者</label>
                            @else
                              <label><input class="mx-3" type="radio" name="role" value="1">管理者</label>
                            @endif
                        </div>
                    @else
                        <input type="hidden" class="mx-3" type="radio" name="role" value="0"></label>
                    @endif
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label" style="font-weight:bold">社員区分 :</label>
                        <select class="form-control w-50" name="staff_status" id="staff_status">
                            <option value="0" selected>未選択</option>
                            @foreach($staff_statuses as $staff_status)
                            @if($staff_status->id == $edit_data->staff_status)
                                <option value="{{ $staff_status->id }}" selected>{{ $staff_status->name }}</option>
                            @else
                                <option value="{{ $staff_status->id }}" >{{ $staff_status->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mt-3 mx-4">
                        <label class="form-label" style="font-weight:bold">始業時間 :</label>
                        <input type="number" class="form-control " name="start_time" id="start_time" placeholder="" value="{{ $edit_data->start_time }}">
                    </div>
                     <div class="col-md-1 mt-3">
                        <label class="form-label" style="font-weight:bold"></label>
                        <p class="mt-3 mx-3">〜</p>
                    </div>
                    <div class="col-md-2 mt-3">
                        <label class="form-label" style="font-weight:bold">終業時間 :</label>
                        <input type="number" class="form-control " name="last_time" id="last_time" placeholder="" value="{{ $edit_data->last_time }}">
                    </div>
                    <div class="col-md-6 mt-3"></div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">所属部署 :</label>
                        <select class="form-control w-50" name="group_id" id="group_id">
                            <option value="" selected>未選択</option>
                            @foreach($groups as $group)
                            @if($group_id->group_id == $group->id)
                                <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                            @else
                                <option value="{{ $group->id }}" >{{ $group->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">役職 :</label>
                        <select class="form-control w-50" name="title_id" id="title_id" value="">
                            <option value="" selected>未選択</option>
                            @foreach($titles as $title)
                            @if($group_id->title_id == $title->id)
                                <option value="{{ $title->id }}" selected>{{ $title->name }}</option>
                            @else
                                <option value="{{ $title->id }}" >{{ $title->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">所属チーム :</label>
                        <select class="form-control w-50" name="team_id" id="team_id" value="">
                            <option value="" selected>未選択</option>
                            @foreach($teams as $team)
                            @if($group_id->team_id == $team->id)
                                <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                            @else
                                <option value="{{ $team->id }}" >{{ $team->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">勤務地 :</label>
                        <select class="form-control w-50" name="work_location_id" id="work_location_id" value="">
                            <option value="" selected>未選択</option>
                            @foreach($work_locations as $work_location)
                            @if($group_id->work_location_id == $work_location->id)
                                <option value="{{ $work_location->id }}" selected>{{ $work_location->name }}</option>
                            @else
                                <option value="{{ $work_location->id }}" >{{ $work_location->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">入社日 :</label>
                        <input type="date" class="form-control w-25" name="first_day" id="first_day" placeholder="" value="{{ $edit_data->first_day }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">退職日 :</label>
                        <input type="date" class="form-control w-25" name="last_day" id="last_day" placeholder="" value="{{ $edit_data->last_day }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">ファイル管理 :</label>
                    </div>
                    <div class="col-md-12">
                        <!--<input class="form-control" style="width: 220px" type="file_name" name="file_name" placeholder="ファイル名入力">-->
                        <select class="form-control w-75" name="file_name" id="file_name" value="選択">
                            <option value="">未入力</option>
                            <option value="履歴書">履歴書</option>
                            <option value="職務経歴">職務経歴書</option>

                        <input class="mt-2" type="file" name="my_file" id="my_file">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label" style="font-weight:bold">備考 :</label>
                        <textarea class="form-control w-75" name="memo" id="memo" rows="5">{{ $edit_data->memo }}</textarea>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="form-label" style="font-weight:bold">タグ :</label>

                        <!--<div class="card" style="width: 730px; height: 150px;">-->
                        @foreach($tags as $tag)
                            <div class="form-check form-check-inline mx-3 mt-3">
                                <input class="form-check-input mt-1" type="checkbox" name="tag[]" id="{{ $tag['id'] }}" value="{{ $tag['id'] }}" {{ in_array($tag['id'], $include_tags) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $tag['id'] }}"><span class="badge text-white mx-1 mt-1" style="background-color:{{ $tag['color'] }}">{{ $tag['name'] }}</span></label>
                            </div>
                        @endforeach
                        <!--</div>-->
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">プロフィール画像登録</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="imagefileobj" id="imagefileobj">
          <input type="hidden" name="id" id="id" class="form-control" value="{{ $edit_data->id }}">
          <input id='scal' type='range' value='' min='10' max='400' oninput="scaling(value)" style='width: 300px;'><br>
          <canvas id='cvs' width='200' height='200'></canvas><br>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
          <button type="button" class="btn btn-primary" onclick='crop_img()' data-bs-dismiss="modal">画像を確認</button>
      </div>
    </div>
  </div>
</div>

<!-- ここまで  -->


<script>
    const cvs = document.getElementById( 'cvs' )
    const cw = cvs.width
    const ch = cvs.height
    const out = document.getElementById( 'out' )
    const oh = out.height
    const ow = out.width

    let ix = 0    // 中心座標
    let iy = 0
    let v = 1.0   // 拡大縮小率
    const img  = new Image()
    function trimming(obj)
    {
    	var fileReader = new FileReader();
    	fileReader.onload = function(e) {
            img.onload = function( _ev ){   // 画像が読み込まれた
                ix = img.width  / 2
                iy = img.height / 2
                let scl = parseInt( cw / img.width * 100 )
                document.getElementById( 'scal' ).value = scl
                scaling( scl )
            }
            img.src = e.target.result;
    	};
    	fileReader.readAsDataURL(obj.files[0]);
    }
    function scaling( _v ) {        // スライダーが変��た
        v = parseInt( _v ) * 0.01
        draw_canvas( ix, iy )       // 画像更新
    }

    function draw_canvas( _x, _y ){     // 画像更新
        const ctx = cvs.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, cw, ch )    // 背景を塗る
        ctx.drawImage( img,
            0, 0, img.width, img.height,
            (cw/2)-_x*v, (ch/2)-_y*v, img.width*v, img.height*v,
        )
        ctx.strokeStyle = 'rgba(200, 0, 0, 0.8)'
        ctx.strokeRect( (cw-ow)/2, (ch-oh)/2, ow, oh ) // 赤い枠
    }

    function crop_img(){                // 画像切り取り
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
        ctx.drawImage( img,
            0, 0, img.width, img.height,
            (ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,
        )
        document.getElementById("non").style.display ="none"; 　//既存画像を非表示
        var png = out.toDataURL();
        document.getElementById('imagefileobj').value = png;
        non.style.display ="none";

    }

    let mouse_down = false      // canvas ドラッグ中フラグ
    let sx = 0                  // canvas ドラッグ開始位置
    let sy = 0
    cvs.ontouchstart =
    cvs.onmousedown = function ( _ev ){     // canvas ドラッグ開始位置
        mouse_down = true
        sx = _ev.pageX
        sy = _ev.pageY
        return false // イベントを伝搬しない
    }
    cvs.ontouchend =
    cvs.onmouseout =
    cvs.onmouseup = function ( _ev ){       // canvas ドラッグ終了位置
        if ( mouse_down == false ) return
        mouse_down = false
        draw_canvas( ix += (sx-_ev.pageX)/v, iy += (sy-_ev.pageY)/v )
        return false // イベントを伝搬しない
    }
    cvs.ontouchmove =
    cvs.onmousemove = function ( _ev ){     // canvas ドラッグ中
        if ( mouse_down == false ) return
        draw_canvas( ix + (sx-_ev.pageX)/v, iy + (sy-_ev.pageY)/v )
        return false // イベントを伝搬しない
    }
    cvs.onmousewheel = function ( _ev ){    // canvas ホイールで拡大縮小
        let scl = parseInt( parseInt( document.getElementById( 'scal' ).value ) + _ev.wheelDelta * 0.05 )
        if ( scl < 10  ) scl = 10
        if ( scl > 400 ) scl = 400
        document.getElementById( 'scal' ).value = scl
        scaling( scl )
        return false // イベントを伝搬しない
    }
</script>

<script>
    let search = document.getElementById('search');
search.addEventListener('click', ()=>{
    let api = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';
    let error = document.getElementById('error');
    let input = document.getElementById('input');
    let address1 = document.getElementById('address1');
    let address2 = document.getElementById('address2');
    let address3 = document.getElementById('address3');
    let param = input.value.replace("-",""); //入力された郵便番号から「-」を削除
    let url = api + param;

    fetchJsonp(url, {
        timeout: 10000, //タイムアウト時間
    })
    .then((response)=>{
        error.textContent = ''; //HTML側のエラーメッセージ初期化
        return response.json();
    })

    .then(($getAdd)=>{
        var _addFormatted  = "";
        if($getAdd.status === 400){ //エラー時
            error.textContent = $getAdd.message;
        }else if($getAdd.results === null){
            error.textContent = '郵便番号から住所が見つかりませんでした。';
        } else {
            _addFormatted += $getAdd.results[0].address1; // 都道府県名
			_addFormatted += $getAdd.results[0].address2; // 市町村名
			_addFormatted += $getAdd.results[0].address3; // 町域名

        }
        document.getElementById("address").value = _addFormatted;
    })
    .catch((ex)=>{ //例外処理
        console.log(ex);
    });
}, false);
</script>

<script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

@endsection
