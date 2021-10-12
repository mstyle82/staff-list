<?php $__env->startSection('content'); ?>
    <div class="card border border-0" >
        <div class="row g-0">
            <div class="col-md-2">
                <img src="<?php echo e(asset('storage/'.$list['profile_image'])); ?>" alt="プロフィール画像" class="rounded" style="width: 150px; height: 150px;">
            </div>
            <div class="col-md-9 mx-2">
                <div class="row">
                    <div class="col-md-3">
                        <p style="font-weight:bold"><?php echo e($list['name']); ?></p>
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">郵便番号：</p>
                    </div>
                    <div class="col-md-6">
                        <p><?php echo e($list['post_code']); ?></p>
                    </div>
                    <div class="col-md-3">
                        <p><small class="text-muted ex4"><?php echo e($list['kana']); ?></small></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">住所：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p><?php echo e($list['address']); ?></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <?php if( $list->gender === 1 ): ?>
                            <p><i class="far fa-solid fa-user"></i> 男性</p>
                        <?php elseif( $list->gender === 2 ): ?>
                            <p><i class="far fa-solid fa-user"></i> 女性</p>
                        <?php else: ?>
                            <p><i class="far fa-solid fa-user"></i> 未選択</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">TEL：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p><?php echo e($list['office_tell']); ?></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p><i class="far fa-regular fa-gift"></i> <?php echo e($list->birthday); ?></p>
                        <p class='mx-5'>&emsp;<?php echo e($age); ?>歳</p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">Enail：</p>
                    </div>
                    <div class="col-md-6 ex4 mt-1">
                        <p><?php echo e($list['email']); ?></p>
                    </div>
                    <div class="col-md-3 ex4">
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">自宅TEL：</p>
                    </div>
                    <div class="col-md-6 ex4 mt-1">
                        <p><?php echo e($list['home_tell']); ?></p>
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
                    <p><?php echo e($list->user_id); ?></p>
                </div>
                <div class="col-md-2">
                    <p style="font-weight:bold">所属部署：</p>
                </div>
                <div class="col-md-4">
                   <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if(empty( $attribute->group_id )): ?>
                      <p>未選択</p>
                   <?php break; ?>
                   <?php elseif( $attribute->group_id == $group->id ): ?>
                      <p><?php echo e($group->name); ?></p>
                   <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">社員区分：</p>
                </div>
                <div class="col-md-4 ex4">
                    <?php if($list->staff_status == 1): ?>
                    <p>役員</p>
                    <?php elseif($list->staff_status == 2): ?>
                    <p>正社員</p>
                    <?php elseif($list->staff_status == 3): ?>
                    <p>パート</p>
                    <?php else: ?>
                    <p>未選択</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">役職：</p>
                </div>
                <div class="col-md-4">
                   <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if(empty( $attribute->title_id )): ?>
                      <p>未選択</p>
                   <?php break; ?>
                   <?php elseif( $attribute->title_id === $title->id ): ?>
                      <p><?php echo e($title->name); ?></p>
                   <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-md-6 ex4">
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">所属チーム：</p>
                </div>
                <div class="col-md-3 ex4">
                   <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if(empty( $attribute->team_id )): ?>
                      <p>未選択</p>
                   <?php break; ?>
                   <?php elseif( $attribute->team_id === $team->id ): ?>
                      <p><?php echo e($team->name); ?></p>
                   <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-md-6 ex4">
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">勤務地：</p>
                </div>
                <div class="col-md-10 ex4">
                   <?php $__currentLoopData = $work_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if(empty( $attribute->work_location_id )): ?>
                      <p>未選択</p>
                   <?php break; ?>
                   <?php elseif( $attribute->work_location_id === $work_location->id ): ?>
                      <p><?php echo e($work_location->name); ?></p>
                   <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">入社年月日：</p>
                </div>
                <div class="col-md-4 d-flex">
                    <p><?php echo e($list->first_day); ?></p>
                    <p>（勤続<?php echo e($los); ?>年）</p>
                </div>
                <div class="col-md-6"></div>
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
                    <?php $__currentLoopData = $owned_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--<span class="badge bg-primary text-white mx-2 py-1" style="background-color:<?php echo e($tag->color); ?>"><?php echo e($tag->name); ?></span>-->
                    <span class="badge text-white mx-1 pt-1" style="background-color:<?php echo e($tag->color); ?>"><?php echo e($tag->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mikami/staff-list/resources/views/mypage.blade.php ENDPATH**/ ?>