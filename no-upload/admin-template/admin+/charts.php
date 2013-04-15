<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<head>
	<title>AdminPlus - Premium Bootstrap Admin Template</title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	
	<!-- Bootstrap Extended -->
	<link href="bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet">
	<link href="bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
	
	<!-- JQueryUI v1.9.2 -->
	<link rel="stylesheet" href="theme/scripts/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.min.css" />
	
	<!-- Glyphicons -->
	<link rel="stylesheet" href="theme/css/glyphicons.css" />
	
	<!-- Bootstrap Extended -->
	<link rel="stylesheet" href="bootstrap/extend/bootstrap-select/bootstrap-select.css" />
	<link rel="stylesheet" href="bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
	
	<!-- Uniform -->
	<link rel="stylesheet" media="screen" href="theme/scripts/pixelmatrix-uniform/css/uniform.default.css" />

	<!-- JQuery v1.8.2 -->
	<script src="theme/scripts/jquery-1.8.2.min.js"></script>
	
	<!-- Modernizr -->
	<script src="theme/scripts/modernizr.custom.76094.js"></script>
	
	<!-- MiniColors -->
	<link rel="stylesheet" media="screen" href="theme/scripts/jquery-miniColors/jquery.miniColors.css" />
	
	<!-- Theme -->
	<link rel="stylesheet/less" href="theme/less/style.less?1361269832" />
	
	<!-- FireBug Lite -->
	<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite-debug.js"></script> -->
	
	<!-- Google Analytics -->
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36057737-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	
	<!-- LESS 2 CSS -->
	<script src="theme/scripts/less-1.3.3.min.js"></script>
	
