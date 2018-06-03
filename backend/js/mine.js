jQuery(document).ready(function (){
	jQuery("#appt_patient_num").blur(function(){
		var patient_num=jQuery("#appt_patient_num").val();
		get_patient(patient_num);
	});

	jQuery('.clinic_edit').dblclick(function(){
		var id = jQuery(this).attr('id');
		window.location.replace(site_url+"backend/clinics/edit/"+id);

	});
	jQuery('.appt_edit').dblclick(function(){
		var id = jQuery(this).attr('id');
		window.location.replace(site_url+"backend/appointments/edit/"+id);

	});
	jQuery(".print_btn").click(function(){
        window.print();
    });
});
function get_patient(patient_num){
	jQuery(".pat_num_loading").show();
	$.ajax({
		url: site_url+"Qajax/get_patient",
		type: "post",
		data: {"patient_num":patient_num},
	    success: function (response) {
			 if (response != 1) {
				 data=response.split("#");
				 jQuery("#appt_patient_id").val(data[0]);
				 jQuery("#patient_name").val(data[1]);
				 jQuery("#patient_mobile").val(data[2]);
				 jQuery("#patient_gender").val(data[3]);
			 }else{
				 jQuery("#appt_patient_id").val("");
				 jQuery("#patient_name").val("");
				 jQuery("#patient_mobile").val("");
				 jQuery("#patient_gender").val("");
			 }
			 jQuery(".pat_num_loading").hide();
		 }
	 });
}
