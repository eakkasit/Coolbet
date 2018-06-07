jQuery(document).ready(function () {
    var is_mobile = false;
    if (/Android|webOS|iPhone|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        is_mobile = true;
        item = 2;
    } else {
        item = 4;
    }

    jQuery(".amazingslider-slides").lightSlider({
        item: item,
        autoWidth: false,
        slideMove: 1, // slidemove will be 1 if loop is true
        slideMargin: 10,

        addClass: '',
        mode: "slide",
        useCSS: true,
        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
        easing: 'linear', //'for jquery animation',////

        speed: 400, //ms'
        auto: false,
        pauseOnHover: false,
        loop: false,
        slideEndAnimation: true,
        pause: 2000,

        keyPress: true,
        controls: true,
        prevHtml: '',
        nextHtml: '',

        rtl: false,
        adaptiveHeight: true,

        vertical: false,
        verticalHeight: 500,
        vThumbWidth: 100,

        thumbItem: 10,
        pager: false,
        gallery: false,
        galleryMargin: 5,
        thumbMargin: 5,
        currentPagerPosition: 'middle',

        enableTouch: true,
        enableDrag: false,
        freeMove: true,
        swipeThreshold: 40,

        responsive: [],

        onBeforeStart: function (el) {},
        onSliderLoad: function (el) {},
        onBeforeSlide: function (el) {},
        onAfterSlide: function (el) {},
        onBeforeNextSlide: function (el) {},
        onBeforePrevSlide: function (el) {}
    });

    jQuery('.lslide').click(function (e, index) {
        if (jQuery(this).index() != jQuery('.content-video li.active').index()) {
            var iframe = jQuery('.content-video li.active .embed-container').find('iframe');
            var src_split = iframe.attr('src').toString().split('?');
            iframe.attr('src', src_split[0]);
            iframe.removeAttr('allow');
            vimeoWrap = jQuery('.content-video li.active .embed-container');
            vimeoWrap.html(vimeoWrap.html());
        }
        jQuery('.content-video li.active').removeClass('active');
        jQuery('.content-video li').eq(jQuery(this).index()).addClass('active');
        var iframe = jQuery('.content-video li.active .embed-container').find('iframe');
        var player = new Vimeo.Player(iframe);
        player.play();


    });

});