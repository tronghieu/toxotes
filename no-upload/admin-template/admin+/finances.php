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
	<link rel="stylesheet/less" href="theme/less/style.less?1361270144" />
	
	<!-- FireBug Lite -->
	<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite-debug.js"></script> -->
	
	<!-- LESS 2 CSS -->
	<script src="theme/scripts/less-1.3.3.min.js"></script>
	
	
	<!--[if IE]><script type="text/javascript" src="theme/scripts/excanvas/excanvas.js"></script><![endif]-->
	<!--[if lt IE 8]><script type="text/javascript" src="theme/scripts/json2.js"></script><![endif]-->
</head>
<body>
	
	<!-- Start Content -->
	<div class="container-fluid fixed">
		
		<div class="navbar main">
			<a href="index.php" class="appbrand"><span>Admin+ <span>lovely headline here</span></span></a>
			
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
			      		<li class="active"><a href="finances.php" title="English"><img src="theme/images/lang/en.png" alt="English"> English</a></li>
			      		<li><a href="finance.phps" title="Romanian"><img src="theme/images/lang/ro.png" alt="Romanian"> Romanian</a></li>
			      		<li><a href="finances.php" title="Italian"><img src="theme/images/lang/it.png" alt="Italian"> Italian</a></li>
			      		<li><a href="finances.php" title="French"><img src="theme/images/lang/fr.png" alt="French"> French</a></li>
			      		<li><a href="finances.php" title="Polish"><img src="theme/images/lang/pl.png" alt="Polish"> Polish</a></li>
			    	</ul>
				</li>
				<li class="account">
										<a data-toggle="dropdown" href="form_demo.php" class="glyphicons logout lock"><span class="hidden-phone text">mosaicpro</span><i></i></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="form_demo.php" class="glyphicons cogwheel">Settings<i></i></a></li>
						<li><a href="form_demo.php" class="glyphicons camera">My Photos<i></i></a></li>
						<li class="highlight profile">
							<span>
								<span class="heading">Profile <a href="form_demo.php" class="pull-right">edit</a></span>
								<span class="img"></span>
								<span class="details">
									<a href="form_demo.php">Mosaic Pro</a>
									contact@mosaicpro.biz
								</span>
								<span class="clearfix"></span>
							</span>
						</li>
						<li>
							<span>
								<a class="btn btn-default btn-small pull-right" style="padding: 2px 10px; background: #fff;" href="login.php">Sign Out</a>
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
					<li class="glyphicons home"><a href="index.php"><i></i><span>Dashboard</span></a></li>
					<li class="glyphicons cogwheels"><a href="ui.php"><i></i><span>UI Elements</span></a></li>
					<li class="glyphicons charts"><a href="charts.php"><i></i><span>Charts</span></a></li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons show_thumbnails_with_lines" href="#menu_forms"><i></i><span>Forms</span></a>
						<ul class="collapse" id="menu_forms">
							<li class=""><a href="form_dem.phpo"><span>My Account</span></a></li>
							<li class=""><a href="form_elements.php"><span>Form Elements</span></a></li>
							<li class=""><a href="form_validator.php"><span>Form Validator</span></a></li>
							<li class=""><a href="file_managers.php"><span>File Managers</span></a></li>
						</ul>
					</li>
					<li class="">
						<a class="glyphicons table" href="tables.php"><i></i><span>Tables</span></a>
					</li>
					<li class="glyphicons calendar"><a href="calendar.php"><i></i><span>Calendar</span></a></li>
					<li class="glyphicons user"><a href="login.php"><i></i><span>Login</span></a></li>
				</ul>
				<ul>
					<li class="heading"><span>Sections</span></li>
					<li class="glyphicons coins active"><a href="finances.php"><i></i><span>Finances</span></a></li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons shopping_cart" href="#menu_ecommerce"><i></i><span>Online Shop</span></a>
						<ul class="collapse" id="menu_ecommerce">
							<li class=""><a href="products.php"><span>Products</span></a></li>
							<li class=""><a href="product_edit.php"><span>Add product</span></a></li>
						</ul>
					</li>
					<li class="glyphicons sort"><a href="pages.php"><i></i><span>Site Pages</span></a></li>
					<li class="glyphicons picture"><a href="gallery.php"><i></i><span>Photo Gallery</span></a></li>
					<li class="glyphicons adress_book"><a href="bookings.php"><i></i><span>Bookings</span></a></li>
				</ul>
			</div>
		</div>
		<div id="content">
		<ul class="breadcrumb">
	<li><a href="index.php" class="glyphicons home"><i></i> AdminPlus</a></li>
	<li class="divider"></li>
	<li>Finances</li>
</ul>
<div class="separator"></div>

<div class="heading-buttons">
	<h3 class="glyphicons coins"><i></i> Finances</h3>
	<div class="buttons pull-right">
		<a href="" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i> Add record</a>
		<a href="" class="btn btn-default btn-icon glyphicons history"><i></i> History</a>
	</div>
</div>
<div class="separator"></div>

<div class="filter-bar">
	<form>
		<div class="lbl glyphicons cogwheel"><i></i>Filter</div>
		<div>
			<label>From:</label>
			<div class="input-append">
				<input type="text" name="from" id="dateRangeFrom" class="input-mini" value="08/05/13" style="width: 53px;" />
				<span class="add-on glyphicons calendar"><i></i></span>
			</div>
		</div>
		<div>
			<label>To:</label>
			<div class="input-append">
				<input type="text" name="to" id="dateRangeTo" class="input-mini" value="08/18/13" style="width: 53px;" />
				<span class="add-on glyphicons calendar"><i></i></span>
			</div>
		</div>
		<div>
			<label>Min:</label>
			<div class="input-append">
				<input type="text" name="from" class="input-mini" style="width: 30px;" value="100" />
				<span class="add-on glyphicons euro"><i></i></span>
			</div>
		</div>
		<div>
			<label>Max:</label>
			<div class="input-append">
				<input type="text" name="from" class="input-mini" style="width: 30px;" value="500" />
				<span class="add-on glyphicons euro"><i></i></span>
			</div>
		</div>
		<div>
			<label>Select:</label>
			<select name="from" style="width: 80px;">
				<option>Some option</option>
				<option>Other option</option>
				<option>Some other option</option>
			</select>
		</div>
		<div class="clearfix"></div>
	</form>
