<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends Admin_Controller {
	private $head_words = array("#","Appointment Date","Patient Number","Patient Name","Clinic","Estimated Cost","Status"); 
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('appointment_m');
		$this->load->model('patient_m');
		$this->load->model('clinic_m');
	}
	public function exportExcelData($records){
	$heading = false;
		if (!empty($records))
			foreach ($records as $row) {
				if (!$heading) {
					// display field/column names as a first row
					echo implode("\t", array_keys($row)) . "\n";
					$heading = true;
				}
				echo implode("\t", ($row)) . "\n";
			}
	}
	
	public function Excel(){		
		$objects 	= $this->appointment_m->get('',false,true,$this->_trash);		
		$patients = $this->patient_m->get('',false,true,$this->_trash,"",true);
		$patients_options = array();
		foreach($patients as $patient){
			$patients_options[$patient->patient_id] = array("name"=>$patient->patient_name,"number"=>$patient->patient_key);
		}
		unset($patients);
		$this->load->model("clinic_m");
		$clinics = $this->clinic_m->get('',false,true,$this->_trash,"",true);
		$clinics_options = array();
		foreach($clinics as $clinic){
			$clinics_options[$clinic->clinic_id] = $clinic->clinic_title;
		}
		unset($clinics);
		$dataToExports = array();
		if(!empty($objects)){
			$counter = 1;$i=0;
			foreach($objects as $obj){
				$arrangeData = array();
				if(!empty($clinics_options[$obj->appt_clinic_id])){
					$obj->clinic_title = $clinics_options[$obj->appt_clinic_id];
				}else{
					$obj->clinic_title = " --- ";
				}
				if(!empty($patients_options[$obj->appt_patient_id])){
					$obj->patient_name = $patients_options[$obj->appt_patient_id]["name"];
					$obj->patient_key = $patients_options[$obj->appt_patient_id]["number"];
				}else{
					$obj->patient_name = " --- ";
					$obj->patient_key = " --- ";
				}				
				$arrangeData[$this->head_words[0]] = $counter;
				$arrangeData[$this->head_words[1]] = $obj->appt_date;
				$arrangeData[$this->head_words[2]] = $obj->patient_key;
				$arrangeData[$this->head_words[3]] = $obj->patient_name;
				$arrangeData[$this->head_words[4]] = $obj->clinic_title;
				$arrangeData[$this->head_words[5]] = $obj->appt_cost." USD";
				$arrangeData[$this->head_words[6]] = switch_appt_status($obj->appt_status);
				$counter++;
				$dataToExports[] = $arrangeData;
			}
		}
		// set header
		$filename = "Appointments-".date("Y-m-d").".xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$this->exportExcelData($dataToExports);
	}
	public function pdf(){		
	  $output.='<html>';
	  $output.='<head>';
	  $output.='<style>
	  .appt-data{
		  width:100%;
		  border-collapse: collapse;
	  }
	  .appt-data th,.appt-data td{
		  padding : 8px;
		  border: 1px solid #EEE;
	  }
	  .appt-data th {
		  text-align: left;
		  background: #CCC;
	  }
	  </style>';
	  $output.='</head>';
	  $output.='<body class="'.$dir.'">';
	  $output.='<br> <br>';
	  $output.='<table cellpadding="5" class="appt-data">';
	  $output.='<tr>';
	  foreach($this->head_words as $head){
		  $output.='<th>'.$head.'</th>';
	  }
	  $output.='</tr>';
	  $objects 	= $this->appointment_m->get('',false,true,$this->_trash);		
		$patients = $this->patient_m->get('',false,true,$this->_trash,"",true);
		$patients_options = array();
		foreach($patients as $patient){
			$patients_options[$patient->patient_id] = array("name"=>$patient->patient_name,"number"=>$patient->patient_key);
		}
		unset($patients);
		$this->load->model("clinic_m");
		$clinics = $this->clinic_m->get('',false,true,$this->_trash,"",true);
		$clinics_options = array();
		foreach($clinics as $clinic){
			$clinics_options[$clinic->clinic_id] = $clinic->clinic_title;
		}
		unset($clinics);
		if(!empty($objects)){
			$counter = 1;$i=0;
			foreach($objects as $obj){
				$arrangeData = array();
				if(!empty($clinics_options[$obj->appt_clinic_id])){
					$obj->clinic_title = $clinics_options[$obj->appt_clinic_id];
				}else{
					$obj->clinic_title = " --- ";
				}
				if(!empty($patients_options[$obj->appt_patient_id])){
					$obj->patient_name = $patients_options[$obj->appt_patient_id]["name"];
					$obj->patient_key = $patients_options[$obj->appt_patient_id]["number"];
				}else{
					$obj->patient_name = " --- ";
					$obj->patient_key = " --- ";
				}				
				$output .= '<tr>';
				$output .= '<td>'.$counter.'</td>';
				$output .= '<td>'.$obj->appt_date.'</td>';
				$output .= '<td>'.$obj->patient_key.'</td>';
				$output .= '<td>'.$obj->patient_name.'</td>';
				$output .= '<td>'.$obj->clinic_title.'</td>';
				$output .= '<td>'.$obj->appt_cost." USD".'</td>';
				$output .= '<td>'.switch_appt_status($obj->appt_status).'</td>';
				$output .= '</tr>';
				$counter++;
			}
		}
        $output .= ' </table>';
        $output .= '<br><br>';
        $output .= '</body></html> ';
		/*echo $output; die();*/
          $this->load->library("Pdf");
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->SetCreator(PDF_CREATOR);
 		  $pdf->SetFont('aealarabiya', '', 12);
    	 $pdf->AddPage();
		 $filename = 'Appointments-'.date("Y-m-d").'.pdf';
           $pdf->writeHTML($output, true, false, true, false, '');
           //ob_clean();
		   header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
           $pdf->Output($filename,'I');
	}
}