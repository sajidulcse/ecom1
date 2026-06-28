
<?php $__env->startSection('title','Stock Report'); ?>
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
                <h4 class="page-title">Stock Report</h4>
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
                                <label for="category_id" class="form-label">Categories </label>
                                <select class="form-control select2 <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="category_id" value="<?php echo e(old('category_id')); ?>" >
                                    <option value="">Select..</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if(request()->get('category_id') == $category->id): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category_id'];
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
                            </div>
                        </div>
                        <!-- col end -->
                    </div>  
                </form>
                <div class="row mb-3">
                    <div class="col-sm-6 no-print">
                         <?php echo e($products->links('pagination::bootstrap-4')); ?>

                    </div>
                    <div class="col-sm-6">
                        <div class="export-print text-end">
                            <button onclick="printFunction()"class="no-print btn btn-success"><i class="fa fa-print"></i> Print</button>
                            <button id="export-excel-button" class="no-print btn btn-info"><i class="fas fa-file-export"></i> Export</button>
                        </div>
                    </div>
                </div>
                <div id="content-to-export" class="table-responsive">
                    <table class="table nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width:5%">SL</th>
                            <th style="width:30%">Product Name</th>
                            <th style="width:10%">Price</th>
                            <th style="width:10%">Stock</th>
                            <th style="width:10%">Total</th>
                        </tr>
                    </thead>               
                
                    <tbody>
                        <?php
                            $stock = 0;
                            $total = 0;
                        ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($value->name); ?></td>
                            <td><?php echo e($value->new_price); ?></td>
                            <td><?php echo e($value->stock); ?></td>
                            <td><?php echo e($value->stock*$value->new_price); ?></td>
                        </tr>
                        <?php
                            $stock += $value->stock;
                            $total += $value->stock * $value->new_price;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                     <tfoot>
                             <tr>
                                 <td colspan="3" class="text-end"><strong>Total</strong></td>
                                 <td><strong><?php echo e($stock); ?> Pcs</strong></td>
                                 <td><strong><?php echo e($total); ?> Tk</strong></td>
                             </tr>
                             <tr>
                                 <td colspan="6" class="text-center">
                                     <h5><strong>Total Purchase = <?php echo e($total_purchase); ?></strong></h5>
                                     <h5><strong>Total Stock = <?php echo e($total_stock); ?> Pcs</strong></h5>
                                     <h5><strong>Total Price = <?php echo e($total_price); ?> Tk</strong></h5>
                                 </td>
                             </tr>
                         </tfoot>
                    </table>
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

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/reports/stock.blade.php ENDPATH**/ ?>