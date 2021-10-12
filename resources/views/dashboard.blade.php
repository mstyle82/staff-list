@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header" style="height: 50px;">
            <h5 class="mt-1">ダッシュボード</h5>
        </div>
        <div class="card-body">
            <div class="row g-0">
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">社員数：</p>
                </div>
                <div class="col-md-10 mt-1">
                    <p>{{ $sum_id }} 名</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">平均年齢：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p>{{ intval($avg_age) }}歳</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">平均勤続年数：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p>{{ $avg_los }}年</p>
                </div>
                <div class="col-md-4 mt-1"></div>
                @foreach($sum_staff_statuses as $sum_staff_status)
                <div class="col-md-2 mt-1">
                    <div class="d-flex">
                        <p style="font-weight:bold">{{ $sum_staff_status->name }}：</p>
                        <p>{{ $sum_staff_status->count }}名</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>


    </div>

                <!--    <div class="col-md-2 mt-1">-->
                <!--    <p style="font-weight:bold">役員：</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p>{{ $sum_b_members }}名</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p style="font-weight:bold">正社員：</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p>{{ $sum_member }}名</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p style="font-weight:bold">時短社員：</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p>{{ $sum_ts_member }}名</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p style="font-weight:bold">フルパート：</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p>{{ $sum_fp_member }}</p>-->
                <!--</div>-->
                <!--  <div class="col-md-2 mt-1">-->
                <!--    <p style="font-weight:bold">パート：</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p>{{ $sum_p_member }}名</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--     <p style="font-weight:bold">バイト：</p>-->
                <!--</div>-->
                <!--<div class="col-md-2 mt-1">-->
                <!--    <p>{{ $sum_pt_member }}名</p>-->
                <!--</div>-->


@endsection



