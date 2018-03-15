


<div class="box col-md-12">
	<div class="box-inner">
		
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-globe"></i>   opening balance Detail</h2>
			
			
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
			</div>
		</div>
		
		<td> <h5><b>Opening Balance:</b> <?php echo $trandaily['opbal']; ?> </h5></td>&nbsp&nbsp&nbsp&nbsp
		<td> <h5><b>Running Balance:</b> <?php echo $trandaily['runningbal']; ?> </h5></td>
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					<th>DATE</th>
					<th>Account number</th>
					<th>perticulars</th>
					<th>CREDIT</th>
					<th>DEBIT</th>
					<th>RECEIPT NUM</th>
					<th>PAYMENT VOUCHER NUM</th>
					
					
				</tr>
			</thead>
			
			<tbody>
			<tr><td colspan="6"><h5><b><center>SB TRANSACTION<center></b></h5></td></tr>
				@foreach ($trandaily['sb'] as $sb)
				<tr>
					
					
					<td>{{ $sb->SBReport_TranDate }}</td>
					<td>{{ $sb->AccNum }}</td>
					<td>{{ $sb->particulars }}</td>
					
					@if($sb->TransactionType=="Credit"||$sb->TransactionType=="CREDIT"||$sb->TransactionType=="credit")
					
					<td><p class="text-right"><?php $temp=$sb->Amount; echo $temp; ?></p></td> 
					<td><p class="text-center">-</p></td>
					
					@else
					
					<td><p class="text-center">-</p></td>
					<td><p class="text-right"><?php $temp=$sb->Amount; echo $temp; ?></p></td> 
					
					@endif
					<td>{{ $sb->SB_resp_No }}</td>
					<td>{{ $sb->SB_paymentvoucher_No }}</td>
					
					
				</tr>
				@endforeach
				
				
				<tr>
					<th colspan =3>SB Total</th>
					<td><?php echo $trandaily['sbcredit']; ?></td>
					<td><?php echo $trandaily['sbdebit']; ?></td>
					<td>-</td><td>-</td>
					
				</tr>
				
				<tr><td colspan="6"><h5><b><center>RD TRANSACTION<center></b></h5></td></tr>
				@foreach ($trandaily['rd'] as $rd)
				<tr>
					
					
					<td>{{ $rd->RDReport_TranDate }}</td>
					<td>{{ $rd->AccNum }}</td>
					<td>{{ $rd->RD_Particulars }}</td>
					
					@if($rd->RD_Trans_Type=="Credit"||$rd->RD_Trans_Type=="CREDIT"||$rd->RD_Trans_Type=="credit")
					
					<td><p class="text-right"><?php $temp=$rd->RD_Amount; echo $temp; ?></p></td> 
					<td><p class="text-center">-</p></td>
					
					@else
					
					<td><p class="text-center">-</p></td>
					<td><p class="text-right"><?php $temp=$rd->RD_Amount; echo $temp; ?></p></td> 
					
					@endif
					<td>{{ $rd->RD_resp_No}}</td>
					<td>-</td>
				</tr>
				@endforeach
				<tr>
					<th colspan =3>RDTotal</th>
					<td><?php echo $trandaily['rdcredit']; ?></td>
					<td><?php echo $trandaily['rddebit']; ?></td>
					<td>-</td><td>-</td>
					
				</tr>
				
				
				<tr><td colspan="6"><h5><b><center>PIGMY TRANSACTION<center></b></h5></td></tr>
				@foreach ($trandaily['pigmy'] as $pigmy)
				<tr>
					
					
					<td>{{ $pigmy->PigReport_TranDate }}</td>
					<td>{{ $pigmy->PigmiAcc_No }}</td>
					<td>{{ $pigmy->Particulars }}</td>
					
					@if($pigmy->Transaction_Type=="Credit"||$pigmy->Transaction_Type=="CREDIT"||$pigmy->Transaction_Type=="credit")
					
					<td><p class="text-right"><?php $temp=$pigmy->Amount; echo $temp; ?></p></td> 
					<td><p class="text-center">-</p></td>
					
					@else
					
					<td><p class="text-center">-</p></td>
					<td><p class="text-right"><?php $temp=$pigmy->Amount; echo $temp; ?></p></td> 
					
					@endif
					
					<td>{{ $pigmy->	Pigmy_resp_No}}</td>
					<td>-</td>
				</tr>
				
				@endforeach
				<tr>
					<th colspan =3>PigmyTotal</th>
					<td><?php echo $trandaily['pigmycredit']; ?></td>
					<td><?php echo $trandaily['pigmycredit']; ?></td>
					<td>-</td><td>-</td>
					
				</tr>
				
				<tr><td colspan="6"><h5><b><center>PIGMY PAID AMOUNT<center></b></h5></td></tr>
				@foreach ($trandaily['pigmypayamt'] as $pigmyamt)
				<tr>
					
					
					<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
					<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
					<td>Pigmy Paid Amount</td>
					<td>-</td>
					<td>{{ $pigmyamt->PayAmount_PayableAmount }}</td>
					<td>-</td>
					<td>{{ $pigmyamt->PayAmount_PaymentVoucher }}</td>
					
					
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Pigmy Amount Paid</th>
					<td>-</td>
					<td><?php echo $trandaily['pigmypayamttot']; ?></td>
					<td>-</td><td>-</td>
				</tr>
				<tr><td colspan="6"><h5><b><center>RD PAID AMOUNT<center></b></h5></td></tr>
				@foreach ($trandaily['rdpayamt'] as $rdamt)
				<tr>
					
					
					<td>{{ $rdamt->RDPayAmtReport_PayDate }}</td>
					<td>{{ $rdamt->RDPayAmt_AccNum }}</td>
					<td>RD Paid Amount</td>
					<td>-</td>
					<td>{{ $rdamt->RDPayAmt_PayableAmount }}</td>
					<td>-</td>
					<td>{{ $rdamt->RD_PayAmount_pamentvoucher }}</td>
					
				
					
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>RD Amount Paid</th>
					<td>-</td>
					<td><?php echo $trandaily['rdpayamttot']; ?></td>
					<td>-</td><td>-</td>
					
				</tr>
				<tr><td colspan="6"><h5><b><center>FD PAID AMOUNT<center></b></h5></td></tr>
				@foreach ($trandaily['fdallocamt'] as $fdamt)
				<tr>
					
					
					<td>{{ $fdamt->FdReport_StartDate }}</td>
					<td>{{ $fdamt->Fd_CertificateNum }}</td>
					<td>FD Deposit Amount</td>
					
					<td>{{ $fdamt->Fd_DepositAmt }}</td>
					<td>{{ $fdamt->FD_resp_No }}</td>
					
				
					<td>-</td>
					
					
				</tr>
				@endforeach	
				<tr>
					<th colspan =3>Total FD Amount </th>
					
					<td><?php echo $trandaily['fdallocamttot']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				@foreach ($trandaily['fdpayamt'] as $fdpayamt)
				<tr>
					
					
					<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
					<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
					<td>FD Paid Amount</td>
					<td>-</td>
					<td>{{ $fdpayamt->FDPayAmt_PayableAmount }}</td>
					<td>-</td><td>{{ $fdpayamt->FD_PayAmount_pamentvoucher }}</td>
					
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>FD Amount Paid</th>
					<td>-</td>
					<td><?php echo $trandaily['fdpayamttot']; ?></td>
					<td>-</td><td>-</td>
					
					
					
				</tr>
				@foreach ($trandaily['share'] as $share)
				<tr>
					
					
					<td>{{ $share->PURSH_Date }}</td>
					<td>{{ $share->PURSH_Memshareid }}</td>
					<td>Purchased Shares</td>
					<td>{{ $share->PURSH_Totalamt }}</td>
					<td>-</td><td>-</td><td>-</td>
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Shares Amount </th>
					
					<td><?php echo $trandaily['sharetot']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				@foreach ($trandaily['membshare'] as $membshare)
				<tr>
					
					
					<td>{{ $membshare->CreatedDate }}</td>
					<td>{{ $membshare->Memid }}</td>
					<td>Member Fees</td>
					<td>{{ $membshare->Member_Fee }}</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Member Fee </th>
					
					<td><?php echo $trandaily['membsharetot']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				@foreach ($trandaily['classd'] as $classd)
				<tr>
					
					
					<td>{{ $classd->Created_on }}</td>
					<td>{{ $classd->FirstName }}</td>
					<td>Class D Fees</td>
					<td>{{ $classd->Customer_Fee }}</td>
					<td>-</td>
					<td>{{ $classd->Customer_ReceiptNum }}</td>
					
					<td>-</td>
					<td>-</td>
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total D class Fee </th>
					
					<td><?php echo $trandaily['classdtot']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>	
				
				@foreach ($trandaily['expence'] as $expencetran)
				<tr>
					
					
					<td>{{ $expencetran->e_date }}</td>
					<td>{{ $expencetran->lname }}</td>
					<td>-</td>
					<td>-</td>
					<td>{{ $expencetran->amount }}</td>
					<td>-</td>
					<td>{{ $expencetran->Expence_PamentVoucher }}</td>
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total expence </th>
					
					<td><?php echo $trandaily['expencebal']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				
				@foreach ($trandaily['income'] as $income)
				<tr>
					
					
					<td>{{ $income->Income_date }}</td>
					<td>{{ $income->lname }}</td>
					<td>{{ $income->Income_amount }}</td>
					<td>-</td>
					<td>-</td>
					
					<td>-</td>
					<td>{{ $income->Income_Expence_PamentVoucher }}</td>
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Income </th>
					
					<td><?php echo $trandaily['incomebal']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				@foreach ($trandaily['dlallocation'] as $dlallocation)
				<tr>
					
					
					<td>{{ $dlallocation->DepLoan_LoanStartDate }}</td>
					<td>{{ $dlallocation->DepLoan_LoanNum }}</td>
					<td>-</td>
					<td>-</td>
					<td>{{ $dlallocation->DepLoan_LoanAmount }}</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Deposit Loan </th>
					
					<td><?php echo $trandaily['dlallocationbal']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				@foreach ($trandaily['plallocation'] as $plallocation)
				<tr>
					
					
					<td>{{ $plallocation->StartDate }}</td>
					<td>{{ $plallocation->PersLoan_Number }}</td>
					<td>-</td>
					<td>-</td>
					<td>{{ $plallocation->LoanAmt }}</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Personal Loan </th>
					
					<td><?php echo $trandaily['plallocationbal']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				@foreach ($trandaily['jlallocation'] as $jlallocation)
				<tr>
					
					
					<td>{{ $jlallocation->JewelLoan_StartDate }}</td>
					<td>{{ $jlallocation->JewelLoan_LoanNumber }}</td>
					<td>-</td>
					<td>-</td>
					<td>{{ $jlallocation->JewelLoan_LoanAmount }}</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Jewel Loan </th>
					
					<td><?php echo $trandaily['jlallocationbal']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				@foreach ($trandaily['slallocation'] as $slallocation)
				<tr>
					
					
					<td>{{ $slallocation->StartDate }}</td>
					<td>{{ $slallocation->StfLoan_Number }}</td>
					<td>-</td>
					<td>-</td>
					<td>{{ $slallocation->LoanAmt }}</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				@endforeach
				<tr>
					<th colspan =3>Total Staff Loan</th>
					
					<td><?php echo $trandaily['slallocationbal']; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
				</tr>
				
				<tr>
					<th colspan =3>Grand Total</th>
					<td><b><div class="CreditSum"></div></b></td>
					<td><b><div class="DebitSum"></div></b></td>
				</tr>
				
				
				</tbody>
				</table>
			</div>
		</div>
		
		
		<script>
			
			SBcredit="<?php echo $trandaily['sbcredit']; ?>";
			rdcredit="<?php echo $trandaily['rdcredit']; ?>";
			pigmycredit="<?php echo $trandaily['pigmycredit']; ?>";
			fdcredit="<?php echo $trandaily['fdallocamttot']; ?>";
			sharecredit="<?php echo $trandaily['sharetot']; ?>";
			membfee="<?php echo $trandaily['membsharetot']; ?>";
			classdfee="<?php echo $trandaily['classdtot']; ?>";
			income="<?php echo $trandaily['incomebal']; ?>";
			credit=((parseFloat(SBcredit))+(parseFloat(rdcredit))+(parseFloat(pigmycredit))+(parseFloat(fdcredit))+(parseFloat(sharecredit))+(parseFloat(membfee))+(parseFloat(classdfee))+(parseFloat(income)));
			$('.CreditSum').html(credit);
			//alert(credit);
			
			SBdebit="<?php echo $trandaily['sbdebit']; ?>";
			rddebit="<?php echo $trandaily['rddebit']; ?>";
			pigmydebit="<?php echo $trandaily['pigmydebit']; ?>";
			pigmypatamtdebit="<?php echo $trandaily['pigmypayamttot']; ?>";
			rdpatamtdebit="<?php echo $trandaily['rdpayamttot']; ?>";
			fdpatamtdebit="<?php echo $trandaily['fdpayamttot']; ?>";
			expencetdebit="<?php echo $trandaily['expencebal']; ?>";
			debit=((parseFloat(SBdebit))+(parseFloat(rddebit))+(parseFloat(pigmydebit))+(parseFloat(pigmypatamtdebit))+(parseFloat(rdpatamtdebit))+(parseFloat(fdpatamtdebit))+(parseFloat(expencetdebit)));
			$('.DebitSum').html(debit);
			//alert(debit);
			
			
			
			
			$('.clickme').click(function(e){
				$('.companyclassid').click();
			}); 
			
			$('.crtds').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
		</script>						