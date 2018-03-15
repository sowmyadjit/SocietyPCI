<div class="box_bdy_<?php echo $rdcheque['module']->Mid; ?> box col-md-12">
    <div class="bdy_<?php echo $rdcheque['module']->Mid; ?> box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-user"></i> RD UNCLEARED CHEQUE DETAIL </h2>
			
			
		</div>
		<div class="box-content">
			<div class="chequereject">
				<label class="control-label col-sm-4">Cheque Reject Amount:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="rdchqrjct" name="rdchqrjct" placeholder="CHEQUE REJECT AMOUNT">
				</div>
			</div>
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th>Account Number</th>
						<th>Name</th>
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
								@foreach ($rdcheque['data'] as $rd_transaction)
								<tr>
									<td class="hidden rejecttransid">{{ $rd_transaction->RD_TransID }}</td>
									<td class="hidden">{{ $rd_transaction->Accid }}</td>
									<td class="hidden">{{ $rd_transaction->Uid }}</td>
									
									<td><?php $transcdte=date("d-m-Y",strtotime($rd_transaction->RD_Date));echo $transcdte;?></td>
									<td>{{$rd_transaction->AccNum}}</td>
									<td>{{ $rd_transaction->FirstName }}.{{ $rd_transaction->MiddleName }}.{{ $rd_transaction->LastName }}</td>
									
									<td>{{ $rd_transaction->RD_Trans_Type }}</td>
									<td>{{ $rd_transaction->RDCheque_Number}}</td>	
									<td>{{ $rd_transaction->RDCheque_Date}}</td>
									<td>{{$rd_transaction->RDBank_Name}}</td>
									<td>{{$rd_transaction->RDBank_Branch}}</td>
									<td>{{$rd_transaction->RDIFSC_Code}}</td>
									<td>{{$rd_transaction->RDUncleared_Bal}}</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpbtn<?php echo $rdcheque['module']->Mid; ?>" href="rdclearcheque/{{ $rd_transaction->RD_TransID }}"/>
												
											</div>
										</div>
									</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $rdcheque['module']->Mid; ?>" />
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
						$('.accpbtn<?php echo $rdcheque['module']->Mid; ?>').click(function(e){
							e.preventDefault();
							$('.bdy_<?php echo $rdcheque['module']->Mid; ?>').load($(this).attr('href'));
							//$('.box-inner').load($(this).attr('href'));
							//$('.clearclassid').click();
						});
						
						$('.rejbtn<?php echo $rdcheque['module']->Mid; ?>').click(function(e){
							e.preventDefault();
							$('.chequereject').show();
							m=$('#rdchqrjct').val();
							a=$('.rejecttransid').html();
							//alert(a);
							if(m=="")
							{
								alert("Please Enter the Cheque Reject Amount");
							}
							else
							{
								$.ajax({
									url:'rdrejectcheque',
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