@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    <ul class="nav nav-tabs mt-4" style="max-width: 820px;">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ ('/staff-list/public/conf-department') }}">部署設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ ('/staff-list/public/conf-title') }}">役職設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ ('/staff-list/public/conf-team') }}">チーム設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ ('/staff-list/public/conf-worklocation') }}">勤務地設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ ('/staff-list/public/conf-tag') }}">タグ管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">アカウント登録</a>
        </li>
    </ul>  
    </div> 
    <div class="col align-self-start">
        <div class="form-check mt-5">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                無効を表示
            </label>
        </div>
    </div>
    <div class="col align-self-center"></div>
    <div class="col align-self-end">
        <button type="button" class="btn btn-primary save_btn mt-3">新規登録</button>   
    </div> 
    <div class="col-md-12">
    <div style="max-width: 820px;">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">ステータス</th>
                    <th scope="col">部署名</th>
                    <th scope="col">作成日</th>
                    <th scope="col">編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td style="display:none;">{{ $department['id'] }}</td>
                    <td>
                        @if( $department['status'] === 0) 
                            <p class="text-success">有効</p>        
                        @else 
                            <p class="text-muted">無効</p>  
                        @endif
                    </td>
                    <td>{{ $department['name'] }}</td>
                    <td>{{ $department['created_at']->format('Y/m/d') }}</td>
                    <td>
                        <button type="button" class="btn-original edit_btn">
                            <i class="far fa-edit mr-3"></i>
                        </button>
                    </td>   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>

<!-- 新規登録モーダル -->
<div class="modal fade" id="save_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">新規部署登録</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="conf-group">
                    @csrf
                    <p>
                        <input type="text" name="get_name" class="form-control mt-1" placeholder="部署名入力" required>
                    </p>     
            </div>    
            <div class="modal-footer">
                    <button type="submit" name="save" class="btn btn-secondary mt-2">登録</button>
            </div>   
                </form>
        </div>
    </div>
</div>
<!-- 更新Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">更新</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form method="POST" action="">
            @csrf
                <div class="form-group">
                    <p>
                        <input type="hidden" name="id" id="id" class="form-control" ></p> 
                    <p>
                        <select class="form-control" name="status" id="status">
                            <option value="0">有効</option>
                            <option value="1">無効</option>
                        </select>   
                    </p>     
                    <p> 
                        <input type="text" name="name" id="name" class="form-control mt-1" placeholder="部署名" required>
                    </p> 
                </div>    
            <div class="modal-footer">
                <button type="submit" name="update_data" class="btn btn-secondary mt-2">更新</button>
            </div>   
            </form>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

<script>
//　新規
$(document).ready(function() {
    $('.save_btn').on('click', function() {
        $('#save_modal').modal('show');
    })
})
</script>


@endsection