</div>

<div class="widget widget-2 widget-body-white finances_summary">
	<div class="widget-head">
		<h4 class="heading glyphicons alarm"><i></i> Summary</h4>
	</div>
	<div class="widget-body">
		<div class="row-fluid">
			<div class="span4">
				<div class="well">
					Total expenses					<strong>&euro;32,156.00</strong>
				</div>
				<div class="separator bottom center">
					<span class="glyphicons flash standard"><i></i></span>
				</div>
				<div class="well">
					Total income					<strong>&euro;122,134.00</strong>
				</div>
			</div>
			<div class="span8">
				<div id="chart_simple" style="height: 290px;"></div>
			</div>
		</div>
		<a href="" class="glyphicons list single"><i></i> View details</a>
	</div>
</div>
<div class="widget widget-2 widget-body-white">
	<div class="widget-head">
		<h4 class="heading glyphicons fire"><i></i> Transactions</h4>
	</div>
	<div class="widget-body">
		<table class="table table-condensed table-primary table-vertical-center table-thead-simple">
			<thead>
				<tr>
					<th class="center" style="width: 1%">No.</th>
					<th>Transaction</th>
					<th class="center">Date</th>
					<th class="center">Amount</th>
					<th class="right">Actions</th>
				</tr>
			</thead>
			<tbody>
												<tr class="selectable">
					<td class="center">1</td>
					<td class="important"><span class="glyphicons up_arrow btn-success btn-action single"><i></i></span>Amazon Web Services</td>
					<td class="center"><span class="label label-important">23 Jan 2013</span></td>
					<td class="center">&euro;393.00</td>
					<td class="right actions">
						<a href="#" class="btn-action glyphicons eye_open btn-info"><i></i></a>
						<a href="#" class="btn-action glyphicons pencil btn-success"><i></i></a>
						<a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
					</td>
				</tr>
								<tr class="selectable">
					<td class="center">2</td>
					<td class="important"><span class="glyphicons down_arrow btn-danger btn-action single"><i></i></span>Amazon Web Services</td>
					<td class="center"><span class="label label-important">23 Jan 2013</span></td>
					<td class="center">&euro;566.00</td>
					<td class="right actions">
						<a href="#" class="btn-action glyphicons eye_open btn-info"><i></i></a>
						<a href="#" class="btn-action glyphicons pencil btn-success"><i></i></a>
						<a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
					</td>
				</tr>
								<tr class="selectable">
					<td class="center">3</td>
					<td class="important"><span class="glyphicons down_arrow btn-danger btn-action single"><i></i></span>Amazon Web Services</td>
					<td class="center"><span class="label label-important">23 Jan 2013</span></td>
					<td class="center">&euro;499.00</td>
					<td class="right actions">
						<a href="#" class="btn-action glyphicons eye_open btn-info"><i></i></a>
						<a href="#" class="btn-action glyphicons pencil btn-success"><i></i></a>
						<a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
					</td>
				</tr>
								<tr class="selectable">
					<td class="center">4</td>
					<td class="important"><span class="glyphicons up_arrow btn-success btn-action single"><i></i></span>ThemeForest</td>
					<td class="center"><span class="label label-important">23 Jan 2013</span></td>
					<td class="center">&euro;748.00</td>
					<td class="right actions">
						<a href="#" class="btn-action glyphicons eye_open btn-info"><i></i></a>
						<a href="#" class="btn-action glyphicons pencil btn-success"><i></i></a>
						<a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
					</td>
				</tr>
								<tr class="selectable">
					<td class="center">5</td>
					<td class="important"><span class="glyphicons up_arrow btn-success btn-action single"><i></i></span>Amazon Web Services</td>
					<td class="center"><span class="label label-important">23 Jan 2013</span></td>
					<td class="center">&euro;734.00</td>
					<td class="right actions">
						<a href="#" class="btn-action glyphicons eye_open btn-info"><i></i></a>
						<a href="#" class="btn-action glyphicons pencil btn-success"><i></i></a>
						<a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
					</td>
				</tr>
								<tr class="selectable">
					<td class="center">6</td>
					<td class="important"><span class="glyphicons up_arrow btn-success btn-action single"><i></i></span>Bank of Ireland</td>
					<td class="center"><span class="label label-important">23 Jan 2013</span></td>
					<td class="center">&euro;362.00</td>
					<td class="right actions">
						<a href="#" class="btn-action glyphicons eye_open btn-info"><i></i></a>
						<a href="#" class="btn-action glyphicons pencil btn-success"><i></i></a>
						<a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
					</td>
				</tr>
							</tbody>
		</table>
		<div class="separator top"><a href="" class="glyphicons list single"><i></i> Show all</a></div>
	</div>
</div>

<br/>		
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
	      			<li><a href="documentation.php" class="glyphicons circle_question_mark text" title=""><i></i><span class="hidden-phone">Documentation</span></a></li>
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
	
	<!-- jQuery Knob -->
	<script src="theme/scripts/jquery-knob/js/jquery.knob.js"></script>
	
</body>
</html>