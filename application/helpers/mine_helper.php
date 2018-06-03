<?php
$GLOBALS["privilages"] = array();
function get_user_site_lang(){
		return "en";
}

$encryption_key = "5Vbn05Et";
function mine_encrypt($pure_string,$encryption_key = "5Vbn05Et") {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}
function mine_decrypt($encrypted_string,$encryption_key = "5Vbn05Et") {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}
function add_meta_title ($string)
{
	$CI =& get_instance();
	$CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}
function btn_edit ($uri)
{
	return anchor($uri, '<i class="icon-edit"></i>');
}
function btn_delete ($uri)
{
	return anchor($uri, '<i class="icon-remove"></i>', array(
		'onclick' => "return confirm('You are about to delete a record. Are you sure?');"
	));
}
function article_link($article){
	return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles){
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}
function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}
function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}
function e($string){
	return htmlentities($string);
}
function get_menu ($array, $child = FALSE)
{
	$CI =& get_instance();
	$str = '';

	if (count($array)) {
		$str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

		foreach ($array as $item) {

			$active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
			if (isset($item['children']) && count($item['children'])) {
				$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
				$str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . ci_site_url(e($item['slug'])) . '">' . e($item['title']);
				$str .= '<b class="caret"></b></a>' . PHP_EOL;
				$str .= get_menu($item['children'], TRUE);
			}
			else {
				$str .= $active ? '<li class="active">' : '<li>';
				$str .= '<a href="' . ci_site_url($item['slug']) . '">' . e($item['title']) . '</a>';
			}
			$str .= '</li>' . PHP_EOL;
		}

		$str .= '</ul>' . PHP_EOL;
	}

	return $str;
}
/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}
if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}
function get_user_avatar($user_id=0){
	if(empty($user_id))$user_id = ci_get_current_user_id();
	$_backstage_dir = config_item("backstage_dir");
	$default_avatar = ci_site_url("/".$_backstage_dir."/images/demo/avatar-115.png");
	$CI = get_instance();
	$CI->load->model('user_m');
	$user_avatar = $CI->user_m->get_avatar($user_id);
    if(!empty($user_avatar))$user_avatar = ci_site_url("/media/".$user_avatar);
	return (empty($user_avatar))?$default_avatar:$user_avatar;
}
function get_owner_avatar($adv_id=0){
	// dump_exit($adv_id);
	if(empty($adv_id))$adv_id = ci_get_current_agency_id();
	$_backstage_dir = "agencysprv1";
	$default_avatar=base_url()."assets/img/default-agency-image.png";
	// $default_avatar = ci_site_url("/".$_backstage_dir."/images/demo/avatar-115.png");
	$CI =& get_instance();
	$CI->load->model('agency_m');
	$user_avatar = $CI->agency_m->get_avatar($adv_id);
    if(!empty($user_avatar))$user_avatar = ci_site_url("/media/".$user_avatar);
	return (empty($user_avatar))?$default_avatar:$user_avatar;
}
function the_image($img_url){
	$display = false;
	if(!filter_var($img_url, FILTER_VALIDATE_URL)===false){
		$header_response = get_headers($img_url, 1);
		if (strpos( $header_response[0], "404" ) == false)
			if(getimagesize($img_url) !== false)
				$display = true;
	}
	return $display;
}
function escape_img($object,$_prefix){
	$default_img =  ci_site_url('assets/images/default-thumb.jpg');
	if(empty($object) || empty($_prefix)){
		return $default_img;
	}
	$thumb_field = $_prefix."thumb_id";
	if(!empty($object->$thumb_field)){
		return _img($object->$thumb_field,true);
	}else{
		return $default_img;
	}
}
function _img($url,$is_id=false,$type=""){
	if($is_id)
		if(empty($url)&&!empty($type))
			$url = "images/q-default-".$type."-thumb.png";
		else{
			$CI = get_instance();
			$CI->db->select('media_url');
			$CI->db->where('id',$url);
			$url = $CI->db->get(MEDIA_TABLE);
			$url = $url->row();
			if (!empty($url)) {
				$url = $url->media_url;
				$img_url=base_url().'media/'.$url;
			}
			else
			{
				$img_url="";
			}
		}
	return $img_url;
}
function ci_get_post_parameter($key){
	return (!empty($_POST[$key]))?$_POST[$key]:"";
}
function ci_get_str_parameter($key){
	return (!empty($_GET[$key]))?$_GET[$key]:"";
}
function ci_get_int_parameter($key){
	return (!empty($_GET[$key]))?intval($_GET[$key]):"";
}
function make_cats_links($cats=array(),$link=''){
	$out = '';$cats_count = count($cats);$i=1;
	foreach($cats as $cat){
		$out.= '<a href="'.base_url().$link.'?category='.$cat->id.'">'._t($cat->cat_name).'</a>';
		if($cats_count!=$i)$out.= ' , ';
		$i++;
	}
	return $out;
}
/*================================================================================*/
function mine_draw_pagination_links($pagination_object, $target_page, $page_num) {
	global $config;
    $output = "";$addtional_par="";
	$lang = get_bloginfo("language");
	foreach($_GET as $key=>$val){
		if($key=='_page'||$key=='page_num'){
			continue;
		}
		$addtional_par[$key]=$val;
	}
	$delimiter = $config['enable_query_strings']?"&":"?";
	$pars = !empty($addtional_par)?"&".http_build_query($addtional_par):"";
	if ($pagination_object->total_pages() > 1) {
		$output .= '<div class="pagination">';
		if ($pagination_object->has_previous_page()) {
			if($lang=="ar")$arrow_dir = "right"; else $arrow_dir = "left";
			$href = $target_page.$delimiter."_page=".$pagination_object->previous_page().$pars;
			$output .= '<div class="prev-post"><a href="'.$href.'" cpage="2" class="dt-prev"><span class="fa fa-angle-double-'.$arrow_dir.'"></span> '._lang("Prev").'</a></div>';
		}
		$output .= '<ul>';
		$start=($page_num > 5)?intval($page_num-5):1;
		$end=($pagination_object->total_pages() > intval($page_num +5))?intval($page_num +5):$pagination_object->total_pages();
		$end=($start == 1 && $pagination_object->total_pages() > 10)?10:$end;

		for ($i = $start; $i <= $end; $i++) {
			$class=($i==$page_num)?"active-page":"";
			$href = $target_page.$delimiter."_page=".$i.$pars;
			if($class=="active-page")$output .= '<li class="'.$class.'">'.$i.'</li>';
			else $output .= '<li class="'.$class.'"><a href="'.$href.'">'.$i.'</a></li>';
        }
		$output .= '</ul>';
		if ($pagination_object->has_next_page()) {
			if($lang=="ar")$arrow_dir = "left"; else $arrow_dir = "right";
			$href = $target_page.$delimiter."_page=".$pagination_object->next_page().$pars;
			$output .= '<div class="next-post"><a href="'.$href.'" cpage="1" class="dt-next">'._lang("Next").' <span class="fa fa-angle-double-'.$arrow_dir.'"></span></a></div>';
		}
		$output .= '</div>';
	}
	return $output;
}
function ci_draw_pagination_links($pagination_object, $target_page, $page_num) {
	global $config;
    $output = "";
	$addtional_par="";
	foreach($_GET as $key=>$val){
		if($key=='_page'||$key=='page_num'){
			continue;
		}
		$addtional_par[$key]=$val;
	}
	$delimiter = $config['enable_query_strings']?"&":"?";

	$pars = !empty($addtional_par)?"&".http_build_query($addtional_par):"";

	if ($pagination_object->total_pages() > 1) {
		$output .= '<ul class="pagination ls-pagination">';
		if ($pagination_object->has_previous_page()) {
			$href = $target_page.$delimiter."_page=1".$pars;
			$output .= '<li><a href="'.$href.'">&laquo;</a></li>';
			$href = $target_page.$delimiter."_page=".$pagination_object->previous_page().$pars;
			$output .= '<li><a href="'.$href.'">&lt;</a></li>';
		}
		$start=($page_num > 5)?intval($page_num-5):1;
		$end=($pagination_object->total_pages() > intval($page_num +5))?intval($page_num +5):$pagination_object->total_pages();
		$end=($start == 1 && $pagination_object->total_pages() > 10)?10:$end;
		for ($i = $start; $i <= $end; $i++) {
			$class=($i==$page_num)?"active":"";
			$href = $target_page.$delimiter."_page=".$i.$pars;
			$output .= '<li class="'.$class.'"><a href="'.$href.'">'.$i.'</a></li>';
        }
		if ($pagination_object->has_next_page()) {
			$href = $target_page.$delimiter."_page=".$pagination_object->next_page().$pars;
			$output .= '<li><a href="'.$href.'">&gt;</a></li>';

			$href = $target_page.$delimiter."_page=".$pagination_object->total_pages().$pars;
			$output .= '<li><a href="'.$href.'">&raquo;</a></li>';
		}
		$output .= '</ul>';
	}
	return $output;
}
function ci_customized_date($time,$show_month=true,$show_day=true) {
    global $datetime;
    if (strlen($time) == 19) {
        @ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
        $DBDate = mktime($datetime[4], $datetime[5], $datetime[6], $datetime[2], $datetime[3], $datetime[1]);
    } else {
        $DBDate = $time;
    }
	$Month = date("F", $DBDate);
    $Month = strtoupper($Month);
    $Day = date("D", $DBDate);
    switch ($Month) {
        case "JANUARY" : $MyMonth = _lang("JANUARY");
            break;
        case "FEBRUARY" : $MyMonth = _lang("FEBRUARY");
            break;
        case "MARCH" : $MyMonth = _lang("MARCH");
            break;
        case "APRIL" : $MyMonth = _lang("APRIL");
            break;
        case "MAY" : $MyMonth = _lang("MAY");
            break;
        case "JUNE" : $MyMonth = _lang("JUNE");
            break;
        case "JULY" : $MyMonth = _lang("JULY");
            break;
        case "AUGUST" : $MyMonth = _lang("AUGUST");
            break;
        case "SEPTEMBER" : $MyMonth = _lang("SEPTEMBER");
            break;
        case "OCTOBER" : $MyMonth = _lang("OCTOBER");
            break;
        case "NOVEMBER" : $MyMonth = _lang("NOVEMBER");
            break;
        case "DECEMBER" : $MyMonth = _lang("DECEMBER");
            break;
    } switch ($Day) {
        case "Fri" : $MyDate = _lang("Friday");
            break;
        case "Thu" : $MyDate = _lang("Thursday");
            break;
        case "Wed" : $MyDate = _lang("Wednesday");
            break;
        case "Tue" : $MyDate = _lang("Tuesday");
            break;
        case "Mon" : $MyDate = _lang("Monday");
            break;
        case "Sun" : $MyDate = _lang("Sunday");
            break;
        case "Sat" : $MyDate = _lang("Saturday");
            break;
    }
	$CDate = date("Y", $DBDate) . "-" . date("m", $DBDate) . "-" . date("d", $DBDate);
    $Cooldate = "";
	if($show_day)
		$Cooldate .= $MyDate . " " ;
	$Cooldate .= date("j", $DBDate);
	if($show_month)
		$Cooldate .= " " . $MyMonth;
	$Cooldate .= " " . date("Y", $DBDate) ;
    return $Cooldate;
}
function page_404(){

}
function get_name_of_controller($c){
	switch($c){
		case "category" : return "Categories";
		case "page" : return "Pages";
		case "news" : return "News";
		case "article" : return "Articles";
		case "user" : return "Users";
		case "contact" : return "contacts";
		case "menu" : return "Menus";
		case "sidebar" : return "Sidebars";
		case "widget" : return "Widgets";
	}
}
function file_upload_max_size() {
	  static $max_size = -1;
	  if ($max_size < 0) {
		$max_size = parse_size(ini_get('post_max_size'));
		$upload_max = parse_size(ini_get('upload_max_filesize'));
		if ($upload_max > 0 && $upload_max < $max_size) $max_size = $upload_max;
	  }
	  return $max_size;
}
function parse_size($size) {
	  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
	  $size = preg_replace('/[^0-9\.]/', '', $size);
	  if ($unit) return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
	  else return round($size);
}
function template_subview($view="",$data){
	$CI = get_instance();
	$CI->load->view("templates/".$data["current_template"]."/".$view,$data);
}
function template_widget($view="",$data,$widget=""){
	/*if()
	return;*/
	$CI = get_instance();
	$widget = get_widget($widget);
	$widget = unserialize($widget->layout_content);
	$data["widget"]=$widget;
	$CI->load->view("templates/".$data["current_template"]."/widgets/widget_".$view."/index",$data);
}
function get_widget($widget=""){
	$CI = get_instance();
	$CI->load->model("layout_m");
	return $CI->layout_m->get($widget);
}
function thumb_by_id($id){
	$CI = get_instance();
	$CI->load->model("media_m");
	return $CI->media_m->get($id);
}
function cat_by_id($id){
	$CI = get_instance();
	$CI->load->model("category_m");
	return $CI->category_m->get($id);
}
function page_by_id($id){
	$CI = get_instance();
	$CI->load->model("page_m");
	return $CI->page_m->get($id);
}
function content_by_id($id){
	$CI = get_instance();
	$CI->load->model("contents_m");
	return $CI->contents_m->get($id);
}
function _shorten($description="",$length=250){
	$description = strip_tags($description);
	if(strlen($description)>$length){
		$description = substr($description,0,$length)." ...";
	}
	return $description;
}
function ci_get_the_excerpt($description="",$num_words=50){
	$description = strip_tags($description);
	$description = explode(" ",$description);
	if(count($description) > $num_words) {
		/*$description = array_chunk($description, $num_words);
		$description = $description[0];*/
		$description = array_slice($description, 0, $num_words);
	}
	return implode(" ",$description)." ...";
}
function get_category_permalink($cat_obj){
	if(!is_object($cat_obj))$cat_obj = cat_by_id($cat_obj);
	return base_url("category/".$cat_obj->cat_slug);
}
function get_page_permalink($page_obj){
	if(!is_object($page_obj))$page_obj = page_by_id($page_obj);
	return base_url("page/".$page_obj->page_slug);
}
function get_content_permalink($content_obj){
	if(!is_object($content_obj))$content_obj = content_by_id($content_obj);
	return base_url($content_obj->content_type."/".$content_obj->content_slug);
}
function ci_get_ar_countries_arr($key=""){
	$country = array();
	$country[] = "إختر دولة";
	$country["AD"]="اندورا";
	$country["AE"]="الامارات العربية المتحدة";
	$country["AF"]="افغانستان";
	$country["AG"]="انتيغو وباربودا";
	$country["AI"]="انجويلا";
	$country["AL"]="البانيا";
	$country["AM"]="ارمينيا";
	$country["AN"]="جزر الأنتيل الهولندية";
	$country["AO"]="انجولا";
	$country["AQ"]="انتلاكتيكا";
	$country["AR"]="الارجنتين";
	$country["AS"]="ساموا الأمريكية";
	$country["AT"]="النمسا";
	$country["AU"]="استرايا";
	$country["AW"]="اروبا";
	$country["AX"]="جزر آلاند";
	$country["AZ"]="ازربيجان";
	$country["BA"]="البوسنة والهرسك";
	$country["BB"]="بربادوس";
	$country["BD"]="بنجلاديش";
	$country["BE"]="بلجيكا";
	$country["BF"]="بوركينافاسو";
	$country["BG"]="بلغاريا";
	$country["BH"]="البحرين";
	$country["BI"]="بروندى";
	$country["BJ"]="بنين";
	$country["BL"]="سانت بارتيليمي";
	$country["BM"]="برمودا";
	$country["BN"]="برونى";
	$country["BO"]="بوليفيا";
	$country["BQ"]="إقليم أنتاركتيكا البريطاني";
	$country["BR"]="البرازيل";
	$country["BS"]="البهاما";
	$country["BT"]="بوتان";
	$country["BV"]="جزيرة بوفيت";
	$country["BW"]="بوتسوانا";
	$country["BY"]="بيلاروسيا";
	$country["BZ"]="بليز";
	$country["CA"]="كندا";
	$country["CC"]="جزر كوكوس [كيلينغ]";
	$country["CD"]="الكونغو - كنشاسا";
	$country["CF"]="جمهورية افريقيا الوسطى";
	$country["CG"]="الكونغو - برازافيل";
	$country["CH"]="سويسرا";
	$country["CI"]="ساحل العاج";
	$country["CK"]="جزر كوك";
	$country["CL"]="شيلى";
	$country["CM"]="الكاميرون";
	$country["CN"]="الصين";
	$country["CO"]="كولومبيا";
	$country["CR"]="كوستاريكا";
	$country["CS"]="صربيا ومنتينغرو";
	$country["CT"]="كانتون وجزر إندربري";
	$country["CU"]="كوبا";
	$country["CV"]="الرأس الأخضر";
	$country["CX"]="جزيرة الكريسماس";
	$country["CY"]="قبرص";
	$country["CZ"]="التشيك";
	$country["DD"]="ألمانيا الشرقية";
	$country["DE"]="المانيا";
	$country["DJ"]="جيبوتى";
	$country["DK"]="الدنمارك";
	$country["DM"]="دومينيكا";
	$country["DO"]="جمهورية دومينيكا";
	$country["DZ"]="الجزائر";
	$country["EC"]="الاكوادور";
	$country["EE"]="استونيا";
	$country["EG"]="مصر";
	$country["EH"]="الصحراء الغربية";
	$country["ER"]="ارتيريا";
	$country["ES"]="اسبانين";
	$country["ET"]="اثيوبيا";
	$country["FI"]="فنلندا";
	$country["FJ"]="فيجى";
	$country["FK"]="جزر فوكلاند";
	$country["FM"]="ميكرونيزيا";
	$country["FO"]="جزر فارو";
	$country["FQ"]="الجنوب الفرنسي والأراضي القطبية";
	$country["FR"]="فرنسا";
	$country["FX"]="متروبوليتان فرنسا";
	$country["GA"]="الجابون";
	$country["GB"]="بريطانيا";
	$country["GD"]="غرينادا";
	$country["GE"]="جورجيا";
	$country["GF"]="غينيا الفرنسية";
	$country["GG"]="غيرنسي";
	$country["GH"]="غانا";
	$country["GI"]="جبل طارق";
	$country["GL"]="غرينلاند";
	$country["GM"]="جامبيا";
	$country["GN"]="غينيا";
	$country["GP"]="غوادلوب";
	$country["GQ"]="غينيا الاستوائية";
	$country["GR"]="اليونان";
	$country["GS"]="جورجيا الجنوبية وجزر ساندويتش الجنوبية";
	$country["GT"]="جواتيمالا";
	$country["GU"]="غوام";
	$country["GW"]="غينيا بيساو";
	$country["GY"]="غيانا";
	$country["HK"]="هونج كونج";
	$country["HM"]="جزيرة هيرد وجزر ماكدونالد";
	$country["HN"]="الهندوراس";
	$country["HR"]="كرواتيا";
	$country["HT"]="هايتى";
	$country["HU"]="هنغاريا";
	$country["ID"]="اندونيسيا";
	$country["IE"]="ايرلندا";
	$country["IL"]="اسرائيل";
	$country["IM"]="جزيرة مان";
	$country["IN"]="الهند";
	$country["IO"]="إقليم المحيط الهندي البريطاني";
	$country["IQ"]="العراق";
	$country["IR"]="ايران";
	$country["IS"]="ايسلندا";
	$country["IT"]="ايطاليا";
	$country["JE"]="جيرسى";
	$country["JM"]="جاميكا";
	$country["JO"]="الاردن";
	$country["JP"]="اليابان";
	$country["JT"]="جزيرة جونستون";
	$country["KE"]="كينيا";
	$country["KG"]="قرغيستان";
	$country["KH"]="كامبوديا";
	$country["KI"]="كيريباس";
	$country["KM"]="جزر القمر";
	$country["KN"]="سانت كيتس ونيفيس";
	$country["KP"]="كوريا الشمالية";
	$country["KR"]="كوريا الجنوبية";
	$country["KW"]="الكويت";
	$country["KY"]="جزر كايمان";
	$country["KZ"]="كزاخستان";
	$country["LA"]="لاوس";
	$country["LB"]="لبنان";
	$country["LC"]="سانت لوسيا";
	$country["LI"]="ليختنشتين";
	$country["LK"]="سيريلانكا";
	$country["LR"]="ليبريا";
	$country["LS"]="ليسوتو";
	$country["LT"]="ليتوانيا";
	$country["LU"]="لوكسبورج";
	$country["LV"]="لاتفيا";
	$country["LY"]="ليبيا";
	$country["MA"]="المغرب";
	$country["MC"]="موناكو";
	$country["MD"]="مولدوفا";
	$country["ME"]="مونينجرو";
	$country["MF"]="سانت مارتن";
	$country["MG"]="مدغشقر";
	$country["MH"]="جزيرة مارشال";
	$country["MI"]="جزر ميدواي";
	$country["MK"]="مقدونيا";
	$country["ML"]="مالى";
	$country["MM"]="ميامار [بورما]";
	$country["MN"]="منغوليا";
	$country["MO"]="ماكاو SAR الصين";
	$country["MP"]="جزر ماريانا الشمالية";
	$country["MQ"]="مارتينيك";
	$country["MR"]="مورتانيا";
	$country["MS"]="مونتسيرات";
	$country["MT"]="مالطا";
	$country["MU"]="مورشيوس";
	$country["MV"]="جزر المالديف";
	$country["MW"]="مالاوى";
	$country["MX"]="المكسيك";
	$country["MY"]="ماليزيا";
	$country["MZ"]="موزمبيق";
	$country["NA"]="ناميبيا";
	$country["NC"]="كاليدونيا الجديدة";
	$country["NE"]="النيجر";
	$country["NF"]="جزيرة نورفولك";
	$country["NG"]="نيجريا";
	$country["NI"]="نيكاراغوا";
	$country["NL"]="هولندا";
	$country["NO"]="النرويج";
	$country["NP"]="النيبال";
	$country["NQ"]="دروننغ مود لاند";
	$country["NR"]="ناورو";
	$country["NT"]="المنطقة المحايدة";
	$country["NU"]="نيوي";
	$country["NZ"]="نيوزلندا";
	$country["OM"]="عمان";
	$country["PA"]="بنما";
	$country["PC"]="إقليم جزر المحيط الهادئ الثقة";
	$country["PE"]="بيرو";
	$country["PF"]="بولينيزيا الفرنسية";
	$country["PG"]="بابوا غينيا الجديدة";
	$country["PH"]="الفلبين";
	$country["PK"]="باكستان";
	$country["PL"]="بولندا";
	$country["PM"]="سان بيار وميكلون";
	$country["PN"]="جزر بيتكيرن";
	$country["PR"]="بورتوريكو";
	$country["PS"]="الاراضي الفلسطينية";
	$country["PT"]="البرتغال";
	$country["PU"]="الولايات المتحدة متنوعة جزر المحيط الهادئ";
	$country["PW"]="بالاو";
	$country["PY"]="باراجواى";
	$country["PZ"]="منطقة قناة بنما";
	$country["QA"]="قطر";
	$country["RE"]="ريونيون";
	$country["RO"]="رومانيا";
	$country["RS"]="صيربيا";
	$country["RU"]="روسيا";
	$country["RW"]="رواندا";
	$country["SA"]="السعودية";
	$country["SB"]="جزر سليمان";
	$country["SC"]="سيشل";
	$country["SD"]="السودان";
	$country["SE"]="السويد";
	$country["SG"]="سنغافورا";
	$country["SH"]="سانت هيلانة";
	$country["SI"]="سلوفينا";
	$country["SJ"]="سفالبارد وجان مايان";
	$country["SK"]="سلوفاكيا";
	$country["SL"]="سيرا ليون";
	$country["SM"]="سان مارينو";
	$country["SN"]="السينغال";
	$country["SO"]="الصومال";
	$country["SR"]="سورينام";
	$country["ST"]="ساو تومي وبرينسيبي";
	$country["SU"]="اتحاد الجمهوريات الاشتراكية السوفياتية";
	$country["SV"]="السلفادور";
	$country["SY"]="سوريا";
	$country["SZ"]="سويسرا";
	$country["TC"]="جزر تركس وكايكوس";
	$country["TD"]="تشاد";
	$country["TF"]="الاقاليم الجنوبية الفرنسية";
	$country["TG"]="توجو";
	$country["TH"]="تايلاند";
	$country["TJ"]="طاجكستان";
	$country["TK"]="توكيلاو";
	$country["TL"]="تيمور الشرقية";
	$country["TM"]="تركمنستان";
	$country["TN"]="تونس";
	$country["TO"]="تونغا";
	$country["TR"]="تركيا";
	$country["TT"]="ترنداد وتوباجو";
	$country["TV"]="توفالو";
	$country["TW"]="تايوان";
	$country["TZ"]="تنزانيا";
	$country["UA"]="اوكرانيا";
	$country["UG"]="اوغندا";
	$country["UM"]="جزر الولايات المتحدة البعيدة الصغيرة";
	$country["US"]="الولايات المتحدة";
	$country["UY"]="اورجواى";
	$country["UZ"]="اوزبكستان";
	$country["VA"]="الفاتيكان";
	$country["VC"]="سانت فنسنت وجزر غرينادين";
	$country["VD"]="فيتنام الشمالية";
	$country["VE"]="فنذويلا";
	$country["VG"]="جزر فيرجن البريطانية";
	$country["VI"]="جزر فيرجن الأمريكية";
	$country["VN"]="فيتنام";
	$country["VU"]="فانواتو";
	$country["WF"]="واليس وفوتونا";
	$country["WK"]="جزيرة ويك";
	$country["WS"]="ساموا";
	$country["YE"]="اليمن";
	$country["YT"]="مايوت";
	$country["ZA"]="جنوب افريقيا";
	$country["ZM"]="زامبيا";
	$country["ZW"]="زيمبابوى";
	$country["ZZ"]="غير معروف";
	if(!empty($key))return $country[$key];
	return $country;
}
function ci_get_en_countries_arr($key=""){
	$country = array();
	$country[] = "Choose country";
	$country["AD"] = "Andorra" ;
	$country["AE"] = "United Arab Emirates" ;
	$country["AF"] = "Afghanistan" ;
	$country["AG"] = "Antigua and Barbuda" ;
	$country["AI"] = "Anguilla" ;
	$country["AL"] = "Albania" ;
	$country["AM"] = "Armenia" ;
	$country["AN"] = "Netherlands Antilles" ;
	$country["AO"] = "Angola" ;
	$country["AQ"] = "Antarctica" ;
	$country["AR"] = "Argentina" ;
	$country["AS"] = "American Samoa" ;
	$country["AT"] = "Austria" ;
	$country["AU"] = "Australia" ;
	$country["AW"] = "Aruba" ;
	$country["AX"] = "Åland Islands" ;
	$country["AZ"] = "Azerbaijan" ;
	$country["BA"] = "Bosnia and Herzegovina" ;
	$country["BB"] = "Barbados" ;
	$country["BD"] = "Bangladesh" ;
	$country["BE"] = "Belgium" ;
	$country["BF"] = "Burkina Faso" ;
	$country["BG"] = "Bulgaria" ;
	$country["BH"] = "Bahrain" ;
	$country["BI"] = "Burundi" ;
	$country["BJ"] = "Benin" ;
	$country["BL"] = "Saint Barthélemy" ;
	$country["BM"] = "Bermuda" ;
	$country["BN"] = "Brunei" ;
	$country["BO"] = "Bolivia" ;
	$country["BQ"] = "British Antarctic Territory" ;
	$country["BR"] = "Brazil" ;
	$country["BS"] = "Bahamas" ;
	$country["BT"] = "Bhutan" ;
	$country["BV"] = "Bouvet Island" ;
	$country["BW"] = "Botswana" ;
	$country["BY"] = "Belarus" ;
	$country["BZ"] = "Belize" ;
	$country["CA"] = "Canada" ;
	$country["CC"] = "Cocos [Keeling] Islands" ;
	$country["CD"] = "Congo - Kinshasa" ;
	$country["CF"] = "Central African Republic" ;
	$country["CG"] = "Congo - Brazzaville" ;
	$country["CH"] = "Switzerland" ;
	$country["CI"] = "Côte d`Ivoire" ;
	$country["CK"] = "Cook Islands" ;
	$country["CL"] = "Chile" ;
	$country["CM"] = "Cameroon" ;
	$country["CN"] = "China" ;
	$country["CO"] = "Colombia" ;
	$country["CR"] = "Costa Rica" ;
	$country["CS"] = "Serbia and Montenegro" ;
	$country["CT"] = "Canton and Enderbury Islands" ;
	$country["CU"] = "Cuba" ;
	$country["CV"] = "Cape Verde" ;
	$country["CX"] = "Christmas Island" ;
	$country["CY"] = "Cyprus" ;
	$country["CZ"] = "Czech Republic" ;
	$country["DD"] = "East Germany" ;
	$country["DE"] = "Germany" ;
	$country["DJ"] = "Djibouti" ;
	$country["DK"] = "Denmark" ;
	$country["DM"] = "Dominica" ;
	$country["DO"] = "Dominican Republic" ;
	$country["DZ"] = "Algeria" ;
	$country["EC"] = "Ecuador" ;
	$country["EE"] = "Estonia" ;
	$country["EG"] = "Egypt" ;
	$country["EH"] = "Western Sahara" ;
	$country["ER"] = "Eritrea" ;
	$country["ES"] = "Spain" ;
	$country["ET"] = "Ethiopia" ;
	$country["FI"] = "Finland" ;
	$country["FJ"] = "Fiji" ;
	$country["FK"] = "Falkland Islands" ;
	$country["FM"] = "Micronesia" ;
	$country["FO"] = "Faroe Islands" ;
	$country["FQ"] = "French Southern and Antarctic Territories" ;
	$country["FR"] = "France" ;
	$country["FX"] = "Metropolitan France" ;
	$country["GA"] = "Gabon" ;
	$country["GB"] = "United Kingdom" ;
	$country["GD"] = "Grenada" ;
	$country["GE"] = "Georgia" ;
	$country["GF"] = "French Guiana" ;
	$country["GG"] = "Guernsey" ;
	$country["GH"] = "Ghana" ;
	$country["GI"] = "Gibraltar" ;
	$country["GL"] = "Greenland" ;
	$country["GM"] = "Gambia" ;
	$country["GN"] = "Guinea" ;
	$country["GP"] = "Guadeloupe" ;
	$country["GQ"] = "Equatorial Guinea" ;
	$country["GR"] = "Greece" ;
	$country["GS"] = "South Georgia and the South Sandwich Islands" ;
	$country["GT"] = "Guatemala" ;
	$country["GU"] = "Guam" ;
	$country["GW"] = "Guinea-Bissau" ;
	$country["GY"] = "Guyana" ;
	$country["HK"] = "Hong Kong SAR China" ;
	$country["HM"] = "Heard Island and McDonald Islands" ;
	$country["HN"] = "Honduras" ;
	$country["HR"] = "Croatia" ;
	$country["HT"] = "Haiti" ;
	$country["HU"] = "Hungary" ;
	$country["ID"] = "Indonesia" ;
	$country["IE"] = "Ireland" ;
	$country["IL"] = "Israel" ;
	$country["IM"] = "Isle of Man" ;
	$country["IN"] = "India" ;
	$country["IO"] = "British Indian Ocean Territory" ;
	$country["IQ"] = "Iraq" ;
	$country["IR"] = "Iran" ;
	$country["IS"] = "Iceland" ;
	$country["IT"] = "Italy" ;
	$country["JE"] = "Jersey" ;
	$country["JM"] = "Jamaica" ;
	$country["JO"] = "Jordan" ;
	$country["JP"] = "Japan" ;
	$country["JT"] = "Johnston Island" ;
	$country["KE"] = "Kenya" ;
	$country["KG"] = "Kyrgyzstan" ;
	$country["KH"] = "Cambodia" ;
	$country["KI"] = "Kiribati" ;
	$country["KM"] = "Comoros" ;
	$country["KN"] = "Saint Kitts and Nevis" ;
	$country["KP"] = "North Korea" ;
	$country["KR"] = "South Korea" ;
	$country["KW"] = "Kuwait" ;
	$country["KY"] = "Cayman Islands" ;
	$country["KZ"] = "Kazakhstan" ;
	$country["LA"] = "Laos" ;
	$country["LB"] = "Lebanon" ;
	$country["LC"] = "Saint Lucia" ;
	$country["LI"] = "Liechtenstein" ;
	$country["LK"] = "Sri Lanka" ;
	$country["LR"] = "Liberia" ;
	$country["LS"] = "Lesotho" ;
	$country["LT"] = "Lithuania" ;
	$country["LU"] = "Luxembourg" ;
	$country["LV"] = "Latvia" ;
	$country["LY"] = "Libya" ;
	$country["MA"] = "Morocco" ;
	$country["MC"] = "Monaco" ;
	$country["MD"] = "Moldova" ;
	$country["ME"] = "Montenegro" ;
	$country["MF"] = "Saint Martin" ;
	$country["MG"] = "Madagascar" ;
	$country["MH"] = "Marshall Islands" ;
	$country["MI"] = "Midway Islands" ;
	$country["MK"] = "Macedonia" ;
	$country["ML"] = "Mali" ;
	$country["MM"] = "Myanmar [Burma]" ;
	$country["MN"] = "Mongolia" ;
	$country["MO"] = "Macau SAR China" ;
	$country["MP"] = "Northern Mariana Islands" ;
	$country["MQ"] = "Martinique" ;
	$country["MR"] = "Mauritania" ;
	$country["MS"] = "Montserrat" ;
	$country["MT"] = "Malta" ;
	$country["MU"] = "Mauritius" ;
	$country["MV"] = "Maldives" ;
	$country["MW"] = "Malawi" ;
	$country["MX"] = "Mexico" ;
	$country["MY"] = "Malaysia" ;
	$country["MZ"] = "Mozambique" ;
	$country["NA"] = "Namibia" ;
	$country["NC"] = "New Caledonia" ;
	$country["NE"] = "Niger" ;
	$country["NF"] = "Norfolk Island" ;
	$country["NG"] = "Nigeria" ;
	$country["NI"] = "Nicaragua" ;
	$country["NL"] = "Netherlands" ;
	$country["NO"] = "Norway" ;
	$country["NP"] = "Nepal" ;
	$country["NQ"] = "Dronning Maud Land" ;
	$country["NR"] = "Nauru" ;
	$country["NT"] = "Neutral Zone" ;
	$country["NU"] = "Niue" ;
	$country["NZ"] = "New Zealand" ;
	$country["OM"] = "Oman" ;
	$country["PA"] = "Panama" ;
	$country["PC"] = "Pacific Islands Trust Territory" ;
	$country["PE"] = "Peru" ;
	$country["PF"] = "French Polynesia" ;
	$country["PG"] = "Papua New Guinea" ;
	$country["PH"] = "Philippines" ;
	$country["PK"] = "Pakistan" ;
	$country["PL"] = "Poland" ;
	$country["PM"] = "Saint Pierre and Miquelon" ;
	$country["PN"] = "Pitcairn Islands" ;
	$country["PR"] = "Puerto Rico" ;
	$country["PS"] = "Palestinian Territories" ;
	$country["PT"] = "Portugal" ;
	$country["PU"] = "U.S. Miscellaneous Pacific Islands" ;
	$country["PW"] = "Palau" ;
	$country["PY"] = "Paraguay" ;
	$country["PZ"] = "Panama Canal Zone" ;
	$country["QA"] = "Qatar" ;
	$country["RE"] = "Réunion" ;
	$country["RO"] = "Romania" ;
	$country["RS"] = "Serbia" ;
	$country["RU"] = "Russia" ;
	$country["RW"] = "Rwanda" ;
	$country["SA"] = "Saudi Arabia" ;
	$country["SB"] = "Solomon Islands" ;
	$country["SC"] = "Seychelles" ;
	$country["SD"] = "Sudan" ;
	$country["SE"] = "Sweden" ;
	$country["SG"] = "Singapore" ;
	$country["SH"] = "Saint Helena" ;
	$country["SI"] = "Slovenia" ;
	$country["SJ"] = "Svalbard and Jan Mayen" ;
	$country["SK"] = "Slovakia" ;
	$country["SL"] = "Sierra Leone" ;
	$country["SM"] = "San Marino" ;
	$country["SN"] = "Senegal" ;
	$country["SO"] = "Somalia" ;
	$country["SR"] = "Suriname" ;
	$country["ST"] = "São Tomé and Príncipe" ;
	$country["SU"] = "Union of Soviet Socialist Republics" ;
	$country["SV"] = "El Salvador" ;
	$country["SY"] = "Syria" ;
	$country["SZ"] = "Swaziland" ;
	$country["TC"] = "Turks and Caicos Islands" ;
	$country["TD"] = "Chad" ;
	$country["TF"] = "French Southern Territories" ;
	$country["TG"] = "Togo" ;
	$country["TH"] = "Thailand" ;
	$country["TJ"] = "Tajikistan" ;
	$country["TK"] = "Tokelau" ;
	$country["TL"] = "Timor-Leste" ;
	$country["TM"] = "Turkmenistan" ;
	$country["TN"] = "Tunisia" ;
	$country["TO"] = "Tonga" ;
	$country["TR"] = "Turkey" ;
	$country["TT"] = "Trinidad and Tobago" ;
	$country["TV"] = "Tuvalu" ;
	$country["TW"] = "Taiwan" ;
	$country["TZ"] = "Tanzania" ;
	$country["UA"] = "Ukraine" ;
	$country["UG"] = "Uganda" ;
	$country["UM"] = "U.S. Minor Outlying Islands" ;
	$country["US"] = "United States" ;
	$country["UY"] = "Uruguay" ;
	$country["UZ"] = "Uzbekistan" ;
	$country["VA"] = "Vatican City" ;
	$country["VC"] = "Saint Vincent and the Grenadines" ;
	$country["VD"] = "North Vietnam" ;
	$country["VE"] = "Venezuela" ;
	$country["VG"] = "British Virgin Islands" ;
	$country["VI"] = "U.S. Virgin Islands" ;
	$country["VN"] = "Vietnam" ;
	$country["VU"] = "Vanuatu" ;
	$country["WF"] = "Wallis and Futuna" ;
	$country["WK"] = "Wake Island" ;
	$country["WS"] = "Samoa" ;
	$country["YE"] = "Yemen" ;
	$country["YT"] = "Mayotte" ;
	$country["ZA"] = "South Africa" ;
	$country["ZM"] = "Zambia" ;
	$country["ZW"] = "Zimbabwe" ;
	$country["ZZ"] = "Unknown or Invalid Region" ;
	if(!empty($key))return $country[$key];
	return $country;
}
function _t($txt="",$lang=""){
	if(empty($txt))return "";
	if(empty($lang))$lang = get_user_site_lang();
	$regexp = '/<\!--:(\w+?)-->([^<]+?)<\!--:-->/i';
	$trans_arr = _explode_translation($txt);
	if(empty($trans_arr) || empty($trans_arr[$lang]))return $txt;
	else return $trans_arr[$lang];
}
function _et($txt="",$lang=""){
	echo _t($txt,$lang);
}
function _explode_translation($txt= ""){
	$txt = trim($txt);$parts = array();
	$all_parts = explode("<!--:-->",$txt);
	foreach($all_parts as $_part){
		$lang_val = explode("-->",$_part);
		if(!empty($lang_val[0])){
			$lang_val[0] = str_replace("<!--:","",$lang_val[0]);
			if(!empty($lang_val[1]))
				$parts[$lang_val[0]] = $lang_val[1];
				else $parts[$lang_val[0]] = "";
		}
	}
	return $parts;
}
function _implode_translation($arr=array()){
	$txt="";
	foreach($arr as $lang => $data)$txt.="<!--:".$lang."-->".$data."<!--:-->";
	return $txt;
}
function _current_sitelang(){
	//_wp();
	return  "ar";//qtranxf_getLanguage();
}
function mine_excerpt($s,$no=15){
	$s = strip_tags(stripslashes($s));
	$s = explode(" ",$s);$out = "";
	for($n=0;$n < count($s);$n++)
		if($n==$no){$out.=" ... ";break;}else $out.=$s[$n]." ";
	return $out;
}
function draw_player($url,$type,$extra_class=""){
	if($type != "youtube")
		return '<video controls><source src="'.$url.'" type="video/mp4"></video>';
	if(is_youtube_link($url)){
		return prepare_youtube_embed($url,$extra_class);
	}
	return "";
}
function is_youtube_link($url){
	$pattern = '/https?:\/\/www\.youtube\.com\/watch\?([a-zA-Z])=([a-zA-Z0-9_])([a-zA-Z0-9_\-]+)(.*)/';/**/
	if(preg_match($pattern,$url))
		return true;
	else
		return false;
}
function prepare_youtube_embed($url,$extra_class=""){
	$pattern = '/https?:\/\/www\.youtube\.com\/watch\?([a-zA-Z])=([a-zA-Z0-9_])([a-zA-Z0-9_\-]+)(.*)/';/**/
	$attr_height_width = (!empty($extra_class))?"class='".$extra_class."'":"width='100%' height='450'";
	$replace = '<iframe '.$attr_height_width.'  src="https://www.youtube.com/embed/$2$3" frameborder="0" allowfullscreen></iframe>';

	$link = preg_replace($pattern, $replace, $url);
	return $link;
}
function get_author_name($user_id=0){
	if(empty($user_id))return "";
	$CI = get_instance();
	$CI->load->model('user_m');
	$author = $CI->user_m->get($user_id);
    if(empty($author))return "";
	return (empty($author->user_nickname))?$author->user_name:$author->user_nickname;
}
function _member_name($member){
	if(!empty($member->mem_firstname) && !empty($member->mem_lastname))
		return $member->mem_firstname." ".$member->mem_lastname;
	elseif(!empty($member->mem_name))return $member->mem_name;
	else return $member->mem_username;
}
function addhttp_to_url($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
function ads_position_label($ads_position=""){
	if(!empty($GLOBALS["ads_positions"]) && !empty($ads_position)){
		foreach($GLOBALS["ads_positions"] as $key=>$value){
			if($key == $ads_position)
				return $value;
		}
	}
	return "";
}
function video_type_label($video_type=""){
	if(!empty($GLOBALS["video_types"]) && !empty($video_type)){
		foreach($GLOBALS["video_types"] as $key=>$value){
			if($key == $video_type)
				return $value;
		}
	}
	return "";
}
function count_remaining_date($timestamp,$only_single_object=false){
	$timeleft = $timestamp - time();
	$daysleft = round((($timeleft/24)/60)/60);
	if($daysleft > 365){
		$daysleft = $daysleft - 365;
	}
	$current_date = new DateTime('now', new DateTimeZone('Asia/Riyadh'));
	$end_date = new DateTime(null, new DateTimeZone('Asia/Riyadh'));
	$end_date->setTimestamp($timestamp);
	$interval = $current_date->diff($end_date);
	$val = "";
	if($interval->format('%y') != 0 ){
		$val .= 	$interval->format('%y '._lang('year')) ;
	}
	if($only_single_object){
		if($interval->format('%m') != 0 && empty($val)){
			$val .= 	$interval->format('%m '._lang('month')) ;
		}
		if($interval->format('%d') != 0 && empty($val)){
			$val .= 	$interval->format('%d '._lang('days')) ;
		}
		if($interval->format('%h') != 0 && empty($val)){
			$val .= 	$interval->format('%h '._lang('Hour')) ;
		}
		if($interval->format('%i') != 0 && empty($val)){
			$val .= 	$interval->format('%i '._lang('Minute')) ;
		}
		if($interval->format('%s') != 0 && empty($val)){
			$val .= 	$interval->format('%s '._lang('Seconds')) ;
		}
	}else{
		if($interval->format('%m') != 0 ){
			if(!empty($val)){
				$val .= " "._lang('and');
			}
			$val .= 	$interval->format('%m '._lang('month')) ;
		}
		if($interval->format('%d') != 0 ){
			if(!empty($val)){
				$val .= " "._lang('and');
			}
			$val .= 	$interval->format('%d '._lang('days')) ;
		}
		if($interval->format('%h') != 0){
			if(!empty($val)){
				$val .= " "._lang('and');
			}
			$val .= 	$interval->format('%h '._lang('Hour')) ;
		}
		if($interval->format('%i') != 0 && $interval->format('%h') != 0){
			if(!empty($val)){
				$val .= " "._lang('and');
			}
			$val .= 	$interval->format('%i '._lang('Minute')) ;
		}
	}
	return $val;
//	echo $interval->format(' %y سنة و %m شهر و - %d أيام');
}
function order_status_btn_class($_status){
	$btn_class="";
	switch($_status){
		case "pending":
			$btn_class = "btn-warning";
		break;
		case "processing":
			$btn_class = "btn-info";
		break;
		case "complete":
			$btn_class = "btn-primary";
		break;
		case "refused":
			$btn_class = "btn-danger";
		break;
		default:
			$btn_class = "btn-success";
		break;
	}
	return $btn_class;
}
function order_status_label_class($_status){
	$btn_class="";
	switch($_status){
		case "pending":
			$btn_class = "label-warning";
		break;
		case "processing":
			$btn_class = "label-info";
		break;
		case "complete":
			$btn_class = "label-primary";
		break;
		case "refused":
			$btn_class = "label-danger";
		break;
		default:
			$btn_class = "label-success";
		break;
	}
	return $btn_class;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generateRandomInteger($length = 5) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 function switch_notification_icon($type){
	switch($type){

		 case "profile_updated":
				 $icon='<i class="material-icons">settings</i>';
				 break;
		 case "account_activated":
				 $icon='<i class="material-icons">verified_user</i>';
				 break;
		 case "order_sent":
				 $icon='<i class="fa fa-shopping-cart fa-lg"></i>';
				 break;

		 case "account_created":
				 $icon='<i class="material-icons">account_circle</i>';
				 break;

		 default:
				 $icon="";
 }
 return $icon;
}
function switch_notification_type($notification_obj,$lang){
	if(empty($notification_obj) || empty($notification_obj->notify_type)){
		return false;
	}
	/*
	$CI = get_instance();
	$CI->load->model('user_m');
	$author = $CI->user_m->get($user_id);
	*/
	$_msg = "";
	$text_en='';
	 $text_ar='';
	 switch($notification_obj->notify_type){
			 case "new_product_rate":
					 $text_en="you have new product rate";
					 $text_ar="تم اضافة تقييم جديد لمنتج";
					 break;
			 case "new_product_added":
					 $text_en=$name." shop has just added new product";
					 $text_ar=$name." تم اضافة منتج جديد من قبل محل ";
					 break;
			 case "new_offer_added":
					 $text_en=$name." shop has just added new offer";
					 $text_ar=$name." تم اضافة عرض جديد من قبل محل ";
					 break;
			 case "new_shop_rate":
					 $text_en="your shop has new rate!";
					 $text_ar="تم اضافة تقييم جديد لمحلك!";
					 break;
			 case "account_renewed":
					 $text_en="your account has been renewed successfully";
					 $text_ar="تم تجديد الحساب بنجاح";
					 break;
			 case "settings_updated":
					 $text_en="your shop settings have been updated successfully";
					 $text_ar="تم تعديل الاعدادات الخاصة بمحلك بنجاح";
					 break;
			 case "profile_updated":
					 $text_en="your profile has been updated successfully";
					 $text_ar="تم تعديل حسابك بنجاح";
					 break;
			 case "account_expired":
					 $text_en="your account is expired";
					 $text_ar="تم انتهاء صلاحيه حسابك";
					 break;
			 case "account_expires_tomorrow":
					 $text_en="your account expires tomorrow";
					 $text_ar="سوف تنتهي صلاحيه حسابك غدا";
					 break;

			 case "account_expires_in_week":
					 $text_en="your account expires in a week";
					 $text_ar="سوف تنتهي صلاحيه حسابك خلال اسبوع";
					 break;

			 case "account_expires_in_month":
					 $text_en="your account expires in a month ";
					 $text_ar="سوف تنتهي صلاحيه حسابك خلال شهر";
					 break;

			 case "new_message":
					 $text_en="you have a new message from ".$name;
					 $text_ar=" لديك رساله جديدة من ";
					 $text_ar.=$name;
					 break;

			 case "new_request":
					 $text_en="you have new reservation request for ".$item." from ".$name;
					 $text_ar=" لديك طلب حجز منتج ";
					 $text_ar.=$item;
					 $text_ar.=" من قبل ";
					 $text_ar.=$name;
					 break;
			 case "order_received":
					 $text_en="you have new order request from ".$name;
					 $text_ar=" لديك طلب جديد";
					 $text_ar.="من قبل ";
					 $text_ar.=$name;
					 break;

			 case "account_activated":
					 $text_en="your account has been activated successfully";
					 $text_ar="تم تفعيل الحساب بنجاح";
					 break;
			 case "order_sent":
					 $text_en="your order has been send successfully";
					 $text_ar="تم ارسال الطلب بنجاح";
					 break;

			 case "account_created":
					 $text_en="your account has been created successfully";
					 $text_ar="تم انشاء الحساب بنجاح";
					 break;
					 case "admin":
							$text_en=$notification_obj->notify_text;
							$text_ar=$notification_obj->notify_text;
							break;
			 default:
					 $text="";
	 }
	 $text=($lang=="ar")?$text_ar:$text_en;
	 return $text;

}
function switch_appt_status($_status){
	$_return = "";
	switch($_status){
		case "confirmed":
		$_return = "Confirmed";
		break;
		case "toconfirm":
		$_return = "To Confirm";
		break;
		case "treated":
		$_return = "Closed - Patient Treated";
		break;
		case "skipped":
		$_return = "Closed - Visit Skipped";
		break;
		case "cancelled":
		$_return = "Cancelled";
		break;
		default:
		$_return = "";
		break;
	}
	return $_return;
}
function spr_encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function elang($key){
	$translation = lang($key);
	return !empty($translation)?$translation:$key;
}
function _lang($key){
	return elang($key);
}
function _elang($key){
	echo elang($key);
}
function get_order_by_link($order_by="appt_date",$order_type="desc"){
	$_order_url  = $_order_class = "";
	if(!empty($_GET)){
		if(!empty($_GET["order_by"]) && $_GET["order_by"] == $order_by  && $_GET["order_type"] == $order_type){
			$_order_url = "Javascript:void(0)";
			$_order_class = "inactive";
		}else{
			$_order_url = "?order_by=".$order_by."&order_type=".$order_type."&real_filter=true&";
			foreach($_GET as $key=>$val){
				if(in_array($key,array("order_by","order_type","real_filter"))){
					continue;
				}
				$_order_url .= $key."=".$val."&";
			}
			$_order_url = rtrim($_order_url,"&");
			$_order_class = "";
		}		
	}else{
		$_order_url = "?order_by=".$order_by."&order_type=".$order_type."&real_filter=true";
		$_order_class = "";
	}
	return array("url"=>$_order_url,"class"=>$_order_class);
}