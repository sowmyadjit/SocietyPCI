<?php 
				foreach($sal['sal_r_extra_list'] as $row) {
					switch($row->sal_extra_name)
					{
						case 'Income Tax' 		: $intax_id = $row->sal_extra_id; break;
						case 'Professional Tax' : $proftax_id = $row->sal_extra_id; break;
						case 'Other Deduction' 	: $otherded_id = $row->sal_extra_id; break;
						case 'PF'				: $pf_id = $row->sal_extra_id; break;
						case 'ESI' 				: $esi_id = $row->sal_extra_id; break;
					}
				}
				
				foreach($sal['sal_rs_extra_list'] as $row){
					switch($row->sal_extra_name)
					{
						case 'Society PF' 		: $soc_pf_id = $row->sal_extra_id; break;
						case 'Society ESI' : $soc_esi_id = $row->sal_extra_id; break;
					}
					
				}
				
				$this_month_days = date('t');
				
	?>
	
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-md-12">
	<div class="row">
		<div class="box">
			<div class="box-inner">
				<!--<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>SALARY</h2>
					<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>-->
				{!! Form::open(['url' => "dlrepay",'class' => 'form-horizontal','id' => 'form_dlrepay','method'=>'post']) !!}
				
				<div class="col-md-12">
					<div class="">
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Employee Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="ename" name="ename"  value="{{ $sal['data']->FirstName }}" >
								<input type="text" class="hidden" id="eid" name="eid"  value="{{ $sal['data']->Eid }}" >
								<input type="text" class="hidden" id="uid" name="uid"  value="{{ $sal['data']->Uid }}" >
								<input type="text" class="hidden" id="bid" name="bid"  value="{{ $sal['data']->Bid }}" >
							</div>
						</div>
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Bank Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="bname" name="bname"  >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Designation:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="desig" name="desig"  value="{{ $sal['data']->DName }}" >
								<input type="text" class="hidden" id="desigid" name="desigid"  value="{{ $sal['data']->Did }}" >
							</div>
						</div>
						
			            <div class="form-group">
							<label class="control-label col-sm-4">Employee Code:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="ecode" name="ecode"  value="{{ $sal['data']->ECode }}" >
							</div>
						</div>
						
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Cheque No:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="cqno" name="cqno"  >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Basic Pay:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="bpay" name="bpay"  value="{{ $sal['data']->basicpay }}" >
							</div>
						</div>
						
						
						<input type="text" class="form-control hidden" id="spf" name="spf"  value="{{ $sal['data']->spf }}" >
						
						<input type="text" class="form-control hidden" id="sesi" name="sesi"  value="{{ $sal['data']->sesi }}" >
						
						
						
			<?php 	/*		<div class="form-group">
							<label class="control-label col-sm-4">HRA:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="hra" name="hra"  value="{{ $sal['data']->hra }}" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">CCNA:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ccna" name="ccna"  >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">OTHERS:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="oth" name="oth"  >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">TA:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ta" name="ta"  >
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Special Allowance:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="sa" name="sa"  onblur="earningcalculate();">
							</div>
						</div>*/?>
						
						<div class="form-group da1">
							<label class="control-label col-sm-4">DA:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="da1" name="da1"  onblur=>
							</div>
						</div>
						
						<div class="form-group da1">
							<label class="control-label col-sm-4">No. of Leaves:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="leave" name="leave" value="0" >
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Gross Earning:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="ge" name="ge"   >
							</div>
						</div>
						
						

<!--------------------edit------------------->

						<div class="form-group" id="extra_sal_box">
						</div>
							<center>
								<div class='form-group col-sm-12'>
										<input id="add_extra_sal"  type="button" value="Additions" class="form-group btn btn-success btn-sm " />
								</div>
							</center>
						<center>	<input id="zzz" class="hidden" type="button" value="Extra" /></center>
