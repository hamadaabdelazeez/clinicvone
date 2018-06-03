/*------------------------------------------------------------------
 [ summernote Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :   use on editor
 -------------------------------------------------------------------*/

jQuery(document).ready(function($) {
    'use strict';
    summer_note_call();
    summer_note_theme_call();
    summer_note_air_mode_call();
    summer_note_custom_tool_bar_call();
});
var edit = function() {
    jQuery('.click2edit').summernote({focus: true});
};
var save = function() {
    var aHTML = jQuery('.click2edit').code(); //save HTML If you need(aHTML: array).
    jQuery('.click2edit').destroy();
};
function sendSummerNoteFile(file, editor, welEditable){
	data = new FormData();
	data.append("file", file);
	editor = jQuery(editor);
	$.ajax({
		data: data,
		type: "POST",
		url: site_url+'qajax/summernote_media_upload',
		cache: false,
		contentType: false,
		processData: false,
		success: function(url) {
			var cur_date = new Date();
			var cur_month = (cur_date.getMonth())+1;
			cur_month = (cur_month < 10)?"0"+cur_month:cur_month;
			url = site_url+"media/"+cur_date.getFullYear()+"/"+cur_month+"/"+cur_date.getUTCDate()+"/"+url;
			editor = editor.find('.note-editor .note-editable');
			editor.html(editor.html()+'<p><img src="'+url+'" /><br></p>');
		}
	});
}

function summer_note_call(){
    'use strict';
    jQuery('.summernote').summernote({
        height: 150,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
		onChange: function(contents, $editable) {
    		make_slug(this,'',true,$editable)
  		},
		onImageUpload: function(files) {
			sendSummerNoteFile(files[0],event.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode);
		},
        focus: true,                 // set focus to editable area after initializing summernote
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });
	var summernotes = jQuery('.summernote');
	for(var p = 0;p < jQuery('.summernote').length;p++){
		if(jQuery('.note-editor').eq(p).index() == 1)
			jQuery('.note-editor').eq(p).addClass("active");
	}
}
function summer_note_theme_call(){
    'use strict';
    jQuery('.summernoteTheme').summernote({
        height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                 // set focus to editable area after initializing summernote
    });
}
function summer_note_air_mode_call(){
    'use strict';

    jQuery('.summernoteAirMode').summernote({
        airMode: true
    });
}
function summer_note_custom_tool_bar_call(){
    'use strict';
    jQuery('.customToolBar').summernote({
        toolbar: [
            //[groupname, [button list]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
        ]
    });
}