
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i> REPORT Detail</h2>
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			
			<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<h3><center> USER DETAILS</center></h3>
						<tr>
							<th width="25%">Name</th>
							<td width="25%">{{ $detail['user']->FirstName }} &nbsp {{ $detail['user']->MiddleName }} &nbsp {{ $detail['user']->LastName }}</td>
							<th width="25%">Mobile Number</th>
							<td width="25%">{{$detail['user']->MobileNo}}</td>
						</tr>
						<tr>
							<th width="25%">Gender</th>
							<td width="25%">{{ $detail['user']->Gender}}</td>
							<th width="25%">Marital Status</th>
							<td width="25%">{{$detail['user']->MaritalStatus}}</td>
						</tr>
						
						<tr>
							<th width="25%">Occupation</th>
							<td width="25%">{{ $detail['user']->Occupation}}</td>
							<th width="25%">Age</th>
							<td width="25%">{{$detail['user']->Age}}</td>
						</tr>
						<tr>
							<th width="25%">Birthdate</th>
							<td width="25%">{{ $detail['user']->Birthdate}}</td>
							<th width="25%">Email</th>
							<td width="25%">{{$detail['user']->Email}}</td>
						</tr>
						<tr>
							<th width="25%">Address</th>
							<td width="25%">{{ $detail['user']->Address}}</td>
							<th width="25%">City</th>
							<td width="25%">{{$detail['user']->City}} &nbsp {{$detail['user']->District}}</td>
						</tr>
						
						<tr>
							<th width="25%">State</th>
							<td width="25%">{{ $detail['user']->State}}</td>
							<th width="25%">Pincode</th>
							<td width="25%">{{$detail['user']->Pincode}}</td>
						</tr>
						
						<tr>
							<th colspan="4"><center><h3>PIGMY ALLOCATION DETAILS </h3></center></th>
							
						</tr>
						
						@foreach ($detail['pigmi'] as $pigmi)
						<tr>
							<th width="25%">Pigmy Account Number</th>
							<td width="25%">{{ $pigmi->PigmiAcc_No}} / {{ $pigmi->old_pigmiaccno}}</td>
							<th width="25%">Balance</th>
							<td width="25%">{{$pigmi->Total_Amount}}</td>
						</tr>
						
						<tr>
							<th width="25%">Pigmy StartDate</th>
							<td width="25%">{{ $pigmi->StartDate}}</td>
							<th width="25%">Pigmy EndDate</th>
							<td width="25%">{{$pigmi->EndDate}}</td>
						</tr>
						
						<tr>
							<th width="25%">Pigmi_Type</th>
							<td width="25%">{{ $pigmi->Pigmi_Type}}</td>
							<th width="25%">Pigmy Closed</th>
							<td width="25%">{{$pigmi->Closed}}</td>
						</tr>
						<tr>
							<th width="25%">Agent Name</th>
							<td width="25%">{{ $detail['agent']->FirstName }} &nbsp {{ $detail['agent']->MiddleName }} &nbsp {{ $detail['agent']->LastName }}</td>
							<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="CLOSE" class="btn btn-info btn-sm crtds" href="pigmidirectclose/{{ $pigmi->PigmiAcc_No}}"/>
									</div>
								</div>
								</td>
								
								<td>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="DELETE" class="btn btn-info btn-sm crtds" href="pigmidirectDelete/{{ $pigmi->PigmiAcc_No}}"/>
									</div>
								</div>
								</td>
									
								</tr>
								<tr>
									<td colspan="4">
									</td>
								</tr>
								
								@endforeach
								<tr>
									<th colspan="4"><center><h3>SB  And RD ALLOCATION DETAILS </h3></center></th>
									
								</tr>
								@foreach ($detail['sb'] as $SB)
								<tr>
									<th width="25%">SB Account Number</th>
									<td width="25%">{{ $SB->AccNum}} / {{ $SB->Old_AccNo}}</td>
									<th width="25%">Balance</th>
									<td width="25%">{{$SB->Total_Amount}}</td>
								</tr>
								
								<tr>
									<th width="25%">Created ON</th>
									<td width="25%">{{ $SB->Created_on}}</td>
									<th width="25%">Opening Blance</th>
									<td width="25%">{{$SB->opening_blance}}</td>
								</tr>
								
								<tr>
									<th width="25%">Closed</th>
									<td width="25%">{{ $SB->Closed}}</td>
									
								</tr>
								
								@endforeach
								
								
								<tr>
									<th colspan="4"><center><h3>FD  And KCC ALLOCATION DETAILS </h3></center></th>
									
								</tr>
								
								@foreach ($detail['fd'] as $FD)
								<tr>
									<th width="25%">FD Account Number</th>
									<td width="25%">{{ $FD->Fd_CertificateNum}} / {{ $FD->Fd_OldCertificateNum}}</td>
									
								</tr>
								
								<tr>
									<th width="25%">FD StartDate</th>
									<td width="25%">{{ $FD->Fd_StartDate}}</td>
									<th width="25%">FD MatureDate</th>
									<td width="25%">{{$FD->Fd_MatureDate}}</td>
								</tr>
								
								<tr>
									<th width="25%">FD Type</th>
									<td width="25%">{{ $FD->FdType}}</td>
									<th width="25%"> Fd Interest</th>
									<td width="25%">{{$FD->FdInterest}}</td>
								</tr>
								
								<tr>
									<th width="25%">Deposit Amount</th>
									<td width="25%">{{ $FD->Fd_DepositAmt}}</td>
									<th width="25%"> Matureity Amount </th>
									<td width="25%">{{$FD->Fd_TotalAmt}}</td>
								</tr>
								
								<tr>
									<th width="25%">Paid State</th>
									<td width="25%">{{ $FD->Paid_State}}</td>
									<th width="25%"> Closed </th>
									<td width="25%">{{$FD->Closed}}</td>
								</tr>
								@endforeach
								<tr>
									<th colspan="4"><center><h3>DL ALLOCATION DETAILS </h3></center></th>
									
								</tr>
								
								@foreach ($detail['dl'] as $DL)
								<tr>
									<th width="25%">DL Account Number</th>
									<td width="25%">{{ $DL->DepLoan_LoanNum}} / {{ $DL->Old_loan_number}}</td>
									
								</tr>
								
								<tr>
									<th width="25%">DL StartDate</th>
									<td width="25%">{{ $DL->DepLoan_LoanStartDate}}</td>
									<th width="25%">DL EndDate</th>
									<td width="25%">{{$DL->DepLoan_LoanEndDate}}</td>
								</tr>
								
								<tr>
									<th width="25%">DL On Account</th>
									<td width="25%">{{ $DL->DepLoan_AccNum}}/{{ $DL->Old_Accnum}}</td>
									<th width="25%"> DL Type</th>
									<td width="25%">{{$DL->DepLoan_DepositeType}}</td>
								</tr>
								
								<tr>
									<th width="25%">Deposit Amount</th>
									<td width="25%">{{ $DL->DepLoan_LoanAmount}}</td>
									<th width="25%"> Remaining  Amount </th>
									<td width="25%">{{$DL->DepLoan_RemailningAmt}}</td>
								</tr>
								
								<tr>
									
									<th width="25%"> Closed </th>
									<td width="25%">{{$DL->LoanClosed_State}}</td>
								</tr>
								@endforeach
								
								<tr>
									<th colspan="4"><center><h3>PL ALLOCATION DETAILS </h3></center></th>
									
								</tr>
								
								@foreach ($detail['pl'] as $PL)
								<tr>
									<th width="25%">PL Account Number</th>
									<td width="25%">{{ $PL->PersLoan_Number}} / {{ $PL->Old_PersLoan_Number}}</td>
									<th width="25%">Resolution_no</th>
									<td width="25%">{{$PL->board_resolution_no}}</td>
									
								</tr>
								
								<tr>
									<th width="25%">PL StartDate</th>
									<td width="25%">{{ $PL->StartDate}}</td>
									<th width="25%">PL EndDate</th>
									<td width="25%">{{$PL->EndDate}}</td>
								</tr>
								<tr>
									<th width="25%">PL LoanType</th>
									<td width="25%">{{ $PL->LoanType_Name}}</td>
									<th width="25%">PL Interest</th>
									<td width="25%">{{$PL->LoanType_Interest}}</td>
								</tr>
								
								<tr>
									<th width="25%"> Loan Duration  </th>
									<td width="25%">{{ $PL->LoandurationYears}}</td>
									<th width="25%">EMI</th>
									<td width="25%">{{$PL->EMI_Amount}}</td>
								</tr>
								
								
								
								<tr>
									<th width="25%">Loan Amount</th>
									<td width="25%">{{ $PL->LoanAmt}}</td>
									<th width="25%"> Remaining  Amount </th>
									<td width="25%">{{$PL->RemainingLoan_Amt}}</td>
								</tr>
								
								<tr>
									
									<th width="25%"> Closed </th>
									<td width="25%">{{$PL->LoanClosed_State}}</td>
								</tr>
								@endforeach
								
								<tr>
									<th colspan="4"><center><h3>JL ALLOCATION DETAILS </h3></center></th>
									
								</tr>
								
								@foreach ($detail['jl'] as $JL)
								<tr>
									<th width="25%">JL Account Number</th>
									<td width="25%">{{ $JL->JewelLoan_LoanNumber}} / {{ $JL->jewelloan_Oldloan_No}}</td>
									
									
								</tr>
								
								<tr>
									<th width="25%">JL StartDate</th>
									<td width="25%">{{ $JL->JewelLoan_StartDate}}</td>
									<th width="25%">JL EndDate</th>
									<td width="25%">{{$JL->JewelLoan_EndDate}}</td>
								</tr>
								
								
								<tr>
									<th width="25%"> Loan Duration  </th>
									<td width="25%">{{ $JL->JewelLoan_LoanDuration}}</td>
									<th width="25%">AppraisalValue</th>
									<td width="25%">{{$JL->JewelLoan_AppraisalValue}}</td>
								</tr>
								
								
								
								<tr>
									<th width="25%">Loan Amount</th>
									<td width="25%">{{ $JL->JewelLoan_LoanAmount}}</td>
									<th width="25%"> Remaining  Amount </th>
									<td width="25%">{{$JL->JewelLoan_LoanRemainingAmount}}</td>
								</tr>
								
								<tr>
									<th width="25%">Gross weight </th>
									<td width="25%">{{ $JL->jewelloan_Gross_weight}}</td>
									<th width="25%"> jewelloan Net weight </th>
									<td width="25%">{{$JL->jewelloan_Net_weight}}</td>
								</tr>
								<tr>
									<th width="25%">pergram value </th>
									<td width="25%">{{ $JL->jewelloan_pergram_value}}</td>
									<th width="25%"> jewelloan Description </th>
									<td width="25%">{{$JL->jewelloan_Description}}</td>
								</tr>
								
								<tr>
									
									<th width="25%"> Closed </th>
									<td width="25%">{{$JL->JewelLoan_Closed}}</td>
								</tr>
								@endforeach
							</thead>
							
							
							
						</table>
						
						
						
					</div> 
				</div>
			</div>
		</div>
	</div>
	
	<script>
		
		$('.clickme').click(function(e){
			$('.acctypclassid').click();
		});
		
		$('.crtds').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		
	</script>		