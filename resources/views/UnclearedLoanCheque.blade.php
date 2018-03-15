


<div class="box_bdy_<?php echo $loancheque['module']->Mid; ?> box col-md-12">
    <div class="bdy_<?php echo $loancheque['module']->Mid; ?> box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-user"></i> PIGMI UNCLEARED CHEQUE DETAIL </h2>
			
			
		</div>
		<div class="box-content">
			<div class="chequereject">
				<label class="control-label col-sm-4">Cheque Reject Amount:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="loanchqrjct" name="loanchqrjct" placeholder="CHEQUE REJECT AMOUNT">
				</div>
			</div>
			
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						
						<th>Account Number</th>
						<th>Name</th>
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
						@foreach ($loancheque['dl'] as $loan_transaction)
						<tr>
							
							
							<td class="hidden">{{$loan_transaction->DLRepay_ID}}</td>
							<td>{{$loan_transaction->DepLoan_LoanNum}}/{{$loan_transaction->Old_loan_number}}</td>
							<td>{{ $loan_transaction->FirstName }}
								{{ $loan_transaction->MiddleName }}
							{{ $loan_transaction->LastName }}</td>
							
							<td>{{ $loan_transaction->Dl_Cheque_No}}</td>	
							<td>{{ $loan_transaction->Dl_Cheque_Date}}</td>
							<td>{{$loan_transaction->Dl_BankName}}</td>
							<td>{{$loan_transaction->Dl_BankBranch}}</td>
							<td>{{$loan_transaction->Dl_IFSC}}</td>
							
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpbtn<?php echo $loancheque['module']->Mid; ?>"href="AcceptCheque/{{$loan_transaction->DLRepay_ID}}/{{$loan_transaction->DepLoan_LoanNum}}/dl" />
										
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $loancheque['module']->Mid; ?>"href="rejectDLCheque/{{$loan_transaction->DLRepay_ID}}/dl" />
									</div>
								</div>
							</td>
							
						</tr>
						
						
						
						@endforeach
						
						
						@foreach ($loancheque['pl'] as $loan_transaction)
						<tr>
							
							
							<td class="hidden">{{$loan_transaction->PLRepay_Id}}</td>
							<td>{{$loan_transaction->PersLoan_Number}}/{{$loan_transaction->Old_PersLoan_Number}}</td>
							<td>{{ $loan_transaction->FirstName }}
								{{ $loan_transaction->MiddleName }}
							{{ $loan_transaction->LastName }}</td>
							<td>{{ $loan_transaction->PL_ChequeNO}}</td>	
							<td>{{ $loan_transaction->PL_ChequeDate}}</td>
							<td>{{$loan_transaction->PL_BankName}}</td>
							<td>{{$loan_transaction->PL_BankBranch}}</td>
							<td>{{$loan_transaction->PL_IFSC}}</td>
							
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpbtn<?php echo $loancheque['module']->Mid; ?>" href="AcceptCheque/{{$loan_transaction->PLRepay_Id}}/{{$loan_transaction->PersLoan_Number}}/pl"/>
										
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $loancheque['module']->Mid; ?>"href="rejectDLCheque/{{$loan_transaction->PLRepay_Id}}/pl"  />
									</div>
								</div>
							</td>
							
						</tr>
						
						
						
						@endforeach
						
						@foreach ($loancheque['jl'] as $loan_transaction)
						<tr>
							
							
							<td class="hidden">{{$loan_transaction->JLRepay_Id}}</td>
							<td>{{$loan_transaction->JewelLoan_LoanNumber}}/{{$loan_transaction->jewelloan_Oldloan_No}}</td>
							<td>{{ $loan_transaction->FirstName }}
								{{ $loan_transaction->MiddleName }}
							{{ $loan_transaction->LastName }}</td>
							
							<td>{{ $loan_transaction->JL_ChequeNo}}</td>	
							<td>{{ $loan_transaction->JL_ChequeDate}}</td>
							<td>{{$loan_transaction->JL_BankName}}</td>
							<td>{{$loan_transaction->JL_BankBranch}}</td>
							<td>{{$loan_transaction->JL_IFSC}}</td>
							
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpbtn<?php echo $loancheque['module']->Mid; ?>" href="AcceptCheque/{{$loan_transaction->JLRepay_Id}}/{{$loan_transaction->JewelLoan_LoanNumber}}/jl"/>
										
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $loancheque['module']->Mid; ?>"href="rejectDLCheque/{{$loan_transaction->JLRepay_Id}}/jl"  />
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
				$('.accpbtn<?php echo $loancheque['module']->Mid; ?>').click(function(e){
					e.preventDefault();
					$('.bdy_<?php echo $loancheque['module']->Mid; ?>').load($(this).attr('href'));
					//$('.box-inner').load($(this).attr('href'));
					//$('.clearclassid').click();
				});
				
				$('.rejbtn<?php echo $loancheque['module']->Mid; ?>').click(function(e){
					e.preventDefault();
					$('.chequereject').show();
					m=$('#loanchqrjct').val();
					a=$('.rejecttransid').html();
					//alert(a);
					if(m=="")
					{
						alert("Please Enter the Cheque Reject Amount");
					}
					else
					{
						$.ajax({
							url:'loanrejectcheque',
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