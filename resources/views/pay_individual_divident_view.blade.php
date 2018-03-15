<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>
<script src="js/bootstrap-typeahead.js"></script>


				
				<div class="box-content">
					
					{!! Form::open(['url' => "createloantype",'class' => 'form-horizontal','id' => 'form','method'=>'post']) !!}
					
						
						<div class="form-group">
							<label class="control-label col-sm-4">Member No. :</label>
							<div class="col-md-4">
								<input type="text" class="form-control hide" id="member_id" name="member_id" value="{{$data["member_id"]}}" disabled />
								<input type="text" class="form-control" id="member_no" name="member_no" value="{{$data["member_no"]}}" disabled />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Member Name. :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="name" name="name" value="{{$data["name"]}}" disabled />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">DATE</label>
							<div class="col-md-4 date">
								<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control datepicker" name="date" id="date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}" disabled />
									<span class="input-group-addon add-on">
										<span class="glyphicon glyphicon-calendar">
										</span>
									</span> 
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Divident Amount :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="div_amt" name="div_amt" placeholder="Divident Amount" value="{{$data["div_amt"]}}" disabled />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Pay Amount :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pay_amt" name="pay_amt" placeholder="Pay Amount" value="{{$data["pay_amt"]}}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode :</label>
							<div class="col-md-4">
								<select class="form-control col-sm-12" id="payment_mode" name="payment_mode">
									<option value="none">----- Select Pay Mode -----</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
								</select>
							</div>
						</div>
						
						<div id="cheque">
							<div class="form-group">
								<label class="control-label col-sm-4">Cheque No. :</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chq_no" name="chq_no"  />
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-4 control-label">Cheque Date :	</label>
								<div class="col-md-4 date">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control datepicker" name="chq_date" id="chq_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" />
										<span class="input-group-addon add-on">
											<span class="glyphicon glyphicon-calendar">
											</span>
										</span> 
									</div>
								</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-sm-4">Bank Name :</label>
								<div class="col-md-4">
									<input type="text" class="typeaheadbank form-control" id="bank_name" name="bank_name" placeholder="bank_name" />
								</div>
							</div>
						</div>
						
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-danger btn-sm  " id="pay_single"   />
								</div>
							</div>
						</center>
					<!--</form>-->
					{!! Form::open() !!}
				</div>

<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
	$("#cheque").hide();
	
	
	$("#payment_mode").change(function() {
		var select_val = $("#payment_mode").val();
		if(select_val == "CASH") {
			$("#cheque").hide();
		} else if(select_val == "CHEQUE") {
			$("#cheque").show();
		}
	});
	
	
	$('input.typeaheadbank').typeahead({
		//ajax: '/GetBank'
		source:GetBank
	});
	
	
</script>

<script>
	$("#pay_single").click(function() {
		
		var member_id = $("#member_id").val();
		var member_no = $("#member_no").val();
		var name = $("#name").val();
		var date = $("#date").val();
		var div_amt = $("#div_amt").val();
		var pay_amt = $("#pay_amt").val();
		var payment_mode = $("#payment_mode").val();
		var chq_no = $("#chq_no").val();
		var chq_date = $("#chq_date").val();
		var bank_name = $("#bank_name").val();
		var bank_id = $("#bank_name").attr("data-value");
		
		
		
		$.ajax({
			url:"pay_individual_divident",
			type:"post",
			data: "&member_id="+member_id
					+"&member_no="+member_no
					+"&name="+name
					+"&date="+date
					+"&div_amt="+div_amt
					+"&pay_amt="+pay_amt
					+"&payment_mode="+payment_mode
					+"&chq_no="+chq_no
					+"&chq_date="+chq_date
					+"&bank_name="+bank_name
					+"&bank_id="+bank_id,
					
			success: function(data) {
				alert("success");
				console.log("success");
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
