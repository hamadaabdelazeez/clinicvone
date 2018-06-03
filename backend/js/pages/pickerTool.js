/*------------------------------------------------------------------
 [ datetimepicker & minicolors  Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :   Picker Tool
 -------------------------------------------------------------------*/


jQuery(document).ready(function($) {
    'use strict';

    date_and_time_picker_call();
   
});
/*** Date & Time Picker Call ***/
function date_and_time_picker_call(){
    'use strict';
	/*console.log($("html").attr("dir"));*/
	var datepicker_lang = ($("html").attr("dir") == "rtl")?"ar":"en"; 
    $('.dateTimePicker').datetimepicker({lang:datepicker_lang});
    $('.dateTimePickerCustom').datetimepicker({lang:datepicker_lang});
    $('.dateTimePickerCustom1').datetimepicker({lang:datepicker_lang});

    $('.datePickerCall').click(function () {
        $('.dateTimePickerCustom').datetimepicker('show');
    });
    $('.datePickerCall1').click(function () {
        $('.dateTimePickerCustom1').datetimepicker('show');
    });
    $('.timePickerOnly').datetimepicker({
        datepicker: false,
        format: 'H:i',
		lang:datepicker_lang,
        mask:'00:00'
    });	
    $('.datePickerOnly').datetimepicker({
        timepicker: false,
        datepicker:true,
        format:'Y-m-d',
        allowBlank: true,
		lang:datepicker_lang,
    });
	$('.birthDatePicker').datetimepicker({
		changeMonth: true,
        changeYear: true,
		maxDate: 0,
        timepicker: false,
        datepicker:true,
        format:'Y-m-d',
        allowBlank: true,
		lang:datepicker_lang,
    });
    $('#date_timepicker_start').datetimepicker({

        onShow:function( ct ){
            this.setOptions({
                maxDate:$('#date_timepicker_end').val()?$('#date_timepicker_end').val():false
            })
        }
        /*format:'Y/m/d',
         timepicker:false*/
    });
    $('#date_timepicker_end').datetimepicker({

        onShow:function( ct ){
            this.setOptions({
                minDate:$('#date_timepicker_start').val()?$('#date_timepicker_start').val():false
            })
        }
        /*format:'Y/m/d',
         timepicker:false*/
    });
    $('#inlineDatePicker').datetimepicker({
        format:'d.m.Y H:i',
        inline:true,
        lang:'en'
    });
    $('#inlineDatePickerLanguage').datetimepicker({
        format:'d.m.Y H:i',
        inline:true,
        lang:'ar'
    });
}
/*** Date & Time Picker Call End ***/

/*** Mini Color Call Start***/
function mini_color_call(){
    'use strict';

    $('.miniColors').minicolors({
        animationSpeed: 50,
        animationEasing: 'swing',
        change: null,
        changeDelay: 0,
        control: 'hue',
        defaultValue: $defultColor,
        hide: null,
        hideSpeed: 100,
        inline: false,
        letterCase: 'lowercase',
        opacity: true,
        position: 'bottom left',
        show: null,
        showSpeed: 100,
        theme: 'bootstrap'
    });
    $('.miniColors2').minicolors({
        animationSpeed: 50,
        animationEasing: 'swing',
        change: null,
        changeDelay: 0,
        control: 'hue',
        defaultValue: $redActive,
        hide: null,
        hideSpeed: 100,
        inline: false,
        letterCase: 'lowercase',
        opacity: false,
        position: 'bottom right',
        show: null,
        showSpeed: 100,
        theme: 'bootstrap'
    });

    $('.miniColor3').minicolors({
        animationSpeed: 50,
        animationEasing: 'swing',
        change: null,
        changeDelay: 0,
        control: 'hue',
        defaultValue: $brownActive,
        hide: null,
        hideSpeed: 100,
        inline: false,
        letterCase: 'lowercase',
        opacity: true,
        position: 'top left',
        show: null,
        showSpeed: 100,
        theme: 'bootstrap'
    });
    $('.miniColor4').minicolors({
        animationSpeed: 50,
        animationEasing: 'swing',
        change: null,
        changeDelay: 0,
        control: 'hue',
        defaultValue: $lightBlueActive,
        hide: null,
        hideSpeed: 100,
        inline: false,
        letterCase: 'uppercase',
        opacity: true,
        position: 'top right',
        show: null,
        showSpeed: 100,
        theme: 'bootstrap'
    });
}
/*** Mini Color Call End***/