$(document).ready(function(){
	
	$('.a-img').bind('click',function(){
		
		
		$img_url = $(this).find('img').attr('src');

		$('#div-goods-big-img').find('img').attr('src', $img_url);
		
		
	});
});


