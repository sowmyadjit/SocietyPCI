<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>

<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> AUCTION PAY</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">AUCTION DATE:</label>
						<div class="col-md-4">
							<div class="input-group input-append date auc_date" id="datePicker">
								<input type="text" class="form-control datepicker" name="pdate" id="pdate"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" VALUE="{{date('Y-m-d')}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
					</div>
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
						<label class="control-label col-sm-4" for="comment">BUYER NAME:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bname" name="bname" value="" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">AUCTION AMOUNT:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="auc_amt" name="auc_amt" value="{{$data['auc_amt']}}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="pay_mode" name="pay_mode" onchange="pay_mode_change();">
								<option>-----Payment Mode-----</option>
								<option value="CASH">CASH</option>
						<?php /*<option value="SB">SB</option>*/?>
								<option value="CHEQUE">CHEQUE</option>
							</select>
						</div>
					</div>
					<div class="form-group hide">
						<label class="control-label col-sm-4" for="comment">BANK NAME:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bk_name" name="bk_name" value="" />
						</div>
					</div>
					<div class="form-group buyer_sb">
						<label class="control-label col-sm-4">Account Number:</label>
						<div class="col-md-4">
							<input class="typeahead form-control"  id="rdaccount" type="text" name="rdaccount" placeholder="SELECT Account Number">  
						</div>
					</div>


					<div class="form-group buyer_cheque">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="chequeno" name="chequeno" placeholder="CHEQUE NUMBER">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Cheque Date</label>
							<div class="col-md-4">
								<div class="input-group input-append date auc_date" id="datePicker">
									<input type="text" class="form-control datepicker" name="cheque_date" id="cheque_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" VALUE="{{date('Y-m-d')}}"/>
									<span class="input-group-addon add-on">
										<span class="glyphicon glyphicon-calendar">
										</span>
									</span> 
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Bank Name:</label>
							<div id="the-basics" class="col-sm-4">
								<input class="typeaheadbank form-control"  type="text" id="cheque_bank_id" placeholder="SELECT Bank"  >  
							</div>
						</div>
					</div>







					<div class="form-group">
						<label class="control-label col-sm-4"> TO BRANCH:</label>
						<div class="col-md-4">
							<select class="form-control BranchList2"  id="BranchList2" name="BranchList2" >  
								
								<?php foreach($data['branch_data'] as $key){
									echo "<option value='".$key->Bid."' >" .$key->BName."";
									echo "</option>";
								}?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="pay_type" name="pay_type">
								<option>-----Payment Type-----</option>
								<option>CASH</option>
								<option>Adjust TO Branch</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">HEAD:	</label>
						<div class="col-md-4">
							<select class="form-control HeadListDD"  id="HeadiD" name="HeadiD">  
								<option value="">--Select Head--</option>
								<?php foreach($data['led'] as $key){
									echo "<option value='".$key->lid."' >" .$key->lname."";
									echo "</option>";
								}?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Sub Head:</label>
						<div class="col-md-4">
							<select class="form-control" id="expsubhead" name="expsubhead">
								<option></option>
							</select>
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
	$('input.typeaheadbank').typeahead({
		//ajax: '/GetBank'
		source:GetBank
	});
</script>

<script>
	function pay_mode_change() {
			var pay_mode;
			pay_mode = $("#pay_mode").val();
			if(pay_mode == "SB") {
				$(".buyer_cheque").hide();
				$(".buyer_sb").show();
			} else if(pay_mode == "CHEQUE") {
				$(".buyer_sb").hide();
				$(".buyer_cheque").show();
			} else {
				$(".buyer_sb").hide();
				$(".buyer_cheque").hide();
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
		$(".buyer_sb").hide();
		$(".buyer_cheque").hide();
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
		
		var submit_count = 0;
		$('.sbmbtn').click( function(e) {
	//		e.preventDefault();
	//		var acc,auc_amt,name,ln_no,st_date,end_date,gross_wt,net_wt,app_val,ln_amt,rem_amt,auc_amt,pay_mode;
			
				jl_alloc_id = {{$data['jl_alloc_id']}};
				cname = "{{$data['cname']}}";
				bname =  $("#bname").val();
				ln_no = "{{$data['ln_no']}}";
				st_date = "{{$data['st_date']}}";
				end_date = "{{$data['end_date']}}";
				gross_wt = "{{$data['gross_wt']}}";
				net_wt = "{{$data['net_wt']}}";
				app_val = "{{$data['app_val']}}";
				ln_amt = "{{$data['ln_amt']}}";
				rem_amt = "{{$data['rem_amt']}}";
				rem_int = "{{$data['rem_int']}}";
				charges = "{{$data['charges']}}";
				auc_amt = "{{$data['auc_amt']}}";
				bid2 = $("#BranchList2").val();
				pay_mode = $("#pay_mode").val();
				chequeno = $("#chequeno").val();
				cheque_date = $("#cheque_date").val();
				cheque_bank_id = $("#cheque_bank_id").attr("data-value");
				pay_type = $("#pay_type").val();
				buyer_acc_no = $("#rdaccount").val();
				bk_name = $("#bk_name").val();
				by_ac_no = $("#by_ac_no").val();
				head_id = $("#HeadiD").val();
				subhead_id = $("#expsubhead").val();
				per = $("#per").val();
				auc_date = $("#pdate").val();

				if(submit_count == 0) {
					submit_count++;
					$.ajax({
						url: 'jewelAuctionPay',
					//	type: 'post',
					//	data:  $('#form_des').serialize(),
						type: 'get',
						data:'&jl_alloc_id='+jl_alloc_id+'&cname='+cname+'&bname='+bname+'&ln_no='+ln_no+'&st_date='+st_date+'&end_date='+end_date+'&gross_wt='+gross_wt+'&net_wt='+net_wt+'&ln_amt='+ln_amt+'&rem_amt='+rem_amt+'&rem_int='+rem_int+'&charges='+charges+'&auc_amt='+auc_amt+'&pay_mode='+pay_mode+'&chequeno='+chequeno+'&cheque_date='+cheque_date+'&cheque_bank_id='+cheque_bank_id+'&pay_type='+pay_type+'&bk_name='+bk_name+'&by_ac_no='+by_ac_no+'&bid2='+bid2+'&head_id='+head_id+'&subhead_id='+subhead_id+'&per='+per+'&auc_date='+auc_date+'&buyer_acc_no='+buyer_acc_no,
						success: function(data) {
							alert('success');
						//	$('.branchclassid').click();
						}
					});
				}
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