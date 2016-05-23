var popupStatus = 0;
function loadPopup(id){
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.4"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#"+id).fadeIn("slow");
		popupStatus = 1;
		
	}
}

function disablePopup(id){
	
		if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#"+id).fadeOut("slow");
		popupStatus = 0;
		$(".error").css("display","none");
		
	}
}
function disablePopup(){
		if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$('.popup').fadeOut("slow");
		popupStatus = 0;
		$(".error").css("display","none");
		
	}
}
	function centerPopup(id){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#"+id).height();
	var popupWidth = $("#"+id).width();
	

	
	$("#"+id).css({
		"position": "fixed",
		"top":100,
		"left": windowWidth/2-popupWidth/2
	});
	
	
	
};