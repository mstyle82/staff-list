<?php $__env->startSection('content'); ?>
    <div class="card border border-0">
        <div class="row g-0">
            <div class="col-md-2">
                <img src="<?php echo e(asset('storage/'.$lists['profile_image'])); ?>" alt="プロフィール画像" class="rounded" style="width: 150px; height: 150px;">
                <!--<img src="https://picsum.photos/seed/picsum/150/150" alt="プロフィール画像" class="rounded">-->
            </div>
            <div class="col-md-9 mx-2">
                <div class="row">
                    <p>
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo e($lists->id); ?>">
                    </p>
                    <div class="col-md-3">
                        <p style="font-weight:bold"><?php echo e($lists->name); ?></p>
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">郵便番号：</p>
                    </div>
                    <div class="col-md-6">
                        <p><?php echo e($lists->name); ?></p>
                    </div>
                    <div class="col-md-3">
                        <p><small class="text-muted ex4"><?php echo e($lists->kana); ?></small></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">住所：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p><?php echo e($lists->address); ?></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <?php if( $lists->gender === 1 ): ?>
                            <p><i class="far fa-solid fa-user"></i> 男性</p>
                        <?php elseif( $lists->gender === 2 ): ?>
                            <p><i class="far fa-solid fa-user"></i> 女性</p>
                        <?php else: ?>
                            <p><i class="far fa-solid fa-user"></i> 未選択</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <p style="font-weight:bold">TEL：</p>
                    </div>
                    <div class="col-md-6 ex4">
                        <p><?php echo e($lists->office_tell); ?></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p><i class="far fa-regular fa-gift"></i> <?php echo e($lists->birthday); ?></p>
                        <p><p class='mx-5'><?php echo e($age); ?>&emsp;歳</p></p>
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">Enail：</p>
                    </div>
                    <div class="col-md-6 ex4 mt-1">
                        <p><?php echo e($lists->email); ?></p>
                    </div>
                    <div class="col-md-3 ex4">
                    </div>
                    <div class="col-md-3 ex4">
                        <p style="font-weight:bold">自宅TEL：</p>
                    </div>
                    <div class="col-md-4 ex4 mt-1">
                        <p><?php echo e($lists->home_tell); ?></p>
                    </div>
                    <div class="col-md-2">
                    <a class="btn btn-primary" href="<?php echo e(url('/edit-list/'.$lists->id)); ?>" role="button">更新</a>
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
                    <p><?php echo e($lists->user_id); ?></p>
                </div>
                <div class="col-md-2 ex4">
                    <p style="font-weight:bold">権限：</p>
                </div>
                <div class="col-md-4 ex4">
                <?php if($lists->role == 0): ?>
                    <p>メンバー</p>
                <?php elseif($lists->role == 1): ?>
                    <p>管理者</p>
                <?php endif; ?>
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
                <div class="col-md-3 ex4">


                   <?php if( $lists->staff_status == 0 ): ?>
                      <p>未選択</p>

                   <?php else: ?>
                      <p><?php echo e($staff_status->name); ?></p>
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
                <div class="col-md-4">
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
                <div class="col-md-10">
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
                    <p style="font-weight:bold">勤務時間：</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p><?php echo e($lists->start_time); ?>時〜<?php echo e($lists->last_time); ?>時</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">労働時間：</p>
                </div>
                <div class="col-md-6 mt-1">
                    <p><?php echo e($work_time); ?>時間</p>
                </div>

                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">入社年月日：</p>
                </div>
                <div class="col-md-2">
                    <p><?php echo e($lists->first_day); ?></p>
                </div>
                <div class="col-md-8">
                    <p>勤続<?php echo e($los); ?>年</p>
                </div>
                <div class="col-md-2 mt-1">
                    <p style="font-weight:bold">退職日：</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo e($lists->last_day); ?></p>
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
                    <?php $__currentLoopData = $owned_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge text-white mx-1" style="background-color:<?php echo e($tag->color); ?>"><?php echo e($tag->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php $__currentLoopData = $owned_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(asset('/has_file')); ?>/<?php echo e($file->name); ?>" target="_blank">&emsp;<i class="far fa-regular fa-file" ></i>&nbsp;<?php echo e($file->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <p class="card-text"><?php echo e($lists->memo); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mikami/staff-list/resources/views/list.blade.php ENDPATH**/ ?>