<!--------------------edit end----------------->

						<div class="form-group hidden">
							<label class="control-label col-sm-4">Cheque Date:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="cqdate" name="cqdate"  >
							</div>
						</div>
						
						
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Date:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="date" name="date" >
							</div>
						</div>
						
						
						
						
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Year:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="year" name="year"  >
							</div>
						</div>
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">PF:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pf" name="pf"  value="{{ $sal['data']->pf }}">
							</div>
						</div>
						<div class="form-group hidden">
							<label class="control-label col-sm-4">ESI:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="esi1" name="esi1"  value="{{ $sal['data']->esi }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Income Tax:</label>
							<div class="col-md-4">
								<input type="" class="form-control" id="it" name="it" data="13" onchange="r_calc_gd();" placeholder="Rs." >
							</div>
						</div>
						
						
						
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Professional Tax:</label>
							<div class="col-md-4">
								<input type="" class="form-control" id="pt" name="pt" onchange="r_calc_gd()" placeholder="Rs." >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">other Deduction:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="od" name="od"  onblur="r_calc_gd(); calculatededuction(); " placeholder="Rs." >
							</div>
						</div>
						
						
						
		<?php 	/*			<div class="form-group">
							<label class="control-label col-sm-4">PF:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="staffpf" name="staffpf"   >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"> Society PF:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="socpf" name="socpf"   >
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">ESI:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="esi" name="esi"   >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"> Society ESI:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="socesi" name="socesi"   >
							</div>
						</div>*/?>
						
						
						
				<div class="col-md-12">
					<div class="">
						<div class="form-group">
							<label class="control-label col-sm-4">Gross Deduction:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="gd" name="gd" onclick="r_calc_gd();" placeholder="Rs." >
							</div>
						</div>
						
						
						
					</div>
				</div>
<!--------------------edit------------------->
						<div class="form-group" id="r_extra_sal_box">
						</div>
						<div class='col-sm-12'>
							<center>
									<input id="add_r_extra_sal"  type="button" value="Deductions" class="form-group btn btn-success btn-sm " />
							</center>
						</div>
							<input id="aaa" class="hidden" type="button" value="View" /></center>
						<div class="form-group"></div>
<!--------------------edit end----------------->

<!--------------------edit------------------->
						<div class="form-group" id="rs_extra_sal_box">
						</div>
						<div class=' col-sm-12'>
							<center>
								<input id="rs_add_extra_sal"  type="button" value="Company Contribution" class="form-group btn btn-success btn-sm " />
							</center>
						</div>
							
							<input id="bbb" class="hiddennnn btn-xs" type="button" value="View" />
<!--------------------edit end----------------->
						
				</div>
				</div>
						
				
				
				
				
				<div class="col-md-12">
					<div class="">
						
						<h4>LOAN DETAILS:</h4>
						<div class="loandetails">
							<div class="form-group">
								<label class="control-label col-sm-4">LOAN NUMBER</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="ln" name="ln" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">remaining amount:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="ra" name="ra" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">EMI AMOUNT:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="ea" name="ea" >
								</div>
							</div>
							
						</div>
						<input type="text" class="form-control hidden" id="temp" name="temp" >
						
						<!--staff loan SECTION STARTS HERE-->
						<div class="staff_loan">
							<div class="col-md-6">
								<div class="row">	
									
									<div class="form-group">
										<label class="control-label col-sm-4" for="first_name">SL Account Number :</label>
										<div id="the-basics" class="col-sm-8">
											<input class="SLAccNumTypeAhead form-control"  type="text" placeholder="SELECT SL ACCOUNT NUMBER" id="SLAccNum">  
										</div>
									</div>
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4" for="comment">Employee Name:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="slcustname" name="slcustname" placeholder="EMPLOYEE NAME"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="slremamt" name="slremamt" placeholder="REMAINING AMOUNT"/>
										</div>
									</div>
									
									<div class="form-group" >
										<label class="control-label col-sm-4">DONT PAY LOAN AMT :</label>
										<div class="col-md-8">
											<input type="checkbox" id="dp" name="dp" style="margin-top: 11px;">
										</div>
									</div>
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="slintamt" name="slintamt" placeholder="INTEREST AMOUNT"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4" for="comment">EMI Amount :</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="EMI_Amount" name="EMI_Amount" placeholder="EMI Amount"/>
										</div>
									</div>
									
									
									<input type="button" value="Add charages" class="btn btn-success btn-sm pdladdcharg"/>
									<div class="form-group" id="pdlcharge">
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Net Pay:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="npay" name="npay" >
											
										</div>
									</div>
									
								</div>
								<!--staff loan ENDS HERE-->
								
								
								
							</div>
						</div>
						
						
						<input type="text" class="form-control hidden" id="totpf" name="totpf" >
						<input type="text" class="form-control hidden" id="totesi" name="totesi" >
						
						
						
					</div>
				</div>
				
				<div></div>
				<div class="form-group">
					<div class="text-center">
						<input id="btn_add" name="btn_add" type="submit" class="btn btn-primary sbmbtn" value="SUBMIT" />
						
					</div>
				</div>
			</form>
			
		</div>
	</div>
	