</head>
<body>
	
	<!-- Start Content -->
	<div class="container-fluid fixed">
		
		<div class="navbar main">
			<a href="index.php?lang=en&page=index" class="appbrand"><span>Admin+ <span>lovely headline here</span></span></a>
			
						<button type="button" class="btn btn-navbar">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
			</button>
						
			<ul class="topnav pull-right">
				<li class="visible-desktop">
					<ul class="notif">
						<li><a href="" class="glyphicons envelope" data-toggle="tooltip" data-placement="bottom" data-original-title="5 new messages"><i></i> 5</a></li>
						<li><a href="" class="glyphicons shopping_cart" data-toggle="tooltip" data-placement="bottom" data-original-title="1 new orders"><i></i> 1</a></li>
						<li><a href="" class="glyphicons log_book" data-toggle="tooltip" data-placement="bottom" data-original-title="3 new activities"><i></i> 3</a></li>
					</ul>
				</li>
				<li class="dropdown visible-desktop">
					<a href="" data-toggle="dropdown" class="glyphicons cogwheel"><i></i>Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="">Some option</a></li>
						<li><a href="">Some other option</a></li>
						<li><a href="">Other option</a></li>
					</ul>
				</li>
								<li class="hidden-phone">
					<a href="#themer" data-toggle="collapse" class="glyphicons eyedropper"><i></i><span>Themer</span></a>
					<div id="themer" class="collapse">
						<div class="wrapper">
							<h4>Themer <span>color &amp; layout options</span></h4>
							<ul>
								<li>Theme: <select id="themer-theme" class="pull-right"></select><div class="clearfix"></div></li>
								<li>Primary Color: <input type="text" data-type="minicolors" data-default="#ffffff" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" /><div class="clearfix"></div></li>
								<li>
									<span class="link" id="themer-custom-reset">reset theme</span>
									<span class="pull-right"><label>advanced <input type="checkbox" value="1" id="themer-advanced-toggle" /></label></span>
								</li>
							</ul>
							<div id="themer-getcode" class="hide">
								<hr class="separator" />
								<button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
								<button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</li>
								<li class="hidden-phone">
					<a href="#" data-toggle="dropdown"><img src="theme/images/lang/en.png" alt="en" /></a>
			    	<ul class="dropdown-menu pull-right">
			      		<li class="active"><a href="?lang=en&amp;page=charts" title="English"><img src="theme/images/lang/en.png" alt="English"> English</a></li>
			      		<li><a href="?lang=ro&amp;page=charts" title="Romanian"><img src="theme/images/lang/ro.png" alt="Romanian"> Romanian</a></li>
			      		<li><a href="?lang=it&amp;page=charts" title="Italian"><img src="theme/images/lang/it.png" alt="Italian"> Italian</a></li>
			      		<li><a href="?lang=fr&amp;page=charts" title="French"><img src="theme/images/lang/fr.png" alt="French"> French</a></li>
			      		<li><a href="?lang=pl&amp;page=charts" title="Polish"><img src="theme/images/lang/pl.png" alt="Polish"> Polish</a></li>
			    	</ul>
				</li>
				<li class="account">
										<a data-toggle="dropdown" href="index.php?lang=en&page=form_demo" class="glyphicons logout lock"><span class="hidden-phone text">mosaicpro</span><i></i></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="index.php?lang=en&page=form_demo" class="glyphicons cogwheel">Settings<i></i></a></li>
						<li><a href="index.php?lang=en&page=form_demo" class="glyphicons camera">My Photos<i></i></a></li>
						<li class="highlight profile">
							<span>
								<span class="heading">Profile <a href="index.php?lang=en&page=form_demo" class="pull-right">edit</a></span>
								<span class="img"></span>
								<span class="details">
									<a href="index.php?lang=en&page=form_demo">Mosaic Pro</a>
									contact@mosaicpro.biz
								</span>
								<span class="clearfix"></span>
							</span>
						</li>
						<li>
							<span>
								<a class="btn btn-default btn-small pull-right" style="padding: 2px 10px; background: #fff;" href="index.php?lang=en&page=login">Sign Out</a>
							</span>
						</li>
					</ul>
									</li>
			</ul>
		</div>
		
				<div id="wrapper">
		<div id="menu" class="hidden-phone">
			<div id="menuInner">
				<div id="search">
					<input type="text" placeholder="Quick search ..." />
					<button class="glyphicons search"><i></i></button>
				</div>
				<ul>
					<li class="heading"><span>Category</span></li>
					<li class="glyphicons home"><a href="index.php?lang=en&page=index"><i></i><span>Dashboard</span></a></li>
					<li class="glyphicons cogwheels"><a href="index.php?lang=en&page=ui"><i></i><span>UI Elements</span></a></li>
					<li class="glyphicons charts active"><a href="index.php?lang=en&page=charts"><i></i><span>Charts</span></a></li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons show_thumbnails_with_lines" href="#menu_forms"><i></i><span>Forms</span></a>
						<ul class="collapse" id="menu_forms">
							<li class=""><a href="index.php?lang=en&page=form_demo"><span>My Account</span></a></li>
							<li class=""><a href="index.php?lang=en&page=form_elements"><span>Form Elements</span></a></li>
							<li class=""><a href="index.php?lang=en&page=form_validator"><span>Form Validator</span></a></li>
							<li class=""><a href="index.php?lang=en&page=file_managers"><span>File Managers</span></a></li>
						</ul>
					</li>
					<li class="">
						<a class="glyphicons table" href="index.php?lang=en&page=tables"><i></i><span>Tables</span></a>
					</li>
					<li class="glyphicons calendar"><a href="index.php?lang=en&page=calendar"><i></i><span>Calendar</span></a></li>
					<li class="glyphicons user"><a href="index.php?lang=en&page=login"><i></i><span>Login</span></a></li>
				</ul>
				<ul>
					<li class="heading"><span>Sections</span></li>
					<li class="glyphicons coins"><a href="index.php?lang=en&page=finances"><i></i><span>Finances</span></a></li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons shopping_cart" href="#menu_ecommerce"><i></i><span>Online Shop</span></a>
						<ul class="collapse" id="menu_ecommerce">
							<li class=""><a href="index.php?lang=en&page=products"><span>Products</span></a></li>
							<li class=""><a href="index.php?lang=en&page=product_edit"><span>Add product</span></a></li>
						</ul>
					</li>
					<li class="glyphicons sort"><a href="index.php?lang=en&page=pages"><i></i><span>Site Pages</span></a></li>
					<li class="glyphicons picture"><a href="index.php?lang=en&page=gallery"><i></i><span>Photo Gallery</span></a></li>
					<li class="glyphicons adress_book"><a href="index.php?lang=en&page=bookings"><i></i><span>Bookings</span></a></li>
				</ul>
			</div>
		</div>
		<div id="content">
		<ul class="breadcrumb">
	<li><a href="index.php?lang=en&page=index" class="glyphicons home"><i></i> AdminPlus</a></li>
	<li class="divider"></li>
	<li>Charts</li>
