 
<?php $__env->startSection('title', 'Home'); ?> 
<?php $__env->startPush('seo'); ?>
 
<meta name="description" content="<?php echo $generalsetting->meta_description; ?>" />
<meta name="keyword" content="<?php echo $generalsetting->meta_keyword; ?>" />

		<!-- Open Graph data -->
<meta property="og:title" content="<?php echo e($generalsetting->name); ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo e(URL::to('/')); ?>" />
<meta property="og:image" content="<?php echo e(asset($generalsetting->og_baner)); ?>" />
<meta property="og:description" content="<?php echo $generalsetting->meta_description; ?>" />
<?php $__env->stopPush(); ?> <?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/frontEnd/css/owl.carousel.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('public/frontEnd/css/owl.theme.default.min.css')); ?>" />
<link href="<?php echo e(asset('public/cdn/css/animate-3.5.2.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?> <?php $__env->startSection('content'); ?>
<section class="slider-section">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-12">
                <div class="home-slider-container">
                    <div class="main_slider owl-carousel">
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="slider-item">
                                <img src="<?php echo e(asset($value->image)); ?>" alt="" />
                                
                            </div>
                            <!-- slider item -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider end -->


<section class="homeproduct">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec_title">
                    <h3 class="section-title-header">
                        <div class="timer_inner">
                            <div class="">
                                <span class="section-title-name"> Top Categories </span>
                            </div>
                        </div>
                    </h3>
                </div>
            </div>

            
            
            <div class="col-sm-12">
                <div class="category-sliger owl-carousel">
                    <?php $__currentLoopData = $menucategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <div class="text-center ">
                                <a href="<?php echo e(route('category', $value->slug)); ?>">
                                    <img class="" src="<?php echo e(asset($value->image)); ?>" alt="" style="border: 2px solid #3c7d17; border-radius: 50%; width: 100%; height: auto;" />
                                </a>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo e(route('category', $value->slug)); ?>">
                                    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo e($value->name); ?>

                                    </div>
                                
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>
</section>





<?php
    $hotDealEndDate = $generalsetting->hot_deal_end_date.'T23:59:59';
    $flashSaleEndDate = $generalsetting->flash_sale_end_date.'T23:59:59';
    $isHotDealActive = $hotDealEndDate && \Carbon\Carbon::parse($hotDealEndDate)->isFuture(); // Check if the date is in the future
    $isFlashSaleActive = $flashSaleEndDate && \Carbon\Carbon::parse($flashSaleEndDate)->isFuture(); 