</div>
</div>
<script>
	$('.loandetails').hide();

</script>

<script>
		
		$('#dp').click(function(e){
			if($('#dp').is(":checked"))
			{
				$('#npay').val(netpay);
				noloan="YES";
			}
			else{
				//a=$('#ea').val();
				intt=$('#slintamt').val();
				EMI_Amount=$('#EMI_Amount').val();
				//a=intt+EMI_Amount;
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
				
				gdeduction = $('#gd').val();
				gearn=$('#ge').val();
				netpay=(parseFloat(gearn)-parseFloat(gdeduction));
				
				a=((parseFloat(intt)+parseFloat(EMI_Amount))+sum);
//alert("gern="+gearn+"\ngdeduction="+gdeduction+"\nintt="+intt+"\nEMI_Amount="+EMI_Amount+"\nsum="+sum+"\nnetpay="+netpay);
				netpay=(parseFloat(gearn)-parseFloat(gdeduction));
//alert("netpay="+netpay);
				pay=(parseFloat(netpay)-parseFloat(a));
				pay=Math.round(pay);
//				alert("a="+a +"\npay"+ pay);
				$('#npay').val(pay);
				noloan="NO";
			}
		});
		
//	}
		
</script>
<script>
	indexid=0,noloan="",charges="",amount="",x="";
	$('.sbmbtn').click( function(e) {
	e.preventDefault();
		alert("hai");
		loannum=$('.SLAccNumTypeAhead').data('value');
		
		if(indexid==0)
		{
			as=$('#npay').val();
			
			if(as=="")
			{
				alert("select wether to pay loan or not");
			}
			else
			{
				indexid++;
				
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
				
				var sal_extra="";
/********edit********************/
				var sal_extra = get_sal_extra();
/********edit end********************/
				
				
				$.ajax({
					
					url: 'salaryinsert',
					type: 'post',
					data: $('#form_dlrepay').serialize()+'&noloan='+noloan+'&loannum='+loannum+'&charges='+charges+'&amount='+amount+'&loopid='+x+'&sal_extra_all='+sal_extra,
					success: function(data) {
						alert("success");
						//$('.salclassid').click();
						
					}
				});
			}
		}
	});
	
	
	
	$('.SLAccNumTypeAhead').typeahead({
		ajax:'/getslacc'
	});
	
	
	$('.SLAccNumTypeAhead').change(function(e)
	{
	slaccid=$('.SLAccNumTypeAhead').data('value');
	
	$.ajax({
		url:'/GetslDetail',
		type:'post',
		data:'&slAlcID='+slaccid,
		success:function(data)
		{
			
			$('#slremamt').val(data['reamt']);
			fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
			$('#slcustname').val(fullname);
			$('#slStdate').val(data['StDte']);
			$('#EMI_Amount').val(data['EMI_Amount']);
			alert(data['EMI_Amount']);
			//sdate=$('#slStdate').val();
			bal=$('#slremamt').val();
			sdate=data['StDte'];
			$.ajax({
				url:'/CalcDayDiff',
				type:'post',
				data:'&dlsdate='+sdate,
				success:function(data)
				{
					daydiff=data;
					inerest=13/100;
					days=daydiff/365;
					
					
					totbal=days*inerest*bal;
					totbal=Math.round(totbal);
					$('#slintamt').val(totbal);
					totamt=(parseFloat(totbal)+parseFloat(bal));
					//alert(bal+" "+totbal+" "+totamt);
					$('#slremtotamt').val(totamt);
					
					
				}
			});
		}
	});
	
	
	
	
	});
	$('.BranchTypeAheadSL').typeahead({
		ajax:'/GetBranches'
	});
	xpdl=1;
	var drop_val="<?php foreach($sal['drop'] as $key){
		echo "<option >-------------</option>";
		echo "<option value='".$key->charges_id."' >" .$key->charges_name."";
		echo "</option>";
	}?>";
	
	var htmltextpdl="";
	$('.pdladdcharg').click(function(e){
		
		
		htmltextpdl='<span class="xtr"><label class="control-label inline col-md-4">chareges:';
		htmltextpdl+='<select class="form-control xtr_drop"  id="BranchListDDpdl'+xpdl+'" name="BranchListDDpdl'+xpdl+'" >'+drop_val+'</select>';  
		htmltextpdl+='<input type="text" class="form-control xtr_charg" id="xtr_chargpdl'+xpdl+'">';
		htmltextpdl+="</label></span>";
		
		xpdl=xpdl+1;
		
		
		
		
		$("#pdlcharge").append(htmltextpdl);
		//append
	});
	
	
