 
<?php $__env->startSection('title','Order Create'); ?> 
<?php $__env->startSection('css'); ?>
<style>
    .increment_btn,
    .remove_btn {
        margin-top: -17px;
        margin-bottom: 10px;
    }
</style>
<link href="<?php echo e(asset('public/backEnd')); ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('public/backEnd')); ?>/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form method="get" action="<?php echo e(route('admin.order.cart_clear')); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger rounded-pill delete-confirm" title="Delete"><i class="fas fa-trash-alt"></i> Cart Clear</button></form>
                </div>
                <h4 class="page-title">Order Create</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.order.update')); ?>" method="POST" class="row pos_form" data-parsley-validate="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($order->id); ?>" name="order_id">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="product_id" class="form-label">Products *</label>
                                <select id="cart_add" class="form-control select2 <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  value="<?php echo e(old('product_id')); ?>" >
                                    <option value="">Select..</option>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['product_id'];
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
                        <div class="col-sm-12">
                          <table class="table table-bordered table-responsive-sm">
                            <thead>
                              <tr>
                              <tr>
                                <th style="width:10%">Image</th>
                                <th style="width:25%">Name</th>
                                <th style="width:15%">Quantity</th>
                                <th style="width:15%">Sell Price</th>
                                <th style="width:15%">Discount</th>
                                <th style="width:15%">Sub Total</th>
                                <th style="width:15%">Action</th>
                              </tr>
                              </tr>
                            </thead>
                            <tbody id="cartTable">
                              <?php
                                $product_discount = 0;
                              ?>
                              <?php $__currentLoopData = $cartinfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <td><img height="30" src="<?php echo e(asset($value->options->image)); ?>"></td>

                                <td><?php echo e($value->name); ?> 
                                <?php
                                    $product = App\Models\Product::find($value->id);
                                ?>
                             
                               <?php if($product && ($product->sizes->isNotEmpty() || $product->colors->isNotEmpty())): ?>
                                <div class="row g-1">
                                    <!-- Size Selector -->
                                    <?php if($product->sizes->isNotEmpty()): ?>
                                    <div class="col-md-6">
                                        <select id="size-selector-<?php echo e($value->rowId); ?>" class="form-select form-select-sm cart-size-selector" data-id="<?php echo e($value->rowId); ?>">
                                            <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($size->sizeName); ?>" <?php echo e($size->sizeName == $value->options->product_size ? 'selected' : ''); ?>>
                                                <?php echo e($size->sizeName); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label for="size-selector-<?php echo e($value->rowId); ?>" class="form-label text-muted text-start" style="font-size: 0.875rem;">Size:
                                        <?php if($value->options->product_size): ?>
                                          <?php echo e($value->options->product_size); ?>

                                        <?php endif; ?>
                                        </label>
                                    </div>
                                    <?php endif; ?>
                                
                                    <!-- Color Selector -->
                                    <?php if($product->colors->isNotEmpty()): ?>
                                    <div class="col-md-6">
                                        <select id="color-selector-<?php echo e($value->rowId); ?>" class="form-select form-select-sm cart-color-selector" data-id="<?php echo e($value->rowId); ?>">
                                            <?php $__currentLoopData = $product->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($color->colorName); ?>" <?php echo e($color->colorName == $value->options->product_color ? 'selected' : ''); ?>>
                                                <?php echo e($color->colorName); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label for="color-selector-<?php echo e($value->rowId); ?>" class="form-label text-muted text-start" style="font-size: 0.875rem;">Color:
                                        <?php if($value->options->product_color): ?>
                                           <?php echo e($value->options->product_color); ?>

                                        <?php endif; ?>
                                        </label>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                
                                </td>

                                
                                <td>
                                  <div class="qty-cart vcart-qty">
                                    <div class="quantity">
                                        <button class="minus cart_decrement" value="<?php echo e($value->qty); ?>"  data-id="<?php echo e($value->rowId); ?>">-</button>
                                        <input type="text" value="<?php echo e($value->qty); ?>" readonly />
                                        <button class="plus cart_increment" value="<?php echo e($value->qty); ?>" data-id="<?php echo e($value->rowId); ?>">+</button>
                                    </div>
                                </div>
                                </td>
                                <td><?php echo e($value->price); ?></td>
                                <td class="discount"><input type="number" class="product_discount" value="<?php echo e($value->options->product_discount); ?>" placeholder="0.00" data-id="<?php echo e($value->rowId); ?>">
                                </td>
                                <td><?php echo e(($value->price - $value->options->product_discount)*$value->qty); ?></td>
                                <td><button type="button" class="btn btn-danger btn-xs cart_remove" data-id="<?php echo e($value->rowId); ?>"><i class="fa fa-times"></i></button></td>
                              </tr>
                              <?php
                              $product_discount += $value->options->product_discount*$value->qty;
                              Session::put('product_discount',$product_discount);
                              ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                        </div>
                        <!-- custome address -->
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-2">
                                        <input type="text" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Customer Name" name="name" value="<?php echo e($shippinginfo->name); ?>" required>
                                        <?php $__errorArgs = ['name'];
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
                                <!-- col-end -->
                                <div class="col-sm-12">
                                    <div class="form-group mb-2">
                                        <input type="number" id="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Customer Number" name="phone" value="<?php echo e($shippinginfo->phone); ?>"  required>
                                        <?php $__errorArgs = ['phone'];
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
                                <!-- col-end -->
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <input type="address" placeholder="Address" id="address" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" value="<?php echo e($shippinginfo->address); ?>"  required>
                                        <?php $__errorArgs = ['email'];
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
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <select type="area" id="area" class="form-control <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="area"   required>
                                            <option value="">Delivery Area</option>
                                            <?php $__currentLoopData = $shippingcharge; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php if($shippinginfo->area == $value->name): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['email'];
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
                                <!-- col-end -->
                            </div>
                        </div>
                        <!-- cart total -->
                        <div class="col-sm-6">
                            <table class="table table-bordered">
                                <tbody id="cart_details">
                                    <?php
                                        $subtotal = Cart::instance('pos_shopping')->subtotal();
                                        $subtotal = str_replace(',','',$subtotal);
                                        $subtotal = str_replace('.00', '',$subtotal);
                                        $shipping = Session::get('pos_shipping');
                                        $total_discount = Session::get('pos_discount')+Session::get('product_discount');
                                    ?>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td><?php echo e($subtotal); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Fee</td>
                                        <td><?php echo e($shipping); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td><?php echo e($total_discount); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><?php echo e(($subtotal + $shipping)- $total_discount); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success" value="Update Order" />
                        </div>
                    </form>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/js/pages/form-validation.init.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/libs/select2/js/select2.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/js/pages/form-advanced.init.js"></script>
