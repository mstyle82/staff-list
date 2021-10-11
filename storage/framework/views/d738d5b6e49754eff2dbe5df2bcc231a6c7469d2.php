<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo e(asset('conf-group')); ?>">部署設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(asset('conf-title')); ?>">役職設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(asset('conf-team')); ?>">チーム設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo e(asset('conf-worklocation')); ?>">勤務地設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(asset('conf-tag')); ?>">タグ管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(asset('conf-staff')); ?>">社員区分設定</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(asset('register')); ?>">アカウント登録</a>
        </li>
    </ul>
    </div>
    <div class="col-md-2">
        <div class="form-check mt-5">
            <input class="form-check-input" type="checkbox" onchange="myfunc()" />
            <label class="form-check-label" for="flexCheckDefault">
                無効を表示
            </label>
        </div>
    </div>

    <div class="col-md-2 offset-md-8 mt-4">
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#saveModal">新規登録</button>
    </div>
    <div class="col-md-12">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">ステータス</th>
                    <th scope="col">表示順</th>
                    <th scope="col">勤務地</th>
                    <th scope="col">作成日</th>
                    <th scope="col">編集</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $work_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="line_<?php echo e($work_location->status); ?>">
                    <td style="display:none;"><?php echo e($work_location->id); ?></td>
                    <td>
                        <?php if( $work_location['status'] === 0): ?>
                            <p class="text-success">有効</p>
                        <?php else: ?>
                            <p class="text-muted">無効</p>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($work_location->display_order); ?></td>
                    <td><?php echo e($work_location->name); ?></td>
                    <td><?php echo e($work_location->created_at->format('Y年m月d日')); ?></td>
                    <td>
                        <button type="button" class="btn-original" data-bs-toggle="modal" data-bs-target="#updateModal"  data-bs-id="<?php echo e($work_location['id']); ?>" data-bs-status="<?php echo e($work_location['status']); ?>" data-bs-name="<?php echo e($work_location['name']); ?>" data-bs-order="<?php echo e($work_location['display_order']); ?>"><i class="far fa-edit mr-3"></i></button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>


<!--新規登録Modal -->
<div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新規勤務地登録</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <form method="POST" action="worklocation_store">
              <?php echo csrf_field(); ?>
              <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">勤務地名:</label>
                        <input type="text" class="form-control" name="get_name">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="recipient-name" class="col-form-label">表示順:</label>
                        <input type="text" class="form-control" name="get_order">
                    </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">登録</button>
              </div>
          </form>
    </div>
  </div>
</div>



<!--更新モーダル-->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">更新</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="worklocation_update">
              <?php echo csrf_field(); ?>
              <div class="modal-body">
                <div class="mb-3">
                  <p>
                  <input type="hidden" name="id" id="edit-id" class="form-control"></p>
                  <p>
                  <label for="recipient-name" class="col-form-label">ステータス:</label>
                  <select class="form-control" name="status" id="edit-status">
                    <option value="0">有効</option>
                    <option value="1">無効</option>
                  </select>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">勤務地名:</label>
                    <input type="text" class="form-control" name="name" id="edit-name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="recipient-name" class="col-form-label">表示順:</label>
                    <input type="text" class="form-control" name="order" id="edit-order">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="update_data" class="btn btn-primary">登録</button>
              </div>
          </form>
    </div>
  </div>
</div>

<script>
var updateModal = document.getElementById('updateModal')
updateModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var id = button.getAttribute('data-bs-id')
  var status = button.getAttribute('data-bs-status')
  var name = button.getAttribute('data-bs-name')
  var order = button.getAttribute('data-bs-order')

  var get_id = updateModal.querySelector('#edit-id')
  var get_status = updateModal.querySelector('#edit-status')
  var get_name = updateModal.querySelector('#edit-name')
  var get_order = updateModal.querySelector('#edit-order')

  get_id.value = id
  get_status.value = status
  get_name.value = name
  get_order.value = order

})
</script>

<script>
window.onload = function displayStyle(){
var none = document.getElementsByClassName("line_1");

for(var i = 0; i < none.length; i++) {
none[i].style.display = "none";
}
}
function myfunc() {

    const line_1 = document.getElementsByClassName("line_1");
    const array_1 = Array.prototype.slice.call(line_1);
    for(var i = 0; i < array_1.length; i++) {
      if(array_1[i].style.display==""){
		  // noneで非表示
		    array_1[i].style.display ="none";
	    }else{
		  // noneなしで表示
		    array_1[i].style.display ="";
	    }
      }
}
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<?php $__env->stopSection(); ?>









<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mikami/staff-list/resources/views/conf-worklocation.blade.php ENDPATH**/ ?>