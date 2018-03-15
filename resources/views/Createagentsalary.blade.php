
<!-------------------------------- sal extra ------------->

				<?php 
				
				foreach($sal['sal_extra_list'] as $row) {
						switch($row->sal_extra_name) {
							case "TDS":$tds_extra_sal_id = $row->sal_extra_id; break;
							case "SD":$sd_extra_sal_id = $row->sal_extra_id; break;
							case "Amount to deduct from commission":$com_ded_extra_sal_id = $row->sal_extra_id; break;
						}
					}
				
				?>

<!-------------------------------- sal extra ------------->


<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<div id="content" class="col-md-10">
	<!-- content starts -->
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create New Bank</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_addbank','method'=>'post']) !!}
					
					<div class="form-group">
						<div class="col-sm-4">  
							<label class="control-label">DATE RANGE:
								
								<div id="reportrange"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</label>
							
							
						</div>
					</div>
					
						<div class="form-group">
						<label class="control-label col-sm-4">Agent Name:</label>
						<div class="col-md-4">
							<input class="typeahead1 form-control ptagnt"  id="ptagnt" name="ptagnt" placeholder="SELECT AGENT NAME" >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total amount collected</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="totalamt" name="totalamt" >  
							<input class="form-control"  type="text" id="totalamtdis" name="totalamtsid" disabledddd >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Amount to deduct from commission</label>
						<div class="col-sm-4">
							<input class="form-control "  type="text" id="deductcom" name="deductcom" onchange="calculation_amt();calc_com();">
						</div>
						<div class='col-md-4'>
							<input type='text' class='form-control' id='deductcom_part' name='' placeholder='Particulars'>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Calculation Amount</label>
						<div class="col-sm-4">
							<input class="form-control "  type="text" id="ca" name="ca" onchange="calc_com();">  
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Commission</label>
						<div class="col-sm-2">
							<input class="form-control"  type="text" id="com_val" name="com_val" placeholder="Commission Rs." >  Rs.
						</div>
						<div class="col-sm-2">
							<input class="form-control"  type="text" id="com_per" name="com_per" onchange="calc_com();" placeholder="Commission %">  %
						</div>
					</div>
					
		<?php /*		
					<div class="form-group">
						<label class="control-label col-sm-4">Commission</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="comm" name="comm" >  
							<input class="form-control"  type="text" id="commdis" name="commdis" >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Commission persentage</label>
						<div class="col-md-4">
							<input class="form-control"  type="text" id="cp" name="cp" >  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">TDS</label>
						<div class="col-md-4">
							<input class="form-control"  type="text" id="tds" name="tds" >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">TDS</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="tdsval" name="tdsval" >  
							<input class="form-control"  type="text" id="tdsvaldis" name="tdsvaldis"disabled >  
						</div>
					</div>*/ ?>
					
					
					
				
<!--------------------edit------------------->

						<div class="form-group" id="extra_sal_box">
						</div>
						<div class=' col-sm-12'>
							<center>
								<input id="add_extra_sal"  type="button" value="Additions" class="form-group btn btn-success btn-sm " />
							</center>
						</div>
							<input id="zzz" class="hidden" type="button" value="Extra" />
						

<!--------------------edit end----------------->
					
					
					
					
					
					
					
					
					
					
					<!--personal loan SECTION STARTS HERE-->
					<div class="personal_loan">
						
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">PL Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="PLAccNumTypeAhead form-control"  type="text" placeholder="SELECT PL ACCOUNT NUMBER" id="PLAccNum">  
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plcustname" name="plcustname" placeholder="CUSTOMER NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plremamt" name="plremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plintamt" name="plintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">EMI Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plemi" name="plemi" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						
						
						<input type="button" value="Add charages" class="btn btn-success btn-sm pdladdcharg"/>
						<div class="form-group" id="pdlcharge">
						</div>
						
						<div class="form-group" >
							<label class="control-label col-sm-4">DONT PAY LOAN AMT :</label>
							<div class="col-md-8">
								<input type="checkbox" id="dp" name="dp" style="margin-top: 11px;">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">pay</label>
							<div class="col-sm-4">
								<input class="form-control "  type="text" id="pay" name="pay" >  
								
							</div>
						</div>
						
					</div>
					
					
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="AgentPayMode" name="AgentPayMode">
								<option value="">--Select Payment Mode--</option>
								<option value="CASH">CASH</option>
								
								<option value="SB ACCOUNT">SB ACCOUNT</option>
							</select>
						</div>
					</div>
					
					<div class="sb">
						<div class="form-group sbaccjl">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAhead form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumjl">  
							</div>
						</div>
						
						<div class="form-group jlsbaccnumb">
							<label class="control-label col-sm-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="SBAccountNumdis" name="SBAccountNumdis" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="SBAccountNum" name="SBAccountNum" >
						
						<div class="form-group jlsbavailable">
							<label class="control-label col-sm-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="SBAvailamt" name="SBAvailamt" disabled>
								<input type="text" class="form-control hidden" id="SBAvailhidn" name="SBAvailhidn">
							</div>
						</div>
					</div>
					
					
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="RESET" class="btn btn-info btn-sm resetbtn"/>
							</div>
						</div>
					</center>
					<!--</form>-->
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/sidebar/sidebar.js"></script>
<script src="js/bootstrap-typeahead.js"></script>