<!-- Plugins js -->
<script src="<?php echo e(asset('public/backEnd/')); ?>/assets/libs//summernote/summernote-lite.min.js"></script>
<script>
    $(".summernote").summernote({
        placeholder: "Enter Your Text Here",
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
<script>
    function cart_content(){
           $.ajax({
             type:"GET",
             url:"<?php echo e(route('admin.order.cart_content')); ?>",
             dataType: "html",
             success: function(cartinfo){
               $('#cartTable').html(cartinfo)
             }
          });
      }
      function cart_details(){
           $.ajax({
             type:"GET",
             url:"<?php echo e(route('admin.order.cart_details')); ?>",
             dataType: "html",
             success: function(cartinfo){
               $('#cart_details').html(cartinfo)
             }
          });
      }

      $('#cart_add').on('change',function(e){
       var id =$(this).val();
        if(id){
            $.ajax({
            cache: 'false',
            type:"GET",
            data:{'id':id},
            url:"<?php echo e(route('admin.order.cart_add')); ?>",
            dataType: "json",
            success: function(cartinfo){
                return cart_content()+cart_details();
            }
            });
        }
       });
    $(".cart_increment").click(function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var qty = $(this).val();
        if(id){
              $.ajax({
               cache: false,
               data:{'id':id,'qty':qty},
               type:"GET",
               url:"<?php echo e(route('admin.order.cart_increment')); ?>",
               dataType: "json",
            success: function(cartinfo){
                return cart_content()+cart_details();
            }
          });
        }
   });
    $(".cart_decrement").click(function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var qty = $(this).val();
        if(id){
              $.ajax({
               cache: false, 
               type:"GET",
               data:{'id':id,'qty':qty},
               url:"<?php echo e(route('admin.order.cart_decrement')); ?>",
               dataType: "json",
            success: function(cartinfo){
                return cart_content()+cart_details();
            }
          });
        }
   });
    $(".cart_remove").click(function(e){
        e.preventDefault();
        var id = $(this).data("id");
        if(id){
              $.ajax({
               cache: false,
               type:"GET",
               data:{'id':id},
               url:"<?php echo e(route('admin.order.cart_remove')); ?>",
               dataType: "json",
              success: function(cartinfo){
                return cart_content()+cart_details();
            }
          });
        }
   });
   $(".product_discount").change(function(){
        var id = $(this).data("id");
        var discount = $(this).val();
          $.ajax({
           cache: false,
           type:"GET",
           data:{'id':id,'discount':discount},
           url:"<?php echo e(route('admin.order.product_discount')); ?>",
           dataType: "json",
          success: function(cartinfo){
            return cart_content()+cart_details();
          }
        });
   });
    $(".cartclear").click(function(e){
      $.ajax({
           cache: false,
           type:"GET",
           url:"<?php echo e(route('admin.order.cart_clear')); ?>",
           dataType: "json",
          success: function(cartinfo){
            return cart_content()+cart_details();
          }
       });
   });// pshippingfee from total
    $("#area").on("change", function () {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            data: { id: id },
            url: "<?php echo e(route('admin.order.cart_shipping')); ?>",
            dataType: "html",
            success: function(cartinfo){
               return cart_content()+cart_details();
            }
        });
    });
// Event listener for size selector change
$('.cart-size-selector').on('change', function() {
    var rowId = $(this).data('id'); // Get the row ID
    var selectedSize = $(this).val(); // Get the selected size
     $.ajax({
           cache: false,
           type:"GET",
           data:{'id':rowId,'product_size':selectedSize},
           url:"<?php echo e(route('admin.order.cart.update')); ?>",
           dataType: "json",
            success: function(cartinfo){
            return cart_content()+cart_details();
          }
        });

});


// Event listener for color selector change
$('.cart-color-selector').on('change', function() {
    var rowId = $(this).data('id'); // Get the row ID
    var selectedColor = $(this).val(); // Get the selected color
    $.ajax({
           cache: false,
           type:"GET",
           data:{'id':rowId,'product_color':selectedColor},
           url:"<?php echo e(route('admin.order.cart.update')); ?>",
           dataType: "json",
            success: function(cartinfo){
            return cart_content()+cart_details();
          }
        });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/order/edit.blade.php ENDPATH**/ ?>