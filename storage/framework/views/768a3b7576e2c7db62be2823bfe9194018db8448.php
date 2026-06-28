
<?php $__env->startSection('title',$order_status->name.' Order'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="<?php echo e(route('admin.order.create')); ?>" class="btn btn-danger rounded-pill"><i class="fe-shopping-cart"></i> Add New</a>
                </div>
                <h4 class="page-title"><?php echo e($order_status->name); ?> Order (<?php echo e($order_status->orders_count); ?>)</h4>
            </div>
        </div>
    </div>       
    <!-- end page title --> 
   <div class="row order_page">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <ul class="action2-btn">
                            <li><a data-bs-toggle="modal" data-bs-target="#asignUser" class="btn rounded-pill btn-success"><i class="fe-plus"></i> Assign User</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#changeStatus" class="btn rounded-pill btn-primary"><i class="fe-plus"></i> Change Status</a></li>
                            <li><a href="<?php echo e(route('admin.order.bulk_destroy')); ?>" class="btn rounded-pill btn-danger order_delete"><i class="fe-plus"></i> Delete All</a></li>
                            <li><a href="<?php echo e(route('admin.order.order_print')); ?>" class="btn rounded-pill btn-info multi_order_print"><i class="fe-printer"></i> Print</a></li>
                            <?php if($steadfast): ?>
                            <li><a href="<?php echo e(route('admin.bulk_courier', 'steadfast')); ?>?status=5" class="btn rounded-pill btn-info multi_order_courier"><i class="fe-truck"></i> Steadfast</a></li>
                            <?php endif; ?>
                            <li><a data-bs-toggle="modal" data-bs-target="#pathao" class="btn rounded-pill btn-info"><i class="fe-truck"></i> pathao</a></li>
                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <form class="custom_form" onsubmit="return false">
                            <div class="form-group">
                                <input type="text" id="order-search-input"
                                       placeholder="Search…" autocomplete="off">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                <table id="order-datatable" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th style="width:2%"><input type="checkbox" class="checkall"></th>
                            <th style="width:2%">SL</th>
                            <th style="width:8%">Action</th>
                            <th style="width:8%">Invoice</th>
                            <th style="width:10%">Date</th>
                            <th style="width:10%">Name</th>
                            <th style="width:10%">Phone</th>
                            <th style="width:10%">Check</th>
                            <th style="width:10%">Amount</th>
                            <th style="width:10%">Status</th>
                        </tr>
                    </thead>
                
                
                    <tbody>
                        <?php $__currentLoopData = $show_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><input type="checkbox" class="checkbox" value="<?php echo e($value->id); ?>"></td>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <div class="button-list custom-btn-list">   
                                    <a href="<?php echo e(route('admin.order.invoice',['invoice_id'=>$value->invoice_id])); ?>" title="Invoice"><i class="fe-eye"></i></a>
                                    <a href="<?php echo e(route('admin.order.process',['invoice_id'=>$value->invoice_id])); ?>" title="Process"><i class="fe-settings"></i></a>
                                    <a href="<?php echo e(route('admin.order.edit',['invoice_id'=>$value->invoice_id])); ?>" title="Edit"><i class="fe-edit"></i></a>
                                    <form method="post" action="<?php echo e(route('admin.order.destroy')); ?>" class="d-inline">        
                                        <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e($value->id); ?>" name="id">
                                    <button type="submit" title="Delete" class="delete-confirm"><i class="fe-trash-2"></i></button>

                                    
                                    </form>
                                </div>
                            </td>
                            <td><?php echo e($value->invoice_id); ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($value->updated_at))); ?><br> <?php echo e(date('h:i:s a', strtotime($value->updated_at))); ?></td>
                            <td><strong><?php echo e($value->shipping?$value->shipping->name:''); ?></strong><p><?php echo e($value->shipping?$value->shipping->address:''); ?></p></td>
                            <td><?php echo e($value->shipping?$value->shipping->phone:''); ?></td>
                            
                            <td>
                                <button class="btn btn-sm btn-warning rounded-pill fraud-check-btn"
                                        data-phone="<?php echo e($value->shipping?->phone); ?>"
                                        data-name="<?php echo e($value->shipping?->name); ?>">
                                    <i class="fe-shield"></i> Check
                                </button>
                            </td>
                            <td>৳<?php echo e($value->amount); ?></td>
                            <td><?php echo e($value->status?$value->status->name:''); ?></td>
                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
            </div> <!-- end card body-->
           
        </div> <!-- end card -->
    </div><!-- end col-->
   </div>