</ul>
<div class="separator"></div>

<h3 class="glyphicons charts"><i></i> Charts</h3>
<div class="separator"></div>
<div class="innerLR">
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Simple chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_simple" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Lines chart with fill & without points</h4>
		</div>
		<div class="widget-body">
			<div id="chart_lines_fill_nopoints" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Ordered bars chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_ordered_bars" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Donut chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_donut" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Stacked bars chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_stacked_bars" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Pie chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_pie" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Horizontal bars chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_horizontal_bars" style="height: 250px;"></div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Auto updating chart</h4>
		</div>
		<div class="widget-body">
			<div id="chart_live" style="height: 250px;"></div>
		</div>
	</div>
		
</div>		
				<!-- End Content -->
		</div>
		<!-- End Wrapper -->
		</div>
		
		<!-- Sticky Footer -->
		<div id="footer">
	      	<div class="wrap">
	      		<ul>
	      			<li class="active"><span data-toggle="layout" data-layout="fixed" class="glyphicons show_big_thumbnails text" title=""><i></i><span class="hidden-phone">Fixed layout</span></span></li>
	      			<li><span data-toggle="layout" data-layout="fluid" class="glyphicons show_thumbnails text" title=""><i></i><span class="hidden-phone">Fluid layout</span></span></li>
	      			<li><a href="index.php?lang=en&page=documentation" class="glyphicons circle_question_mark text" title=""><i></i><span class="hidden-phone">Documentation</span></a></li>
	      		</ul>
	      	</div>
	    </div>
				
	</div>
	
	<!-- JQueryUI v1.9.2 -->
	<script src="theme/scripts/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="theme/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- MiniColors -->
	<script src="theme/scripts/jquery-miniColors/jquery.miniColors.js"></script>
	
	<!-- Themer -->
	<script>
	var themerPrimaryColor = '#DA4C4C';
	</script>
	<script src="theme/scripts/jquery.cookie.js"></script>
	<script src="theme/scripts/themer.js"></script>
	
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		
	<!--  Flot (Charts) JS -->
	<script src="theme/scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.pie.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.tooltip.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.selection.js"></script>
	<script src="theme/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.orderBars.js" type="text/javascript"></script>
	
		
	<script>
	var charts = 
	{
		// init all charts
		init: function()
		{
									
			// init simple chart
			this.chart_simple.init();

			// init lines chart with fill & without points
			this.chart_lines_fill_nopoints.init();

			// init ordered bars chart
			this.chart_ordered_bars.init();

			// init donut chart
			this.chart_donut.init();

			// init stacked bars chart
			this.chart_stacked_bars.init();

			// init pie chart
			this.chart_pie.init();

			// init horizontal bars chart
			this.chart_horizontal_bars.init();

			// init live chart
			this.chart_live.init();
					},

		// utility class
		utility:
		{
			chartColors: [ "#37a6cd", "#444", "#777", "#999", "#DDD", "#EEE" ],
			chartBackgroundColors: ["#fff", "#fff"],

			applyStyle: function(that)
			{
				that.options.colors = charts.utility.chartColors;
				that.options.grid.backgroundColor = { colors: charts.utility.chartBackgroundColors };
				that.options.grid.borderColor = charts.utility.chartColors[0];
				that.options.grid.color = charts.utility.chartColors[0];
			},
			
						
			// generate random number for charts
			randNum: function()
			{
				return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
			}
		},

						
		// simple chart
		chart_simple:
		{
			// data
			data: 
			{
				sin: [],
				cos: []
			},
			
			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				grid: 
				{
					show: true,
				    aboveData: true,
				    color: "#3f3f3f",
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: true,
				    mouseActiveRadius: 20,
				    backgroundColor : { }
				},
		        series: {
		        	grow: {active: false},
		            lines: {
	            		show: true,
	            		fill: false,
	            		lineWidth: 4,
	            		steps: false
	            	},
		            points: {
		            	show:true,
		            	radius: 5,
		            	symbol: "circle",
		            	fill: true,
		            	borderColor: "#fff"
		            }
		        },
		        legend: { position: "se" },
		        colors: [],
		        shadowSize:1,
		        tooltip: true, //activate tooltip
				tooltipOpts: {
					content: "%s : %y.3",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},

			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);

				if (this.plot == null)
				{
					for (var i = 0; i < 14; i += 0.5) 
					{
				        this.data.sin.push([i, Math.sin(i)]);
				        this.data.cos.push([i, Math.cos(i)]);
				    }
				}
				this.plot = $.plot(
					$("#chart_simple"),
		           	[{
		    			label: "Sin", 
		    			data: this.data.sin,
		    			lines: {fillColor: "#DA4C4C"},
		    			points: {fillColor: "#fff"}
		    		}, 
		    		{	
		    			label: "Cos", 
		    			data: this.data.cos,
		    			lines: {fillColor: "#444"},
		    			points: {fillColor: "#fff"}
		    		}], this.options);
			}
		},
				
		// lines chart with fill & without points
		chart_lines_fill_nopoints: 
		{
			// chart data
			data: 
			{
				d1: [],
				d2: []
			},

			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				grid: {
					show: true,
				    aboveData: true,
				    color: "#3f3f3f",
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: true,
				    mouseActiveRadius: 20,
				    backgroundColor : { }
				},
		        series: {
		        	grow: {active:false},
		            lines: {
	            		show: true,
	            		fill: true,
	            		lineWidth: 2,
	            		steps: false
	            	},
		            points: {show:false}
		        },
		        legend: { position: "nw" },
		        yaxis: { min: 0 },
		        xaxis: {ticks:11, tickDecimals: 0},
		        colors: [],
		        shadowSize:1,
		        tooltip: true,
				tooltipOpts: {
					content: "%s : %y.0",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},

			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				// generate some data
				this.data.d1 = [[1, 3+charts.utility.randNum()], [2, 6+charts.utility.randNum()], [3, 9+charts.utility.randNum()], [4, 12+charts.utility.randNum()],[5, 15+charts.utility.randNum()],[6, 18+charts.utility.randNum()],[7, 21+charts.utility.randNum()],[8, 15+charts.utility.randNum()],[9, 18+charts.utility.randNum()],[10, 21+charts.utility.randNum()],[11, 24+charts.utility.randNum()],[12, 27+charts.utility.randNum()],[13, 30+charts.utility.randNum()],[14, 33+charts.utility.randNum()],[15, 24+charts.utility.randNum()],[16, 27+charts.utility.randNum()],[17, 30+charts.utility.randNum()],[18, 33+charts.utility.randNum()],[19, 36+charts.utility.randNum()],[20, 39+charts.utility.randNum()],[21, 42+charts.utility.randNum()],[22, 45+charts.utility.randNum()],[23, 36+charts.utility.randNum()],[24, 39+charts.utility.randNum()],[25, 42+charts.utility.randNum()],[26, 45+charts.utility.randNum()],[27,38+charts.utility.randNum()],[28, 51+charts.utility.randNum()],[29, 55+charts.utility.randNum()], [30, 60+charts.utility.randNum()]];
				this.data.d2 = [[1, charts.utility.randNum()-5], [2, charts.utility.randNum()-4], [3, charts.utility.randNum()-4], [4, charts.utility.randNum()],[5, 4+charts.utility.randNum()],[6, 4+charts.utility.randNum()],[7, 5+charts.utility.randNum()],[8, 5+charts.utility.randNum()],[9, 6+charts.utility.randNum()],[10, 6+charts.utility.randNum()],[11, 6+charts.utility.randNum()],[12, 2+charts.utility.randNum()],[13, 3+charts.utility.randNum()],[14, 4+charts.utility.randNum()],[15, 4+charts.utility.randNum()],[16, 4+charts.utility.randNum()],[17, 5+charts.utility.randNum()],[18, 5+charts.utility.randNum()],[19, 2+charts.utility.randNum()],[20, 2+charts.utility.randNum()],[21, 3+charts.utility.randNum()],[22, 3+charts.utility.randNum()],[23, 3+charts.utility.randNum()],[24, 2+charts.utility.randNum()],[25, 4+charts.utility.randNum()],[26, 4+charts.utility.randNum()],[27,5+charts.utility.randNum()],[28, 2+charts.utility.randNum()],[29, 2+charts.utility.randNum()], [30, 3+charts.utility.randNum()]];
				
				// make chart
				this.plot = $.plot(
					'#chart_lines_fill_nopoints', 
					[{
             			label: "Visits", 
             			data: this.data.d1,
             			lines: {fillColor: "#fff8f2"},
             			points: {fillColor: "#88bbc8"}
             		}, 
             		{	
             			label: "Unique Visits", 
             			data: this.data.d2,
             			lines: {fillColor: "rgba(0,0,0,0.1)"},
             			points: {fillColor: "#ed7a53"}
             		}], 
             		this.options);
			}
		},

		// ordered bars chart
		chart_ordered_bars:
		{
			// chart data
			data: null,

			// will hold the chart object
			plot: null,

			// chart options
			options:
			{
				bars: {
					show:true,
					barWidth: 0.2,
					fill:1
				},
				grid: {
					show: true,
				    aboveData: false,
				    color: "#3f3f3f" ,
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: false,
				    mouseActiveRadius: 20,
				    backgroundColor : { }
				},
		        series: {
		        	grow: {active:false}
		        },
		        legend: { position: "ne" },
		        colors: [],
		        tooltip: true,
				tooltipOpts: {
					content: "%s : %y.0",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},

			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				//some data
				var d1 = [];
			    for (var i = 0; i <= 10; i += 1)
			        d1.push([i, parseInt(Math.random() * 30)]);
			 
			    var d2 = [];
			    for (var i = 0; i <= 10; i += 1)
			        d2.push([i, parseInt(Math.random() * 30)]);
			 
			    var d3 = [];
			    for (var i = 0; i <= 10; i += 1)
			        d3.push([i, parseInt(Math.random() * 30)]);
			 
			    var ds = new Array();
			 
			    ds.push({
			     	label: "Data One",
			        data:d1,
			        bars: {order: 1}
			    });
			    ds.push({
			    	label: "Data Two",
			        data:d2,
			        bars: {order: 2}
			    });
			    ds.push({
			    	label: "Data Three",
			        data:d3,
			        bars: {order: 3}
			    });
				this.data = ds;

				this.plot = $.plot($("#chart_ordered_bars"), this.data, this.options);
			}
		},

		// donut chart
		chart_donut:
		{
			// chart data
			data: [
			    { label: "USA",  data: 38 },
			    { label: "Brazil",  data: 23 },
			    { label: "India",  data: 15 },
			    { label: "Turkey",  data: 9 },
			    { label: "France",  data: 7 },
			    { label: "China",  data: 5 },
			    { label: "Germany",  data: 3 }
			],

			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				series: {
					pie: { 
						show: true,
						innerRadius: 0.4,
						highlight: {
							opacity: 0.1
						},
						radius: 1,
						stroke: {
							color: '#fff',
							width: 8
						},
						startAngle: 2,
					    combine: {
		                    color: '#EEE',
		                    threshold: 0.05
		                },
		                label: {
		                    show: true,
		                    radius: 1,
		                    formatter: function(label, series){
		                        return '<div class="label label-inverse">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
		                    }
		                }
					},
					grow: {	active: false}
				},
				legend:{show:false},
				grid: {
		            hoverable: true,
		            clickable: true,
		            backgroundColor : { }
		        },
		        colors: [],
		        tooltip: true,
				tooltipOpts: {
					content: "%s : %y.1"+"%",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},
			
			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				this.plot = $.plot($("#chart_donut"), this.data, this.options);
			}
		},

		// horizontal bars chart
		chart_horizontal_bars:
		{
			// chart data
			data: null,

			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				grid: {
					show: true,
				    aboveData: false,
				    color: "#3f3f3f" ,
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: false,
				    mouseActiveRadius: 20,
				    backgroundColor : { }
				},
		        series: {
		        	grow: {active:false},
			        bars: {
			        	show:true,
						horizontal: true,
						barWidth:0.2,
						fill:1
					}
		        },
		        legend: { position: "ne" },
		        colors: [],
		        tooltip: true,
				tooltipOpts: {
					content: "%s : %y.0",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},
			
			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				var d1 = [];
			    for (var i = 0; i <= 5; i += 1)
			        d1.push([parseInt(Math.random() * 30),i ]);

			    var d2 = [];
			    for (var i = 0; i <= 5; i += 1)
			        d2.push([parseInt(Math.random() * 30),i ]);

			    var d3 = [];
			    for (var i = 0; i <= 5; i += 1)
			        d3.push([ parseInt(Math.random() * 30),i]);

			    this.data = new Array();
			    this.data.push({
			        data: d1,
			        bars: {
			            horizontal:true, 
			            show: true, 
			            barWidth: 0.2, 
			            order: 1
			        }
			    });
				this.data.push({
				    data: d2,
				    bars: {
				        horizontal:true, 
				        show: true, 
				        barWidth: 0.2, 
				        order: 2
				    }
				});
				this.data.push({
				    data: d3,
				    bars: {
				        horizontal:true, 
				        show: true, 
				        barWidth: 0.2, 
				        order: 3
				    }
				});

				this.plot = $.plot($("#chart_horizontal_bars"), this.data, this.options);
			}
		},

		// pie chart
		chart_pie:
		{
			// chart data
			data: [
			    { label: "USA",  data: 38 },
			    { label: "Brazil",  data: 23 },
			    { label: "India",  data: 15 },
			    { label: "Turkey",  data: 9 },
			    { label: "France",  data: 7 },
			    { label: "China",  data: 5 },
			    { label: "Germany",  data: 3 }
			],

			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				series: {
					pie: { 
						show: true,
						highlight: {
							opacity: 0.1
						},
						radius: 1,
						stroke: {
							color: '#fff',
							width: 2
						},
						startAngle: 2,
					    combine: {
		                    color: '#353535',
		                    threshold: 0.05
		                },
		                label: {
		                    show: true,
		                    radius: 1,
		                    formatter: function(label, series){
		                        return '<div class="label label-inverse">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
		                    }
		                }
					},
					grow: {	active: false}
				},
				colors: [],
				legend:{show:false},
				grid: {
		            hoverable: true,
		            clickable: true,
		            backgroundColor : { }
		        },
		        tooltip: true,
				tooltipOpts: {
					content: "%s : %y.1"+"%",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},
			
			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				this.plot = $.plot($("#chart_pie"), this.data, this.options);
			}
		},

		// stacked bars chart
		chart_stacked_bars:
		{
			// chart data
			data: null,

			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				grid: {
					show: true,
				    aboveData: false,
				    color: "#3f3f3f" ,
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: true,
				    mouseActiveRadius: 20,
				    backgroundColor : { }
				},
		        series: {
		        	grow: {active:false},
		        	stack: 0,
	                lines: { show: false, fill: true, steps: false },
	                bars: { show: true, barWidth: 0.5, fill:1}
			    },
		        xaxis: {ticks:11, tickDecimals: 0},
		        legend: { position: "ne" },
		        colors: [],
		        shadowSize:1,
		        tooltip: true,
				tooltipOpts: {
					content: "%s : %y.0",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			},
			
			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				var d1 = [];
			    for (var i = 0; i <= 10; i += 1)
			        d1.push([i, parseInt(Math.random() * 30)]);
			 
			    var d2 = [];
			    for (var i = 0; i <= 10; i += 1)
			        d2.push([i, parseInt(Math.random() * 20)]);
			 
			    var d3 = [];
			    for (var i = 0; i <= 10; i += 1)
			        d3.push([i, parseInt(Math.random() * 20)]);
			 
			    this.data = new Array();
			 
			    this.data.push({
			     	label: "Data One",
			        data: d1
			    });
			    this.data.push({
			    	label: "Data Two",
			        data: d2
			    });
			    this.data.push({
			    	label: "Data Tree",
			        data: d3
			    });

			    this.plot = $.plot($("#chart_stacked_bars"), this.data, this.options);
			}
		},

		// live chart
		chart_live:
		{
			// chart data
			data: [],
			totalPoints: 300,
		    updateInterval: 200,

			// we use an inline data source in the example, usually data would
		    // be fetched from a server
			getRandomData: function()
			{
				if (this.data.length > 0)
		            this.data = this.data.slice(1);

		        // do a random walk
		        while (this.data.length < this.totalPoints) 
			    {
		            var prev = this.data.length > 0 ? this.data[this.data.length - 1] : 50;
		            var y = prev + Math.random() * 10 - 5;
		            if (y < 0)
		                y = 0;
		            if (y > 100)
		                y = 100;
		            this.data.push(y);
		        }

		        // zip the generated y values with the x values
		        var res = [];
		        for (var i = 0; i < this.data.length; ++i)
		            res.push([i, this.data[i]])
		        return res;
			},

			// will hold the chart object
			plot: null,

			// chart options
			options: 
			{
				series: { 
		        	grow: { active: false },
		        	shadowSize: 0,
		        	lines: {
	            		show: true,
	            		fill: true,
	            		lineWidth: 2,
	            		steps: false
		            }
		        },
		        grid: {
					show: true,
				    aboveData: false,
				    color: "#3f3f3f",
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: false,
				    mouseActiveRadius: 20,
				    backgroundColor : { }
				}, 
				colors: [],
		        tooltip: true,
				tooltipOpts: {
					content: "Value is : %y.0",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				},	
		        yaxis: { min: 0, max: 100 },
		        xaxis: { show: true}
			},
			
			// initialize
			init: function()
			{
				// apply styling
				charts.utility.applyStyle(this);
				
				this.plot = $.plot($("#chart_live"), [ this.getRandomData() ], this.options);
				setTimeout(this.update, charts.chart_live.updateInterval);
			},

			// update
			update: function()
			{
				charts.chart_live.plot.setData([ charts.chart_live.getRandomData() ]);
		        charts.chart_live.plot.draw();
		        
		        setTimeout(charts.chart_live.update, charts.chart_live.updateInterval);
			}
		}
			};

	$(function()
	{
		// initialize charts
		charts.init();
	});
	</script>
	
	
	<!-- Resize Script -->
	<script src="theme/scripts/jquery.ba-resize.js"></script>
	
	<!-- Uniform -->
	<script src="theme/scripts/pixelmatrix-uniform/jquery.uniform.min.js"></script>
	
	<!-- Bootstrap Script -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Bootstrap Extended -->
	<script src="bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<script src="bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script src="bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
	<script src="bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="bootstrap/extend/bootbox.js" type="text/javascript"></script>
	<script src="bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
	<script src="bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
	
	<!-- Custom Onload Script -->
	<script src="theme/scripts/load.js"></script>
	
</body>
</html>