<script>
	$('#SecurityDepositNeeded').change(function() {
//			alert("changed");
			deductcom1();
		}
	);
	
	
	
	/*
	function deductcom1()
	{
		$cp=$('#cp').val();
		$tds=$('#tds').val();
		$totcol=$('#totalamt').val();
		$deductcom=$('#deductcom').val();
		
		if($('#SecurityDepositNeeded').prop('checked')) {
			SecurityDepositNeeded = "YES";
		} else {
			SecurityDepositNeeded = "NO";
		}
		$tot=(parseInt($totcol))-(parseInt($deductcom));
		$('#ca').val($tot);
		
		$.ajax({
			url:'getagentsalary_1',
			type:'get',
			data:'&amount='+$tot+'&cp='+$cp+'&tds='+$tds+'&SecurityDepositNeeded='+SecurityDepositNeeded,
			success:function(data)
			{
//				alert(data['secutitydeposit']);
				$('#commdis').val(data['interest']);
				$('#comm').val(data['interest']);
				$('#tdsval').val(data['tds']);
				$('#tdsvaldis').val(data['tds']);
				$('#sdpodis').val(data['secutitydeposit']);
				$('#sdpo').val(data['secutitydeposit']);
			}
		});
	}
	*/
	
	$('.sb').hide();
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			$('.bankclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.resetbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			
			return true;
		}
		else{
			return false;
		}
		
	});
	
	
	$('input.typeahead1').typeahead({
		ajax: '/getAllocateagentlist'
	});
	
</script>

