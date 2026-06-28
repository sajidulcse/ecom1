<?php $__env->startSection('title', 'SMTP Settings'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">SMTP Settings</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form action="<?php echo e(route('admin.smtp.update')); ?>" method="POST" class="row" data-parsley-validate="">
                        <?php echo csrf_field(); ?>

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Mail Mailer</label>
                                <select class="form-control" name="MAIL_MAILER">
                                    <option value="smtp"  <?php if($smtp['MAIL_MAILER'] == 'smtp'): ?>  selected <?php endif; ?>>smtp</option>
                                    <option value="sendmail" <?php if($smtp['MAIL_MAILER'] == 'sendmail'): ?> selected <?php endif; ?>>sendmail</option>
                                    <option value="log"   <?php if($smtp['MAIL_MAILER'] == 'log'): ?>   selected <?php endif; ?>>log (debug)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Encryption</label>
                                <select class="form-control" name="MAIL_ENCRYPTION">
                                    <option value="tls" <?php if($smtp['MAIL_ENCRYPTION'] == 'tls'): ?> selected <?php endif; ?>>TLS</option>
                                    <option value="ssl" <?php if($smtp['MAIL_ENCRYPTION'] == 'ssl'): ?> selected <?php endif; ?>>SSL</option>
                                    <option value=""    <?php if($smtp['MAIL_ENCRYPTION'] == ''): ?>    selected <?php endif; ?>>None</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group mb-3">
                                <label class="form-label">Mail Host *</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['MAIL_HOST'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="MAIL_HOST" value="<?php echo e(old('MAIL_HOST', $smtp['MAIL_HOST'])); ?>" required>
                                <?php $__errorArgs = ['MAIL_HOST'];
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

                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Mail Port *</label>
                                <input type="number" class="form-control <?php $__errorArgs = ['MAIL_PORT'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="MAIL_PORT" value="<?php echo e(old('MAIL_PORT', $smtp['MAIL_PORT'])); ?>" required>
                                <?php $__errorArgs = ['MAIL_PORT'];
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

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Mail Username (Email) *</label>
                                <input type="email" class="form-control <?php $__errorArgs = ['MAIL_USERNAME'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="MAIL_USERNAME" value="<?php echo e(old('MAIL_USERNAME', $smtp['MAIL_USERNAME'])); ?>" required>
                                <?php $__errorArgs = ['MAIL_USERNAME'];
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

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Mail Password</label>
                                <input type="password" class="form-control" name="MAIL_PASSWORD"
                                       value="<?php echo e(old('MAIL_PASSWORD', $smtp['MAIL_PASSWORD'])); ?>"
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label">From Address *</label>
                                <input type="email" class="form-control <?php $__errorArgs = ['MAIL_FROM_ADDRESS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="MAIL_FROM_ADDRESS" value="<?php echo e(old('MAIL_FROM_ADDRESS', $smtp['MAIL_FROM_ADDRESS'])); ?>" required>
                                <?php $__errorArgs = ['MAIL_FROM_ADDRESS'];
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

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label">From Name *</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['MAIL_FROM_NAME'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="MAIL_FROM_NAME" value="<?php echo e(old('MAIL_FROM_NAME', $smtp['MAIL_FROM_NAME'])); ?>" required>
                                <?php $__errorArgs = ['MAIL_FROM_NAME'];
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

                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-success" value="Save SMTP Settings">
                        </div>

                    </form>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd')); ?>/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="<?php echo e(asset('public/backEnd')); ?>/assets/js/pages/form-validation.init.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/settings/smtp.blade.php ENDPATH**/ ?>