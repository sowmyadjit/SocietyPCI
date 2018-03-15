<script src="js/jquery.validate.min.js"></script>
		<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>
			</div>
        </noscript>

<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
           <!-- <div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a class="clickme" >Transaction</a>
					</li>
				</ul>
			</div>-->
			
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
		
				<!--<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> SALARY</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>-->
				
			{!! Form::open(['url' => "createsalary",'class' => 'form-horizontal','id' => 'form_sal','method'=>'post']) !!}	
				
				<div class="form-group">
							<label class="control-label col-sm-4">EMPLOYEE NAME:</label>
							<div class="col-md-8">
								<input class="typeahead form-control" placeholder="SELECT EMPLOYEE" id='typahd'>
							</div>
						</div>

				</form>
				<div id="lddt"></div>
				</div>
				</div>
				</div>
				</div>
				
				

<script src="js/bootstrap-typeahead.js"></script>
<script>
  $('.cnclbtn').click(function(e)
{
	alert('are you sure?');
	$('.salclassid').click();
	
});

$('.sbmbtn').click( function(e) {
	
	
	 emp=$('.typeahead1').data('value');
	 emp1=emp;
	e.preventDefault();
    $.ajax({
		
        url: 'createsalary',
        type: 'post',
        data: $('#form_sal').serialize() + '&emp1=' + emp ,
        success: function(data) {
                   $('.salclassid').click();
				  
                 }
    });
});
</script>
<script>

$('input.typeahead').typeahead({
      ajax: '/GetSalary'
});

$('#typahd').change(function(){
var emp = $('.typeahead').data('value');
$.ajax({
		
        url: 'getsal',
        type: 'post',
        data: '&emp1=' + emp ,
        success: function(data) {
                   $('#lddt').html(data);
				  
                 }
    });
});

</script>