<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var $stdate=sdate;
	var edate;
	var $endate=edate;
	$(function() {
		
		function cb(start, end) {
			
			$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			//sdate=start.format('DD/MM/YYYY');
			//edate=end.format('DD/MM/YYYY');
			//alert(sdate);
			//alert(edate);
			//alert(moment());
			
		}
		cb(moment(), moment());
		
		
		$('#reportrange').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY',
				
			},
			"showDropdowns": true,
			"opens": "right",
			
			"autoApply": true,
			
			
		}, cb);
		
	});
	
	$('#ptagnt').change(function(e)
	{
		AN=$('#ptagnt').data('value');
		cp=$('#cp').val();
		tds=$('#tds').val();
		e.preventDefault();
		$.ajax({
			url:'getagentsalary',
			type:'get',
			data:'&startdate='+sdate+'&enddate='+edate+'&Auid='+AN+'&cp='+cp+'&tds='+tds,
			success:function(data)
			{
				
				$('#totalamt').val(data['amount']);
				
				$('#totalamtdis').val(data['amount']);
				
				/*	$('#commdis').val(data['interest']);
					$('#comm').val(data['interest']);
					$('#tdsval').val(data['tds']);
					$('#tdsvaldis').val(data['tds']);
					$('#sdpodis').val(data['secutitydeposit']);
				$('#sdpo').val(data['secutitydeposit']);*/
				
				
			}
		});
		
	});
	x=0;
	salindex=0;
	$('.sbmbtn').click( function(e) {
		if(salindex==0)
		{
			a=$('#pay').val();
			if(a=="")
			{
		alert("select weather to deduct loan amount or not");
			}
			{
			
			if(x>0)
				{
					charges;
					amount;
				}
				else
				{
					charges="";
					amount="";
					
				}
				salindex++;
				auid=$('#ptagnt').data('value');
				AccNum=$('.SBAccNumTypeAhead').data('value');
				loannum=$('.PLAccNumTypeAhead').data('value');
				pmode=$('#AgentPayMode').val();
				e.preventDefault();
				
				
				
	/********edit******/
				
				
				var sal_extra = "";
				sal_extra = get_sal_extra_all();
				
				var deductcom = $('#deductcom').val();
				var deductcom_part = $('#deductcom_part').val();
				
				if(isNaN(deductcom)) {
					deductcom = 0;
				}
				sal_extra += "|" + {{$com_ded_extra_sal_id}} + "#" + deductcom + "#" + deductcom_part;
				alert(sal_extra);
				
				
				var tds_box_no = tds_id.substr(1);
				var tds_value = $('#er'+tds_box_no).val();
				if(isNaN(tds_value)) {
					tds_value = 0;
				}
				
				var sd_box_no = sd_id.substr(1);
				var sd_value = $('#er'+sd_box_no).val();
				if(isNaN(sd_value)) {
					sd_value = 0;
				}
				
	/********edit******/
				
				
				$.ajax({
					
					url: 'payagentcommision',
					type: 'post',
					data: $('#form_addbank').serialize() + '&aguid='+auid+'&sbAcNo='+AccNum+'&pmode='+pmode+'&loannum='+loannum+'&noloan='+noloan+'&charges='+charges+'&amount='+amount+'&loopid='+x+'&tds_value='+tds_value+'&sd_value='+sd_value+'&sal_extra_all='+sal_extra,
					success: function(data) {
						alert('success');
						// $('.fdallocclassid').click();
						//window.location.reload(true);
					}
				});
			}
		}
	});
	
	$('#AgentPayMode').change(function(e)
	{
	
	pmode=$('#AgentPayMode').val();
	if(pmode=="CASH")
	{
		$('.sb').hide();
		
	}
	else if(pmode=="SB ACCOUNT")
	{
		$('.sb').show();
		
		$('.SBAccNumTypeAhead').change(function(e)
		{
			AccNum=$('.SBAccNumTypeAhead').data('value');
			$.ajax({
				url:'/DLRepayGetSBDetails',
				type:'post',
				data:'&sbAcNo='+AccNum,
				success:function(data)
				
				{
					
					$('#SBAccountNumdis').val(data['acnum']);
					$('#SBAccountNum').val(data['acnum']);
					
					$('#SBAvailamt').val(data['totamt']);
					$('#SBAvailhidn').val(data['totamt']);
				}
			});
		});
	}
	
	});	
	$('.SBAccNumTypeAhead').typeahead({
		ajax:'/SBdlacc'
	});
	$('.PLAccNumTypeAhead').change(function(e)
	{
		
		
		
		
		placcid=$('.PLAccNumTypeAhead').data('value');
		
		$.ajax({
			url:'/GetplDetail',
			type:'post',
			data:'&plAlcID='+placcid,
			success:function(data)
			{
				
				$('#plremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#plcustname').val(fullname);
				$('#plStdate').val(data['StDte']);
				emi=data['emi'];
				//emi=+emi.toFixed(2);
				//$('#plemi').val(data['emi']);
				$('#plemi').val(emi);
				//sdate=$('#plStdate').val();
				//bal=$('#plremamt').val();
				sdate=data['StDte'];
				bal=data['reamt'];
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate,
					success:function(data)
					{
						
						alert(data);
						daydiff=data;
						if(daydiff>90)
						{
							inerest=19/100;
						}
						else
						{
							
							inerest=16/100;
						}
						
						days=daydiff/365;
						
						//bal=round($bal,2);
						totbal=days*inerest*bal;
						totbal=Math.round(totbal);
						bal=Math.round(bal);
						//totbal=+totbal.toFixed(2);
						//totbal=round($totbal1,2);
						$('#plintamt').val(totbal);
						//totamt=(parseFloat(totbal)+parseFloat(bal));
						//totamt=round($totamt1,2);
						
						//alert(bal+" "+totbal+" "+totamt);
						$('#plremtotamt').val(totbal);
						$('#balamt').val(bal);
						
						
					}
				});
				
				
				
			}
		});
		
		
		
		
	});
	$('.PLAccNumTypeAhead').typeahead({
		ajax:'/getplacc'
	});
	
	
	$('#dp').click(function(e){
		if($('#dp').is(":checked"))
		{
			paysal=$('#com_val').val();
			$('#pay').val(paysal);
			noloan="YES";
		}
		else{
			comm=$('#com_val').val();
			plemi=$('#plemi').val();
			plintamt=$('#plintamt').val();
			
			temp="";
			temp1="";
			sum=0;
			for(i=1;i<xpdl;i++)
			{
				amt=$('#BranchListDDpdl'+i).val();
				amt1=$('#xtr_chargpdl'+i).val();
				sum=parseInt(sum)+parseInt(amt1);
				if(i < xpdl-1){
					temp+=amt+",";
					temp1+=amt1+",";
					}else{
					temp+=amt;
					temp1+=amt1;
				}
			}
			
			x=xpdl;
			charges=temp;
			amount=temp1;
			loalpayamt=parseFloat(plemi)+parseInt(sum)+parseInt(plintamt);
			a=(parseFloat(comm)-loalpayamt);
			a=Math.round(a);
			$('#pay').val(a);
			noloan="NO";
		}
	});
	
	xpdl=1;
	var drop_val="<?php foreach($sal['drop'] as $key){
		echo "<option >-------------</option>";
		echo "<option value='".$key->charges_id."' >" .$key->charges_name."";
		echo "</option>";
	}?>";
	
	var htmltextpdl="";
	$('.pdladdcharg').click(function(e){
		
		
		htmltextpdl='<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltextpdl+='<select class="form-control xtr_drop"  id="BranchListDDpdl'+xpdl+'" name="BranchListDDpdl'+xpdl+'" >'+drop_val+'</select>';  
		htmltextpdl+='<input type="text" class="form-control xtr_charg" id="xtr_chargpdl'+xpdl+'">';
		htmltextpdl+="</label></span>";
		
		xpdl=xpdl+1;
		
		
		
		
		$("#pdlcharge").append(htmltextpdl);
		//append
	});