?>
<!--//Flash sales-->
<?php if($isFlashSaleActive): ?>
<section class="homeproduct">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec_title">
                    <h3 class="section-title-header">
                        <div class="timer_inner">
                            <div class="">
                                <span class="section-title-name">Flash Sales </span>
                            </div>

                            <div class="">
                                <div class="offer_timer" id="flash_sale_timer"></div>
                            </div>
                        </div>
                    </h3>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="flash_sale_slider owl-carousel">
                    <?php $__currentLoopData = $flas_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product_item wist_item">
                            <div class="product_item_inner">
                                <?php if($value->old_price): ?>
                                <div class="sale-badge">
                                    <div class="sale-badge-inner">
                                        <div class="sale-badge-box">
                                            <span class="sale-badge-text">
                                                <p><?php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) ?> <?php echo e(number_format($discount, 0)); ?>%</p>
                                                ছাড়
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="pro_img">
                                    <a href="<?php echo e(route('product', $value->slug)); ?>">
                                        <img src="<?php echo e(asset($value->image ? $value->image->image : '')); ?>"
                                            alt="<?php echo e($value->name); ?>" />
                                    </a>
                                    <?php if($value->stock < 1): ?>
                                    <div class="stock-out-overlay">STOCK OUT</div>
                                    <?php endif; ?>
                                </div>
                                <div class="pro_des">
                                    <div class="pro_name">
                                        <a href="<?php echo e(route('product', $value->slug)); ?>"><?php echo e(Str::limit($value->name, 80)); ?></a>
                                    </div>
                                    
                                    <span style="background-color:#FFBCA5" class="px-3 py-1 rounded-pill">Sold <?php echo e($value->sold??0); ?></span>
                                  
                                <div class="pro_price">
                                    <p>
                                        <?php
                                            $old = isset($value->old_price) ? floatval($value->old_price) : 0;
                                            $new = isset($value->new_price) ? floatval($value->new_price) : 0;
                                        ?>

                                        <?php if($old > 0): ?>
                                            <del>৳ <?php echo e(number_format($old, 2)); ?></del>
                                        <?php endif; ?>

                                        ৳ <?php echo e(number_format($new, 2)); ?>

                                    </p>
                            </div>

                                </div>
                            </div>

                            <?php if(!$value->prosizes->isEmpty() || !$value->procolors->isEmpty() || ($value->stock < 1)): ?>
                                <div class="pro_btn">
                                   
                                    <div class="cart_btn order_button">
                                        <a href="<?php echo e(route('product', $value->slug)); ?>"
                                            class="addcartbutton">অর্ডার করুন</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="pro_btn">
                                    
                                    <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($value->id); ?>" />
                                        <input type="hidden" name="qty" value="1" />
                                        <button type="submit">অর্ডার করুন</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-sm-12">
               <a href="<?php echo e(route('flashsales')); ?>" class="view_more_btn" style="float:left">View More</a> 
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!--//hot deals-->
<?php if($isHotDealActive): ?>
<section class="homeproduct">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec_title">
                    <h3 class="section-title-header">
                        <div class="timer_inner">
                            <div class="">
                                <span class="section-title-name">Hot Deal </span>
                            </div>

                            <div class="">
                                <div class="offer_timer" id="simple_timer"></div>
                            </div>
                        </div>
                    </h3>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="product_slider owl-carousel">
                    <?php $__currentLoopData = $hotdeal_top; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product_item wist_item">
                            <div class="product_item_inner">
                                <?php if($value->old_price): ?>
                                <div class="sale-badge">
                                    <div class="sale-badge-inner">
                                        <div class="sale-badge-box">
                                            <span class="sale-badge-text">
                                                <p><?php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) ?> <?php echo e(number_format($discount, 0)); ?>%</p>
                                                ছাড়
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="pro_img">
                                    <a href="<?php echo e(route('product', $value->slug)); ?>">
                                        <img src="<?php echo e(asset($value->image ? $value->image->image : '')); ?>"
                                            alt="<?php echo e($value->name); ?>" />
                                    </a>
                                    <?php if($value->stock < 1): ?>
                                    <div class="stock-out-overlay">STOCK OUT</div>
                                    <?php endif; ?>
                                </div>
                                <div class="pro_des">
                                    <div class="pro_name">
                                        <a
                                            href="<?php echo e(route('product', $value->slug)); ?>"><?php echo e(Str::limit($value->name, 80)); ?></a>
                                    </div>
                                <div class="pro_price">
                                    <p>
                                        <?php
                                            $old = isset($value->old_price) ? floatval($value->old_price) : 0;
                                            $new = isset($value->new_price) ? floatval($value->new_price) : 0;
                                        ?>

                                        <?php if($old > 0): ?>
                                            <del>৳ <?php echo e(number_format($old, 2)); ?></del>
                                        <?php endif; ?>

                                        ৳ <?php echo e(number_format($new, 2)); ?>

                                    </p>
                            </div>
                                </div>
                            </div>

                            <?php if(!$value->prosizes->isEmpty() || !$value->procolors->isEmpty() || ($value->stock < 1)): ?>
                                <div class="pro_btn">
                                   
                                    <div class="cart_btn order_button">
                                        <a href="<?php echo e(route('product', $value->slug)); ?>"
                                            class="addcartbutton">অর্ডার করুন</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="pro_btn">
                                    
                                    <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($value->id); ?>" />
                                        <input type="hidden" name="qty" value="1" />
                                        <button type="submit">অর্ডার করুন</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-sm-12">
               <a href="<?php echo e(route('hotdeals')); ?>" class="view_more_btn" style="float:left">View More</a> 
            </div>
        </div>
    </div>
</section>
<?php endif; ?>




