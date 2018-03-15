


<div class="box_bdy_<?php echo $fdcheque['module']->Mid; ?> box col-md-12">
    <div class="bdy_<?php echo $fdcheque['module']->Mid; ?> box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-user"></i> FD UNCLEARED CHEQUE DETAIL </h2>
			
			
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
						<th>Allocation Date</th>
						<th>Account Number</th>
						<th>Full Name</th>
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
						@foreach ($fdcheque['data'] as $fdallocation)
						<tr>
							<td class="hidden rejecttransid">{{ $fdallocation->Fdid }}</td>
							<td class="hidden">{{ $fdallocation->Accid }}</td>
							<td class="hidden">{{ $fdallocation->Uid }}</td>
							
							<td><?php $transcdte=date("d-m-Y",strtotime($fdallocation->FD_StartDate));echo $transcdte;?></td>
							<td>{{$fdallocation->AccNum}}</td>
					<td>{{ $fdallocation->FirstName }}.{{ $fdallocation->MiddleName }}.{{ $fdallocation->LastName }}</td>
							<td>{{ $fdallocation->FDChq_No}}</td>	
							<td>{{ $fdallocation->FDChq_Date}}</td>
							<td>{{$fdallocation->FDBnk_Name}}</td>
							<td>{{$fdallocation->FDBnk_Branch}}</td>
							<td>{{$fdallocation->FDIFSC_Code}}</td>
							<td>{{$fdallocation->FDUnclear_Bal}}</td>
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpbtn<?php echo $fdcheque['module']->Mid; ?>" href="fdclearcheque/{{ $fdallocation->Fdid }}"/>
										
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $fdcheque['module']->Mid; ?>" />
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
				$('.accpbtn<?php echo $fdcheque['module']->Mid; ?>').click(function(e){
					e.preventDefault();
					//	$('.box-inner').load($(this).attr('href'));
					//	$('.clearclassid').click();
					$('.bdy_<?php echo $fdcheque['module']->Mid; ?>').load($(this).attr('href'));
				});
				
				$('.rejbtn<?php echo $fdcheque['module']->Mid; ?>').click(function(e){
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
							url:'fdrejectcheque',
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