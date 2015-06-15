jQuery(function ($) {
    $(document).ready(function () {
        $('.woocommerce #content div.product div.images div.thumbnails').slick({
            vertical:true,
            verticalSwiping:true,
            slidesToShow:4,
            slidesToScroll:3,
            infinite:false,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-up"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-down"></i></button>'
        });
        $(".slick-prev,.slick-next").css("background-color",$(".sage #header .top").css("background-color"));
        $(".slick-prev,.slick-next").css("color",$(".sage #header .top .ecommerce-options a").css("color"));
    });
});