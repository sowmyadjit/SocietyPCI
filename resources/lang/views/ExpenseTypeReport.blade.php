                <div class='SearchRes'>
					<div  id="toprint">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>BRANCH</th>
									<th>EXPENSE DATE</th>
									<th>PAYMENT MODE</th>
									<th>BANK</th>
									<th>Credited Amount</th>
									<th>Total Balance</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								
								@foreach($PigmyBranchWise['PigmiReportBWData'] as $PABD)
								<tr>
									<td class="hidden">{{ $PABD->PigmiTrans_ID }}</td>
									<td>{{ $PABD->BName }}</td>
									<td>{{ $PABD->FirstName }}.{{ $PABD->MiddleName }}.{{ $PABD->LastName }}</td>
									<td>{{ $PABD->PigmiAcc_No }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($PABD->PigReport_TranDate)); echo $trandate; ?></td>
									<!--<td>{{ $PABD->Trans_Date }}</td>-->
									<!--<td>{{ $PABD->old_pigmiaccno }}</td>-->
									
									<td>{{ $PABD->Pigmi_Type }}</td>
									<td>{{ $PABD->Current_Balance }}</td>
									<td>{{ $PABD->Amount }}</td>	
									<td>{{ $PABD->Total_Amount }}</td>
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
					
					<div id='pagei'>
						{!! $PigmyBranchWise['PigmiReportBWData']->render() !!}
					</div>
				</div>