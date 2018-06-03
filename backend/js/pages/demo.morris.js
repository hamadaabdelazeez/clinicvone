/*------------------------------------------------------------------
 [Morrisjs  Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :   use on Morrisjs
 -------------------------------------------------------------------*/




jQuery(document).ready(function($) {
    'use strict';

    two_Line_graph();
    //hero_bar_chart();
    //hero_donut_chart();
    //hero_area_chart();
});

var resizeIdMorris;
$(window).resize(function() {
    clearTimeout(resizeIdMorris);
    resizeIdMorris= setTimeout(doneResizingMorris, 600);

});
function doneResizingMorris(){
    $('#2LineGraph').html('');
    two_Line_graph();
    $('#hero-bar').html('');
    hero_bar_chart();
    $('#hero-donut').html('');
    hero_donut_chart();
    $('#hero-area').html('');
    hero_area_chart();
}


function two_Line_graph(){
    'use strict';
    Morris.Line({
        element: '2LineGraph',
        data: year_data,
        xkey: 'period',
        ykeys: ['amount'],
        labels: [amount_word],
        lineColors: [$redActive, $redActive, $greenActive, $textColor],
        resize: true
    });
}
function hero_bar_chart(){
    'use strict';

    Morris.Bar({
        element: 'hero-bar',
        data: [
            {device: 'iPhone', geekbench: 136},
            {device: 'iPhone 3G', geekbench: 137},
            {device: 'iPhone 3GS', geekbench: 275},
            {device: 'iPhone 4', geekbench: 380},
            {device: 'iPhone 4S', geekbench: 655},
            {device: 'iPhone 5', geekbench: 2200},
            {device: 'iPhone 5S', geekbench: 2500}
        ],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: [$greenActive],
        resize: true
    });
}
function hero_donut_chart(){
    'use strict';

    Morris.Donut({
        element: 'hero-donut',
        data: [
            {label: 'OSX', value: 25 },
            {label: 'Linux', value: 40 },
            {label: 'Ubuntu', value: 25 },
            {label: 'Other', value: 10 }
        ],
        formatter: function (y) {
            return y + "%"
        },
        colors: [$fillColor2, $redActive, $greenActive, $lightBlueActive]
    });
}
function hero_area_chart(){
    'use strict';

    Morris.Area({
        element: 'hero-area',
        data: [
            {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
            {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
            {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
            {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
            {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
            {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
            {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
            {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
            {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
            {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
        ],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        lineColors: [$redActive, $greenActive, "rgba(239, 174, 77, 0.71)", $fillColor2, $textColor],
        resize: true
    });
}