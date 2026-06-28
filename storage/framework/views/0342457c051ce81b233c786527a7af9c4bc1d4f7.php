<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta name="csrf-token" content="igEtQwGfz0hpKoVDnpDYhEg17PsP86VmBfjfpIDl">

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo e(asset($generalsetting->favicon)); ?>" alt="<?php echo e($generalsetting->name); ?>" />
	<title>Admin Login | <?php echo e($generalsetting->name); ?></title>

	<!-- google font -->
	<link rel="stylesheet" href="<?php echo e(asset('public/cdn/fonts/poppins/font.css')); ?>">

	<!-- aiz core css -->
	<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/assets_login/css/vendors.css">
    	<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/assets_login/css/aiz-core.css">

    <style>
        body {
            font-size: 12px;
        }
    </style>

</head>
<body class="">

	<div class="aiz-main-wrapper d-flex">
        <div class="flex-grow-1">
            
<div class="h-100 bg-cover bg-center py-5 d-flex align-items-center" style="background-image: url(<?php echo e(asset('public/backEnd/')); ?>/assets_login/img/background.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-4 mx-auto">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="mb-5 text-center">
                            <img src="<?php echo e(asset($generalsetting->dark_logo)); ?>" class="mw-100 mb-4" height="40">
                            <h1 class="h3 text-primary mb-0">Welcome to <?php echo e($generalsetting->name); ?></h1>
                            <p>Login to your account.</p>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>
                          <form method="POST" action="<?php echo e(route('login')); ?>" >
                          <?php echo csrf_field(); ?>
							<div class="form-group">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Email">
                                                                                                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
															
															</div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" value="<?php echo e(old('password')); ?>" required placeholder="Password">
                                                                                                                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
															
															</div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" name="remember" id="checkbox-signin" value="1" >
                                            <span>Remember Me</span>
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                                                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <a href="<?php echo e(route('password.request')); ?>" class="text-reset fs-14">Forgot password ?</a>
                                        </div>
                                    </div>
                                                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Login
                            </button>
                        </form>
                                            </div>
                </div>
            </div>
        </div>
    </div>
</div>


        </div>
    </div><!-- .aiz-main-wrapper -->

    

    <script src="<?php echo e(asset('public/backEnd/')); ?>/assets_login/js/vendors.js" ></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/assets_login/js/aiz-core.js" ></script>

</body>

</html><?php /**PATH F:\laragon\www\ecommerce1.nextstagesoftware.com_20260507_141104\resources\views/backEnd/auth/login.blade.php ENDPATH**/ ?>