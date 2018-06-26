
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
						<label class="control-label col-sm-4">Agent Name:</label>
						<div class="col-md-4">
							<input class="typeahead1 form-control ptagnt"  id="ptagnt" name="ptagnt" placeholder="SELECT AGENT NAME" >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total amount collected</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="totalamt" name="totalamt" >  
							<input class="form-control"  type="text" id="totalamtdis" name="totalamtsid"disabled >  
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Security Deposit</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="sdpo" name="sdpo" >  
							<input class="form-control"  type="text" id="sdpodis" name="sdpodis"disabled >  
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">TDS</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="tdsval" name="tdsval" >  
							<input class="form-control"  type="text" id="tdsvaldis" name="tdsvaldis"disabled >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Commission</label>
						<div class="col-sm-4">
							<input class="form-control hidden"  type="text" id="comm" name="comm" >  
							<input class="form-control"  type="text" id="commdis" name="commdis" >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Other Income</label>
						<div class="col-sm-4">
							<input class="form-control "  type="text" id="ot" name="ot" >  
							
						</div>
					</div>
					
					
					
					
					
					
					
					
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
						
						
						
						<div class="form-group" id="charge">
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
					{!! Form::open() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/sidebar/sidebar.js"></script>
<script src="js/bootstrap-typeahead.js"></script>

<script>
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
		ajax: '/getAllocatesaraparalist'
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
			url:'getsaraparasalary',
			type:'get',
			data:'&startdate='+sdate+'&enddate='+edate+'&Auid='+AN+'&cp='+cp+'&tds='+tds,
			success:function(data)
			{
				
				$('#totalamt').val(data['amount']);
				$('#comm').val(data['interest']);
				$('#totalamtdis').val(data['amount']);
				$('#commdis').val(data['interest']);
				
				$('#tdsval').val(data['tds']);
				$('#tdsvaldis').val(data['tds']);
				$('#sdpodis').val(data['secutitydeposit']);
				$('#sdpo').val(data['secutitydeposit']);
				$('#ot').val(data['otherincome']);

				/**************/
				var temp_cvommission = parseFloat($('#totalamtdis').val()) - parseFloat($('#sdpodis').val()) - parseFloat($('#ot').val()) - parseFloat($('#tdsvaldis').val());
				$('#commdis').val(temp_cvommission);
				/**************/
				
				
			}
		});
		
	});
	salindex=0;
	$('.sbmbtn').click( function(e) {
		if(salindex==0)
		{
			salindex++;
			auid=$('#ptagnt').data('value');
			AccNum=$('.SBAccNumTypeAhead').data('value');
loannum=$('.PLAccNumTypeAhead').data('value');
			pmode=$('#AgentPayMode').val();
			e.preventDefault();
			$.ajax({
				
				url: 'payagentcommision2',
				type: 'post',
				data: $('#form_addbank').serialize() + '&aguid='+auid+'&sbAcNo='+AccNum+'&pmode='+pmode+'&loannum='+loannum+'&noloan='+noloan,
				success: function(data) {
					alert('success');
					// $('.fdallocclassid').click();
					//window.location.reload(true);
				}
			});
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
			paysal=$('#commdis').val();
		$('#pay').val(paysal);
			noloan="YES";
		}
		else{
			comm=$('#commdis').val();
			plemi=$('#plemi').val();
			a=(parseFloat(comm)-parseFloat(plemi));
			a=Math.round(a);
			$('#pay').val(a);
			noloan="NO";
		}
	});
</script>
