function chart_examples() {
  
  /********
    Line chart
  ********/
  
  if($('#linechart').length > 0) {
    chart1 = new Highcharts.Chart({
       chart: {
          renderTo: 'linechart',
          type: 'spline',
          marginRight: '24',
          marginLeft: '36',
          marginTop: '24'
       },
       title: {
          text: ''
       },
       xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
       },
       yAxis: {
          title: {
             text: ''
          },
          plotLines: [{
             value: 0,
             width: 1,
             color: '#808080'
          }]
       },
       legend: {
         borderWidth: 0,
       },
       series: [{
          name: 'Tokyo',
          data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
       }, {
          name: 'New York',
          data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
       }, {
          name: 'Berlin',
          data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
       }, {
          name: 'London',
          data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
       }]
    });
  }
  
  /********
    Dashboard chart
  ********/
  
  if($('#dashboardchart').length > 0) {
    chart1 = new Highcharts.Chart({
       chart: {
          renderTo: 'dashboardchart',
          type: 'column',
          marginRight: '24',
          marginLeft: '36',
          marginTop: '24'
       },
       title: {
          text: ''
       },
       xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
       },
       yAxis: {
          title: {
             text: ''
          },
          plotLines: [{
             value: 0,
             width: 1,
             color: '#808080'
          }]
       },
       legend: {
         borderWidth: 0,
       },
       series: [{
          name: 'Unique visitors',
          data: [125, 152, 135, 203, 154, 138, 298, 204, 178, 153, 143, 102]
       }, {
          name: 'Visitors',
          data: [175, 192, 145, 293, 164, 188, 365, 234, 198, 203, 173, 122]
       }]
    });
  } 
  
  /************
    Bar chart
  ************/
  
  if($('#barchart').length > 0) {
    chart2 = new Highcharts.Chart({
       chart: {
          renderTo: 'barchart',
          defaultSeriesType: 'column',
          marginRight: '24',
          marginLeft: '36',
          marginTop: '24'
       },
       legend: {
          borderWidth: 0,
        },

       title: {
          text: ''
       },

       xAxis: {
          categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
       },

       yAxis: {
          allowDecimals: false,
          min: 0,
          title: {
             text: ''
          }
       },

       tooltip: {
          formatter: function() {
             return '<b>'+ this.x +'</b><br/>'+
                 this.series.name +': '+ this.y +'<br/>'+
                 'Total: '+ this.point.stackTotal;
          }
       },

       plotOptions: {
          column: {
             stacking: 'normal'
          }
       },

        series: [{
          name: 'John',
          data: [5, 3, 4, 7, 2],
          stack: 'male'
       }, {
          name: 'Joe',
          data: [3, 4, 4, 2, 5],
          stack: 'male'
       }, {
          name: 'Jane',
          data: [2, 5, 6, 2, 1],
          stack: 'female'
       }, {
          name: 'Janet',
          data: [3, 0, 4, 4, 3],
          stack: 'female'
       }]
    });
  }
  
  if($('#dynamicchart').length > 0) {
    chart = new Highcharts.Chart({
      chart: {
         renderTo: 'dynamicchart',
         defaultSeriesType: 'spline',
         marginRight: '24',
         marginLeft: '36',
         marginTop: '24',
         events: {
            load: function() {

               // set up the updating of the chart each second
               var series = this.series[0];
               setInterval(function() {
                  var x = (new Date()).getTime(), // current time
                     y = Math.random();
                  series.addPoint([x, y], true, true);
               }, 1000);
            }
         }
      },
      title: {
         text: ''
      },
      xAxis: {
         type: 'datetime',
         tickPixelInterval: 150
      },
      yAxis: {
         title: {
            text: ''
         },
         plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
         }]
      },
      tooltip: {
         formatter: function() {
                   return '<b>'+ this.series.name +'</b><br/>'+
               Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+ 
               Highcharts.numberFormat(this.y, 2);
         }
      },
      legend: {
         enabled: false
      },
      exporting: {
         enabled: false
      },
      series: [{
         name: 'Random data',
         data: (function() {
            // generate an array of random data
            var data = [],
               time = (new Date()).getTime(),
               i;

            for (i = -19; i <= 0; i++) {
               data.push({
                  x: time + i * 1000,
                  y: Math.random()
               });
            }
            return data;
         })()
      }]
   });
  }
  
  if($('#complexchart').length > 0) {
    chart4 = new Highcharts.Chart({
      chart: {
         renderTo: 'complexchart',
         zoomType: 'xy',
         marginTop: 24,
         marginRight: 118,
         marginLeft: 68
      },
      title: {
         text: ''
      },
      xAxis: [{
         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      }],
      yAxis: [{ // Primary yAxis
         labels: {
            formatter: function() {
               return this.value +'Ã‚Â°C';
            },
            style: {
               color: '#89A54E'
            }
         },
         title: {
            text: '',
            style: {
               color: '#89A54E'
            }
         },
         opposite: true

      }, { // Secondary yAxis
         gridLineWidth: 0,
         title: {
            text: '',
            style: {
               color: '#4572A7'
            }
         },
         labels: {
            formatter: function() {
               return this.value +' mm';
            },
            style: {
               color: '#4572A7'
            }
         }

      }, { // Tertiary yAxis
         gridLineWidth: 0,
         title: {
            text: '',
            style: {
               color: '#AA4643'
            }
         },
         labels: {
            formatter: function() {
               return this.value +' mb';
            },
            style: {
               color: '#AA4643'
            }
         },
         opposite: true
      }],
      tooltip: {
         formatter: function() {
            var unit = {
               'Rainfall': 'mm',
               'Temperature': 'Ã‚Â°C',
               'Sea-Level Pressure': 'mb'
            }[this.series.name];

            return ''+
               this.x +': '+ this.y +' '+ unit;
         }
      },
      legend: {
         layout: 'vertical',
         align: 'left',
         x: 120,
         verticalAlign: 'top',
         y: 80,
         floating: true,
         backgroundColor: '#FFFFFF'
      },
      series: [{
         name: 'Rainfall',
         color: '#4572A7',
         type: 'column',
         yAxis: 1,
         data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]      

      }, {
         name: 'Sea-Level Pressure',
         type: 'spline',
         color: '#AA4643',
         yAxis: 2,
         data: [1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7],
         marker: {
            enabled: false
         },
         dashStyle: 'shortdot'               

      }, {
         name: 'Temperature',
         color: '#89A54E',
         type: 'spline',
         data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
      }]
   });
  }
  
  if($('#piechart').length > 0) {
    chart = new Highcharts.Chart({
          chart: {
             renderTo: 'piechart',
             plotBackgroundColor: null,
             plotBorderWidth: null,
             plotShadow: false
          },
          title: {
             text: ''
          },
          legend: {
              borderWidth: 0,
            },
          tooltip: {
             formatter: function() {
                return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
             }
          },
          plotOptions: {
             pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                   enabled: false
                },
                showInLegend: true
             }
          },
           series: [{
             type: 'pie',
             name: 'Browser share',
             data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                   name: 'Chrome',    
                   y: 12.8,
                   sliced: true,
                   selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
             ]
          }]
       });
  }
}