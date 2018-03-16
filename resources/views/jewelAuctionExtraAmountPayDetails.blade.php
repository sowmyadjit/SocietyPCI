<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>	
<link href="css/datepicker.css" rel='stylesheet'>

<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i>AUCTION EXTRA AMOUNT PAY</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">CUSTOEMR NAME:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="cname" name="cname" value="{{$data['cname']}}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">LOAN NO. :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lno" name="lno" value="{{$data['ln_no']}}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">EXTRA AMOUNT:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="extra_amt" name="extra_amt" value="{{$data['extra_amt']}}" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">PAYMENT DATE:</label>
						<div class="col-md-4">
							<div class="input-group input-append date " id="datePicker">
								<input type="text" class="form-control datepicker" name="pay_date" id="pay_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" VALUE="{{date('Y-m-d')}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="pay_mode" name="pay_mode" onchange="pay_mode_change();">
								<option>-----Payment Mode-----</option>
								<option value="CASH">CASH</option>
								<option value="SB">SB</option>
								<option value="CHEQUE">CHEQUE</option>
							</select>
						</div>
					</div>
					
					<div class="form-group sb">
						<label class="control-label col-sm-4">Account Number:</label>
						<div class="col-md-4">
							<input class="typeahead form-control"  id="rdaccount" type="text" name="rdaccount" placeholder="SELECT Account Number">  
						</div>
					</div>
					
					<div class="chq form-group">
							<div class="form-group">
								<label class="control-label col-sm-4">Cheque No.:</label>
								<div class="col-md-4">
									<input class="form-control"  id="cheque_no" type="text" name="cheque_no" placeholder="Cheque No.">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label">CHEQUE DATE:</label>
								<div class="input-group input-append col-md-4">
									<input type="text" name="cheque_date" id="cheque_date" class="form-control datepicker" value="{{date("Y-m-d")}}" />
									<span class="input-group-addon add-on">
										<span class="glyphicon glyphicon-calendar">
										</span>
										<b class="caret"></b>
									</span>
								</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-sm-4">Bank Account No.:</label>
								<div class="col-md-4">
									<input class="typeahead3 form-control"  id="bank_acc_no" type="text" name="bank_acc_no" placeholder="SELECT Bank Account Number">
								</div>
							</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Perticulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="per" name="per" placeholder="">
						</div>
					</div>
					
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="PAY" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
					
					
					{!! Form::close() !!}
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
	function pay_mode_change() {
			var pay_mode;
			pay_mode = $("#pay_mode").val();
			if(pay_mode == "SB") {
				$(".sb").show();
				$(".chq").hide();
			} else if(pay_mode == "CHEQUE") {
				$(".sb").hide();
				$(".chq").show();
			} else { //cash
				$(".sb").hide();
				$(".chq").hide();
			}
		}
		
		
		$('#account').change(function(e){
		accnum=$('#account').val();
		alert(accnum);
		e.preventDefault();
		$.ajax({
			url:'retriveacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				$('#cb').val(data['crbal']);
				$('#cbreadonly').val(data['crbal']);
				$('#at').val(data['actype']);
				$('#name').val(data['fname']);
				$('#acctype').val(data['acid']);
			}
		});
	});
	
	$('input.typeahead').typeahead({
		//ajax: '/Getaccnum'
		source:Getaccnum
	});
	
	$('#rdaccount').change(function(e){
		accnum=$('#rdaccount').data('value');
		e.preventDefault();
		$.ajax({
			url:'retrieverdacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				$('#rdcb').val(data['rdcrbal']);
				$('#rdcbreadonly').val(data['rdcrbal']);
				$('#rdat').val(data['rdactype']);
				$('#rdatreadonly').val(data['rdactype']);
				$('#rdname').val(data['rdfname']);
				$('#rdnamereadonly').val(data['rdfname']);
				$('#rdacctype').val(data['rdacid']);
				$('#rdacctypereadonly').val(data['rdacid']);
				$('#rdduration').val(data['rdduration']);
				$('#rddurationreadonly').val(data['rdduration']);
			}
		});
	});
	
	
	
	
	
	
	
	$(document).ready(function(){
		$(".sb").hide();
		$(".chq").hide();
		var branchid=0;
		$('.cnclbtn').click(function(e){
			var retVal = confirm("Are You Sure ?");
			if( retVal == true ){
//				$('.branchclassid').click();
				return true;
			} else {
				return false;
			}
		});
		
		$('.sbmbtn').click( function(e) {
			e.preventDefault();
			var jl_alloc_id,auc_amt,name,ln_no,st_date,end_date,gross_wt,net_wt,app_val,ln_amt,auc_amt,pay_mode,per;
			
				jl_alloc_id = "{{$data['jl_alloc_id']}}";
				cname = "{{$data['cname']}}";
				ln_no = "{{$data['ln_no']}}";
				st_date = "{{$data['st_date']}}";
				end_date = "{{$data['end_date']}}";
				gross_wt = "{{$data['gross_wt']}}";
				net_wt = "{{$data['net_wt']}}";
				ln_amt = "{{$data['ln_amt']}}";
				auc_amt = "{{$data['auc_amt']}}";
				extra_amt = $("#extra_amt").val();
				acc_no=$('#rdaccount').data('value');
				pay_mode = $("#pay_mode").val();
				bk_name = $("#bk_name").val();
				cheque_no = $("#cheque_no").val();
				cheque_date = $("#cheque_date").val();
				bank_acc_no = $("#bank_acc_no").attr("data-value");
				pay_date = $("#pay_date").val();
				per = $("#per").val();
			
			$.ajax({
				url: 'jewelAuctionExtraAmountPayDetails',
			//	type: 'post',
			//	data:  $('#form_des').serialize(),
				type: 'get',
				data:'&jl_alloc_id='+jl_alloc_id+'&cname='+cname+'&ln_no='+ln_no+'&st_date='+st_date+'&end_date='+end_date+'&gross_wt='+gross_wt+'&net_wt='+net_wt+'&ln_amt='+ln_amt+'&auc_amt='+auc_amt+'&pay_mode='+pay_mode+'&bk_name='+bk_name+'&per='+per+'&acc_no='+acc_no+'&extra_amt='+extra_amt+'&cheque_no='+cheque_no+'&cheque_date='+cheque_date+'&bank_acc_no='+bank_acc_no+'&pay_date='+pay_date,
				success: function(data) {
					alert('success');
				//	$('.branchclassid').click();
				}
			});
		});
		
		$('#HeadiD').change(function(e){
			Lid=$('#HeadiD').val();
			
			alert(Lid);
			e.preventDefault();
			
			$.ajax({
				url:'GetSubLedgerHead',
				type:'get',
				data:'&LedgerId='+Lid,
				success:function(data)
				{
					// alert("success");
					var sel = document.getElementById('expsubhead');
					for (i = sel.length - 1; i >= 0; i--) {
						sel.remove(i);
					}
					$("#expsubhead").append("<option value=\"ALL\">SELECT</option>");
					var jsonData = JSON.parse(data);
					for (var i = 0; i < jsonData.length; i++) {
						var prop = jsonData[i];
						$("#expsubhead").append("<option value=\"" + prop.lid +"\">"+ prop.lname +"</option>");
					}
					
				}
			});
		});
	});
</script>

<script>
	
	$('input.typeahead3').typeahead({
		//ajax:'/Getbranchname'
		source:GetBank
	});
</script>