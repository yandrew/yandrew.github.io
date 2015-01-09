//$(document).ready(function () {
//	$('body').click(function(){
//
//		$('div .blog-post').fadeTo('slow',0.1);
//});

$(document).ready(function() {
     $(this).click(function() {
         $('div .blog-post').fadeToggle()('slow');
     });
});

