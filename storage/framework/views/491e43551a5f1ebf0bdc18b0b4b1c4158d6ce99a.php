<?php $__env->startSection('title', 'Contact Messages'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Contact Messages</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e($m->is_read ? '' : 'table-warning fw-bold'); ?>">
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($m->name); ?></td>
                                <td><?php echo e($m->email); ?></td>
                                <td><?php echo e($m->phone); ?></td>
                                <td><?php echo e(\Str::limit($m->subject, 40)); ?></td>
                                <td><?php echo e($m->created_at->format('d M Y, h:i A')); ?></td>
                                <td>
                                    <?php if($m->is_read): ?>
                                        <span class="badge bg-secondary">Read</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Unread</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.contact_messages.show', $m->id)); ?>"
                                       class="btn btn-sm btn-info rounded-pill">
                                        <i class="fe-eye"></i> View
                                    </a>
                                    <form action="<?php echo e(route('admin.contact_messages.destroy', $m->id)); ?>"
                                          method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill delete-confirm">
                                            <i class="fe-trash-2"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">No messages yet.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <?php echo e($messages->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/contact_messages/index.blade.php ENDPATH**/ ?>