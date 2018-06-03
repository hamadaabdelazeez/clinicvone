/*------------------------------------------------------------------
 [chartjs  Trigger Js]

 For Pie Chart Only
 By : Shams IT
 -------------------------------------------------------------------*/
jQuery(document).ready(function($) {
    'use strict';
    chartLoad();
});

var sizeId;
$(window).resize(function() {
    clearTimeout(sizeId);
    sizeId= setTimeout(chartSize, 1000);

});
/******** Chart js Data set Start********/
var randomScalingFactor = function(){ return Math.round(Math.random()*10)};
var pieData = [];
var item_counter = 0;
var mypieChartCanvasDataView_html = "";
for(c=0;c<chart_Data.length;c++){
	if(item_counter == 25)
		item_counter = Math.floor(Math.random()*24);
	obj_data = chart_Data[c];
	pie_item = {
		value: obj_data.value,
        color: item_colors[item_counter],
        highlight: hover_colors[item_counter],
        label: obj_data.title
		}
	pieData.push(pie_item);	
	mypieChartCanvasDataView_html += '<li><span style="background:'+item_colors[item_counter]+';"></span> '+obj_data.title+' - '+obj_data.value+'</li>';
	item_counter++;
}
jQuery("#mypieChartCanvasDataView ul").html(mypieChartCanvasDataView_html);
   /* {
        value: 30,
        color: item_colors[0],
        highlight: hover_colors[0],
        label: "Product A"
    },
    {
        value: 50,
        color: item_colors[1],
        highlight: hover_colors[1],
        label: "Product B"
    },
    {
        value: 20,
        color: item_colors[2],
        highlight: hover_colors[2],
        label: " Product C"
    }

];*/
/******** Chart js Data set End********/

/******** Chart js Defaults Global Value Set Start ********/
Chart.defaults.global = {
    // Boolean - Whether to animate the chart
    animation: true,

    // Number - Number of animation steps
    animationSteps: 60,

    // String - Animation easing effect
    animationEasing: "easeOutQuart",

    // Boolean - If we should show the scale at all
    showScale: true,

    // Boolean - If we want to override with a hard coded scale
    scaleOverride: false,

    // ** Required if scaleOverride is true **
    // Number - The number of steps in a hard coded scale
    scaleSteps: null,
    // Number - The value jump in the hard coded scale
    scaleStepWidth: null,
    // Number - The scale starting value
    scaleStartValue: null,

    // String - Colour of the scale line
    scaleLineColor: "rgba(0,0,0,.1)",

    // Number - Pixel width of the scale line
    scaleLineWidth: 1,

    // Boolean - Whether to show labels on the scale
    scaleShowLabels: true,

    // Interpolated JS string - can access value
    scaleLabel: "<%=value%>",

    // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
    scaleIntegersOnly: true,

    // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero: false,

    // String - Scale label font declaration for the scale label
    scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Scale label font size in pixels
    scaleFontSize: 12,

    // String - Scale label font weight style
    scaleFontStyle: "normal",

    // String - Scale label font colour
    scaleFontColor: "#666",

    // Boolean - whether or not the chart should be responsive and resize when the browser does.
    responsive: true,

    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,

    // Boolean - Determines whether to draw tooltips on the canvas or not
    showTooltips: true,

    // Array - Array of string names to attach tooltip events
    tooltipEvents: ["mousemove", "touchstart", "touchmove"],

    // String - Tooltip background colour
    tooltipFillColor: "rgba(0,0,0,0.8)",

    // String - Tooltip label font declaration for the scale label
    //tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Tooltip label font size in pixels
    tooltipFontSize: 14,

    // String - Tooltip font weight style
    tooltipFontStyle: "normal",

    // String - Tooltip label font colour
    tooltipFontColor: "#fff",

    // String - Tooltip title font declaration for the scale label
    //tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Tooltip title font size in pixels
    tooltipTitleFontSize: 14,

    // String - Tooltip title font weight style
    tooltipTitleFontStyle: "bold",

    // String - Tooltip title font colour
    tooltipTitleFontColor: "#fff",

    // Number - pixel width of padding around tooltip text
    tooltipYPadding: 6,

    // Number - pixel width of padding around tooltip text
    tooltipXPadding: 6,

    // Number - Size of the caret on the tooltip
    tooltipCaretSize: 8,

    // Number - Pixel radius of the tooltip border
    tooltipCornerRadius: 6,

    // Number - Pixel offset from point x to tooltip edge
    tooltipXOffset: 10,

    // String - Template string for single tooltips
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",

    // String - Template string for single tooltips
    multiTooltipTemplate: "<%= value %>",

    // Function - Will fire on animation progression.
    onAnimationProgress: function(){},

    // Function - Will fire on animation completion.
    onAnimationComplete: function(){}
};
/******** Chart js Defaults Global Value Set End ********/


var myPie;
function chartLoad(){
    'use strict';
    var ctx = document.getElementById("pie-chart-area").getContext("2d");
    myPie = new Chart(ctx).Pie(pieData, {responsive : true});
}
function chartSize(){
    //console.log('LOG');
    myPie.destroy();
    chartLoad();
}