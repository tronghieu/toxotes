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
	
	<!-- google-code-prettify -->
	<link href="theme/scripts/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
	
	<!-- Theme -->
	<link rel="stylesheet/less" href="theme/less/style.less?1361270688" />
	
	<!-- FireBug Lite -->
	<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite-debug.js"></script> -->
	
	<!-- LESS 2 CSS -->
	<script src="theme/scripts/less-1.3.3.min.js"></script>
	
</head>
<body>
	
	<!-- Start Content -->
	<div class="container-fluid fixed documentation">
		
		<div class="navbar main">
			<a href="index.php" class="appbrand"><span>Admin+ <span>lovely headline here</span></span></a>
			
						
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
			      		<li class="active"><a href="documentation.php" title="English"><img src="theme/images/lang/en.png" alt="English"> English</a></li>
			      		<li><a href="documentation.php" title="Romanian"><img src="theme/images/lang/ro.png" alt="Romanian"> Romanian</a></li>
			      		<li><a href="documentation.php" title="Italian"><img src="theme/images/lang/it.png" alt="Italian"> Italian</a></li>
			      		<li><a href="documentation.php" title="French"><img src="theme/images/lang/fr.png" alt="French"> French</a></li>
			      		<li><a href="documentation.php" title="Polish"><img src="theme/images/lang/pl.png" alt="Polish"> Polish</a></li>
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
		
		<div style="padding: 20px;">

<!-- Documentation -->
<section class="documentation">
	<div class="row-fluid">
		<div class="span9">
				
			<!-- Documentation CONTENT -->
			<h1>Documentation</h1>
<hr class="separator bottom" />
<p>AdminPlus is a fully responsive html template, perfect for anyone
	looking to start a backend system with a modern interface. No more
	separate websites for mobile, as this theme will adapt seamlessly to
	any device screen and on top of that it's HD / retina ready.</p>

<p>Trough this documentation we have laid out information about using
	AdminPlus and in-depth customizing of elements in the item.</p>

<h3>Getting started</h3>
<hr class="separator bottom" />
<p>
	Find your way around AdminPlus with it's available theme &amp; layout
	options and learn how to change to a custom theme, the menu position
	&amp; size, allow or disallow skin or menu customization options from
	the browser etc. <a
		href="documentation/getting-started/files.html"
		class="glyphicons single share"><i></i>Getting Started</a>
</p>

<h3>Customization Guide</h3>
<hr class="separator bottom" />
<p>A complete showcase of each element and editable components is shown
	here along with detailed description and several ideas on how to get
	the best and fastest workflow when editing AdminPlus. <a href="documentation/customization-guide/grid-system.html" class="glyphicons single share"><i></i>Customization Guide</a></p>
			<!-- Documentation CONTENT END -->
				
		</div>
		<div class="span3">
			<div class="widget widget-2 primary widget-body-white">
				<div class="widget-head">
					<h4 class="heading glyphicons circle_question_mark"><i></i> Documentation</h4>
				</div>
				<div class="widget-body list list-2">
					<ul>
						<li class="active"><a href="documentation.php" title="" class="glyphicons link"><i></i>Overview</a></li>
						<li class="hasSubmenu">
							<a href="documentation/getting-started/files.html" title="" class="glyphicons link"><i></i>Getting Started</a>
							<ul>
								<li><a href="documentation/getting-started/files.html" title="">What's in the package</a></li>
								<li><a href="documentation/getting-started/config.html" title="">Configuration</a></li>
								<li><a href="documentation/getting-started/lang.html" title="">Translations</a></li>
							</ul>
						</li>
						<li class="hasSubmenu">
							<a href="documentation/getting-started/grid-system.html" title="" class="glyphicons link"><i></i>Customization Guide</a>
							<ul>
								<li><a href="documentation/customization-guide/grid-system.html" title="">Grid System</a></li>
								<li><a href="documentation/customization-guide/buttons.html" title="">Buttons</a></li>
								<li><a href="documentation/customization-guide/icons.html" title="">Icons</a></li>
								<li><a href="documentation/customization-guide/tables.html" title="">Tables</a></li>
								<li><a href="documentation/customization-guide/widgets.html" title="">Widgets</a></li>
								<li><a href="documentation/customization-guide/tabs.html" title="">Tabs</a></li>
								<li><a href="documentation/customization-guide/elements.html" title="">Other</a></li>
							</ul>
						</li>
						<li><a href="documentation/credits.html" title="" class="glyphicons link"><i></i>Credits</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Documentation END -->

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
	
	<!-- google-code-prettify -->
	<script src="theme/scripts/google-code-prettify/prettify.js"></script>
	<script>
	$(function(){
		prettyPrint();
	});
	</script>
	
</body>
</html>