</script>

<script>
	
	var extra_no=-1;
	$('#add_extra_sal').click(function() {
	box_count++;
	
	
	
	
	
	
	
	
			var part_html="",extra_id='';
			extra_no++;
			extra_id = 'e'+extra_no;
			extra_value_id = 'v'+extra_no;
			extra_rs_id = 'er'+extra_no;
			extra_per_id = 'ep'+extra_no;
			extra_pert_id = 'ept'+extra_no;
			extra_ckbox_name = 'name=n'+extra_no;
			sel_onchange = "select_tag_change("+extra_value_id+");";
			part_html = `
							<div class='form-group extra_salary' id=`+extra_id+`>
								<label class='control-label col-sm-4 hidden'>
									<div class='col-md-1'>
										<input type='checkbox' class='' id='' name='' checked disabled >
									</div>Extra:
								</label>
								<div class='col-md-2'>
								</div>
								<div class='col-md-2 ex_name'>
									<select class='form-control' id=`+extra_value_id+` name='' data=`+extra_rs_id+` onchange=`+sel_onchange+`>
										<option class='form-control' id='' value=''>---------select--------</option>
										<?php
											foreach($sal['sal_extra_list'] as $row) {
										?>
												<option class='form-control' id=`+extra_value_id+` value='{{$row->sal_extra_id}}'>
													{{$row->sal_extra_display_name}}
												</option>
										<?php
											}
										?>
									</select>
								</div>
								<div class='col-md-2 ex_val'>
									<input type='text' class='form-control' id=`+extra_rs_id+` name='' onchangeeee='calc_com();' >Rs.
								</div>
								<div class='col-md-2 ex_per'>
									<input type='text' class='form-control' id=`+extra_per_id+` name='' onchange='calc_com();' >%
								</div>
								<div class='col-md-4 ex_pert'>
									<input type='text' class='form-control' id=`+extra_pert_id+` name='' placeholder='Particulars'>
								</div>
							</div>
						`;
						
						
			$("#extra_sal_box").append(part_html);
		}
	);

</script>


