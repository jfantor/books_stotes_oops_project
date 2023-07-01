$(document).ready(function(){

    $('#address_next').click(function(){
        $('#address_selection').hide(100);
        $('#book_info').show();
    });
    $('#post_next').click(function(){
        $('#book_info').hide(100);
        $('#price_section').show();
    });
    $('#info_back_btn').click(function(){
        $('#book_info').hide(100);
        $('#address_selection').show();
    });
    $('#price_back_btn').click(function(){
        $('#price_section').hide(100);
        $('#book_info').show();
    });
    $('#close_post').click(function(){
        $('#popup_box').hide(500);
    });
    $('#open_post').click(function(){
        $('#popup_box').show(500);
    });
    $('#sub_book').click(function(){
        $('#subname').show(500);
        $('#ub_writer_div').hide(500);
    });
    $('#sub_writer').click(function(){
        $('#sub_writer_div').show(500);
        $('#subname').hide(500);
    });

    $('#book_info_tab').click(function(){
        $('#book_info_tab').addClass("active_manu");
        $('#book_des_tab').removeClass('active_manu');
        $('#writer_tab').removeClass('active_manu');
        $('#book_des_table').show(500);
        $('#description_of_book').hide(500);
        $('#writer_deteils_info').hide(500);
    });
    $('#book_des_tab').click(function(){
        $('#book_des_tab').addClass("active_manu");
        $('#book_info_tab').removeClass('active_manu');
        $('#writer_tab').removeClass('active_manu');
        $('#description_of_book').show(500);
        $('#book_des_table').hide(500);
        $('#writer_deteils_info').hide(500);
    });
    $('#writer_tab').click(function(){
        $('#writer_tab').addClass("active_manu");
        $('#book_info_tab').removeClass('active_manu');
        $('#book_des_tab').removeClass('active_manu');
        $('#writer_deteils_info').show(500);
        $('#description_of_book').hide(500);
        $('#book_des_table').hide(500);
    });







});

function getDivision(val){
    
    $.ajax({
        type : "POST",
        url : "../controller/show_data.php",
        data:'coutry_id1='+val,
        success:function(data){
            $("#division_list").html(data);
            getCity();
        }
    });
}

function getCity(val){
    $.ajax({
        type : "POST",
        url : "../controller/show_data.php",
        data:'city_id='+val,
        success:function(data){
            $("#city_list").html(data);
            getAria();
        }
    });
}
function getAria(val){
    $.ajax({
        type : "POST",
        url : "../controller/show_data.php",
        data:'aria_id='+val,
        success:function(data){
            $("#aria_list").html(data);
        }
    });
}

function Division1(val){
    
    $.ajax({
        type : "POST",
        url : "../controller/show_data.php",
        data:'coutry_id2='+val,
        success:function(data){
            $("#division_list1").html(data);
            City1();
        }
    });
}

function City1(val){
    $.ajax({
        type : "POST",
        url : "../controller/show_data.php",
        data:'city_id2='+val,
        success:function(data){
            $("#city_list1").html(data);
            Aria1();
        }
    });
}
function Aria1(val){
    $.ajax({
        type : "POST",
        url : "../controller/show_data.php",
        data:'aria_id2='+val,
        success:function(data){
            $("#aria_list1").html(data);
        }
    });
}







const swiper = new Swiper('.swiper', {
    // Optional parameters
    // direction: 'vertical',

    autoplay: {
        delay:3000,
        disableOnInteraction:false,
    },
    loop: true,
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable:true,
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    // scrollbar: {
    //   el: '.swiper-scrollbar',
    // },
  });
  








// $(document).ready(function() {
//     var $window = $(window);  
//     var $sidebar = $("#site-header"); 
//     var $sidebarOffset = $sidebar.offset();
  
//     $window.scroll(function() {
//       if($window.scrollTop() >=650 &&! $sidebarOffset.top) {
//         $sidebar.addClass("sticky");
//       } else {
//         $sidebar.removeClass("sticky");   
//       }    
          
//     });   
//     var options = {
//       animateClass: 'animate__animated', // for v3 or 'animate__animated' for v4
//       animateThreshold: 100,
//       scrollPollInterval: 20
//   }
//   $('.home-section').AniView(options);
  
//   });





//   (function($) {

//     //custom scroll replacement to allow for interval-based 'polling'
//     //rather than checking on every pixel.
//     var uniqueCntr = 0;
//     $.fn.scrolled = function(waitTime, fn) {
//         if (typeof waitTime === 'function') {
//             fn = waitTime;
//             waitTime = 200;
//         }
//         var tag = 'scrollTimer' + uniqueCntr++;
//         this.scroll(function() {
//             var self = $(this);
//             clearTimeout(self.data(tag));
//             self.data(tag, setTimeout(function() {
//                 self.removeData(tag);
//                 fn.call(self[0]);
//             }, waitTime));
//         });
//     };

//     $.fn.AniView = function(options) {

//         //some default settings. animateThreshold controls the trigger point
//         //for animation and is subtracted from the bottom of the viewport.
//         var settings = $.extend({
//             animateClass: 'animated',
//             animateThreshold: 0,
//             scrollPollInterval: 20,
//         }, options);

//         //keep the matched elements in a variable for easy reference
//         var collection = this;

//         //cycle through each matched element and wrap it in a block/div
//         //and then proceed to fade out the inner contents of each matched element
//         $(collection).each(function(index, element) {
//             $(element).wrap('<div class="av-container"></div>');
//             $(element).css('opacity', 0);
//         });

//         /**
//          * returns boolean representing whether element's top is coming into bottom of viewport
//          *
//          * @param HTMLDOMElement element the current element to check
//          */
//         function EnteringViewport(element) {
//             var elementTop = $(element).offset().top;
//             var viewportBottom = $(window).scrollTop() + $(window).height();
//             return (elementTop < (viewportBottom - settings.animateThreshold)) ? true : false;
//         }

//         /**
//          * cycle through each element in the collection to make sure that any
//          * elements which should be animated into view, are...
//          *
//          * @param collection of elements to check
//          */
//         function RenderElementsCurrentlyInViewport(collection) {
//             $(collection).each(function(index, element) {
//                 var elementParentContainer = $(element).parent('.av-container');
//                 if ($(element).is('[data-av-animation]') && !$(elementParentContainer).hasClass('av-visible') && EnteringViewport(elementParentContainer)) {
//                     $(element).css('opacity', 1);
//                     $(elementParentContainer).addClass('av-visible');
//                     $(element).addClass([settings.animateClass, $(element).attr('data-av-animation')].join(' '));
//                 }
//             });
//         }

//         //on page load, render any elements that are currently/already in view
//         RenderElementsCurrentlyInViewport(collection);

//         //enable the scrolled event timer to watch for elements coming into the viewport
//         //from the bottom. default polling time is 20 ms. This can be changed using
//         //'scrollPollInterval' from the user visible options
//         $(window).scrolled(settings.scrollPollInterval, function() {
//             RenderElementsCurrentlyInViewport(collection);
//         });
//     };
// })(jQuery);


