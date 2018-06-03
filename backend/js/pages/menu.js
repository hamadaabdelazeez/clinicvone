function update_serialization(list){
	var data = [];list  =(!list)?$('#drop_zone').children().eq(0).children():list;
	for(k=0;k<list.length;k++){
		obj={"id":list.eq(k).attr('data-id')};
		if(list.eq(k).find('ol').length > 0)
			obj = {"id":obj.id,"children" : update_serialization(list.eq(k).children().eq(3).children())};
		data.push(obj);
	}
	return data;	
}
function update_nested_serialization(){
	new_objects = (update_serialization());
	new_objects = window.JSON.stringify(new_objects);
	$('#layout_content').val(new_objects);
}
function append_custom_link(){
	if(jQuery('#link_url').val().length && jQuery('#link_title').val().length){
		jQuery('#drop_zone ol:eq(	0)').append('<li class="dd-item" data-id="'+jQuery('#link_url').val()+',custom,'+jQuery('#link_title').val()+'"><div class="dd-handle">'+jQuery('#link_title').val()+' <span class="remove_item">x</span></div></li>');
		jQuery('#link_url').val("");
		jQuery('#link_title').val("");
		update_nested_serialization();
	}
}
jQuery(document).ready(function($) {
    'use strict';
	/*
	$('ul.simple_with_no_drop li').draggable({
		containment: '#menu_form', helper:'clone'
	});
	$( ".simple_with_no_drag" ).sortable({
		containment: '#menu_form'
	});
	$('#menu_form').parent().droppable({
		accept:'.menu-drop',
		drop: function(event, ui) {
		//$(ui.draggable).remove();
	}});
	$('ul.simple_with_no_drag').parent().droppable({
		accept:'.menu-drag',
		drop: function(event, ui) {
            $(this).children().eq(0).append($(ui.draggable).clone());
            $('.simple_with_no_drag .menu-drag').addClass("menu-drop");
			//$('.simple_with_no_drag .menu-drag').append('<i>X<i>');
			$('.simple_with_no_drag .menu-drag').removeClass("menu-drag");
			$(".menu-drop").css('position','relative');
        }
	});
	*/
	
	var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
			$('#layout_content').val(window.JSON.stringify(list.nestable('serialize')));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    // activate Nestable for list 1
    $('#drop_zone').nestable({
        group: 1,
		containment : '#drop_zone_container'
    })
    .on('change', updateOutput);
    // activate Nestable for list 2
    $('#drag_zone').nestable({
        group: 1,
		containment : '#menu_form',
		canDrop : true
		
    })
    .on('change', updateOutput);
	
	$('#drag_zone0').nestable({
        group: 1,
		containment : '#menu_form',
		canDrop : true
		
    })
    .on('change', updateOutput);
	
	$('#drag_zone1').nestable({
        group: 1,
		containment : '#menu_form',
		canDrop : true
		
    })
    .on('change', updateOutput);
	
	$('#drag_zone2').nestable({
        group: 1,
		containment : '#menu_form',
		canDrop : true
		
    })
    .on('change', updateOutput);
	
    updateOutput($('#drag_zone').data('output', $('#layout_content')));
	updateOutput($('#drag_zone0').data('output', $('#layout_content')));
	updateOutput($('#drag_zone1').data('output', $('#layout_content')));
	updateOutput($('#drag_zone2').data('output', $('#layout_content')));
	updateOutput($('#drop_zone').data('output', $('#layout_content')));
    
});
function dropped_draggable(){
	$(".menu-drop").draggable({containment: '#menu_form'});
}