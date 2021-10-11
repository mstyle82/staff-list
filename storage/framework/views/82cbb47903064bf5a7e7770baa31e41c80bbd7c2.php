<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('storage/rogo1.png')); ?>" alt="ロゴ" height="28" class="d-inline-block align-top">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto justify-content-left">
                                <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo e(url('/')); ?>">マイページ</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/dashboard')); ?>">ダッシュボード</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/conf-group')); ?>">各種設定</a>
                                </li>
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <div class="d-flex mx-3">

                                <img src="<?php echo e(asset('storage/' .Auth::user()->profile_image)); ?>" alt="プロフィール画像" class="rounded-circle mt-1" style="width: 35px;height: 35px;">
                                <!--<img src="storage/<?php echo e(Auth::user()->profile_image); ?>" alt="プロフィール画像" class="mt-1"  style="border-radius:50%"  height="32">-->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                        </form>
                                    <a class="dropdown-item" href="<?php echo e(url('/edit-myprof')); ?>">
                                        プロフィール編集
                                    </a>
                                </div>
                                </div>
                            </li>
                        </ul>
                        <?php endif; ?>
                </div>
            </div>
        </nav>
         <!--左カラム-->
                <?php if(session('flash_message')): ?>
                    <div class="row">
                        <div class="col-md-7"></div>
                        <div class="col-md-12">
                            <div class="flash_message alert alert-success text-center"　id="alertfadeout" role="alert">
                                <?php echo e(session('flash_message')); ?>

                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                <?php endif; ?>
        <div class="row mt-3">
        <div class="col-md-1"></div>
            <div class="col-xs-2 mx-3">
            <div class="card" style="width: 260px;">
                <div class="card-header" style="height: 50px;">
                <div class="row justify-content-between">
                <p class="mx-3 mt-1">社員一覧</p>
                <a class="mx-3 mt-1" href="https://mikami.naviiiva.work/staff-list/public/list-card"> <i class="far fa-solid fa-address-card"></i></a>
                </div>
                </div>
                <div class="card-body">
                     <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <h6 class="mt-3" offset-md-1><i class="far fa-solid fa-building"><?php echo e($group->name); ?></i></h6>
                         <?php $__currentLoopData = $grouplists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grouplist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php if($group->id == $grouplist->group_id): ?>
                             <a href="<?php echo e(url('list/'.$grouplist->id)); ?>" class="card-text d-block elipsis offset-md-1"><?php echo e($grouplist->name); ?></a>
                         <?php endif; ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php $__currentLoopData = $grouplists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grouplist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php if(empty($grouplist->group_id)): ?>
                             <h6 class="mt-3">未所属</h6>
                             <?php if(empty($grouplist->group_id)): ?>
                                 <a href="<?php echo e(url('list/'.$grouplist->id)); ?>" class="card-text d-block elipsis offset-md-1"><?php echo e($grouplist->name); ?></a>
                             <?php endif; ?>
                         <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                </div>
            </div>
            <div class="col-md-8">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <div class="col-md-1"></div>
        </div>
        <main class="py-4">
        </main>
    </div>

</body>
</html>

<?php /**PATH /var/www/mikami/staff-list/resources/views/layouts/app.blade.php ENDPATH**/ ?>