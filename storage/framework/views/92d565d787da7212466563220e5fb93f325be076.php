<?php $__env->startSection('title', 'FraudBD Settings'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">FraudBD Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">FraudBD Settings</h4>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Get your API key from <a href="https://fraudbd.com" target="_blank">fraudbd.com</a>.
                        It is used to check courier fraud status in the Orders page.
                    </p>

                    <form action="<?php echo e(route('admin.fraud.setting.update')); ?>" method="POST"
                          class="row" data-parsley-validate="">
                        <?php echo csrf_field(); ?>

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label class="form-label">FraudBD API Key *</label>
                                <input type="text" name="api_key"
                                       class="form-control <?php $__errorArgs = ['api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('api_key', $apiKey)); ?>"
                                       placeholder="Enter your FraudBD Bearer token" required>
                                <?php $__errorArgs = ['api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-2">
                            <input type="submit" class="btn btn-success" value="Save API Key">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd')); ?>/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="<?php echo e(asset('public/backEnd')); ?>/assets/js/pages/form-validation.init.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/settings/fraud.blade.php ENDPATH**/ ?>