<script>
	var sd_id = "";
	var tds_id = "";
	var box_count =0;
	function calc_com()
	{
		var calc_amt = parseFloat($('#ca').val());
		if(isNaN(calc_amt)) {
			calc_amt = 0;
		}
		$('#ca').val(calc_amt);
		
		
		var com_per = parseFloat($('#com_per').val());
		if(isNaN(com_per) || com_per==''){
			com_per=0;
		}
		$('#com_per').val(com_per);
		//alert(calc_amt);
		var com_val = 0;
		com_val = calc_amt * (com_per / 100);
		
		
		
		
		var tds_box_no = tds_id.substr(1);
		var tds_per = parseFloat($('#ep'+tds_box_no).val());
		if(isNaN(tds_per)) {	tds_per = 0;	}
		$('#ep'+tds_box_no).val(tds_per);
		var tds_val = com_val * (tds_per/ 100);
		if(isNaN(tds_val)) {
			tds_val = 0;
		}
		$('#er'+tds_box_no).val(tds_val);
		
		
		
		
		var sd_box_no = sd_id.substr(1);
		var sd_per = parseFloat($('#ep'+sd_box_no).val());
		if(isNaN(sd_per)) {	sd_per = 0;	}
		$('#ep'+sd_box_no).val(sd_per);
		var sd_val = com_val * (sd_per/ 100);
		$('#er'+sd_box_no).val(sd_val);
		if(isNaN(sd_val)) {
			sd_val = 0;
		}
		$('#er'+sd_box_no).val(sd_val);
		
		
		//alert('tds_box_no = '+tds_box_no+'\nsd_box_no = '+sd_box_no);
		//alert("tds_per = "+tds_per+"\nsd_per = "+sd_per);
		com_val = com_val - tds_val - sd_val;
		
		//alert('com_val='+com_val);
		if(isNaN(com_val)) {
			com_val = 0;
		}
		$('#com_val').val(com_val);
		
		
		extra_ded();
	}
	
	function select_tag_change(select_obj)
	{
	//	var extra_id,extra_rs_id;
		
	//	extra_id = select_obj.value;
	//	extra_rs_id = select_obj.getAttribute('data');
		var sel_id = select_obj.getAttribute('id');
		
		if(sel_id == tds_id) {
			tds_id = "";
			//alert("tds_id = "+tds_id);
		} else if(sel_id == sd_id) {
			sd_id = "";
			//alert("sd_id = "+sd_id);
		}
		
		
		var sel_val = $('#'+sel_id).val();
		if(sel_val == {{$tds_extra_sal_id}}) {
			tds_id = sel_id;
			//alert("tds_id = "+tds_id);
		} else if(sel_val == {{$sd_extra_sal_id}}) {
			sd_id = sel_id;
			//alert("sd_id = "+sd_id);
		} /*else {
			var data = $('#'+sel_id).attr('data');
			alert('sel data = ' + data);
		}*/
		
		
		calc_com();
		
	}
	
	
</script>

<script>
	function calculation_amt()
	{
		var col_amt = parseFloat($('#totalamtdis').val());
		var ded_amt = parseFloat($('#deductcom').val());
		var calc_amt = col_amt-ded_amt;
		$('#ca').val(calc_amt);
		//alert("ded_amt = "+ded_amt);
	}
</script>

<script>
	function extra_ded()
	{
		var i = 0;
		var temp_data;
		var temp_amt;
		var temp_sum = 0;
		var sel_id = "";
		for(i=0; i<box_count;i++) {
			sel_id = "v"+i;
			if(sel_id == tds_id) {
				console.log("skip tds");
				continue;
			} else if(sel_id == sd_id) {
				console.log("skip sd");
				continue;
			}
			
			temp_data = $('#v'+i).attr('data');
			temp_amt = parseFloat($("#"+temp_data).val());
			if(isNaN(temp_amt)) {
				temp_amt = 0
			}
			$("#"+temp_data).val(temp_amt);
			console.log(temp_data + " = "+temp_amt);
			temp_sum += temp_amt;
			
		}
		var com_val = parseFloat($("#com_val").val()) - temp_sum;
		if(isNaN(com_val)) {
			com_val = 0;
		}
		$("#com_val").val(Math.round(com_val,1));
		
		return;
	}
</script>


<script>
	
	
	function get_sal_extra_all() {
		var aaa="";
		var ex_name = new Array();
		var ex_val = new Array();
		var ex_part = new Array();
		var i=0,n=0;
		
		$('#extra_sal_box > .extra_salary > .ex_name > select').each(function () {
			if($(this).val()=="") {
				ex_name[i++] = '-';
			} else {
				ex_name[i++] = $(this).val();
			}
		});
		
		i=0;
		$('#extra_sal_box > .extra_salary > .ex_val > input').each(function () {
			if(isNaN($(this).val()) || $(this).val()=="" ) {
				ex_val[i++] = 0;
			} else {
				ex_val[i++] = $(this).val();
			}
		//	n=i-1;
		});
		
		i=0;
		$('#extra_sal_box > .extra_salary > .ex_pert > input').each(function () {
			if($(this).val()=="" ) {
				ex_part[i++] = "-";
			} else {
				ex_part[i++] = $(this).val();
			}
			n=i-1;
		});
		
		for(i=0;i<=n;i++) {
			if(i==0){
				sal_extra_all = ex_name[i]+ "#" +ex_val[i]+ "#" +ex_part[i];
			} else {
				sal_extra_all = sal_extra_all + "|" +	ex_name[i]+ "#" +ex_val[i]+ "#" +ex_part[i];
			}
		}
		
		alert(sal_extra_all);
		return sal_extra_all;
	}
</script>

