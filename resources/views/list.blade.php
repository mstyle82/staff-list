@extends('layouts.app')

@section('content')
    <div class="card border border-0">
        <div class="row g-0">
            <div class="col-md-2">
                <img src="{{ asset('storage/'.$lists['profile_image']) }}" alt="プロフィール画像" class="rounded" style="width: 150px; height: 150px;">
                <!--<img src="https://picsum.photos/seed/picsum/150/150" alt="プロフィール画像" class="rounded">-->
            </div>
            <div class="col-md-9 mx-2">
                <div class="row">
                    <p>
                        <input type="hidden" name="id" id="id" class="form-control" value="{{ $lists->id }}">
                    </p>
                    <div class="col-md-3">
                        <p style="font-weight:bold">{{ $lists->name }}</p>
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">郵便番号：</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $lists->name }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><small class="text-muted ex4">{{ $lists->kana }}</small></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">住所：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p>{{ $lists->address }}</p>
                    </div>
                    <div class="col-md-3 ex4">
                        @if( $lists->gender === 1 )
                            <p><i class="far fa-solid fa-user"></i> 男性</p>
                        @elseif( $lists->gender === 2 )
                            <p><i class="far fa-solid fa-user"></i> 女性</p>
                        @else
                            <p><i class="far fa-solid fa-user"></i> 未選択</p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">TEL：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p>{{ $lists->office_tell }}</p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p><i class="far fa-regular fa-gift"></i> {{ $lists->birthday }}</p>
                        <p><p class='mx-5'>{{ $age }}&emsp;歳</p></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">Enail：</p>
                    </div>
                    <div class="col-md-6 ex4 mt-1">
                        <p>{{ $lists->email }}</p>
                    </div>
                    <div class="col-md-3 ex4">
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">自宅TEL：</p>
                    </div>
                    <div class="col-md-4 ex4 mt-1">
                        <p>{{ $lists->home_tell }}</p>
                    </div>
                    <div class="col-md-2">
                    <a class="btn btn-primary" href="{{ url('/edit-list/'.$lists->id) }}" role="button">更新</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between" style="height: 50px;">
            <h5 class="mt-1">基本情報</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <p style="font-weight:bold">社員No：</p>
                </div>
                <div class="col-md-4">
                    <p>{{ $lists->user_id }}</p>
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">権限：</p>
                </div>
                <div class="col-md-4 ex4">
                @if($lists->role == 0)
                    <p>メンバー</p>
                @elseif($lists->role == 1)
                    <p>管理者</p>
                @endif
                </div>
                <div class="col-md-2">
                    <p style="font-weight:bold">所属部署：</p>
                </div>
                <div class="col-md-4">
                   @foreach($groups as $group)
                   @empty( $attribute->group_id )
                      <p>未選択</p>
                   @break
                   @elseif( $attribute->group_id == $group->id )
                      <p>{{ $group->name }}</p>
                   @endif
                   @endforeach
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">社員区分：</p>
                </div>
                <div class="col-md-3 ex4">


                   @if( $lists->staff_status == 0 )
                      <p>未選択</p>

                   @else
                      <p>{{ $staff_status->name }}</p>
                   @endif

                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">役職：</p>
                </div>
                <div class="col-md-4">
                   @foreach($titles as $title)
                   @empty( $attribute->title_id )
                      <p>未選択</p>
                   @break
                   @elseif( $attribute->title_id === $title->id )
                      <p>{{ $title->name }}</p>
                   @endif
                   @endforeach
                </div>
                <div class="col-md-6 ex4">
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">所属チーム：</p>
                </div>
                <div class="col-md-4">
                   @foreach($teams as $team)
                   @empty( $attribute->team_id )
                      <p>未選択</p>
                   @break
                   @elseif( $attribute->team_id === $team->id )
                      <p>{{ $team->name }}</p>
                   @endif
                   @endforeach
                </div>
                <div class="col-md-6 ex4">
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">勤務地：</p>
                </div>
                <div class="col-md-10">
                   @foreach($work_locations as $work_location)
                   @empty( $attribute->work_location_id )
                      <p>未選択</p>
                   @break
                   @elseif( $attribute->work_location_id === $work_location->id )
                      <p>{{ $work_location->name }}</p>
                   @endif
                   @endforeach
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">勤務時間：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p>{{ $lists->start_time }}時〜{{ $lists->last_time }}時</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">労働時間：</p>
                </div>
                <div class="col-md-6 mt-1">
                    <p>{{ $work_time }}時間</p>
                </div>

                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">入社年月日：</p>
                </div>
                <div class="col-md-2">
                    <p>{{ $lists->first_day }}</p>
                </div>
                <div class="col-md-8">
                    <p>勤続{{ $los }}年</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">退職日：</p>
                </div>
                <div class="col-md-10">
                    <p>{{ $lists->last_day }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header" style="height: 50px;">
            <h5 class="mt-1">保有資格</h5>
        </div>
        <div class="card-body">
            <div class="row g-0">
                <div class="col-md-12 float-start">
                    @foreach($owned_tags as $tag)
                    <span class="badge text-white mx-1" style="background-color:{{ $tag->color }}">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header" style="height: 50px;">
            <h5 class="mt-1">ファイル管理</h5>
        </div>
        <div class="card-body">
            <div class="row g-0">
                <div class="col-md-12 float-start">
                    @foreach($owned_files as $file)
                    <a href="{{asset('/has_file')}}/{{ $file->name }}" target="_blank">&emsp;<i class="far fa-regular fa-file" ></i>&nbsp;{{ $file->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between" style="height: 50px;">
            <h5 class="mt-1">備考</5>
        </div>
        <div class="card-body">
            <div class="row g-0">
                <div class="col-md-12">
                    <p class="card-text">{{ $lists->memo }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
