<?php $__env->startSection('content'); ?>
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
                    <p><?php echo e($sum_id); ?> 名</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">役員：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($sum_b_members); ?>名</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">正社員：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($sum_member); ?>名</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">時短社員：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($sum_ts_member); ?>名</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">フルパート：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($sum_fp_member); ?></p>
                </div>
                  <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">パート：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($sum_p_member); ?>名</p>
                </div>
                <div class="col-md-2 mt-1">
                     <p style="font-weight:bold">バイト：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($sum_pt_member); ?>名</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">平均年齢：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e(intval($avg_age)); ?>歳</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">平均勤続年数：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($avg_los); ?>年</p>
                </div>
            </div>
        </div>
        <div>
            <?php $__currentLoopData = $staff_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($staff_status->name); ?></p>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($staff_status->id == $user->staff_status): ?>
                           <p><?php echo e($staff_status->id); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mikami/staff-list/resources/views/dashboard.blade.php ENDPATH**/ ?>