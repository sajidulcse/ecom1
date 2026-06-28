
<?php $__env->startSection('title','Order Report'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/backEnd')); ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('public/backEnd/')); ?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<style>
    p{
        margin:0;
    }
   @page { 
        margin: 50px 0px 0px 0px;
    }
   @media print {
    td{
        font-size: 18px;
    }
    p{
        margin:0;
    }
    title {
        font-size: 25px;
    }
    header,footer,.no-print,.left-side-menu,.navbar-custom {
      display: none !important;
    }
  }
</style>
<?php $__env->stopSection(); ?> 
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Order Report</h4>
            </div>
        </div>
    </div>       
    <!-- end page title --> 
   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="no-print">
                    <div class="row">   
                        <div class="col-sm-3">
                            <div class="form-group">
                               <label for="keyword" class="form-label">Keyword</label>
                                <input type="text" value="<?php echo e(request()->get('keyword')); ?>" class="form-control" name="keyword">
                            </div>
                        </div>
                        <!--col-sm-3-->
                        <div class="col-sm-3">
                            <div class="form-group mb-3">
                                <label for="user_id" class="form-label">Assign User </label>
                                <select class="form-control select2 <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="user_id" value="<?php echo e(old('user_id')); ?>" >
                                    <option value="">Select..</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>" <?php if(request()->get('user_id') == $value->id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['user_id'];
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
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="form-group">
                               <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" value="<?php echo e(request()->get('start_date')); ?>"  class="form-control flatdate" name="start_date">
                            </div>
                        </div>
                        <!--col-sm-3--> 
                        <div class="col-sm-3">
                            <div class="form-group">
                               <label for="end_date" class="form-label">End Date</label>
                                <input type="date" value="<?php echo e(request()->get('end_date')); ?>" class="form-control flatdate" name="end_date">
                            </div>
                        </div>
                        <!--col-sm-3-->
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <button class="btn btn-primary">Submit</button>
                                <a href="<?php echo e(route('admin.order_report')); ?>" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                        <!-- col end -->
                    </div>  
                </form>
                <div class="row mb-3">
                    <div class="col-sm-6 no-print">
                         <?php echo e($orders->links('pagination::bootstrap-4')); ?>

                    </div>
                    <div class="col-sm-6">
                        <div class="export-print text-end">
                            <button onclick="printFunction()"class="no-print btn btn-success"><i class="fa fa-print"></i> Print</button>
                            <button id="export-excel-button" class="no-print btn btn-info"><i class="fas fa-file-export"></i> Export</button>
                        </div>
                    </div>
                </div>
                <div id="content-to-export">
                    <div class="table-responsive">
                        <table class="table nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:5%">Invoice</th>
                                <th style="width:20%">Customer</th>
                                <th style="width:20%">Phone</th>
                                <th style="width:30%">Product</th>
                                <th style="width:10%">Purchase</th>
                                <th style="width:10%">Sale</th>
                                <th style="width:10%">Qty</th>
                                <th style="width:10%">Total</th>
                            </tr>
                        </thead>               
                    
                        <tbody>
                            <?php
                                $total_purchase = 0;
                                $total_qty = 0;
                                $total_sale = 0;
                            ?>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr>
                                <td><?php echo e($value->order?$value->order->invoice_id:''); ?></td>
                                <td><?php echo e($value->shipping?$value->shipping->name:''); ?></td>
                                <td><?php echo e($value->shipping?$value->shipping->phone:''); ?></td>
                                <td><?php echo e($value->product_name); ?></td>
                                <td><?php echo e($value->purchase_price); ?></td>
                                <td><?php echo e($value->sale_price); ?></td>
                                <td><?php echo e($value->qty); ?></td>
                                <td><?php echo e($value->qty*$value->sale_price); ?></td>
                            </tr>
                            <?php
                                $total_purchase += $value->qty*$value->purchase_price;
                                $total_qty += $value->qty;
                                $total_sale += $value->qty * $value->sale_price;
                            ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </tbody>
                        </table>
                        <div style="display: flex; justify-content: center; margin-top: 20px;">
                            <table style="
                                border: 2px solid #333;
                                padding: 20px;
                                border-radius: 8px;
                                text-align: left;
                                min-width: 300px;
                                background: #f9f9f9;
                            ">
                                <tr>
                                    <td>
                                        <h5><strong>Sale Quantity = <?php echo e($total_qty); ?></strong></h5>
                                        <h5><strong>Sales = <?php echo e($page_sales); ?></strong></h5>
                                        <h5><strong>Purchase = <?php echo e($page_purchase); ?></strong></h5>
                                        <h5><strong>Profit = <?php echo e($page_sales - $page_purchase); ?></strong></h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/libs/select2/js/select2.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/js/pages/form-advanced.init.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?php echo e(asset('public/cdn/js/jquery.table2excel.min.js')); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        flatpickr(".flatdate", {});
    });
</script>
<script>
    function printFunction() {
        window.print();
    }
</script>
<script>
    $(document).ready(function() {
        $('#export-excel-button').on('click', function() {
            var contentToExport = $('#content-to-export').html();
            var tempElement = $('<div>');
            tempElement.html(contentToExport);
            tempElement.find('.table').table2excel({
                exclude: ".no-export",
                name: "Order Report" 
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/reports/order.blade.php ENDPATH**/ ?>