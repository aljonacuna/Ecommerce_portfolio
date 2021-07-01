// JavaScript Document
 $(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:false,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });
    $('#gallery').lightSlider({
	    gallery: true,
	    item: 1,
	    loop:false,
	    slideMargin: 0,
	    thumbItem: 5
	});  
  });