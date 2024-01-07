$(document).ready(function() {
	new WOW().init();

  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.icon_backtotop').fadeIn();
    } else {
      $('.icon_backtotop').fadeOut();
    }
  });

  $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
      $('.header_pc .header_page:nth-child(3)').addClass('fixed_header');
      $('.header_pc .header_page:nth-child(2)').addClass('fixed_header_mobi');
    } else {
      $('.header_pc .header_page:nth-child(3)').removeClass('fixed_header');
      $('.header_pc .header_page:nth-child(2)').removeClass('fixed_header_mobi');
    }
  });



  $('.icon_backtotop').click(function() {
    $('html, body').animate({ scrollTop: 0 }, 800);
    return false;
  });
  $('.main_menu>li').click(function(event) {
    if ($('.main_menu').hasClass('main_menu_mobi')) {
      $('.main_menu>li').not($(this)).removeClass('active');
      /*$('.menu_pc>li .mega_menu').not($(this).next()).slideUp(300);*/
    }
    $(this).toggleClass('active');
  });

  $('.cate_post > li').click(function(event) {
    if ($('.cate_post').hasClass('cate_post_line')) {
      $('.cate_post > li').not($(this)).removeClass('active');
      /*$('.menu_pc>li .mega_menu').not($(this).next()).slideUp(300);*/
    }
    $(this).toggleClass('active');
  });

  $('.icon_bar').click(function(){
    $('.header_pc .header_page:nth-child(3)').toggleClass('active');
    $(this).toggleClass('active');
  });

  $('.slider_video_hotro').slick({
    dots: false,
    slidesToShow: 4,
    autoplay: true,
    prevArrow: "<button class='prev slick-prev'><img class='left-arrow ' src='./assets/img/next2.png' alt=''></button>",
    nextArrow: "<button class='next slick-next'><img class='right-arrow ' src='./assets/img/next1.png' alt=''></button>",
    responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
      }
    }
    ]
  });

  $('.slider_image_1').slick({
    dots: false,
    slidesToShow: 3,
    autoplay: true,
    prevArrow: "<button class='prev slick-prev'><img class='left-arrow ' src='./assets/img/next2.png' alt=''></button>",
    nextArrow: "<button class='next slick-next'><img class='right-arrow ' src='./assets/img/next1.png' alt=''></button>",
    responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
      }
    }
    ]
  });
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('.slider_image_1').slick('setPosition');
  });

  $('.slider_image_2').slick({
    dots: false,
    slidesToShow: 3,
    autoplay: true,
    prevArrow: "<button class='prev slick-prev'><img class='left-arrow ' src='./assets/img/next2.png' alt=''></button>",
    nextArrow: "<button class='next slick-next'><img class='right-arrow ' src='./assets/img/next1.png' alt=''></button>",
    responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
      }
    }
    ]
  });
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('.slider_image_2').slick('setPosition');
  });
    
});

/**/
var TabPictureView = {
    classPreview    : ".preview_img",
    elmGirdImg      : ".list_grid_img",
    elmGirdItem     : ".gird_img_item",
    elmSlidePreview : ".slider_preview_img",
    elmClosePreview : ".close_preview_img",
    slickActive     : null,

    unSlick: function(elm = null) {
        if (elm == null) {
            elm = this.slickActive;
        }
        elm.slick('unslick');
    },

    setSlick: function(elmSetSlick) {
        this.slickActive = $(elmSetSlick).slick({
            dots: true,
            slidesToShow: 1,
        });
    },

    openPreview: function(elmClick) {
        var elementPreview = $(elmClick).find(this.classPreview);
        var sliderPreview = elementPreview.find(this.elmSlidePreview);
        elementPreview.show();
        this.setSlick(sliderPreview);
    },

    closePreview : function(elmClick){
        this.unSlick();
        $(elmClick).closest(this.classPreview).hide();
    },

    setClickLibraryPicture : function(){
        $(this.elmGirdImg).on('click', this.elmGirdItem, function(e) {
            if($(e.target).hasClass(TabPictureView.classPreview) || $(e.target).closest(TabPictureView.classPreview).length > 0){
                return true;
            }
            TabPictureView.openPreview(this);
        });
        $(this.elmGirdImg).on('click', this.elmClosePreview, function() {
            TabPictureView.closePreview(this);
        });
    }
}

TabPictureView.setClickLibraryPicture();