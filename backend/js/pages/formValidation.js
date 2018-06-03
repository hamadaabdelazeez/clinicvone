/*------------------------------------------------------------------
 [Form Validation Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :   use on formValidation
 -------------------------------------------------------------------*/


jQuery(document).ready(function($) {
    'use strict';

    bootstrap_validator_call();
    animated_text_area();
    mask_input_validation();
    validation_engine_call();
});

function bootstrap_validator_call(){
    'use strict';

    jQuery('#defaultForm').bootstrapValidator();
}
function animated_text_area(){
    'use strict';

    jQuery('.animatedTextArea').autosize({append: "\n"});
}
function mask_input_validation(){
    'use strict';

    $.mask.definitions['~'] = "[+-]";
    jQuery("#date").mask("99/99/9999", {completed: function () {
        alert("completed!");
    }});
    jQuery("#phone").mask("(999) 999-9999");
    jQuery("#phoneExt").mask("(999) 999-9999? x99999");
    jQuery("#iphone").mask("+33 999 999 999");
    jQuery("#tin").mask("99-9999999");
    jQuery("#ssn").mask("999-99-9999");
    jQuery("#product").mask("a*-999-a999", { placeholder: " " });
    jQuery("#eyescript").mask("~9.99 ~9.99 999");
    jQuery("#po").mask("PO: aaa-999-***");
    jQuery("#pct").mask("99%");
}
function validation_engine_call(){
    'use strict';
	jQuery('#formID,.validate_form').validationEngine('hideAll');			
	jQuery("#formID,.validate_form").validationEngine('detach');
    jQuery("#formID,.validate_form").validationEngine('attach', {
        showOneMessage: false,
        promptPosition: "bottomLeft",
        autoHidePrompt: false,
        scroll: true,
        /*onValidationComplete: function (form, status) {
			if(status){
				form.submit();
				return false;
			}
        }*/
        /*showPrompts:false*/
    });
}