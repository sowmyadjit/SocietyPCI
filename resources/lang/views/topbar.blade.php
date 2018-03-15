<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <title>PCICS,{{$udetail->BName}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link id="bs-css" href="css/floating-box.css" rel="stylesheet">

	
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href="bower_components/fullcalendar/dist/fullcalendar.css" rel='stylesheet'>
    <link href="bower_components/fullcalendar/dist/fullcalendar.print.css" rel='stylesheet' media='print'>
    <link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
    <link href="bower_components/colorbox/example3/colorbox.css" rel='stylesheet'>
    <link href="bower_components/responsive-tables/responsive-tables.css" rel='stylesheet'>
    <link href="bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css" rel='stylesheet'>
    <link href="css/jquery.noty.css" rel='stylesheet'>
    <link href="css/noty_theme_default.css" rel='stylesheet'>
    <link href="css/elfinder.min.css" rel='stylesheet'>
    <link href="css/elfinder.theme.css" rel='stylesheet'>
    <link href="css/jquery.iphone.toggle.css" rel='stylesheet'>
    <link href="css/uploadify.css" rel='stylesheet'>
    <link href="css/animate.min.css" rel='stylesheet'>
    

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
	
	<script type="text/javascript">
        // Load the Google Transliterate API
        google.load("elements", "1", {
            packages: "transliteration"
        });

        function onLoad() {
            var options = {
                sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
                destinationLanguage:
                [google.elements.transliteration.LanguageCode.KANNADA],
                shortcutKey: 'ctrl+e',
                transliterationEnabled: true
            };

            // Create an instance on TransliterationControl with the required
            // options.
            var control =
            new google.elements.transliteration.TransliterationControl(options);

            // Enable transliteration in the textbox with id
            // 'transliterateTextarea'.
            control.makeTransliteratable(['transliterateTextarea']);


        }
        google.setOnLoadCallback(onLoad);
    </script>
	
	

    
    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>
<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  href="/home"> <img alt="PCI Logo" src="img/logo20.png" class="hidden-xs" height="75px" width="75px"/>
                <span style="color:#ffffff;font-weight:bold;font-size:25px">PCI Society</span>
			&nbsp<span style="color:#ffffff;font-weight:bold;font-size:15px">,BRANCH: {{$udetail->BName}} </span>
			</a>
			
			

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
			
			
             
			   <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> {{$udetail->FirstName}} </span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            
            </div>
            </div>
            <!-- user dropdown ends -->
			<ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <!--<li><a href="#"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Dropdown <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>-->
				
              <!--  <li class="pull-left">
				<span style="color:#ffffff;font-weight:bold">BRANCH: {{$udetail->BName}} </span>
				</li>-->
				
				<!--<li>
				
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>-->
				
				<!--<li>
				
					<div id="google_translate_element" class="btn-group pull-right"></div>
					<script type="text/javascript">
					function googleTranslateElementInit() {
					  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'kn', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
					}
					</script>
					<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				
				</li>-->
				
				<!--<li>
				
				
				
				 
				  <div class="panel btn-group pull-right">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" href="#collapse1">English To Kannada</a>
					  </h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
					  <div class="panel-body">
					  ಭಾಷಾಂತರಿಸಲು: ಪದವನ್ನು ಟೈಪ್ ಮಾಡಿ ಸ್ಪೇಸ್ ಕೀಲಿಯನ್ನು ಒತ್ತಿರಿ
					  <form runat="server">
					  
		<input type='text' class="form-control" ID="transliterateTextarea" runat="server" placeholder=""/>
					  
					  </form>
					  </div>
					  
					</div>
				  </div>
				
				
				
				
				
				
				</li>-->
				
				
				<li>
				
				
				
				
				
				</li>
				
				
				
				
				
				
				
				
				
				
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
<script src="js/floating-box.js"></script>


</body>
</html>