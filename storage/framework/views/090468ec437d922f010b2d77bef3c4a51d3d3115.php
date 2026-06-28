
<?php $__env->startSection('title','Customer Account'); ?>
<?php $__env->startSection('content'); ?>
<section class="customer-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="customer-sidebar">
                    <?php echo $__env->make('frontEnd.layouts.customer.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="customer-content">
                    <h5 class="account-title">My Order</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->created_at->format('d-m-y')); ?></td>
                                    <td>৳<?php echo e($value->amount); ?></td>
                                    <td>৳<?php echo e($value->discount); ?></td>
                                    <td><?php echo e($value->status?$value->status->name:''); ?></td>
                                    <td><a href="<?php echo e(route('customer.invoice',['id'=>$value->id])); ?>" class="invoice_btn"><i class="fa-solid fa-eye"></i></a>
                                    <?php if($value->admin_note): ?>
                                    <a href="<?php echo e(route('customer.order_note',['id'=>$value->id])); ?>" class="invoice_btn bg-primary"><i class="fa-solid fa-pencil"></i></a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/frontEnd/layouts/customer/orders.blade.php ENDPATH**/ ?>