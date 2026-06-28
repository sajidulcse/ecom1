<?php $__env->startSection('title', 'View Message'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="<?php echo e(route('admin.contact_messages.index')); ?>" class="btn btn-primary rounded-pill">
                        <i class="fe-arrow-left"></i> Back
                    </a>
                </div>
                <h4 class="page-title">View Message</h4>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th width="150">Name</th>
                            <td><?php echo e($msg->name); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><a href="mailto:<?php echo e($msg->email); ?>"><?php echo e($msg->email); ?></a></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo e($msg->phone); ?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td><?php echo e($msg->subject); ?></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td><?php echo e($msg->created_at->format('d M Y, h:i A')); ?></td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td style="white-space: pre-wrap;"><?php echo e($msg->message); ?></td>
                        </tr>
                    </table>

                    <form action="<?php echo e(route('admin.contact_messages.destroy', $msg->id)); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger delete-confirm">
                            <i class="fe-trash-2"></i> Delete Message
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/contact_messages/show.blade.php ENDPATH**/ ?>