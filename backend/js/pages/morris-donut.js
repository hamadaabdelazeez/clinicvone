/*------------------------------------------------------------------
 [Morrisjs  Trigger Js]

Donut Chart Only
By: Shams IT
 -------------------------------------------------------------------*/
jQuery(document).ready(function($) {
    'use strict';
    hero_donut_chart();
	//replace_html_special_chars();
	/*setTimeout(function() {
	jQuery("tspan").each(function( index ) {
		var old_html = jQuery(this).html();		
		console.log(old_html);
		old_html = decodeHtml(old_html);
		old_html = old_html.replace(/&lt;/gi,"<");
		old_html = old_html.replace(/&gt;/gi,">");
		console.log("-------------------------");		
		console.log(old_html);
		console.log("=================");
		jQuery(this).html(old_html).text();		
	});
	}, 1000);*/
});

var resizeIdMorris;
$(window).resize(function() {
    clearTimeout(resizeIdMorris);
    resizeIdMorris= setTimeout(doneResizingMorris, 600);

});
function doneResizingMorris(){
    $('#hero-donut').html('');
    hero_donut_chart();
}
function hero_donut_chart(){
    'use strict';
	var donutData = [];
	var donutColors = [];
	var item_counter = 0;
	for(var c=0;c<chart_Data.length;c++){
		if(item_counter == 25)
			item_counter = Math.floor(Math.random()*24);
		var obj_data = chart_Data[c];
		var donut_item = {			
			label: obj_data.title,
			value: obj_data.value
			}		
		donutData.push(donut_item);
		donutColors.push(item_colors[item_counter]);
		item_counter++;
	}
    Morris.Donut({
        element: 'hero-donut',
        data: donutData,
        formatter: function (y) {
            return y + " "+ item_name
        },
        colors: donutColors
    });
}
function replace_html_special_chars(){
	 setTimeout(function() {
	jQuery("tspan").each(function( index ) {
		old_html = jQuery(this).html();
		old_html = old_html.replace("&lt;","<");
		old_html = old_html.replace("&gt;",">");
		jQuery(this).html(old_html);
	});
	}, 100);
}
function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}