/********************* fun *************************/
	function check_string(item)
	{
		if(item == null) {
			return "-";
		} else {
			return item;
		}
	}
	function check_num(item)
	{
		if(isNaN(item) || item == null) {
console.log("item = "+ "0");
			return "0";
		} else {
console.log("item = "+ item);
			return item;
		}
	}
	
	function get_sal_extra()
	{
		var sal_extra;
		sal_extra = get_sal_extra_all();
		sal_extra += "|" + get_sal_r_extra_all();
		sal_extra += "|" + get_sal_rs_extra_all();
		
		var intax = check_num($('#it').val());
		var proftax = check_num($('#pt').val());
		var otherded = check_num($('#od').val());
		
		sal_extra = sal_extra + "|" + {{$intax_id}} + "#" + intax + "#" + "Income Tax";
		sal_extra = sal_extra + "|" + {{$proftax_id}} + "#" + proftax + "#" + "Professional Tax";
		sal_extra = sal_extra + "|" + {{$otherded_id}} + "#" + otherded + "#" + "Other Deduction";
//console.clear();
console.log(sal_extra);
		return sal_extra;
	}
/********************* fun *************************/
	
/************************************ Additions *********************************/
	var extra_no=-1;
	$('#add_extra_sal').click(function() {
			var part_html="",extra_id='';
			extra_no++;
			extra_id = 'e'+extra_no;
			extra_value_id = 'id=v'+extra_no;
			extra_rs_id = 'id=er'+extra_no;
			extra_per_id = 'id=ep'+extra_no;
			extra_pert_id = 'ept'+extra_no;
			extra_ckbox_name = 'name=n'+extra_no;
			part_html = `
							<div class='form-group extra_salary' id=`+extra_id+`>
								<div class='form-control-div col-sm-1'>
									<div class='col-md-1'>
										<span type='button' class="btn btn-warning btn-xs glyphicon glyphicon-remove ck_box" id='' name='' onclick='remove("`+extra_id+`");' checked disabledddd ></span>
									</div>
								</div>
								<label class='control-label col-sm-3'>
									Addition:
								</label>
								<div class='col-md-2 ex_name'>
									<select class='form-control' id='' name='' >
										<option class='form-control' id='' value=''>---------select--------</option>
										<?php
											foreach($sal['sal_extra_list'] as $row) {
										?>
												<option class='form-control' `+extra_value_id+` value='{{$row->sal_extra_id}}'>	
													{{$row->sal_extra_display_name}}
												</option>
										<?php
											}
										?>
									</select>
								</div>
								<div class='col-md-1 ex_val'>
									<input type='text' class='form-control' `+extra_rs_id+` name='' onchange='calc_ge();' >Rs.
								</div>
								<div class='col-md-1 ex_per'>
									<input type='text' class='form-control' `+extra_per_id+` name='' onchange='calc_rs(`+extra_no+`);' >%
								</div>
								<div class='col-md-4 ex_pert'>
									<input type='text' class='form-control' id=`+extra_pert_id+` name=''  placeholder='particulars' >
								</div>
							</div>
						`;
			$("#extra_sal_box").append(part_html);
		}
	);
	
	
