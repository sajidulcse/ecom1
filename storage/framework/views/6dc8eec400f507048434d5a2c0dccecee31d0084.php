
<?php $__env->startSection('title'); ?>
  <title>Track Oder</title>
<?php $__env->startSection('content'); ?>
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-content">
                    <p class="auth-title">Order Track Result</p>
                    <div class="track_info">
                        <ul>
                            <li><span>Invoice ID:</span> <?php echo e($value->invoice_id); ?> </li>
                            <li><span>Date:</span> <?php echo e($value->created_at); ?> </li>
                            <li><span>Status:</span> <?php echo e(App\Models\Orderstatus::where('id',$value->order_status)->first()->name); ?> </li>
                        </ul>
                    </div>
                    <table class="table table-bordered tracktable">
                        <thead>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            <?php 
                                $orderdetails = App\Models\OrderDetails::where(['order_id'=>$value->id])->get();
                            ?>
                             <?php $__currentLoopData = $orderdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->product_name); ?></td>
                                <td><?php echo e($product->qty); ?></td>
                                <td style="text-align:right;"><?php echo e($product->sale_price * $product->qty); ?> TK</td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="2"></td>
                            <td class="tfoot_bg"><span>Delivery Charge:</span> <?php echo e($value->shipping_charge); ?> Tk.</td>
                            </tr>
                            <tr>
                            <td colspan="2"></td>
                            <td class="tfoot_bg"><span>Total:</span> <?php echo e($value->amount); ?> Tk.</td>
                            </tr>
                        </tfoot>
                       
                    </table>
                    
                    
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('public/frontEnd/')); ?>/js/parsley.min.js"></script>
<script src="<?php echo e(asset('public/frontEnd/')); ?>/js/form-validation.init.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/frontEnd/layouts/customer/tracking_result.blade.php ENDPATH**/ ?>