</div>
<!-- Assign User End -->
<div class="modal fade" id="asignUser" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo e(route('admin.order.assign')); ?>" id="order_assign">
      <div class="modal-body">
        <div class="form-group">
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Select..</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Assign User End-->

<!-- Assign User End -->
<div class="modal fade" id="changeStatus" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo e(route('admin.order.status')); ?>" id="order_status_form">
      <div class="modal-body">
        <div class="form-group">
            <select name="order_status" id="order_status" class="form-control">
                <option value="">Select..</option>
                <?php $__currentLoopData = $orderstatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Assign User End-->
<!-- pathao coureir start -->
<div class="modal fade" id="pathao" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pathao Courier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo e(route('admin.order.pathao')); ?>" id="order_sendto_pathao">

      <div class="modal-body">
        <div class="form-group">
            <label for="pathaostore" class="form-label">Store</label>
           <select name="pathaostore" id="pathaostore" class="pathaostore form-control" >
             <option value="">Select Store...</option>
             <?php if(isset($pathaostore['data']['data'])): ?>
             <?php $__currentLoopData = $pathaostore['data']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <option value="<?php echo e($store['store_id']); ?>"><?php echo e($store['store_name']); ?></option>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php else: ?>
             <?php endif; ?>
           </select>
            <?php if($errors->has('pathaostore')): ?>
              <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('pathaostore')); ?></strong>
              </span>
              <?php endif; ?>
        </div>
        <!-- form group end -->
        <div class="form-group mt-3">
          <label for="pathaocity" class="form-label">City</label>
           <select name="pathaocity" id="pathaocity" class="chosen-select pathaocity form-control" style="width:100%" >
             <option value="">Select City...</option>
             <?php if(isset($pathaocities['data']['data'])): ?>
             <?php $__currentLoopData = $pathaocities['data']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <option value="<?php echo e($city['city_id']); ?>"><?php echo e($city['city_name']); ?></option>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php else: ?>
             <?php endif; ?>
           </select>
            <?php if($errors->has('pathaocity')): ?>
              <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('pathaocity')); ?></strong>
              </span>
              <?php endif; ?>
        </div>
        <!-- form group end -->
        <div class="form-group mt-3">
          <label for="" class="form-label">Zone</label>
             <select name="pathaozone" id="pathaozone" class="pathaozone chosen-select form-control  <?php echo e($errors->has('pathaozone') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('pathaozone')); ?>"  style="width:100%">
            </select>
             <?php if($errors->has('pathaozone')): ?>
              <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('pathaozone')); ?></strong>
              </span>
              <?php endif; ?>
        </div>
        <!-- form group end -->
        <div class="form-group mt-3">
          <label for="" class="form-label">Area</label>
             <select name="pathaoarea" id="pathaoarea" class="pathaoarea chosen-select form-control  <?php echo e($errors->has('pathaoarea') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('pathaoarea')); ?>"  style="width:100%">
            </select>
             <?php if($errors->has('pathaoarea')): ?>
              <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('pathaoarea')); ?></strong>
              </span>
              <?php endif; ?>
        </div>
        <!-- form group end -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- pathao courier  End-->

