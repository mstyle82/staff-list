@extends('layouts.app')

@section('content')
<form method="post" action="{{ asset('/list-card') }}">
@csrf
    <div class="row align-items-start">
     <div class="col-4">
         <div class="input-group">
	         <input type="text" class="form-control" placeholder="検索" name="input_serch">
	       　 <span class="input-group-btn">
		      　<button type="submit" name="serch_sub" class="btn btn-light">検索</button>
	       　 </span>
        </div>
     </div>
   </form>
   <div class="col-8"></div>
<div class="row align-items-start">
    @foreach($grouplists1 as $grouplist1)
      <div class="col-md-3　float-start mt-3 mx-4">
        <div class="card" style="height: 260px; width: 210px">
          <div class="card-header d-flex bg-info" style="height: 50px;">
            <img src="{{ asset('storage/' .$grouplist1['profile_image']) }}" alt="プロフィール画像" class="rounded-circle" style="width: 32px;height: 32px;">
            <h6 class="card-title mx-2 mt-2 text-white">{{ $grouplist1->users_name }}</h6>
          </div>
            <div class="card-body ">
              <ul class="" style="padding-left: 0;">
                <li class="">社員No：&emsp;{{ $grouplist1->staff_id }}</li>
                <li class="">{{ $grouplist1->groups_name }}</li>
                <li class="">{{ $grouplist1->titles_name }}</li>
                <li class="">{{ $grouplist1->teams_name }}</li>
              </ul>
              <div class="float-start">
                @foreach($owned_tags as $owned_tag)
                @if($grouplist1['users_id'] == $owned_tag['user_id'])
                <span class="badge text-white pt-1" style="background-color:{{ $owned_tag->color }}">{{ $owned_tag->name }}</span>
                @endif
                @endforeach
              </div>
            </div>
        </div>
      </div>

    @endforeach

</div>
@endsection
