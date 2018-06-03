/*------------------------------------------------------------------
 [autosize & fileinput Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :   use on sample-form
 -------------------------------------------------------------------*/


jQuery(document).ready(function($) {
    'use strict';
    animated_text_area();
    file_input_trigger();	
	jQuery('.user-privilages-ch0').on('ifChecked', function(event){
	  var checked_id = event.target.id;
	  if(checked_id.indexOf("_index") > -1){
		  jQuery('#'+checked_id).parent().parent().parent().parent().find('input').iCheck('check');
	  }
	});
	jQuery('.make_admin').on('ifChecked', function(event){
	  var checked_id = event.target.id;
	  if(checked_id =='make_admin1')
	  	jQuery('#custom_privilages').stop().slideUp();
	else 
		jQuery('#custom_privilages').stop().slideDown();
	});
});
function animated_text_area(){
    'use strict';

    jQuery('.animatedTextArea').autosize({append: "\n"});
}
/*** file input Call ****/
function file_input_trigger(){
    'use strict';

    jQuery("#file-3").fileinput({
        showCaption: false,
        browseClass: "btn btn-ls",
        fileType: "any",
        'showUpload': false
    });
}
/*** file input Call end ****/
function make_slug(t,id,slug,rich){
	if(!rich){
		var title = jQuery(t).val();
		if(!slug)jQuery("#"+id).val(title.replace(" ","-"));
	}
	combine_multilang(t,rich);
}
function combine_multilang(t,rich){
	var output = "";
	if(rich){
		var edits = jQuery(".note-editor .note-editable");var new_val = "";
		for(var p = 0;p < edits.length;p++){
			new_val = edits.eq(p).html();
			output += "<!--:"+jQuery(".note-editor").eq(p).prev().attr("id").split("_").pop()+"-->"+new_val+"<!--:-->";
		}
		jQuery(".note-editor").eq(0).parent().find("textarea.hidden").val(output);
	}else{
		var all_fields = jQuery(t).parent().find(".multilang");
		for(var i=0;i < all_fields.length;i++)
			output += "<!--:"+all_fields.eq(i).attr("id").split("_").pop()+"-->"+all_fields.eq(i).val()+"<!--:-->";
		jQuery(t).parent().find("input[type=hidden]").val(output);
		jQuery(t).parent().find("textarea.hidden").val(output);
	}
}