<script id="all-order-ids" type="application/json"><?php echo json_encode($all_ids, 15, 512) ?></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo e(asset('/public/backEnd/')); ?>/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
// IIFE captures CDN jQuery+DataTables ref before vendor.min.js overwrites $ -- 2026-05-02
;(function($){
$(document).ready(function(){
    var allIds = JSON.parse(document.getElementById('all-order-ids').textContent);
    var selectAllMode = false;

    // Init DataTables -- added 2026-05-02
    var orderTable = $('#order-datatable').DataTable({
        lengthMenu : [[25, 50, 100, -1],[25, 50, 100, 'All']],
        pageLength : 25,
        searching  : true,
        columnDefs : [
            { orderable: false, searchable: false, targets: [0, 2, 7] }
        ],
        dom: '<"row"<"col-sm-6"l><"col-sm-6">>rtip',
        language: {
            paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }
        },
        drawCallback: function(){
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        }
    });

    // Wire custom search → DataTables (all columns, no page refresh) -- 2026-05-02
    $('#order-search-input').on('input', function(){
        orderTable.search($(this).val()).draw();
    });

    // Helper: get selected IDs (respects select-all mode)
    function getSelectedIds() {
        if (selectAllMode) return allIds;
        return $('input.checkbox:checked').map(function(){ return $(this).val(); }).get();
    }

    $(".checkall").on('change', function(){
        selectAllMode = $(this).is(':checked');
        $(".checkbox").prop('checked', selectAllMode);
    });

    // Individual uncheck exits select-all mode
    $(document).on('change', '.checkbox', function(){
        if (!$(this).is(':checked')) selectAllMode = false;
    });

    // order assign
    $(document).on('submit', 'form#order_assign', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        let user_id=$(document).find('select#user_id').val();
        var order_ids = getSelectedIds();
        if(order_ids.length ==0){
            toastr.error('Please Select An Order First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{user_id,order_ids},
           success:function(res){
               if(res.status=='success'){
                toastr.success(res.message);
                window.location.reload();
                
            }else{
                toastr.error('Failed something wrong');
            }
           }
        });
    
    });

    // order status change
    $(document).on('submit', 'form#order_status_form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        let order_status=$(document).find('select#order_status').val();
        var order_ids = getSelectedIds();
        if(order_ids.length ==0){
            toastr.error('Please Select An Order First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{order_status,order_ids},
           success:function(res){
               if(res.status=='success'){
                toastr.success(res.message);
                window.location.reload();
                
            }else{
                toastr.error('Failed something wrong');
            }
           }
        });
    
    });
    // order delete
    $(document).on('click', '.order_delete', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var order_ids = getSelectedIds();
        if(order_ids.length ==0){
            toastr.error('Please Select An Order First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{order_ids},
           success:function(res){
               if(res.status=='success'){
                toastr.success(res.message);
                window.location.reload();
                
            }else{
                toastr.error('Failed something wrong');
            }
           }
        });
    
    });
    
    // multiple print
    $(document).on('click', '.multi_order_print', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var order_ids = getSelectedIds();
        if(order_ids.length ==0){
            toastr.error('Please Select Atleast One Order!');
            return ;
        }
        $.ajax({
           type:'GET',
           url,
           data:{order_ids},
           success:function(res){
               if(res.status=='success'){
                   console.log(res.items, res.info);                          
                   var myWindow = window.open("", "_blank");                   
                   myWindow.document.write(res.view);
            }else{
                toastr.error('Failed something wrong');
            }
           }
        });
    });
    // multiple courier
    // Bulk courier send -- updated 2026-04-15
    $(document).on('click', '.multi_order_courier', function(e){
        e.preventDefault();
        var url      = $(this).attr('href');
        var courier  = $(this).text().trim();
        var order_ids = getSelectedIds();

        if (order_ids.length === 0) {
            toastr.error('Please select at least one order first.');
            return;
        }

        // Show spinner on button
        var btn = $(this);
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

        $.ajax({
            type: 'GET',
            url:  url,
            data: { order_ids: order_ids },
            success: function(res) {
                if (res.status === 'error') {
                    toastr.error(res.message);
                    btn.prop('disabled', false).html('<i class="fe-truck"></i> ' + courier);
                    return;
                }

                // Build result modal body
                var html = '';

                if (res.success && res.success.length) {
                    html += '<h6 class="text-success"><i class="fe-check-circle"></i> Sent (' + res.success.length + ')</h6>';
                    html += '<table class="table table-sm table-bordered mb-3"><thead><tr><th>Invoice</th><th>Consignment ID</th><th>Note</th></tr></thead><tbody>';
                    $.each(res.success, function(i, o) {
                        html += '<tr class="table-success"><td>' + o.invoice + '</td><td>' + (o.consignment_id||'—') + '</td><td>' + o.message + '</td></tr>';
                    });
                    html += '</tbody></table>';
                }

                if (res.failed && res.failed.length) {
                    html += '<h6 class="text-danger"><i class="fe-alert-circle"></i> Failed (' + res.failed.length + ')</h6>';
                    html += '<table class="table table-sm table-bordered"><thead><tr><th>Invoice</th><th>Reason</th></tr></thead><tbody>';
                    $.each(res.failed, function(i, o) {
                        html += '<tr class="table-danger"><td>' + o.invoice + '</td><td>' + o.message + '</td></tr>';
                    });
                    html += '</tbody></table>';
                }

                if (!html) html = '<p class="text-muted">No orders were processed.</p>';

                $('#courierResultBody').html(html);
                $('#courierResultModal').modal('show');

                if (res.success && res.success.length) {
                    setTimeout(function(){ window.location.reload(); }, 3000);
                }
            },
            error: function(xhr) {
                toastr.error('Server error. Please try again.');
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fe-truck"></i> ' + courier);
            }
        });
    });
}); // end ready
}(jQuery)); // end IIFE — jQuery here is CDN jQuery with DataTables
</script>


