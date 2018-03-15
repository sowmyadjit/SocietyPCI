<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>


<div id="content<?php echo $data['module']->Mid; ?>" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box_bdy_<?php echo $data['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $data['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Add Share Divident</h2>
					<span class = "pull-right back_btn"><a href="">back</a></span>
					
					
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "createloantype",'class' => 'form-horizontal','id' => 'form_add_div','method'=>'post']) !!}
					
						<div class="form-group">
							<label class="control-label col-sm-4">Class Name:</label>
							<div class="col-sm-4">
								<select class="form-control shareclassid"  id="shareclassid" name="shareclassid" placeholder="SELECT Class">  
									<option value="">--Select Class--</option>
									@foreach($data['class'] as $row)
										<option id="{{$row->Share_ID}}" value="{{$row->Share_ID}}" data="{{$row->Share_Class}}">{{$row->Share_Class}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control hidden" id="classname" name="classname" placeholder="classname">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">START DATE</label>
							<div class="col-md-4 date">
								<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control datepicker" name="start_date" id="start_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
									<span class="input-group-addon add-on">
										<span class="glyphicon glyphicon-calendar">
										</span>
									</span> 
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">END DATE</label>
							<div class="col-md-4 date">
								<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control datepicker" name="end_date" id="end_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
									<span class="input-group-addon add-on">
										<span class="glyphicon glyphicon-calendar">
										</span>
									</span> 
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Divident Percent :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="div_percent" name="div_percent" placeholder="Divident Percent">
							</div>
						</div>
						
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm sbmt LoanTypeSbmBtn<?php echo $data['module']->Mid; ?>"/>
								</div>
							</div>
						</center>
					<!--</form>-->
					{!! Form::open() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
	$(".shareclassid").change(function() {
console.log($(this).val());
		var id = $(this).val();
console.log($("#"+id).attr("data"));
		var classname = $("#"+id).attr("data");
		$("#classname").val(classname);
	});
	
	
	$(".sbmt").click(function() {
		$.ajax({
			url: "adddivident",
			type: 'post',
			data: $("#form_add_div").serialize(),
			success: function(data) {
				alert('success');
			}
		});
	});
</script>

<script>
	$(".back_btn").click(function(e) {
		e.preventDefault();
		$.ajax({
			url:"divident",
			type:"get",
			success: function(data) {
				$("#maintest").html(data);
			}
		});
	});
</script>
