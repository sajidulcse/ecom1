 <?php
  $product_discount = 0;
?>
<?php $__currentLoopData = $cartinfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td><img height="30" src="<?php echo e(asset($value->options->image)); ?>"></td>
  <td>
      <?php echo e($value->name); ?>

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
</script><?php /**PATH /www/wwwroot/ecommerce1.nextstagesoftware.com/resources/views/backEnd/order/cart_content.blade.php ENDPATH**/ ?>