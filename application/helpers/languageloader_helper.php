<?php
class LanguageLoader{
    function initialize($_lang="") {
        $ci =& get_instance();
        $ci->load->helper('language');
		if(empty($_lang))$_lang = get_user_site_lang();		
		$site_lang = !empty($_lang)?$_lang:"ar";
        if ($site_lang) {
            $ci->lang->load('mine',$site_lang);
			$ci->config->set_item('language', $site_lang);
        } else {
            $ci->lang->load('mine','ar');
        }
    }
}