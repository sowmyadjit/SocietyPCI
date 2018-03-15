


<div class="box_bdy_<?php echo $pgmcheque['module']->Mid; ?> box col-md-12">
    <div class="bdy_<?php echo $pgmcheque['module']->Mid; ?> box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-user"></i> PIGMI UNCLEARED CHEQUE DETAIL </h2>
			
		</div>
		<div class="box-content">
			<div class="chequereject">
				<label class="control-label col-sm-4">Cheque Reject Amount:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="pgmchqrjct" name="pgmchqrjct" placeholder="CHEQUE REJECT AMOUNT">
				</div>
			</div>
			
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th>Account Number</th>
						<th>Full Name</th>
						<th>Transaction Type</th>
						<th>Cheque Number</th>
						<th>Cheque Date</th>
						<th>Bank Name</th>
						<th>Bank Branch</th>
						<th>IFSC Code</th>
						<th>Amount</th>
						<th colspan=2><center>Action</center></th>
							
						</tr>
						</thead>
						<tbody>
							
							<tr>
								@foreach ($pgmcheque['data'] as $pigmi_transaction)
								<tr>
									<td class="hidden rejecttransid">{{ $pigmi_transaction->PigmiTrans_ID }}</td>
									<td class="hidden">{{ $pigmi_transaction->PigmiAllocID }}</td>
									<td class="hidden">{{ $pigmi_transaction->Uid }}</td>
									
									<td><?php $transcdte=date("d-m-Y",strtotime($pigmi_transaction->Trans_Date));echo $transcdte;?></td>
									<td>{{$pigmi_transaction->PigmiAcc_No}}</td>
<td>{{ $pigmi_transaction->FirstName }}.{{ $pigmi_transaction->MiddleName }}.{{ $pigmi_transaction->LastName }}</td>
									<td>{{ $pigmi_transaction->Transaction_Type }}</td>
									<td>{{ $pigmi_transaction->PgmCheque_Number}}</td>	
									<td>{{ $pigmi_transaction->PgmCheque_Date}}</td>
									<td>{{$pigmi_transaction->PgmBank_Name}}</td>
									<td>{{$pigmi_transaction->PgmBank_Branch}}</td>
									<td>{{$pigmi_transaction->PgmIFSC_Code}}</td>
									<td>{{$pigmi_transaction->PgmUncleared_Bal}}</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpbtn<?php echo $pgmcheque['module']->Mid; ?>" href="pgmclearcheque/{{ $pigmi_transaction->PigmiTrans_ID }}"/>
												
											</div>
										</div>
									</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $pgmcheque['module']->Mid; ?>" />
											</div>
										</div>
									</td>
									
								</tr>
								
								
								
								@endforeach
							</div>
						</div>
					</div>
					<script>
						
						$('.chequereject').hide();
						
						/*$('.crtds').click(function(e)
							{
							e.preventDefault();
							$('.box-inner').load($(this).attr('href'));
						});*/
						$('.accpbtn<?php echo $pgmcheque['module']->Mid; ?>').click(function(e){
							e.preventDefault();
							//$('.box-inner').load($(this).attr('href'));
							//$('.clearclassid').click();
							$('.bdy_<?php echo $pgmcheque['module']->Mid; ?>').load($(this).attr('href'));
						});
						
						$('.rejbtn<?php echo $pgmcheque['module']->Mid; ?>').click(function(e){
							e.preventDefault();
							$('.chequereject').show();
							m=$('#pgmchqrjct').val();
							a=$('.rejecttransid').html();
							//alert(a);
							if(m=="")
							{
								alert("Please Enter the Cheque Reject Amount");
							}
							else
							{
								$.ajax({
									url:'pgmrejectcheque',
									type:'post',
									data:'&cheqchrge='+m+'&tid='+a,
									success:function()
									{
										$('.clearclassid').click();
									}
								});
								/*$('.box-inner').load($(this).attr('href'));*/
								
							}
						});
						
					</script>					