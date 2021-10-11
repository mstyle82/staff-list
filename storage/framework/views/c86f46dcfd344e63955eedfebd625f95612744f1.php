<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(asset('/list-card')); ?>">
<?php echo csrf_field(); ?>
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
    <?php $__currentLoopData = $grouplists1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grouplist1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-3　float-start mt-3 mx-4">
        <div class="card" style="height: 260px; width: 210px">
          <div class="card-header d-flex bg-info" style="height: 50px;">
            <img src="<?php echo e(asset('storage/' .$grouplist1['profile_image'])); ?>" alt="プロフィール画像" class="rounded-circle" style="width: 32px;height: 32px;">
            <h6 class="card-title mx-2 mt-2 text-white"><?php echo e($grouplist1->users_name); ?></h6>
          </div>
            <div class="card-body ">
              <ul class="" style="padding-left: 0;">
                <li class="">社員No：&emsp;<?php echo e($grouplist1->staff_id); ?></li>
                <li class=""><?php echo e($grouplist1->groups_name); ?></li>
                <li class=""><?php echo e($grouplist1->titles_name); ?></li>
                <li class=""><?php echo e($grouplist1->teams_name); ?></li>
              </ul>
              <div class="float-start">
                <?php $__currentLoopData = $owned_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owned_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($grouplist1['users_id'] == $owned_tag['user_id']): ?>
                <span class="badge text-white pt-1" style="background-color:<?php echo e($owned_tag->color); ?>"><?php echo e($owned_tag->name); ?></span>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
        </div>
      </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mikami/staff-list/resources/views/list-card.blade.php ENDPATH**/ ?>