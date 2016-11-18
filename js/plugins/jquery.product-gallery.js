/* 
 Created on : 05-Aug-2016, 20:05:01
 Author     : Gino
 */
(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== 'undefined') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }

}(function ($) {
    'use strict';
    var ProductGallery = window.ProductGallery || {};

    ProductGallery = (function () {

        var instanceUid = 0;
        function ProductGallery(element, settings) {

            var _ = this, dataSettings, responsiveSettings;

            _.defaults = {
            };

            _.initials = {
            };

            _.$gallery = $(element),
                    _.$thumbnails,
                    _.$thumbnailImgs,
                    _.$mainImageContainer,
                    _.$mainImage,
                    _.$loader,
                    _.current_main_image,
                    _.$overlay,
                    _.$fotorama,
                    _.fotorama;

            $.extend(_, _.initials);

            dataSettings = $(element).data('slick') || {};

            _.options = $.extend({}, _.defaults, dataSettings, settings);

            _.instanceUid = instanceUid++;

            // A simple way to check for HTML strings
            // Strict HTML recognition (must start with <)
            // Extracted from jQuery v1.11 source
            _.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;

            _.init();

        }

        return ProductGallery;

    }());

    ProductGallery.prototype.init = function () {

        var _ = this;

        if (!$(_.$gallery).hasClass('product-gallery')) {
            $(_.$gallery).addClass('product-gallery');
        }

        if (!$(_.$gallery).hasClass('initialized')) {

            $(_.$gallery).addClass('initialized');
            _.initStructure();
            //_.initFotorama();
            _.initSlick();
            _.initThumbEvents();
            _.initDimensions();
        }

    };

    ProductGallery.prototype.initStructure = function () {
        var _ = this;
        if (_.$gallery.find('.thumbnails').length === 0) {
            _.$gallery.wrapInner('<div class="thumbnails"></div>');
        }
        if (_.$gallery.find('.main-image').length === 0) {
            var table = '<table class = "main-image">' +
                    '<tr>' +
                    '<td>' +
                    '<a href = "" itemprop = "image" title = "" >' +
                    '<div class = "img" style = "background-image:url(\'\')"></div>' +
                    '</a>' +
                    '<img class = "loader" src = "loading.gif" style = "display:none">' +
                    '</td>' +
                    '</tr>' +
                    '</table>';
            _.$gallery.prepend($(table));
        }
        _.$thumbnails = _.$gallery.children(".thumbnails"),
                _.$thumbnailImgs = _.$thumbnails.children(),
                _.$mainImageContainer = _.$gallery.children(".main-image"),
                _.$mainImage = _.$mainImageContainer.find(".img"),
                _.$loader = _.$mainImageContainer.find(".loader"),
                _.current_main_image = _.$mainImage.attr("src");

    };

    ProductGallery.prototype.initDimensions = function () {

        var _ = this;

        _.$mainImageContainer.find('a').height(_.$mainImageContainer.width());
    }
    ProductGallery.prototype.initSlick = function () {

        var _ = this;
        _.$thumbnails.on('init', function (event, slick, direction) {
            _.initDimensions();
        });

        _.$thumbnails.slick({
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 4,
            slidesToScroll: 3,
            infinite: false,
            adaptiveHeight: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-up"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-down"></i></button>'
        });
    };

    ProductGallery.prototype.initThumbEvents = function () {

        var _ = this;
        _.$thumbnailImgs.mouseenter(function (e) {
            _.change_img(_.getImageUrl(this, "preview"));
        });
        _.$thumbnails.mouseleave(function (e) {
            _.change_img(_.current_main_image);
        });
        _.$thumbnailImgs.click(function (e) {
            e.preventDefault();
            _.current_main_image = _.getImageUrl(this, "preview");
            _.change_img(_.getImageUrl(this, "preview"),_.getImageUrl(this, "original"));
            _.$thumbnails.find(".active").removeClass("active");
            $(this).addClass("active");
        });
        _.$mainImage.load(function () {
            _.$loader.dequeue().hide(0);
        });
        // bind clicks
        _.$mainImage.click(function(e){
            e.preventDefault();
            window.open($(this).parent("a").attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
        });
        /*
        _.$mainImage.click(function (e) {

            e.preventDefault();
            var activeIndex;
            _.$thumbnailImgs.each(function (index, value) {
                if ($(this).hasClass("active")) {
                    activeIndex = index;
                }
            });
            _.fotorama.load(_.getFotoramaData());
            _.$overlay
                    .show()
                    .stop()
                    .fadeTo(150, 1, function () {
                        _.$fotorama.stop().fadeTo(150, 1);
                        // API calls
                        _.fotorama
                                // show needed frame
                                .show(activeIndex)
                                // open fullscreen
                                .requestFullScreen();
                    });
        });

        _.$fotorama.on('fotorama:fullscreenexit', function () {
            _.$fotorama.stop().fadeTo(0, 0);
            _.$overlay.stop().fadeTo(300, 0, function () {
                _.$overlay.hide();
            });
        });*/
        _.$thumbnails.find(".slick-track").children().first().click()
    };

    ProductGallery.prototype.getImageUrl = function (image, requiredSrc) {
        image = $(image);
        var thumb = image.attr("src") || image.children("img").attr("src"),
                large = image.children("img").data("large") || image.data("large"),
                preview = image.attr("href") || image.data("preview") || large || thumb;
        switch (requiredSrc) {
            case 'thumb':
                return thumb;
                break;
            case 'preview':
                return preview;
                break;
            case 'original':
                return large;
                break;
            case 'all':
                return {
                    'thumb': thumb,
                    'large': large,
                    'preview': preview
                };
                break;
            default:
                return false;
        }
    }

    ProductGallery.prototype.initFotorama = function () {

        var _ = this;

        if ($('body').find(' > .fotorama').length == 0) {
            _.$overlay = $('<div class="fotorama-overlay">&nbsp;</div>')
                    .css({position: 'fixed', top: 0, right: 0, bottom: 0, left: 0, zIndex: 10001})
                    .fadeTo(0, 0)
                    .hide()
                    .appendTo('body');
            var $fotorama = $("<div id='fotorama'></div>");
            $fotorama.css({position: 'absolute', left: -99999, top: -99999})
                    .fadeTo(0, 0)
                    .appendTo('body');
            $("#fotorama")
                    .fotorama({
                        thumbwidth: 100,
                        thumbheight: 100,
                        allowfullscreen: true,
                        nav: 'thumbs',
                        autoplay: false,
                        arrows: 'always',
                        click: true,
                        swipe: true
                    })
            var fotorama = $fotorama.data('fotorama');
            /*
            for (var _i = 0, _l = fotorama.data.length; _i < _l; _i++) {
                // prepare id to use in fotorama.show()
                fotorama.data[_i].id = fotorama.data[_i].img;
            }
            */
        }
        _.$overlay = $('body').children('.fotorama-overlay');
        _.$fotorama = $('body').children('.fotorama');
        _.fotorama = _.$fotorama.data('fotorama');
        
    };
    ProductGallery.prototype.getFotoramaData = function () {

        var _ = this;

        var images = [];
        _.$thumbnailImgs.each(function () {
            var urls = _.getImageUrl(this, "all");
            var alt = $(this).attr("alt") || $(this).children("img").attr("alt");
            images.push({
                'img': urls.preview,
                'thumb': urls.thumb,
                'full': urls.large,
                'caption': alt
            });
        });
        return images;
    };
    ProductGallery.prototype.change_img = function (src, large) {

        var _ = this;

        if (_.$mainImage.css("background-image") != src) {
            _.$loader.delay(1000).show(0);
            //_.$mainImage.attr("src", src);
            _.$mainImage.delay(1000).hide(0);
            _.$mainImage.css("background-image", "url('" + src + "')").waitForImages({
                waitForAll: true,
                finished: function () {
                    _.$loader.dequeue().hide(0);
                    _.$mainImage.dequeue().show(0);
                    _.$mainImageContainer.find("a").attr("href", large)
                }
            });
        }
    };

    $.fn.productGallery = function () {
        var _ = this,
                opt = arguments[0],
                args = Array.prototype.slice.call(arguments, 1),
                l = _.length,
                i = 0,
                ret;
        for (i; i < l; i++) {
            if (typeof opt == 'object' || typeof opt == 'undefined')
                _[i].productGallery = new ProductGallery(_[i], opt);
            else
                ret = _[i].productGallery[opt].apply(_[i].productGallery, args);
            if (typeof ret != 'undefined')
                return ret;
        }
        return _;
    };

}));