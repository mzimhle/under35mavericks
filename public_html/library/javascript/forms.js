$(document).ready(function(){
	
    var wi = $(window).width();
    var isw = 1000;
    
    $(window).resize(function() {
        var wi = $(window).width();
        
        if (wi <= 480){
            isw = 420;
            }
        else if (wi <= 767){
            isw = 600;
            }
        else if (wi <= 980){
            isw = 800;
            }
        else if (wi <= 1200){
            isw = 900;
            }
        else {
            isw = 1170;
            }
    }); 
    
    
    var options=
    { 
        width: 1072,//width of slider
        height: 'auto',//height of slider
        movement:'horizontal',
        next_prev: true,//will show next and prev links
        next_class: 'btn btn-default rgt-spc pull-right fader',//class for next link
        prev_class: 'btn btn-default lft-spc pull-left fader',//class for prev link
        error_class: 'alert form-alert pull-left',//class for validation errors
        submit_class: 'btn btn-success fader',
        submit_button: true,
        error_position: 'onelement',
        validation: true,
        texts:{
            next: 'Next',
            prev: 'Previous',
            submit: 'Submit'
        },
        speed: 600,
        submit_handler:function(){
			submitSlideForm();
		},
    };
 
    $('#slider').jFormslider(options);
});