/*	$('#zzz').click(function() {
		get_sal_extra_all();
	});*/
	
	
	
	function get_sal_extra_all() {
			var aaa="";
			var ex_name = new Array();
			var ex_val = new Array();
			var ex_pert = new Array();
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
				n=i-1;
			});
			
			i=0;
			$('#extra_sal_box > .extra_salary > .ex_pert > input').each(function () {		// 			* ex_pert
				if($(this).val()=="" ) {
					ex_pert[i++] = "-";
				} else {
					ex_pert[i++] = $(this).val();
				}
				n=i-1;
			});
			
			for(i=0;i<=n;i++) {
			ex_pert[i] = check_string(ex_pert[i]);									//*
				if(i==0){
					sal_extra_all = ex_name[i]+ "#" +ex_val[i]+ "#" +ex_pert[i];
				} else {
					sal_extra_all = sal_extra_all + "|" +	ex_name[i]+ "#" +ex_val[i]+ "#" +ex_pert[i];
				}
			}
			
		//	alert(sal_extra_all);
			return sal_extra_all;
		}
	
	
	function calc_rs(extra_no)
	{
		var temp = $('#bpay').val();
		var per = $('#ep'+extra_no).val();
		if(isNaN(per)) {
			per = 0;
		}
		var rs = temp * per / 100;
		$('#er'+extra_no).val(rs);
		calc_ge();
	}
	
	function calc_ge()
	{
		var temp = 0,rs_sum = 0,rs=0,ge=0;
		var basic = parseInt($('#bpay').val());
		var da1 = parseInt($('#da1').val());
		
		
		var temp_ge = basic + da1;
		var days_in_month = {{$this_month_days}};
		var sal_per_day = Math.round(temp_ge / days_in_month);
		var no_of_leave = parseInt($('#leave').val());
		var leave_deduction = sal_per_day * no_of_leave;
		
		
		
		//temp = $("[id^='er']").val();
		
		$("[id^='er']").each(function(){
			rs=parseInt($(this).val());
			if(isNaN(rs)) {
				rs = 0;
			}
			rs_sum += rs;
		});
		ge = basic + da1 - leave_deduction + rs_sum;
		
		$('#ge').val(ge);
	}
	
	
</script>
	
	
<script>
	var bpay = parseFloat($('#bpay').val());
	var da1 = bpay * 0.20;
	$('#da1').val(da1);
	calc_ge();
	
	var pf_percent = {{ $sal['data']->pf }};
	var esi_percent = {{ $sal['data']->esi }};
	var society_pf_percent = {{ $sal['data']->spf }};
	var society_esi_percent = {{ $sal['data']->sesi }};
	
	var pf_value = Math.round((bpay+da1)*(parseFloat(pf_percent)/100));
	// var esi_value = Math.ceil((bpay+da1)*(parseFloat(esi_percent)/100));
	var temp_esi = (bpay+da1)*(parseFloat(esi_percent)/100);
	temp_esi = Math.round(parseFloat(temp_esi) * 100);
	temp_esi = parseFloat(temp_esi) / 100;
	var esi_value = Math.ceil(temp_esi);
	var society_pf_value = Math.round((bpay+da1)*(parseFloat(society_pf_percent)/100));
	var society_esi_value = Math.round((bpay+da1)*(parseFloat(society_esi_percent)/100));
	
	var total_pf = parseFloat(pf_value)+parseFloat(society_pf_value);
	var total_esi = parseFloat(esi_value)+parseFloat(society_esi_value);
//	$('#totpf').value(total_pf);
//	$('#totesi').value(total_esi);
	