<?php if($generalsetting->show_all_products): ?>
<section class="homeproduct">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec_title">
                    <h3 class="section-title-header">
                        <div class="timer_inner">
                            <div class="">
                                <span class="section-title-name">All Products</span>
                            </div>
                        </div>
                    </h3>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="category-product main_product_inner">
                    <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product_item wist_item">
                        <div class="product_item_inner">
                             <?php if($value->old_price): ?>
                            <div class="sale-badge">
                                <div class="sale-badge-inner">
                                    <div class="sale-badge-box">
                                        <span class="sale-badge-text">
                                           <p> <?php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) ?> <?php echo e(number_format($discount,0)); ?>%</p>
                                            ছাড়
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="pro_img">
                                <a href="<?php echo e(route('product',$value->slug)); ?>">
                                    <img src="<?php echo e(asset($value->image ? $value->image->image : '')); ?>" alt="<?php echo e($value->name); ?>" />
                                </a>
                                <?php if($value->stock < 1): ?>
                                <div class="stock-out-overlay">STOCK OUT</div>
                                <?php endif; ?>
                            </div>
                            <div class="pro_des">
                                <div class="pro_name">
                                    <a href="<?php echo e(route('product',$value->slug)); ?>"><?php echo e(Str::limit($value->name,80)); ?></a>
                                </div>
                                <div class="pro_price">
                                    <p>
                                        <?php
                                            $old = isset($value->old_price) ? floatval($value->old_price) : 0;
                                            $new = isset($value->new_price) ? floatval($value->new_price) : 0;
                                        ?>

                                        <?php if($old > 0): ?>
                                            <del>৳ <?php echo e(number_format($old, 2)); ?></del>
                                        <?php endif; ?>

                                        ৳ <?php echo e(number_format($new, 2)); ?>

                                    </p>
                            </div>
                            </div>
                        </div>

                         <?php if(! $value->prosizes->isEmpty() || ! $value->procolors->isEmpty() || ($value->stock < 1)): ?>
                        <div class="pro_btn">
                            
                            <div class="cart_btn order_button">
                                <a href="<?php echo e(route('product',$value->slug)); ?>" class="addcartbutton">অর্ডার করুন</a>
                            </div>
                            
                        </div>
                        <?php else: ?>

                        <div class="pro_btn">
                           
                            <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($value->id); ?>" />
                                <input type="hidden" name="qty" value="1" />
                                <button type="submit">অর্ডার করুন</button>
                            </form>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<?php if($sliderbottomads): ?>
<section class="mt-2">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $sliderbottomads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottomAds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <a href="<?php echo e($bottomAds->link); ?>?sold=show">
                    <img class="img-fluid" src="<?php echo e($bottomAds->image); ?>"/>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>




<?php if($generalsetting->show_category_wise_products): ?>
    <?php $__currentLoopData = $homeproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homecat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="homeproduct">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sec_title">
                            <h3 class="section-title-header">
                                <span class="section-title-name"><?php echo e($homecat->name); ?></span>
                                
                            </h3>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="product_sliders">
                            <?php $__currentLoopData = $homecat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <div class="product_item wist_item">
                                <div class="product_item_inner">
                                    <?php if($value->old_price): ?>
                                    <div class="sale-badge">
                                        <div class="sale-badge-inner">
                                            <div class="sale-badge-box">
                                                <span class="sale-badge-text">
                                                    <p><?php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) ?> <?php echo e(number_format($discount, 0)); ?>%</p>
                                                    ছাড়
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="pro_img">
                                        <a href="<?php echo e(route('product', $value->slug)); ?>">
                                            <img src="<?php echo e(asset($value->image ? $value->image->image : '')); ?>"
                                                alt="<?php echo e($value->name); ?>" />
                                        </a>
                                        <?php if($value->stock < 1): ?>
                                        <div class="stock-out-overlay">STOCK OUT</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pro_des">
                                        <div class="pro_name">
                                            <a
                                                href="<?php echo e(route('product', $value->slug)); ?>"><?php echo e(Str::limit($value->name, 80)); ?></a>
                                        </div>
                                <div class="pro_price">
                                    <p>
                                        <?php
                                            $old = isset($value->old_price) ? floatval($value->old_price) : 0;
                                            $new = isset($value->new_price) ? floatval($value->new_price) : 0;
                                        ?>

                                        <?php if($old > 0): ?>
                                            <del>৳ <?php echo e(number_format($old, 2)); ?></del>
                                        <?php endif; ?>

                                        ৳ <?php echo e(number_format($new, 2)); ?>

                                    </p>
                                </div>
                                    </div>
                                </div>
    
                                <?php if(!$value->prosizes->isEmpty() || !$value->procolors->isEmpty() || ($value->stock < 1)): ?>
                                    <div class="pro_btn">
                                       
                                        <div class="cart_btn order_button">
                                            <a href="<?php echo e(route('product', $value->slug)); ?>"
                                                class="addcartbutton">অর্ডার করুন</a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="pro_btn">
                                        
                                        <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($value->id); ?>" />
                                            <input type="hidden" name="qty" value="1" />
                                            <button type="submit">অর্ডার করুন</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="show_more_btn">
                            <a href="<?php echo e(route('category', $homecat->slug)); ?>" class="view_more_btn">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if($campaognads): ?>
