
$(document).ready(function(){

	/*  inner page slider  */
    if($('#slider').length>0){
	    $("#slider").responsiveSlides({
	        timeout: 3e3
	    });
	 }    


    /*  hide-show mobile menu  */
    $("#menu_icon").click(function(){
        $("#nav_menu ul").toggleClass("show_menu");
        $("#menu_icon").toggleClass("close_menu");
        return false;
    });

});