//	alert("\npf="+pf_value+"\nscocpf="+society_pf_value+"\nesi="+esi_value+"\nsocesi="+society_esi_value);
</script>
	
	
	
	

<script>
			//deductions
var r_extra_no=-1;
	$('#add_r_extra_sal').click(function() {
			var part_html="",r_extra_id='';
			r_extra_no++;
			r_extra_id = 'r_e'+r_extra_no;
//			r_extra_value_id = 'id=r_v'+r_extra_no;
			r_extra_value_id = 'r_v'+r_extra_no;
//			temp2 = 'r_v'+r_extra_no;
//			r_extra_rs_id = 'id=r_er'+r_extra_no;
			r_extra_rs_id = 'r_er'+r_extra_no;
//			temp = 'r_er'+r_extra_no;
			r_extra_per_id = 'id=r_ep'+r_extra_no;
			r_extra_pert_id = 'r_ept'+r_extra_no;
			r_extra_ckbox_name = 'name=r_n'+r_extra_no;
			part_html = `
							<div class='form-group r_extra_salary' id=`+r_extra_id+`>
								<div class='form-control-div col-sm-1'>
									<div class='col-md-1'>
										<span type='button' class="btn btn-warning btn-xs glyphicon glyphicon-remove ck_box" id='' name='' onclick='remove("`+r_extra_id+`");' checked disabledddd ></span>
									</div>
								</div>
								<label class='control-label col-sm-3'>
									Deduction:
								</label>
								<div class='col-md-2 r_ex_name'>
									<select class='form-control' id=`+r_extra_value_id+` name='' data=`+r_extra_rs_id+`>
										<option class='form-control' id='' value=''>---------select--------</option>
										<?php
											foreach($sal['sal_r_extra_list'] as $row) {
												if($row->sal_extra_name == 'Income Tax') {
													continue;
												} elseif($row->sal_extra_name == 'Professional Tax') {
													continue;
												} elseif($row->sal_extra_name == 'Other Deduction') {
													continue;
												}
										?>
												<option class='form-control' id=`+r_extra_value_id+` value='{{$row->sal_extra_id}}' >			
													{{$row->sal_extra_display_name}}
												</option>
										<?php
											}
										?>
									</select>
								</div>
								<div class='col-md-2 r_ex_val'>
									<input type='text' class='form-control' id=`+r_extra_rs_id+` name='' onchange='r_calc_gd();' value=''>Rs.
								</div>
								<div class='col-md-1 r_ex_per hidden'>
									<input type='text' class='form-control ' `+r_extra_per_id+` name='' onchange='r_calc_rs(`+r_extra_no+`);' >%
								</div>
								<div class='col-md-4 r_ex_pert'>
									<input type='text' class='form-control' id=`+r_extra_pert_id+` name=''  placeholder='particulars'  >
								</div>
							</div>
						`;
			$("#r_extra_sal_box").append(part_html);
			
			$('#'+r_extra_value_id).change(function(){
				var data = $(this).attr('data');
				var select_val = $(this).val();
				if(select_val == {{$pf_id}}){
					$('#'+data).val(pf_value);
				}else
				if(select_val == {{$esi_id}}) {
					$('#'+data).val(esi_value);
				}
				r_calc_gd();
			});
		}
	);
	
	
	$('#aaa').click(function() {
		get_sal_r_extra_all();
	});
	
	
	function get_sal_r_extra_all() {
		var aaa="";
		var r_ex_name = new Array();
		var r_ex_val = new Array();
		var r_ex_pert = new Array();
		var i=0,n=0;
		
		$('#r_extra_sal_box > .r_extra_salary > .r_ex_name > select').each(function () {
console.log("r_ex_name = "+$(this).val());
			if($(this).val()=="") {
				r_ex_name[i++] = '-';
			} else {
				r_ex_name[i++] = $(this).val();
			}
		});
		
		i=0;
		$('#r_extra_sal_box > .r_extra_salary > .r_ex_val > input').each(function () {
console.log("r_ex_val = "+$(this).val());
			if(isNaN($(this).val()) || $(this).val()=="" ) {
				r_ex_val[i++] = 0;
			} else {
				r_ex_val[i++] = $(this).val();
			}
			n=i-1;
		});
		
		i=0;
		
		$('#r_extra_sal_box > .r_extra_salary > .r_ex_pert > input').each(function () {		// 			* r_ex_pert
console.log("r_ex_pert = "+$(this).val());
			if($(this).val()=="" ) {
				r_ex_pert[i++] = "-";
			} else {
				r_ex_pert[i++] = $(this).val();
			}
			n=i-1;
		});
		
		for(i=0;i<=n;i++) {
			r_ex_pert[i] = check_string(r_ex_pert[i]);								// *
			if(i==0){
				sal_r_extra_all = r_ex_name[i]+ "#" +r_ex_val[i]+ "#" +r_ex_pert[i];
			} else {
				sal_r_extra_all = sal_r_extra_all + "|" +	r_ex_name[i]+ "#" +r_ex_val[i]+ "#" +r_ex_pert[i];
			}
		}
		return sal_r_extra_all;
	}
	
	function r_calc_rs(extra_r_no)
	{
		var temp = $('#bpay').val();
		var per = $('#r_ep'+r_extra_no).val();
		if(isNaN(per)) {
			per = 0;
		}
		var rs = temp * per / 100;
		$('#r_er'+extra_r_no).val(rs);
		r_calc_gd();
	}
	
	function r_calc_gd()
	{
		var rs_sum = 0,rs=0, temp = 0, a;
		$("[id^='r_er']").each(function(){
			rs=parseInt($(this).val());
			if(isNaN(rs)) {
				rs = 0;
			}
			rs_sum += rs;
		});
		
		itax=$('#it').val(); if(isNaN(itax) || itax == ''){ itax = 0; }
		ptax=$('#pt').val(); if(isNaN(ptax) || ptax == ''){ptax = 0;}
		otherdedction=$('#od').val(); if(isNaN(otherdedction) || otherdedction == '') otherdedction = 0;
		if(isNaN(rs_sum) || rs_sum == '') rs_sum=0;
		gdeduction=(parseFloat(itax)+parseFloat(ptax)+parseFloat(otherdedction)) + rs_sum;
		$('#gd').val(gdeduction);
		
	}