<section>
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $campaognads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaignAds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12">
                <a href="<?php echo e($campaignAds->link); ?>?sold=show">
                    <img class="img-fluid" src="<?php echo e($campaignAds->image); ?>"/>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if($reviews->count()>0): ?>
<section class="homeproduct">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec_title">
                    <h5 class="text-center text-light py-2" style="background-color:#3c7d17">
                        সম্মানীত কাষ্টমারদের পজিটিভ রিভিউ
                    </h5>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="customer-review owl-carousel">
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border rounded">
                        <img class="img-fluid w-100" src="<?php echo e(asset($review->image)); ?>" />
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
        </div>
    </div>
</section>
<?php endif; ?>
<section>
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $footertopads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footerAds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <a href="<?php echo e($footerAds->link); ?>?sold=show">
                    <img class="img-fluid w-100" src="<?php echo e($footerAds->image); ?>"/>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?> <?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('public/frontEnd/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontEnd/js/jquery.syotimer.min.js')); ?>"></script>

<script>
    $(document).ready(function() {
        $(".main_slider").owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            nav: true,
            autoplayHoverPause: true,
            margin: 0,
            mouseDrag: true,
            smartSpeed: 8000,
            autoplayTimeout: 3000,
            animateOut: "fadeOutRight",
            animateIn: "slideInLeft",

            navText: ["<i class='fa-solid fa-angle-left'></i>",
                "<i class='fa-solid fa-angle-right'></i>"
            ],
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".hotdeals-slider").owlCarousel({
            margin: 15,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 3,
                    nav: true,
                },
                600: {
                    items: 3,
                    nav: false,
                },
                1000: {
                    items: 6,
                    nav: true,
                    loop: false,
                },
            },
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".category-slider").owlCarousel({
            margin: 15,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 5,
                    nav: true,
                },
                600: {
                    items: 3,
                    nav: false,
                },
                1000: {
                    items: 8,
                    nav: true,
                    loop: false,
                },
            },
        });

        $(".product_slider").owlCarousel({
            margin: 15,
            items: 6,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false,
                },
                600: {
                    items: 5,
                    nav: false,
                },
                1000: {
                    items: 6,
                    nav: false,
                },
            },
        });
        
        $(".flash_sale_slider").owlCarousel({
            margin: 8,
            items: 6,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 3,
                    nav: false,
                },
                600: {
                    items: 6,
                    nav: false,
                },
                1000: {
                    items: 7,
                    nav: false,
                },
            },
        });
        
        $(".category-sliger").owlCarousel({
            margin: 8,
            items: 6,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 3,
                    nav: false,
                },
                600: {
                    items: 6,
                    nav: false,
                },
                1000: {
                    items: 7,
                    nav: false,
                },
            },
        });
        $(".customer-review").owlCarousel({
            margin: 8,
            items: 6,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false,
                },
                600: {
                    items: 3,
                    nav: false,
                },
                1000: {
                    items: 5,
                    nav: false,
                },
            },
        });
    });
</script>

<script>
    $("#simple_timer").syotimer({
        date: new Date("<?php echo e($generalsetting->hot_deal_end_date); ?>T23:59:59"), // November is month 10 (0-indexed)
        layout: "hms", // Hours, minutes, seconds
        doubleNumbers: false, // No leading zeros
        effectType: "opacity", // Opacity effect when changing numbers
        periodUnit: "d", // Period unit set to days
        periodic: false // Countdown only, no reset
    });
   $("#flash_sale_timer").syotimer({
        date: new Date("<?php echo e($generalsetting->flash_sale_end_date); ?>T23:59:59"), // Use the date from your Laravel model
        layout: "hms", // Hours, minutes, seconds
        doubleNumbers: false, // No leading zeros
        effectType: "opacity", // Opacity effect when changing numbers
        periodUnit: "d", // Period unit set to days
        periodic: false, // Countdown only, no reset
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontEnd.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laragon\www\ecommerce1.nextstagesoftware.com_20260507_141104\resources\views/frontEnd/layouts/pages/index.blade.php ENDPATH**/ ?>