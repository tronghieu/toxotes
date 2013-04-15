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

	<!-- ColorPicker -->
	<link rel="stylesheet" media="screen" href="theme/scripts/farbtastic/farbtastic.css" />

	<!-- JQuery v1.8.2 -->
	<script src="theme/scripts/jquery-1.8.2.min.js"></script>
	
	<!-- Modernizr -->
	<script src="theme/scripts/modernizr.custom.76094.js"></script>
	
	<!-- MiniColors -->
	<link rel="stylesheet" media="screen" href="theme/scripts/jquery-miniColors/jquery.miniColors.css" />
	
	<!-- Theme -->
	<link rel="stylesheet/less" href="theme/less/style.less?1361270004" />
	
	<!-- FireBug Lite -->
	<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite-debug.js"></script> -->
	
	<!-- LESS 2 CSS -->
	<script src="theme/scripts/less-1.3.3.min.js"></script>
	
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
			      		<li class="active"><a href="form_elements.php" title="English"><img src="theme/images/lang/en.png" alt="English"> English</a></li>
			      		<li><a href="form_elements.php" title="Romanian"><img src="theme/images/lang/ro.png" alt="Romanian"> Romanian</a></li>
			      		<li><a href="form_elements.php" title="Italian"><img src="theme/images/lang/it.png" alt="Italian"> Italian</a></li>
			      		<li><a href="form_elements.php" title="French"><img src="theme/images/lang/fr.png" alt="French"> French</a></li>
			      		<li><a href="form_elements.php" title="Polish"><img src="theme/images/lang/pl.png" alt="Polish"> Polish</a></li>
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
					<li class="hasSubmenu active">
						<a data-toggle="collapse" class="glyphicons show_thumbnails_with_lines" href="#menu_forms"><i></i><span>Forms</span></a>
						<ul class="collapse in" id="menu_forms">
							<li class=""><a href="form_demo.php"><span>My Account</span></a></li>
							<li class=" active"><a href="form_elements.php"><span>Form Elements</span></a></li>
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
					<li class="glyphicons coins"><a href="finances.php"><i></i><span>Finances</span></a></li>
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
	<li><a href="index" class="glyphicons home"><i></i> AdminPlus</a></li>
	<li class="divider"></li>
	<li>Forms</li>
	<li class="divider"></li>
	<li>Form Elements</li>
</ul>
<div class="separator"></div>

