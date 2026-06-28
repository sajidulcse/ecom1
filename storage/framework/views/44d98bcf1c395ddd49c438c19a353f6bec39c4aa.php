<?php $__env->startSection('title','Product Manage'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right d-flex gap-2 align-items-center">
                    
                    <div class="dropdown">
                        <button class="btn btn-secondary rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fe-download me-1"></i> Export Product
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" id="export-csv"><i class="fe-file-text me-1"></i> Excel (CSV)</a>
                            <a class="dropdown-item" href="#" id="export-pdf"><i class="fe-file me-1"></i> PDF</a>
                        </div>
                    </div>
                    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-danger rounded-pill"><i class="fe-shopping-cart"></i> Add Product</a>
                </div>
                <h4 class="page-title">Product Manage</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <ul class="action2-btn">
                                <li><a href="<?php echo e(route('products.update_deals',['status'=>1])); ?>" class="btn rounded-pill btn-success hotdeal_update"><i class="fe-thumbs-up"></i> Deal</a></li>
                                <li><a href="<?php echo e(route('products.update_deals',['status'=>0])); ?>" class="btn rounded-pill btn-danger hotdeal_update"><i class="fe-thumbs-down"></i> Deal</a></li>
                                <li><a href="<?php echo e(route('products.update_status',['status'=>1])); ?>" class="btn rounded-pill btn-primary update_status"><i class="fe-thumbs-up"></i> Active</a></li>
                                <li><a href="<?php echo e(route('products.update_status',['status'=>0])); ?>" class="btn rounded-pill btn-warning update_status"><i class="fe-thumbs-down"></i> Inactive</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="product-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:2%"><input type="checkbox" class="checkall"></th>
                                    <th>SL</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Deal & Feature</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" value="<?php echo e($value->id); ?>"></td>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <div class="button-list custom-btn-list">
                                            <?php if($value->status == 1): ?>
                                            <form method="post" action="<?php echo e(route('products.inactive')); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($value->id); ?>" name="hidden_id">
                                                <button type="button" class="change-confirm" title="Active"><i class="fe-thumbs-down"></i></button>
                                            </form>
                                            <?php else: ?>
                                            <form method="post" action="<?php echo e(route('products.active')); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($value->id); ?>" name="hidden_id">
                                                <button type="button" class="change-confirm" title="Inactive"><i class="fe-thumbs-up"></i></button>
                                            </form>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('products.edit',$value->id)); ?>" title="Edit"><i class="fe-edit"></i></a>
                                            <form method="post" action="<?php echo e(route('products.destroy')); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($value->id); ?>" name="hidden_id">
                                                <button type="submit" class="delete-confirm" title="Delete"><i class="fe-trash-2"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td><?php echo e($value->category ? $value->category->name : ''); ?></td>
                                    <td><img src="<?php echo e(asset($value->image ? $value->image->image : '')); ?>" class="backend-image" alt=""></td>
                                    <td><?php echo e($value->new_price); ?></td>
                                    <td><?php echo e($value->stock); ?></td>
                                    <td>
                                        <p class="m-0">Hot Deals: <?php echo e($value->topsale==1?'Yes':'No'); ?></p>
                                        <p class="m-0">Top Feature: <?php echo e($value->feature_product==1?'Yes':'No'); ?></p>
                                    </td>
                                    <td>
                                        <?php if($value->status==1): ?>
                                            <span class="badge bg-soft-success text-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-soft-danger text-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- DataTables JS -->
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>

<script src="<?php echo e(asset('/public/backEnd/assets/js/kalpurush_vfs.js')); ?>"></script>
<script>
pdfMake.fonts = {
    Kalpurush: { normal: 'kalpurush.ttf', bold: 'kalpurush.ttf', italics: 'kalpurush.ttf', bolditalics: 'kalpurush.ttf' },
    Roboto:    { normal: 'Roboto-Regular.ttf', bold: 'Roboto-Medium.ttf', italics: 'Roboto-Italic.ttf', bolditalics: 'Roboto-MediumItalic.ttf' }
};
</script>

<script>
$(document).ready(function(){

    // Init DataTable -- added 2026-05-02
    var table = $('#product-datatable').DataTable({
        lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, 'All']],
        pageLength: 10,
        lengthChange: true,
        // disable sorting on checkbox (col 0), action (col 2), image (col 5), deal&feature (col 8)
        columnDefs: [
            { orderable: false, targets: [0, 2, 5, 8] }
        ],
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function(){
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        }
    });

    // Wire Export CSV button to DataTables CSV export
    $('#export-csv').on('click', function(e){
        e.preventDefault();
        table.button('.buttons-csv').trigger();
    });
    $('#export-pdf').on('click', function(e){
        e.preventDefault();
        table.button('.buttons-pdf').trigger();
    });

    // Hidden DataTables buttons for CSV + PDF (triggered by dropdown above)
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'csvHtml5',
                className: 'buttons-csv',
                title: 'Products Report',
                exportOptions: { columns: [1,3,4,6,7,9] }
            },
            {
                extend: 'pdf',
                className: 'buttons-pdf',
                title: 'Products Report',
                exportOptions: { columns: [1,3,4,6,7,9] },
                // Use Kalpurush for Bangla support -- added 2026-05-02
                customize: function(doc) {
                    doc.defaultStyle.font = 'Kalpurush';
                    doc.styles.tableHeader.font = 'Kalpurush';
                }
            },
        ]
    });

    // Checkbox: select all on current page
    $('.checkall').on('change', function(){
        $('#product-datatable tbody tr').find('input.checkbox').prop('checked', $(this).is(':checked'));
    });

    // Bulk deal update
    $(document).on('click', '.hotdeal_update', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var ids = $('input.checkbox:checked').map(function(){ return $(this).val(); }).get();
        if(!ids.length){ toastr.error('Please select a product first!'); return; }
        $.get(url, {product_ids: ids}, function(res){
            if(res.status === 'success'){ toastr.success(res.message); location.reload(); }
            else { toastr.error('Something went wrong'); }
        });
    });

    // Bulk status update
    $(document).on('click', '.update_status', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var ids = $('input.checkbox:checked').map(function(){ return $(this).val(); }).get();
        if(!ids.length){ toastr.error('Please select a product first!'); return; }
        $.get(url, {product_ids: ids}, function(res){
            if(res.status === 'success'){ toastr.success(res.message); location.reload(); }
            else { toastr.error('Something went wrong'); }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/product/index.blade.php ENDPATH**/ ?>