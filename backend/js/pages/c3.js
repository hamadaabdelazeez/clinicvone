/*------------------------------------------------------------------
 [C3 Chart Js Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :	C3 Chart Js use on c3js
 -------------------------------------------------------------------*/

jQuery(document).ready(function($) {
    'use strict';
    c3_line_and_bar();
});

function c3_line_and_bar(){
    'use strict';

    var chart_combination = c3.generate({
        bindto: '#line-and-bar',
        color: { pattern: [$redActive, $lightBlueActive, $lightGreen, $blueActive, $brownActive] },
        data: {
		  names: {
			data1: patients,
			data2: paid_money
		  },
           columns: [
                patients_arr,
                money_arr
            ],
            axes: {
                data2: 'y2'
            },
            types: {
                data2: 'bar' // ADD
            }

        },
        axis: {
            y: {
                label: {
                    text: patients_lbl,
                    position: 'outer-middle'
                }
            },
            y2: {
                show: true,
                label: {
                    text: money_lbl,
                    position: 'outer-middle'
                }
            },
            x:{
                show: true,
				type: "category",
                label: {
                    text: doctors_lbl,
                    position: 'outer-middle'
                },
				categories: doctors_arr
            }
        }
    });
}
