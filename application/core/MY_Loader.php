<?php
class MY_Loader extends CI_Loader {

  function template($view, $vars = array(), $return = FALSE) {
	$the_temp = $this->_ci_view_paths;
    $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(APPPATH . "templates" . '/' => TRUE));
    $this->_ci_load(array(
		'_ci_view' => $view,
		'_ci_vars' => $this->_ci_object_to_array($vars),
		'_ci_return' => $return
	));
	$this->_ci_view_paths = $the_temp;
  }

}





?>