<div class="innerLR">
	<div class="widget widget-4">
		<div class="widget-head">
			<h3 class="heading">Form Elements</h3>
		</div>
		<div class="widget-body">
			<p>There are various form elements contained in AdminPlus, custom select controls, custom checkbox &amp; radio controls, custom input controls with &amp; without appended / prepended elements (icons, dropdowns, dropups, groups), toggle (on/off) buttons, icons &amp; many more.</p>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Input controls</h4>
		</div>
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="row-fluid">
			<div class="span6">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading">Default</h4></div>
				<div class="separator"></div>
				<div class="row-fluid">
					<input type="text" placeholder="Text input" class="span12" />
				</div>
			</div>
			
			<div class="widget widget-4 row-fluid">
				<div class="widget-head"><h4 class="heading">Extended</h4></div>
				<div class="separator"></div>
				<div class="input-prepend">
				  	<span class="add-on">@</span>
				  	<input id="prependedInput" class="span12" type="text" placeholder="Username" />
				</div>
			</div>
				
			<div class="widget widget-4 row-fluid">
				<div class="widget-head"><h4 class="heading">Combined</h4></div>
				<div class="separator"></div>
				<div class="input-prepend input-append">
					<span class="add-on">$</span>
					<input class="span12" id="appendedPrependedInput" type="text" placeholder="100,000,000" /> 
					<span class="add-on">.00</span>
				</div>
			</div>
			
			<div class="widget widget-4 uniformjs">
				<div class="widget-head">
					<h4 class="heading">Checkbox</h4>
				</div>
				<div class="separator"></div>
				<label class="checkbox">
					<input type="checkbox" class="checkbox" value="1" />
					Option 1 - Sexy checkbox
				</label>
				<label class="checkbox">
					<input type="checkbox" class="checkbox" value="1" checked="checked" />
					Option 2 - Checked
				</label>
				<label class="checkbox">
					<input type="checkbox" class="checkbox" value="1" disabled="disabled" />
					Option 3 - Disabled checkbox
				</label>
			</div>
			
			</div>
			<div class="span6">
			
			<div class="widget widget-4 row-fluid">
				<div class="widget-head"><h4 class="heading">Buttons</h4></div>
				<div class="separator"></div>
				<div class="input-append">
				  	<input class="span6" id="appendedInputButtons" type="text" placeholder="Placeholder .." />
				  	<button class="btn" type="button"><i class="icon-search"></i></button>
				  	<button class="btn" type="button">Options</button>
				</div>
			</div>
				
			<div class="widget widget-4 row-fluid">
				<div class="widget-head"><h4 class="heading">Dropdown / Dropup</h4></div>
				<div class="separator"></div>
				<div class="input-append">
					<input class="span8" id="appendedDropdownButton" type="text" />
					<div class="btn-group dropup">
						<button class="btn dropdown-toggle" data-toggle="dropdown">
							Action <span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
				</div>
			</div>	
				
			<div class="widget widget-4 row-fluid">
				<div class="widget-head"><h4 class="heading">Segmented Groups</h4></div>
				<div class="separator"></div>
				<div class="input-append">
					<input type="text" class="span7" />
					<div class="btn-group dropup">
						<button class="btn" tabindex="-1">Action</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="widget widget-4 uniformjs">
				<div class="widget-head">
					<h4 class="heading">Radio</h4>
				</div>
				<div class="separator"></div>
				<label class="radio">
					<input type="radio" class="radio" name="radio" value="1" />
					Option 1 - Sexy radio
				</label><br/>
				<label class="radio">
					<input type="radio" class="radio" name="radio" value="1" checked="checked" />
					Option 2 - Checked
				</label><br/>
				<label class="radio">
					<input type="radio" class="radio disabled" name="radio" value="1" disabled="disabled" />
					Option 3 - Disabled radio
				</label>
			</div>
			
			</div>
			</div>
			
		</div>	
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">File controls</h4>
		</div>
		<div class="widget-body" style="padding: 10px 0;">
			<div class="row-fluid">
				<div class="span6">
					<div class="widget widget-4">
						<div class="widget-head">
							<h4 class="heading">File upload widget</h4>
						</div>
						<div class="separator"></div>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  	<div class="input-append">
						    	<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
						  	</div>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="widget widget-4">
						<div class="widget-head">
							<h4 class="heading">File upload button</h4>
						</div>
						<div class="separator"></div>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  	<span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" /></span>
						  	<span class="fileupload-preview"></span>
						  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="widget widget-gray widget-body-white row-fluid">
		<div class="widget-head">
			<h4 class="heading">WYSIHTML5 Editor</h4>
		</div>
		<div class="widget-body" style="padding: 10px 0 0;">
			<textarea id="mustHaveId" class="wysihtml5 span12" rows="5">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</textarea>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Toggle buttons</h4>
		</div>
		<div class="widget-body center">
			<div class="toggle-button">
				<input type="checkbox" checked="checked" />
			</div>
			<div class="toggle-button" data-toggleButton-style-enabled="info">
				<input type="checkbox" checked="checked" />
			</div>
			<div class="toggle-button" data-toggleButton-style-enabled="warning">
				<input type="checkbox" checked="checked" />
			</div>
			<div class="toggle-button" data-toggleButton-style-enabled="danger">
				<input type="checkbox" checked="checked" />
			</div>
			<div class="toggle-button" data-toggleButton-style-enabled="success">
				<input type="checkbox" checked="checked" />
			</div>
			<div class="toggle-button"
				data-toggleButton-style-custom-enabled-background="#3F4246"
				data-toggleButton-style-custom-enabled-gradient="#000000">
				<input type="checkbox" checked="checked" />
			</div>
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Select controls</h4>
		</div>
		<div class="widget-body" style="padding: 10px 0;">
			<div class="row-fluid">
				<div class="span3">
					<h5>Default</h5>
					<div class="row-fluid">
						<select class="span12">
							<optgroup label="Picnic">
								<option>Mustard</option>
								<option>Ketchup</option>
								<option>Relish</option>
							</optgroup>
							<optgroup label="Camping">
								<option>Tent</option>
								<option>Flashlight</option>
								<option>Toilet Paper</option>
							</optgroup>
						</select>
					</div>
					<hr/>
					<h5>Extended</h5>
					<div class="row-fluid">
						<select class="selectpicker span12">
							<optgroup label="Picnic">
								<option>Mustard</option>
								<option>Ketchup</option>
								<option>Relish</option>
							</optgroup>
							<optgroup label="Camping">
								<option>Tent</option>
								<option>Flashlight</option>
								<option>Toilet Paper</option>
							</optgroup>
						</select>
					</div>
				</div>
				<div class="span5">
					<h5>Styles</h5>
					<div class="row-fluid">
						<select class="selectpicker span6" data-style="btn-primary">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select> 
						<select class="selectpicker span6" data-style="btn-default">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
					<div class="row-fluid">
						<select class="selectpicker span6" data-style="btn-info">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
						<select class="selectpicker span6" data-style="btn-success">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
					<div class="row-fluid">
						<select class="selectpicker span6" data-style="btn-warning">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select> 
						<select class="selectpicker span6" data-style="btn-inverse">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
				</div>
				<div class="span4">
					<h5>Grid</h5>
					<div class="row-fluid">
						<select class="selectpicker span3">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select> 
						<select class="selectpicker span9">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
					<div class="row-fluid">
						<select class="selectpicker span4">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select> 
						<select class="selectpicker span8">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
					<div class="row-fluid">
						<select class="selectpicker span6">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select> 
						<select class="selectpicker span6">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
				</div>
			</div>
		
		</div>
	</div>
	
	<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Color picker &amp; Date pickers</h4>
		</div>
		<div class="widget-body">
			
			<div class="form-horizontal">
				<div class="control-group">
					<label class="control-label">Color picker</label>
					<div class="controls">
						<input type="text" id="colorpickerColor" value="#D15353" /><br/><br/>
						<div id="colorpicker"></div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Date picker</label>
					<div class="controls">
						<input type="text" id="datepicker" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Inline Date picker</label>
					<div class="controls">
						<div id="datepicker-inline"></div>
					</div>
				</div>
			</div>
					
		</div>
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
	
	<!-- ColorPicker -->
	<script src="theme/scripts/farbtastic/farbtastic.js" type="text/javascript"></script>

	
	
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