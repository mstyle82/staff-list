@extends('layouts.app')

@section('content')
    <div class="card border border-0" >
        <div class="row g-0">
            <div class="col-md-2">
                <img src="{{ asset('storage/'.$list['profile_image']) }}" alt="プロフィール画像" class="rounded" style="width: 150px; height: 150px;">
            </div>
            <div class="col-md-9 mx-2">
                <div class="row">
                    <div class="col-md-3">
                        <p style="font-weight:bold">{{ $list['name'] }}</p>
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">郵便番号：</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $list['post_code'] }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><small class="text-muted ex4">{{ $list['kana'] }}</small></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">住所：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p>{{ $list['address'] }}</p>
                    </div>
                    <div class="col-md-3 ex4">
                        @if( $list->gender === 1 )
                            <p><i class="far fa-solid fa-user"></i> 男性</p>
                        @elseif( $list->gender === 2 )
                            <p><i class="far fa-solid fa-user"></i> 女性</p>
                        @else
                            <p><i class="far fa-solid fa-user"></i> 未選択</p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">TEL：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p>{{ $list['office_tell'] }}</p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p><i class="far fa-regular fa-gift"></i> {{ $list->birthday }}</p>
                        <p class='mx-5'>{{ $age }}&emsp;歳</p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">Enail：</p>
                    </div>
                    <div class="col-md-6 ex4 mt-1">
                        <p>{{ $list['email'] }}</p>
                    </div>
                    <div class="col-md-3 ex4">
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">自宅TEL：</p>
                    </div>
                    <div class="col-md-6 ex4 mt-1">
                        <p>{{ $list['home_tell'] }}</p>
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
                <div class="col-md-10">
                    <p>{{ $list->user_id }}</p>
                </div>
                <div class="col-md-2">
                    <p style="font-weight:bold">所属部署：</p>
                </div>
                <div class="col-md-4">
                   @foreach($groups as $group)
                   @if(empty( $attribute->group_id ))
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
                <div class="col-md-4 ex4">
                    @if($list->staff_status == 1)
                    <p>役員</p>
                    @elseif($list->staff_status == 2)
                    <p>正社員</p>
                    @elseif($list->staff_status == 3)
                    <p>パート</p>
                    @else
                    <p>未選択</p>
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
                <div class="col-md-3 ex4">
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
                <div class="col-md-10 ex4">
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
                    <p style="font-weight:bold">入社年月日：</p>
                </div>
                <div class="col-md-2">
                    <p>{{ $list->first_day }}</p>
                </div>
                <div class="col-md-8">
                    <p>勤続{{ $los }}年</p>
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
                    <div class="col-md-12 d-flex">
                    @foreach($owned_tags as $tag)
                    <!--<span class="badge bg-primary text-white mx-2 py-1" style="background-color:{{ $tag->color }}">{{ $tag->name }}</span>-->
                    <span class="badge text-white mx-1 pt-1" style="background-color:{{ $tag->color }}">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
