/*
 * Global variables. If you change any of these vars, don't forget 
 * to change the values in the less files!
 */
$(function() {
    "use strict";

    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function(e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {

        } else {
            //Else, enable content stretching
            $(".workspace").toggleClass("open-left-pane").addClass("open-options-pane");
        }
    });
    
    //Enable sidebar toggle if page left-pane already collapse
    $("[data-toggle='tab']").click(function(e) {
        e.preventDefault();
       //Else, enable content stretching
        $(".workspace").addClass("open-left-pane");
    });

    //Add hover support for touch devices
    $('.btn').bind('touchstart', function() {
        $(this).addClass('hover');
    }).bind('touchend', function() {
        $(this).removeClass('hover');
    });

    //Activate tooltips
    $("[data-toggle='tooltip']").tooltip();

    /*     
     * Add collapse and remove events to boxes
     */
    $("[data-widget='collapse']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        //Find the body and the footer
        var bf = box.find(".box-body, .box-footer");
        if (!box.hasClass("collapsed-box")) {
            box.addClass("collapsed-box");
            bf.slideUp();
        } else {
            box.removeClass("collapsed-box");
            bf.slideDown();
        }
    });

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
    $('.btn-group[data-toggle="btn-toggle"]').each(function() {
        var group = $(this);
        $(this).find(".btn").click(function(e) {
            group.find(".btn.active").removeClass("active");
            $(this).addClass("active");
            e.preventDefault();
        });

    });

    /*
     * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
     * ---------------------------------------
    $(".navbar .menu").slimscroll({
        height: "200px",
        alwaysVisible: false,
        size: "3px"
    }).css("width", "100%");
     */
    
    /*
     * Initialize SlimScroll plugin
     * ----------------------------
     */
    $('#leftPane').slimScroll({
        wheelStep: 2,
        height: '100%',
        color: '#d0d0d0',
    });
    // $('#editPane').slimScroll({
        // wheelStep: 2,
        // height: '100%',
        // color: '#181818',
        // animate: 'true'
    // });

    /**
     * INITIALIZE TOOLTIP
     * 
     * Main navigation tooltip
     */
    $(".nav-main-tooltip-right").tooltip({placement : 'right'});
    
    $('#user-overview-tab-toggle').click(function(){
        $('.nav-tabs > .user-overview-tab').find('a').trigger('click');
    });
    $('#user-account-settings-tab-toggle').click(function(){
        $('.nav-tabs > .user-account-settings-tab').find('a').trigger('click');
    });
    $('#user-tasks-tab-toggle').click(function(){
        $('.nav-tabs > .user-tasks-tab').find('a').trigger('click');
    });
    
});

function resize_iframe() {
  
}

$(document).ready(function() { 

	// Navigation menu

	// $('ul#navigation').superfish({ 
		// delay:       1000,
		// animation:   {opacity:'show',height:'show'},
		// speed:       'fast',
		// autoArrows:  true,
		// dropShadows: false
	// });
	
	// $('ul#navigation li').hover(function(){
		// $(this).addClass('sfHover2');
	// },
	// function(){
		// $(this).removeClass('sfHover2');
	// });

	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();

	// Dialog			
	$('#dialog').dialog({
		autoOpen: false,
		width: 600,
		bgiframe: false,
		modal: false,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	// Login Dialog Link
	$('#login_dialog').click(function(){
		$('#login').dialog('open');
		return false;
	});

	// Login Dialog			
	$('#login').dialog({
		autoOpen: false,
		width: 300,
		height: 230,
		bgiframe: true,
		modal: true,
		buttons: {
			"Login": function() { 
				$(this).dialog("close"); 
			}, 
			"Close": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	// Dialog Link
	$('#dialog_link').click(function(){
		$('#dialog').dialog('open');
		return false;
	});

	// Dialog auto open			
	$('#welcome_login').dialog({
		autoOpen: true,
		width: 370,
		height: 430,
		bgiframe: true,
		modal: true,
		buttons: {
			"Proceed to demo !": function() {
				window.location = "index.php";
			}
		}
	});

	// Datepicker
	$('#datepicker').datepicker({
		inline: true
	});
	
	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	//Sortable

	$(".column").sortable({
		connectWith: '.column'
	});

	//Sidebar only sortable boxes
	$(".side-col").sortable({
		axis: 'y',
		connectWith: '.side-col'
	});

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header")
			.addClass("ui-widget-header")
			.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
			.end()
		.find(".portlet-content");

	$(".portlet-header .ui-icon").click(function() {
		$(this).toggleClass("ui-icon-circle-arrow-n");
		$(this).parents(".portlet:first").find(".portlet-content").slideToggle();
	});

	$(".column").disableSelection();


	/* Table Sorter */
	// $("#sort-table")
	// .tablesorter({
		// widgets: ['zebra'],
		// headers: { 
		            // // assign the secound column (we start counting zero) 
		            // 0: { 
		                // // disable it by setting the property sorter to false 
		                // sorter: false 
		            // }, 
		            // // assign the third column (we start counting zero) 
		            // 6: { 
		                // // disable it by setting the property sorter to false 
		                // sorter: false 
		            // } 
		        // } 
	// })
	
	// .tablesorterPager({container: $("#pager")}); 

	$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

	/**
	 * Make iframes full height of browser window
	 * 
	 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
	 * @source     http://stackoverflow.com/questions/20125340/can-i-use-jquery-to-resize-an-iframe-to-fill-the-remaining-window-space
	 */
	$(window).on('load resize', function(){
			$window = $(window);
			$('iframe.fullheight').height(function(){
					return $window.height()-$(this).offset().top;   
			});
	});
	
});

/* Tooltip */

$(function() {
	$('.tooltip').tooltip({
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - ",
		fade: 250
	});
});
		
    
    
/* Check all table rows */
	
var checkflag = "false";
function check(field) {
	if (checkflag == "false") 
	{
		for (i = 0; i < field.length; i++) {
			field[i].checked = true;
		}
		checkflag = "true";
		return "check_all"; 
	}
	else 
	{
		for (i = 0; i < field.length; i++) {
			field[i].checked = false; 
		}
		checkflag = "false";
		return "check_none"; 
	}
}

/*
 * This script checks and unchecks boxes on a form 
 * Checks and unchecks unlimited number in the group...
 * Pass the Checkbox group name...
 */
function selectToggle(toggle, form) {
	 var myForm = document.forms[form];
	 for( var i=0; i < myForm.length; i++ ) { 
		  if(toggle) {
			   myForm.elements[i].checked = "checked";
		  } 
		  else {
			   myForm.elements[i].checked = "";
		  }
	 }
}
//  End -->