<div class="modal fade" id="courierResultModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fe-truck"></i> Courier Push Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="courierResultBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="fraudModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="fe-shield"></i> Fraud Check — <span id="fraud-modal-name"></span> (<span id="fraud-modal-phone"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="fraud-modal-body">
                <div class="text-center py-4">
                    <div class="spinner-border text-warning" role="status"></div>
                    <p class="mt-2">Checking with FraudBD…</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.fraud-check-btn', function () {
    var phone = $(this).data('phone');
    var name  = $(this).data('name');

    $('#fraud-modal-name').text(name || '—');
    $('#fraud-modal-phone').text(phone || '—');
    $('#fraud-modal-body').html('<div class="text-center py-4"><div class="spinner-border text-warning" role="status"></div><p class="mt-2">Checking with FraudBD…</p></div>');
    $('#fraudModal').modal('show');

    $.ajax({
        type: 'GET',
        url: '<?php echo e(route("admin.fraud.check")); ?>',
        data: { phone: phone },
        success: function (res) {
            $('#fraud-modal-body').html(buildFraudResult(res));
        },
        error: function (xhr) {
            var msg = xhr.responseJSON?.error ?? 'Something went wrong.';
            $('#fraud-modal-body').html('<div class="alert alert-danger">' + msg + '</div>');
        }
    });
});

function buildFraudResult(data) {
    if (data.error) {
        return '<div class="alert alert-danger">' + data.error + '</div>';
    }

    var html = '';

    // Loop over each courier in response
    $.each(data, function (courier, info) {
        if (typeof info !== 'object' || info === null) return;

        var badgeClass = 'secondary';
        var riskLabel  = 'Unknown';

        // Pathao uses rating labels
        if (info.rating) {
            var r = info.rating;
            if (r === 'excellent_customer' || r === 'good_customer') { badgeClass = 'success'; riskLabel = r.replace('_', ' '); }
            else if (r === 'moderate_customer') { badgeClass = 'warning'; riskLabel = 'Moderate'; }
            else if (r === 'risky_customer')    { badgeClass = 'danger';  riskLabel = 'Risky'; }
            else if (r === 'new_customer')      { badgeClass = 'info';    riskLabel = 'New'; }
        }

        // Generic risk level from other couriers
        if (info.risk_level) {
            var lvl = info.risk_level.toLowerCase();
            if (lvl === 'low')    { badgeClass = 'success'; riskLabel = 'Low Risk'; }
            if (lvl === 'medium') { badgeClass = 'warning'; riskLabel = 'Medium Risk'; }
            if (lvl === 'high')   { badgeClass = 'danger';  riskLabel = 'High Risk'; }
        }

        html += '<div class="card mb-3">';
        html += '<div class="card-header d-flex justify-content-between align-items-center">';
        html += '<strong>' + courier.toUpperCase() + '</strong>';
        html += '<span class="badge bg-' + badgeClass + ' fs-6">' + riskLabel + '</span>';
        html += '</div>';
        html += '<div class="card-body"><div class="row">';

        $.each(info, function (k, v) {
            if (typeof v === 'object') return;
            var label = k.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            html += '<div class="col-sm-6 mb-1"><small class="text-muted">' + label + '</small><br><strong>' + v + '</strong></div>';
        });

        html += '</div></div></div>';
    });

    return html || '<div class="alert alert-info">No data returned for this phone number.</div>';
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/order/index.blade.php ENDPATH**/ ?>