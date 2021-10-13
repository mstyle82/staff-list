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
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">人員換算：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($work_time); ?>人区</p>
                </div>

                <?php $__currentLoopData = $sum_staff_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_staff_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-2 mt-1">
                    <div class="d-flex">
                        <p style="font-weight:bold"><?php echo e($sum_staff_status->name); ?>：</p>
                        <p><?php echo e($sum_staff_status->count); ?>名</p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mikami/staff-list/resources/views/dashboard.blade.php ENDPATH**/ ?>