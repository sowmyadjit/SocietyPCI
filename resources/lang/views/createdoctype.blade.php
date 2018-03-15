<script src="js/jquery.validate.min.js"></script>
<div id="content" class="col-md-12">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> CREATE DOCUMENT TYPE</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				{!! Form::open(['url' => 'doccreate','class' => 'form-horizontal','id' => 'form_doc','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4">Document Type:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="docname" name="docname" placeholder="DOCUMENT TYPE">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4">Description:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="desc" name="desc" placeholder="DESCRIPTION">
					</div>
				</div>

        		
				<center>
    
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="Upload" class="btn btn-info btn-sm sbmbtn"/>
							<input type="button" value="cancel" class="btn btn-info btn-sm cnclbtn"/>
						</div>
					</div>
				</center>
				
				{!! Form::close() !!}
				
				</div>
				</div>
			</div>
		</div>
</div>


<script src="js/bootstrap-typeahead.js"></script>

<script>
  $('.cnclbtn').click(function(e)
{
	alert('are you sure?');
	$('.docclassid').click();
	//alert(a);
});
$('.sbmbtn').click( function(e) {
$("#form_doc").validate({
rules:
{
docname:"required",
desc:"required"
}
});
	if($("#form_doc").valid())
	{
	e.preventDefault();
    $.ajax({
		
        url: 'insertdoc',
        type: 'post',
        data: $('#form_doc').serialize() ,
        success: function(data) {
			//alert('success');
                   $('.docclassid').click();
				  
                 }
    });
	}
});
</script>