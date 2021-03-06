@extends('layout/template')
@section('content')
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <title>PCIC SOCIETY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

   	
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


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>

<div class="ch-container">
    <div class="row">
        <div class="col-md-12">
		<center>
		<img alt="PCI Logo" src="img/logo20.png" height="175px" width="150px"/>
		</center>
		</div>
    <div class="row">
		
	
        <div class="col-md-12 center login-header">
            <h2>Potters Cottage Industrial Co-operative Society</h2>
        </div>
        <!--/span-->
    </div><!--/row-->
</br>
</br>
</br>
    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Please login with your Username and Password.
            </div>
			

            <form class="form-horizontal" action="/authenticate" method="post" id='LoginForm'>
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" placeholder="LoginName" id="LoginName" name="LoginName">
						
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Password" id="Password" name="Password">
						
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-prepend" id='response'>
                       <!-- <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>-->
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary sbmbtn">Login</button>
                     
                    </p>
                </fieldset>
            </form>
			
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- external javascript -->

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
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

<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

$('.sbmbtn').on('click', function (e) {
	//alert('hi');
	$("#LoginForm").validate({
		rules:{
			LoginName:"required",
			Password:"required",
		}
	});
	
	if($("#LoginForm").valid())
	{
        e.preventDefault();
        var LoginName = $('#LoginName').val();
        var Password = $('#Password').val();
        $.ajax({
            type: "post",
            url: '/authenticate',
            data: {LoginName: LoginName, Password: Password},
            error: function( data ) {
				 $.each(data, function( index, value ) {
					 if(value.msg)
                $("#response").html("<div class='alert alert-danger'>"+value.msg+"</div>");
			else if(value.home)
				 window.location.href = value.home;
				 });
            }
            
        });
	}
});
	
	




</script>



</body>
</html>
