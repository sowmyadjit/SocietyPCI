
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>



<div id="content" class="col-lg-12 col-sm-12">
	<!-- content starts -->
	
	
	
		
		<div class="box-inner">
			
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i>  Branch TO Branch Transfer</h2>
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			
			<!--<div class="box-content">
				<div class="alert alert-info">
				<a href="#" class="btn btn-default crtds">Create Company</a>
			</div>-->
			
			
			
			
			<div class="col-md-12">
				
					<div class="row table-row alert alert-info">
						
						
						
						
						<label class="control-label inline col-md-4">FROM BRANCH:
							<select class="form-control BranchList1"  id="BranchList1" name="BranchList1">  
								
								<?php foreach($branch['branch_data'] as $key){
									echo "<option value='".$key->Bid."' >" .$key->BName."";
									echo "</option>";
								}?>
							</select>
						</label>
						
						
						
						
						<label class="control-label inline col-md-4"> TO BRANCH:
							<select class="form-control BranchList2"  id="BranchList2" name="BranchList2">  
								
								<?php foreach($branch['branch_data'] as $key){
									echo "<option value='".$key->Bid."' >" .$key->BName."";
									echo "</option>";
								}?>
							</select>
						</label>
						
						<label class="control-label inline col-md-4">HEAD:
							<select class="form-control HeadListDD"  id="HeadiD" name="HeadiD">  
								<option value="">--Select Head--</option>
								<?php foreach($branch['led'] as $key){
									echo "<option value='".$key->lid."' >" .$key->lname."";
									echo "</option>";
								}?>
							</select>
						</label>
						
						
						<label class="control-label inline col-md-4">Sub Head:
							
							<select class="form-control" id="expsubhead" name="expsubhead">
								
								<option></option>
								
							</select>
							
						</label>
						</br></br>
						
						
							<label class="control-label inline col-sm-4">Amount:
							
								<input type="text" class="form-control" id="amt" name="amt" placeholder="Amount"/>
							</label>
							
							
						
						
						<div class="form-group">
							<label class="control-label col-sm-2">Perticulars:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="per" name="per" placeholder="">
							</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">Transaction Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="tt" name="tt">
								<option>-----select  Transaction-----</option>
								<option>INHAND</option>
								<option>ADJUSTMENT</option>
								<!--<option>Loan Transaction</option>
								<option>Divident Transaction</option>-->
							</select>
						</div>
					</div>
						
						<div class="col-md-2">
							<a class="btn btn-default SearchBWPig pull-left">Transfer</a>
						</div>
						
					</div>
					
					
					
					</br></br>
					
				</div>
			
		</div>
		
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Date</th>
								
								<th>Adjustment Number</th>
								<th>Expence From</th>
								<th>Amount</th>							
								<th>Particulars</th>
								
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($branch['tran'] as $expence)
							<tr>
								
								<td>{{ $expence->Branch_Tran_Date }}</td>
								<td>{{ $expence->Branch_Id }}</td>
								<td>{{ $expence->BName }}</td>
								<td>{{ $expence->Branch_Amount }}</td>
								<td>{{ $expence->Branch_per }}</td>
							
								
							</tr>
							@endforeach
							

	
	
	<script>
		
		
		$("ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc");
			
		});
		
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('#maincontents').load($(this).attr('href'));
		});
		
		
		$('.clickme').click(function(e){
			$('.companyclassid').click();
		}); 
		
		indexid=0;
		$('.SearchBWPig').click(function(e){
			if(indexid==0)
			{
				indexid++;
				Br1=$('#BranchList1').val();
				//alert(Br1);
				//Br1id=$('#BranchList1').data('value');
				//alert(Br1id);
				//Br2id=$('#BranchList2').data('value');
				Br2=$('#BranchList2').val();
				amt=$('#amt').val();
				per=$('#per').val();
				tt=$('#tt').val();
				hid=$('#HeadiD').val();
				sid=$('#expsubhead').val();
				
				
				e.preventDefault();
				$.ajax({
					url:'transferbranchamt',
					type:'post',
					data:'&Br1='+Br1+'&Br2='+Br2+'&amt='+amt+'&per='+per+'&tt='+tt+'&hid='+hid+'&sid='+sid,
					success:function(data)
					{
						alert('success');
						$('.expenceclassid').click();
					}
				});
			}
		});
		
		
		
		
		$('#HeadiD').change(function(e){
			//agent=$('ul.typeahead1 li.active').data('value');
			Lid=$('#HeadiD').val();
			
			// alert(Lid);
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
		
	</script>
	
	