</script>
	
<script>
	
			//society contribution
			
var rs_extra_no=-1;
	$('#rs_add_extra_sal').click(function() {
			var part_html="",rs_extra_id='';
			rs_extra_no++;
			rs_extra_id = 'rs_e'+rs_extra_no;
//			rs_extra_value_id = 'id=rs_v'+rs_extra_no;
			rs_extra_value_id = 'rs_v'+rs_extra_no;
//			rs_extra_rs_id = 'id=rs_er'+rs_extra_no;
			rs_extra_rs_id = 'rs_er'+rs_extra_no;
			rs_extra_per_id = 'id=rs_ep'+rs_extra_no;
			rs_extra_pert_id = 'rs_ept'+rs_extra_no;
			rs_extra_ckbox_name = 'name=rs_n'+rs_extra_no;
			part_html = `
							<div class='form-group rs_extra_salary' id=`+rs_extra_id+`>
								<div class='form-control-div col-sm-1'>
									<div class='col-md-1'>
										<span type='button' class="btn btn-warning btn-xs glyphicon glyphicon-remove ck_box" id='' name='' onclick='remove("`+rs_extra_id+`");' checked disabledddd ></span>
									</div>
								</div>
								<label class='control-label col-sm-3'>
									Company Contribution:
								</label>
								<div class='col-md-2 rs_ex_name'>
									<select class='form-control' id=`+rs_extra_value_id+` name='' data=`+rs_extra_rs_id+` >
										<option class='form-control' id='' value=''>---------select--------</option>
										<?php
											foreach($sal['sal_rs_extra_list'] as $row) {
										?>
												<option class='form-control' id=`+rs_extra_value_id+` value='{{$row->sal_extra_id}}'>			
													{{$row->sal_extra_display_name}}
												</option>
										<?php
											}
										?>
									</select>
								</div>
								<div class='col-md-2 rs_ex_val'>
									<input type='text' class='form-control' id=`+rs_extra_rs_id+` name='' onchange='' >Rs.
								</div>
								<div class='col-md-1 ex_rs_per hidden'>
									<input type='text' class='form-control' `+rs_extra_per_id+` name='' onchange='rs_calc_rs(`+rs_extra_no+`);' >%
								</div>
								<div class='col-md-4 rs_ex_pert'>
									<input type='text' class='form-control' id=`+rs_extra_pert_id+` name=''   placeholder='particulars' >
								</div>
							</div>
						`;
			$("#rs_extra_sal_box").append(part_html);
			
			
			$('#'+rs_extra_value_id).change(function(){
				var data = $(this).attr('data');
				var select_val = $(this).val();
				if(select_val == {{$soc_pf_id}}){
					$('#'+data).val(society_pf_value);
				}else
				if(select_val == {{$soc_esi_id}}) {
					$('#'+data).val(society_esi_value);
				}
			});
		}
	);
	
	
	$('#bbb').click(function() {
		get_sal_extra();
	//	get_sal_rs_extra_all();
	
	});
	
	
	function get_sal_rs_extra_all() {
		var aaa="";
		var rs_ex_name = new Array();
		var rs_ex_val = new Array();
		var rs_ex_pert = new Array();
		var i=0,n=0;
		
		$('#rs_extra_sal_box > .rs_extra_salary > .rs_ex_name > select').each(function () {
			if($(this).val()=="") {
				rs_ex_name[i++] = '-';
			} else {
				rs_ex_name[i++] = $(this).val();
			}
		});
		
		i=0;
		$('#rs_extra_sal_box > .rs_extra_salary > .rs_ex_val > input').each(function () {
			if(isNaN($(this).val()) || $(this).val()=="" ) {
				rs_ex_val[i++] = 0;
			} else {
				rs_ex_val[i++] = $(this).val();
			}
			n=i-1;
		});
		
		i=0;
		$('#rs_extra_sal_box > .rs_extra_salary > .rs_ex_pert > input').each(function () {		// 			* rs_ex_pert
			if($(this).val()=="" ) {
				rs_ex_pert[i++] = "-";
			} else {
				rs_ex_pert[i++] = $(this).val();
			}
			n=i-1;
		});
		
		
		for(i=0;i<=n;i++) {
			rs_ex_pert[i] = check_string(rs_ex_pert[i]);									//	*
			if(i==0){
				sal_rs_extra_all = rs_ex_name[i]+ "#" +rs_ex_val[i]+ "#" +rs_ex_pert[i];
			} else {
				sal_rs_extra_all = sal_rs_extra_all + "|" +	rs_ex_name[i]+ "#" +rs_ex_val[i]+ "#" +rs_ex_pert[i];
			}
		}
		//alert(sal_rs_extra_all);
		return sal_rs_extra_all;
	}
	
	function rs_calc_rs(rs_extra_no)
	{
		var temp = $('#bpay').val();
		var per = $('#rs_ep'+rs_extra_no).val();
		if(isNaN(per)) {
			per = 0;
		}
		var rs = temp * per / 100;
		$('#rs_er'+rs_extra_no).val(rs);
	}
	
	
	
	$(".ck_box").click(function() {
		alert();
	});
	
	function remove(id)
	{
		if(confirm("sure?")) {
			$("#"+id).remove();
			calc_ge();
		}
	}
	
	
</script>


<script>
/***************** LEAVE ********************/
	$("#leave").change(function() {
		console.log("leave value changed");
		calc_ge();
	});
/***************** LEAVE ********************/
</script>

<style>
	[class$="extra_salary"] {
	//		border:1px solid black;
		border-radius:2%;
		padding:5px;
		background:#f2efef73;
		margin-right:0;
		margin-left:0;
	}
	
	#r_extra_sal_box {
		
	//	background:#f2e00f73;
	}
	
	#bbb {
		opacity:0.1;
	}
</style>