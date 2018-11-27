<link href="css/datepicker.css" rel='stylesheet'>

<script src="js/bootstrap-datepicker.js"/>
<div class="box col-md-12">
	<div class="box-inner">
		<div class="SearchRes">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i>   opening balance Detail</h2>
				
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			
			
			<div class="alert alert-info">
				<div class="form-group">
					<label class="col-sm-2 control-label"> DATE</label>
					<div class="col-md-4 date">
						<div class="input-group input-append date" id="datePicker">
							<input type="text" class="form-control datepicker" name="pdate" id="pdate"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
							<span class="input-group-addon add-on">
								<span class="glyphicon glyphicon-calendar">
								</span>
							</span> 
						</div>
					</div>
				</div>
				<input type="button" value="VIEW" class="btn btn-info viewreport" />
				
			</div>
			
			
			<td> <h5><b>Opening Balance:</b> <?php echo $trandaily['opbal']; ?> </h5></td>&nbsp&nbsp&nbsp&nbsp
			<td> <h5><b>Running Balance:</b> <span id="running_balance"><?php //echo $trandaily['runningbal']; ?> </span></h5></td>
			
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
				<thead>
					<tr>
						<th>DATE</th>
						<th>Account number</th>
						<th>perticulars</th>
						<th>CREDIT</th>
						<th>DEBIT</th>
						<th>ADJUSTMENT CREDIT</th>
						<th>ADJUSTMENT DEBIT</th>
						<th>REC. NUM</th>
						<th>VOUCH. NUM</th>
						<th>ADJ NUM</th>
						
						
					</tr>
				</thead>
				
				
				<?php
					$gt_cash_cr = 0;
					$gt_cash_db = 0;
					$gt_adj_cr = 0;
					$gt_adj_db = 0;
				?>
				
				
				<tbody>
					<tr><td colspan="10"><h5><b><center>SB TRANSACTION<center></b></h5></td></tr>
					<?php
						$sb_cash_cr = 0;
						$sb_cash_db = 0;
						$sb_adj_cr = 0;
						$sb_adj_db = 0;
						$sb_cash_cr_total = 0;
						$sb_cash_db_total = 0;
						$sb_adj_cr_total = 0;
						$sb_adj_db_total = 0;
					?>
					@foreach ($trandaily['sb'] as $sb)
						<tr>
							<td>{{ $sb->SBReport_TranDate }}</td>
							<td>{{ $sb->AccNum }}</td>
							<td>{{ $sb->particulars }} - {{$sb->name}}({{$sb->Uid}})</td>
							
							@if($sb->TransactionType=="Credit"||$sb->TransactionType=="CREDIT"||$sb->TransactionType=="credit")
									<?php
										$sb_cash_cr = $sb->Amount;
										$sb_cash_cr_total += $sb_cash_cr;
									?>
								<td><p class="text-right"></p><?php echo $sb_cash_cr; ?></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td>{{ $sb->SB_resp_No }}</td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
							@else
								<?php
									$sb_cash_db=$sb->Amount;
									$sb_cash_db_total += $sb_cash_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $sb_cash_db; ?></p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td>{{ $sb->SB_paymentvoucher_No }}</td>
								<td><p class="text-center">-</p></td>
							@endif
						</tr>
					@endforeach
					
					@foreach ($trandaily['sb_adjust'] as $sb)
						<tr>
							<td>{{ $sb->SBReport_TranDate }}</td>
							<td>{{ $sb->AccNum }}</td>
							<td>{{ $sb->particulars }} - {{ $sb->name }}({{ $sb->Uid }})</td>
							
							@if($sb->TransactionType=="Credit"||$sb->TransactionType=="CREDIT"||$sb->TransactionType=="credit")
								<?php
									$sb_adj_cr = $sb->Amount;
									$sb_adj_cr_total += $sb_adj_cr;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $sb_adj_cr; ?></p></td> 
								<td><p class="text-center">-</p></td>
							@else
								<?php
									$sb_adj_db = $sb->Amount;
									$sb_adj_db_total += $sb_adj_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $sb_adj_db; ?></p></td>
							@endif
							<td><p class="text-center">-</p></td>
							<td><p class="text-center">-</p></td>
							<td>{{ $sb->adj_no }}</td>
						</tr>
					@endforeach
					
					<tr>
						<th colspan =3>SB Total</th>
						<td class="text-right"><?php echo $sb_cash_cr_total ?></td>
						<td class="text-right"><?php echo $sb_cash_db_total ?></td>
						<td class="text-right"><?php echo $sb_adj_cr_total ?></td>
						<td class="text-right"><?php echo $sb_adj_db_total ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $sb_cash_cr_total;
						$gt_cash_db += $sb_cash_db_total;
						$gt_adj_cr += $sb_adj_cr_total;
						$gt_adj_db += $sb_adj_db_total;
					?>



<?php /****************** SB INTEREST PAID********************/ ?>
					<tr><td colspan="10"><h5><b><center>SB INTEREST<center></b></h5></td></tr>
					<?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>

					
					@foreach ($trandaily['sb_int_paid'] as $row)
						<?php
							$amt = $row->Amount;
							$acc_no = $row->AccNum;
							$date = $row->SBReport_TranDate;
							$particulars = $row->particulars;
							$name = $row->name;
							$uid = $row->Uid;
							$rv_cr = "";
							$rv_db = "";
							$rv_adj = "";
						?>
										<?php
											$adj_db = $amt;
											$adj_db_total += $adj_db;
										?>
										<tr>
											<td>{{$date}}</td>
											<td>{{$acc_no}}</td>
											<td>{{$particulars}} - {{ $name }}({{$uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $adj_db }}</td>
											<td>{{$rv_cr}}</td>
											<td>{{$rv_db}}</td>
											<td>{{$rv_adj}}</td>
										</tr>
					@endforeach

					<tr>
						<th colspan="3">Total SB INTEREST</th>
						<td><?php echo $cash_cr_total; ?></td>
						<td><?php echo $cash_db_total; ?></td>
						<td><?php echo $adj_cr_total; ?></td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $cash_cr_total;
						$gt_cash_db += $cash_db_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>
<?php /****************** SB INTEREST PAID********************/ ?>







<?php /****************** RD TRANSACTION ********************/ ?>
					<tr><td colspan="10"><h5><b><center>RD TRANSACTION<center></b></h5></td></tr>
					<?php
						$rd_cash_cr = 0;
						$rd_cash_db = 0;
						$rd_adj_cr = 0;
						$rd_adj_db = 0;
						$rd_cash_cr_total = 0;
						$rd_cash_db_total = 0;
						$rd_adj_cr_total = 0;
						$rd_adj_db_total = 0;
					?>
				<?php /****************** RD TRAN ********************/ ?>
					@foreach ($trandaily['rd'] as $rd)
						<tr>	
							<td>{{ $rd->RDReport_TranDate }}</td>
							<td>{{ $rd->AccNum }}</td>
							<td>{{ $rd->RD_Particulars }} - {{ $rd->name }}({{ $rd->Uid }})</td>
									
							@if($rd->RD_Trans_Type=="Credit"||$rd->RD_Trans_Type=="CREDIT"||$rd->RD_Trans_Type=="credit"&&$rd->RDPayment_Mode=="CASH")
								<?php
									$rd_cash_cr = $rd->RD_Amount;
									$rd_cash_cr_total += $rd_cash_cr;
								?>
								<td><p class="text-right"><?php echo $rd_cash_cr; ?></p></td> 
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
							@else ($rd->RD_Trans_Type=="Debit"||$rd->RD_Trans_Type=="DEBIT"||$rd->RD_Trans_Type=="debit"&&$rd->RDPayment_Mode=="CASH")
								<?php
									$rd_cash_db = $rd->RD_Amount;
									$rd_cash_db_total += $rd_cash_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $rd_cash_db; ?></p></td> 
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>	
							@endif
							<td>{{ $rd->RD_resp_No}}</td>
							<td>-</td>
						</tr>
					@endforeach
					
					@foreach ($trandaily['rd_adjust'] as $rd)
						<tr>	
							<td>{{ $rd->RDReport_TranDate }}</td>
							<td>{{ $rd->AccNum }}</td>
							<td>{{ $rd->RD_Particulars }} - {{ $rd->name }}({{$rd->Uid}})</td>
									
							@if($rd->RD_Trans_Type=="Credit"||$rd->RD_Trans_Type=="CREDIT"||$rd->RD_Trans_Type=="credit"&&$rd->RDPayment_Mode=="CASH")
								<?php
									$rd_adj_cr = $rd->RD_Amount;
									$rd_adj_cr_total += $rd_adj_cr;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $rd_adj_cr; ?></p></td>
								<td><p class="text-center">-</p></td>
							@elseif ($rd->RD_Trans_Type=="Debit"||$rd->RD_Trans_Type=="DEBIT"||$rd->RD_Trans_Type=="debit"&&$rd->RDPayment_Mode=="CASH")
								<?php
									$rd_adj_db = $rd->RD_Amount;
									$rd_adj_db_total += $rd_adj_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>	
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $rd_adj_db; ?></p></td>
							@endif
							<td>-</td>
							<td>-</td>
							<td>{{ $rd->adj_no }}</td>
						</tr>
					@endforeach
				<?php /****************** RD TRAN ********************/ ?>
				<?php /****************** RD PAY AMT ********************/ ?>
					@foreach ($trandaily['rdpayamt'] as $rdamt)
						@if(strcasecmp($rdamt->RDPayAmt_PaymentMode, 'CASH') == 0)
							<?php
								$rd_cash_db = $rdamt->RDPayAmt_PayableAmount;
								$rd_cash_db_total += $rd_cash_db;
							?>
							<tr>
								<td>{{ $rdamt->RDPayAmtReport_PayDate }}</td>
								<td>{{ $rdamt->RDPayAmt_AccNum }}</td>
								<td>RD Paid Amount - {{ $rdamt->name }}({{ $rdamt->Uid }})</td>
								<td>-</td>
								<td>{{ $rdamt->RDPayAmt_PayableAmount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $rdamt->RD_PayAmount_pamentvoucher }}</td>
							</tr>
						@else
							<?php
								$rd_adj_db = $rdamt->RDPayAmt_PayableAmount;
								$rd_adj_db_total += $rd_adj_db;
							?>
							<tr>
								<td>{{ $rdamt->RDPayAmtReport_PayDate }}</td>
								<td>{{ $rdamt->RDPayAmt_AccNum }}</td>
								<td>RD Paid Amount</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $rdamt->RDPayAmt_PayableAmount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $rdamt->adj_no }}</td>
							</tr>
						@endif
					@endforeach
				<?php /****************** RD PAY AMT ********************/ ?>
				<tr>
					<th colspan =3>RD Total</th>
					<td class="text-right"><?php echo $rd_cash_cr_total ?></td>
					<td class="text-right"><?php echo $rd_cash_db_total ?></td>
					<td class="text-right"><?php echo $rd_adj_cr_total ?></td>
					<td class="text-right"><?php echo $rd_adj_db_total ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $rd_cash_cr_total;
					$gt_cash_db += $rd_cash_db_total;
					$gt_adj_cr += $rd_adj_cr_total;
					$gt_adj_db += $rd_adj_db_total;
				?>
<?php /****************** RD TRANSACTION ********************/ ?>



					
					
<?php /****************** RD INTEREST ********************/ ?>
					<tr><td colspan="10"><h5><b><center>RD INTEREST<center></b></h5></td></tr>
					<?php
						$rd_cash_cr = 0;
						$rd_cash_db = 0;
						$rd_adj_cr = 0;
						$rd_adj_db = 0;
						$rd_cash_cr_total = 0;
						$rd_cash_db_total = 0;
						$rd_adj_cr_total = 0;
						$rd_adj_db_total = 0;
					?>
					<?php /****************** RD PAY AMT - INTEREST ********************/ ?>
						@foreach ($trandaily['rdpayamt'] as $rdamt)
							@if(strcasecmp($rdamt->RDPayAmt_PaymentMode, 'CASH') == 0)
								<?php
									$rd_cash_db = $rdamt->Interest_Amt;
									$rd_cash_db_total += $rd_cash_db;
								?>
								<tr>
									<td>{{ $rdamt->RDPayAmtReport_PayDate }}</td>
									<td>{{ $rdamt->RDPayAmt_AccNum }}</td>
									<td>RD Paid Amount - {{ $rdamt->name }}({{ $rdamt->Uid }})</td>
									<td>-</td>
									<td>{{ $rdamt->Interest_Amt }}</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>{{ $rdamt->RD_PayAmount_pamentvoucher }}</td>
								</tr>
							@else
								<?php
									$rd_adj_db = $rdamt->Interest_Amt;
									$rd_adj_db_total += $rd_adj_db;
								?>
								<tr>
									<td>{{ $rdamt->RDPayAmtReport_PayDate }}</td>
									<td>{{ $rdamt->RDPayAmt_AccNum }}</td>
									<td>RD Paid Amount</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>{{ $rdamt->Interest_Amt }}</td>
									<td>-</td>
									<td>-</td>
									<td>{{ $rdamt->adj_no }}</td>
								</tr>
							@endif
						@endforeach
					<?php /****************** RD PAY AMT - INTEREST ********************/ ?>
				<tr>
					<th colspan =3>RD INTEREST TOTAL</th>
					<td class="text-right"><?php echo $rd_cash_cr_total ?></td>
					<td class="text-right"><?php echo $rd_cash_db_total ?></td>
					<td class="text-right"><?php echo $rd_adj_cr_total ?></td>
					<td class="text-right"><?php echo $rd_adj_db_total ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $rd_cash_cr_total;
					$gt_cash_db += $rd_cash_db_total;
					$gt_adj_cr += $rd_adj_cr_total;
					$gt_adj_db += $rd_adj_db_total;
				?>
<?php /****************** RD INTEREST ********************/ ?>




				<?php /********************** PG ************************/?>
					<tr><td colspan="10"><h5><b><center>PIGMY TRANSACTION<center></b></h5></td></tr>
					<?php
						$pigmy_cash_cr = 0;
						$pigmy_cash_db = 0;
						$pigmy_adj_cr = 0;
						$pigmy_adj_db = 0;
						$pigmy_cash_cr_total = 0;
						$pigmy_cash_db_total = 0;
						$pigmy_adj_cr_total = 0;
						$pigmy_adj_db_total = 0;
					?>

					<?php /********************** PG TRAN ************************/?>
					@foreach ($trandaily['pigmycash'] as $pigmy)
						<tr>
							<td>{{ $pigmy->PigReport_TranDate }}</td>
							<td>{{ $pigmy->PigmiAcc_No }}</td>
							<td>{{ $pigmy->Particulars }} - {{ $pigmy->name }}({{ $pigmy->Uid }})</td>
									
							@if($pigmy->Transaction_Type=="Credit"||$pigmy->Transaction_Type=="CREDIT"||$pigmy->Transaction_Type=="credit")
								<?php
									$pigmy_cash_cr = $pigmy->Amount;
									$pigmy_cash_cr_total += $pigmy_cash_cr;
								?>
								<td><p class="text-right"><?php echo $pigmy_cash_cr; ?></p></td> 
								<td><p class="text-center">-</p></td>
							@else
								<?php
									$pigmy_cash_db = $pigmy->Amount;
									$pigmy_cash_db_total += $pigmy_cash_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $pigmy_cash_db; ?></p></td>
							@endif
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmy->	Pigmy_resp_No}}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					
					@foreach ($trandaily['pigmy'] as $pigmy)
						<tr>
							<td>{{ $pigmy->PigReport_TranDate }}</td>
							<td>{{ $pigmy->PigmiAcc_No }}</td>
							<td>{{ $pigmy->Particulars }} - {{ $pigmy->name }}({{ $pigmy->Uid }})</td>
							<td>-</td>
							<td>-</td>
							
							@if($pigmy->Transaction_Type=="Credit"||$pigmy->Transaction_Type=="CREDIT"||$pigmy->Transaction_Type=="credit")
								<?php
									$pigmy_adj_cr = $pigmy->Amount;
									$pigmy_adj_cr_total += $pigmy_adj_cr;
								?>
								<td><p class="text-right"><?php echo $pigmy_adj_cr; ?></p></td> 
								<td><p class="text-center">-</p></td>
							@else
								<?php
									$pigmy_adj_db = $pigmy->Amount;
									$pigmy_adj_db_total += $pigmy_adj_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $pigmy_adj_db; ?></p></td>
							@endif
							<td>{{ $pigmy->	Pigmy_resp_No}}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					
					@foreach ($trandaily['pigmy_service_charge'] as $pigmy)
						<tr>
							<td>{{ $pigmy->PigReport_TranDate }}</td>
							<td>{{ $pigmy->PigmiAcc_No }}</td>
							<td>{{ $pigmy->Particulars }} - {{ $pigmy->name }}({{ $pigmy->Uid }})</td>
							<td>-</td>
							<td>-</td>
							
								<?php
									$pigmy_adj_db = $pigmy->Amount;
									$pigmy_adj_db_total += $pigmy_adj_db;
								?>
								<td><p class="text-center">-</p></td>
								<td><p class="text-right"><?php echo $pigmy_adj_db; ?></p></td> 
								
							<td>{{ $pigmy->	Pigmy_resp_No}}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					<?php /********************** PG TRAN ************************/?>

					<?php /********************** PG PAY ************************/?>
					@foreach ($trandaily['pigmypayamt'] as $pigmyamt)	<?php /* CASH - INTEREST */?>
						<?php
							$pigmy_cash_db = $pigmyamt->PayAmount_PayableAmount;
							if($pigmy_cash_db <= 0) {
								continue;
							}
							$pigmy_cash_db_total += $pigmy_cash_db;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Paid Amount - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PayableAmount }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PaymentVoucher }}</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['pigmypayamt_per'] as $pigmyamt) <?php /* CASH - PREWITHDRAWAL */?>
						<?php
							$pigmy_cash_db = $pigmyamt->PgmTotal_Amt;
							if($pigmy_cash_db <= 0) {
								continue;
							}
							$pigmy_cash_db_total += $pigmy_cash_db;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Paid Amount - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>-</td>
							<td>{{ $pigmyamt->PgmTotal_Amt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PaymentVoucher }}</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['pigmypayamt_adjust'] as $pigmyamt) <?php /* ADJUSTMENT - INTEREST */?>
						<?php
							$pigmy_adj_db = $pigmyamt->PayAmount_PayableAmount;
							if($pigmy_adj_db <= 0) {
								continue;
							}
							$pigmy_adj_db_total += $pigmy_adj_db;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Paid Amount - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PayableAmount }}</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->adj_no }}</td>
						</tr>
					@endforeach
					@foreach ($trandaily['pigmypayamt_per_adjust'] as $pigmyamt) <?php /* ADJUSTMENT - PREWITHDRAWAL */?>
						<?php
							$pigmy_adj_db = $pigmyamt->PayAmount_PayableAmount;
							if($pigmy_adj_db <= 0) {
								continue;
							}
							$pigmy_adj_db_total += $pigmy_adj_db;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Paid Amount - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PayableAmount }}</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->adj_no }}</td>
						</tr>
					@endforeach
		<?php /*	@foreach ($trandaily['show_pigmicharg'] as $pigmyamt) < ?php // CASH - PREWITHDRAWAL - DEDUCT COMMISSION ?>
						< ?php
							$pigmypay_cash_cr = $pigmyamt->Deduct_Commission;
							if($pigmypay_cash_cr <= 0) {
								continue;
							}
							$pigmypay_cash_cr_total += $pigmypay_cash_cr;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Pay Deduct Commission - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>{{ $pigmyamt->Deduct_Commission }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PaymentVoucher }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['show_pigmicharg'] as $pigmyamt) < ?php // CASH - PREWITHDRAWAL - DEDUCT AMOUNT ?>
						< ?php
							$pigmypay_cash_cr = $pigmyamt->Deduct_Amount;
							if($pigmypay_cash_cr <= 0) {
								continue;
							}
							$pigmypay_cash_cr_total += $pigmypay_cash_cr;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Pay Deduct Amount - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>{{ $pigmyamt->Deduct_Amount }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->PayAmount_PaymentVoucher }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['show_pigmicharg_adjust'] as $pigmyamt) < ?php // ADJUSTMENT - PREWITHDRAWAL - DEDUCT COMMISSION ?>
						< ?php
							$pigmypay_adj_cr = $pigmyamt->Deduct_Commission;
							if($pigmypay_adj_cr <= 0) {
								continue;
							}
							$pigmypay_adj_cr_total += $pigmypay_adj_cr;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Pay Deduct Commission - {{ $pigmyamt->name }}({{ $pigmyamt->Uid }})</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->Deduct_Commission }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->adj_no }}</td>
						</tr>
					@endforeach
					@foreach ($trandaily['show_pigmicharg_adjust'] as $pigmyamt) < ?php // ADJUSTMENT - PREWITHDRAWAL - DEDUCT AMOUNT ?>
						< ?php
							$pigmypay_adj_cr = $pigmyamt->Deduct_Amount;
							if($pigmypay_adj_cr <= 0) {
								continue;
							}
							$pigmypay_adj_cr_total += $pigmypay_adj_cr;
						?>
						<tr>
							<td>{{ $pigmyamt->PayAmountReport_PayDate }}</td>
							<td>{{ $pigmyamt->PayAmount_PigmiAccNum }}</td>
							<td>Pigmy Pay Deduct Amount</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->Deduct_Amount }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $pigmyamt->adj_no }}</td>
						</tr>
					@endforeach  
*/?>
					<?php /********************** PG PAY ************************/?>
					
					<tr>
						<th colspan =3>Pigmy Total</th>
						<td class="text-right"><?php echo $pigmy_cash_cr_total ?></td>
						<td class="text-right"><?php echo $pigmy_cash_db_total ?></td>
						<td class="text-right"><?php echo $pigmy_adj_cr_total ?></td>
						<td class="text-right"><?php echo $pigmy_adj_db_total ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $pigmy_cash_cr_total;
						$gt_cash_db += $pigmy_cash_db_total;
						$gt_adj_cr += $pigmy_adj_cr_total;
						$gt_adj_db += $pigmy_adj_db_total;
					?>
				<?php /********************** PG ************************/?>


					
					
					


				<?php /****************** FD ****************/?>
					<tr><td colspan="10"><h5><b><center>FD TRANSACTION<center></b></h5></td></tr>
					<?php
						$fd_cash_cr = 0;
						$fd_adj_cr = 0;
						$fd_cash_db = 0;
						$fd_adj_db = 0;
						
						$fd_cash_cr_total = 0;
						$fd_adj_cr_total = 0;
						$fd_cash_db_total = 0;
						$fd_adj_db_total = 0;
					?>
					<?php /***************** FD ALLOCATION *******************/?>
					@foreach ($trandaily['fdallocamt'] as $fdamt)
						<?php
							$fd_cash_cr = $fdamt->Fd_DepositAmt;
							$fd_cash_cr_total += $fd_cash_cr;
						?>
						<tr>
							<td>{{ $fdamt->Created_Date }}</td>
							<td>{{ $fdamt->Fd_CertificateNum }}</td>
							<td>FD Deposit Amount - {{ $fdamt->name }}({{ $fdamt->Uid }})</td>
							<td>{{ $fdamt->Fd_DepositAmt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $fdamt->FD_resp_No }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach	
					@foreach ($trandaily['fdallocamt_adjust'] as $fdamt)
						<?php
							$fd_adj_cr = $fdamt->Fd_DepositAmt;
							$fd_adj_cr_total += $fd_adj_cr;
						?>
						<tr>
							<td>{{ $fdamt->Created_Date }}</td>
							<td>{{ $fdamt->Fd_CertificateNum }}</td>
							<td>FD Deposit Amount - {{ $fdamt->name }}({{ $fdamt->Uid }})</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $fdamt->Fd_DepositAmt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $fdamt->adj_no }}</td>
						</tr>
					@endforeach
					<?php /***************** FD ALLOCATION *******************/?>
					
					<?php /***************** FD PAID AMT *******************/?>
					@foreach ($trandaily['fdpayamt'] as $fdpayamt)
						@if($fdpayamt->FdTid != 1)
							<?php
								$fd_cash_db = $fdpayamt->FDPayAmt_PayableAmount;
								$fd_cash_db_total += $fd_cash_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>FD Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>{{ $fdpayamt->FDPayAmt_PayableAmount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->FD_PayAmount_pamentvoucher }}</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach
					@foreach ($trandaily['fdpayamt_adjust'] as $fdpayamt)
						@if($fdpayamt->FdTid != 1)
							<?php
								$fd_adj_db = $fdpayamt->FDPayAmt_PayableAmount;
								$fd_adj_db_total += $fd_adj_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>FD Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->FDPayAmt_PayableAmount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					<?php /***************** FD PAID AMT *******************/?>

					<tr>
						<th colspan =3>Total FD Amount </th>
						<td><?php echo $fd_cash_cr_total; ?></td>
						<td><?php echo $fd_cash_db_total; ?></td>
						<td><?php echo $fd_adj_cr_total; ?></td>
						<td><?php echo $fd_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $fd_cash_cr_total;
						$gt_adj_cr += $fd_adj_cr_total;
						$gt_cash_db += $fd_cash_db_total;
						$gt_adj_db += $fd_adj_db_total;
					?>
				<?php /****************** FD ****************/?>






				
				<?php /****************** FD INTEREST ****************/?>
					<tr><td colspan="10"><h5><b><center>FD INTEREST<center></b></h5></td></tr>
					<?php
						$fd_cash_cr = 0;
						$fd_adj_cr = 0;
						$fd_cash_db = 0;
						$fd_adj_db = 0;
						
						$fd_cash_cr_total = 0;
						$fd_adj_cr_total = 0;
						$fd_cash_db_total = 0;
						$fd_adj_db_total = 0;
					?>
					
					
					<?php /***************** FD PAID AMT - INTEREST *******************/?>
					@foreach ($trandaily['fdpayamt'] as $fdpayamt)
						@if($fdpayamt->FdTid != 1)
							<?php
								$fd_cash_db = $fdpayamt->interest_amount;
								if($fd_cash_db == 0) {
									continue;
								}
								$fd_cash_db_total += $fd_cash_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>FD Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>{{ $fdpayamt->interest_amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->FD_PayAmount_pamentvoucher }}</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach
					@foreach ($trandaily['fdpayamt_adjust'] as $fdpayamt)
						@if($fdpayamt->FdTid != 1)
							<?php
								$fd_adj_db = $fdpayamt->interest_amount;
								if($fd_adj_db == 0) {
									continue;
								}
								$fd_adj_db_total += $fd_adj_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>FD Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->interest_amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					<?php /***************** FD PAID AMT - INTEREST *******************/?>
					<?php /***************** FD monthly int *******************/?>
						@foreach ($trandaily['fd_monthly_int'] as $row)
							<?php
								$fd_adj_db = $row->amount;
								$fd_adj_db_total += $fd_adj_db;
							?>
							<tr>
								<td>{{$row->FD_Date}}</td>
								<td>{{$row->fdnum}}</td>
								<td>FD Interest  - {{ $row->name }}({{$row->Uid}})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->amount}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endforeach
						<?php /***************** FD monthly int *******************/?>

					<tr>
						<th colspan =3>Total FD INTEREST AMOUNT </th>
						<td><?php echo $fd_cash_cr_total; ?></td>
						<td><?php echo $fd_cash_db_total; ?></td>
						<td><?php echo $fd_adj_cr_total; ?></td>
						<td><?php echo $fd_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $fd_cash_cr_total;
						$gt_adj_cr += $fd_adj_cr_total;
						$gt_cash_db += $fd_cash_db_total;
						$gt_adj_db += $fd_adj_db_total;
					?>
				<?php /****************** FD INTEREST ****************/?>
					

					


				<?php /****************** KCC ****************/?>
					<tr><td colspan="10"><h5><b><center>KCC TRANSACTION<center></b></h5></td></tr>
					<?php
						$fd_cash_cr = 0;
						$fd_adj_cr = 0;
						$fd_cash_db = 0;
						$fd_adj_db = 0;
						
						$fd_cash_cr_total = 0;
						$fd_adj_cr_total = 0;
						$fd_cash_db_total = 0;
						$fd_adj_db_total = 0;
					?>
					
					<?php /****************** KCC ALLOCATION ****************/?>
					@foreach ($trandaily['kccallocamt'] as $fdamt)
						<?php
							$fd_cash_cr = $fdamt->Fd_DepositAmt;
							$fd_cash_cr_total += $fd_cash_cr;
						?>
						<tr>
							<td>{{ $fdamt->Created_Date }}</td>
							<td>{{ $fdamt->Fd_CertificateNum }}</td>
							<td>KCC Deposit Amount - {{ $fdamt->name }}({{ $fdamt->Uid }})</td>
							<td>{{ $fdamt->Fd_DepositAmt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $fdamt->FD_resp_No }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach	
					@foreach ($trandaily['kccallocamt_adjust'] as $fdamt)
						<?php
							$fd_adj_cr = $fdamt->Fd_DepositAmt;
							$fd_adj_cr_total += $fd_adj_cr;
						?>
						<tr>
							<td>{{ $fdamt->Created_Date }}</td>
							<td>{{ $fdamt->Fd_CertificateNum }}</td>
							<td>KCC Deposit Amount</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $fdamt->Fd_DepositAmt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $fdamt->adj_no }}</td>
						</tr>
					@endforeach
					<?php /****************** KCC ALLOCATION ****************/?>

					<?php /****************** KCC PAID AMT ****************/?>
					@foreach ($trandaily['fdpayamt'] as $fdpayamt)
						@if($fdpayamt->FdTid == 1)
							<?php
								$fd_cash_db = $fdpayamt->FDPayAmt_PayableAmount;
								$fd_cash_db_total += $fd_cash_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>KCC Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>{{ $fdpayamt->FDPayAmt_PayableAmount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->FD_PayAmount_pamentvoucher }}</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach
					@foreach ($trandaily['fdpayamt_adjust'] as $fdpayamt)
						@if($fdpayamt->FdTid == 1)
							<?php
								$fd_adj_db = $fdpayamt->FDPayAmt_PayableAmount;
								$fd_adj_db_total += $fd_adj_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>KCC Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->FDPayAmt_PayableAmount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					<?php /****************** KCC PAID AMT ****************/?>

					<tr>
						<th colspan =3>Total KCC Amount</th>
						<td>-</td>
						<td><?php echo $fd_cash_db_total; ?></td>
						<td><?php echo $cash_db_total; ?></td>
						<td><?php echo $fd_adj_db_total; ?></td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $fd_cash_cr_total;
						$gt_adj_cr += $fd_adj_cr_total;
						$gt_cash_db += $fd_cash_db_total;
						$gt_adj_db += $fd_adj_db_total;
					?>
				<?php /****************** KCC ****************/?>



				
				<?php /****************** KCC INTEREST ****************/?>
					<tr><td colspan="10"><h5><b><center>KCC INTEREST<center></b></h5></td></tr>
					<?php
						$fd_cash_cr = 0;
						$fd_adj_cr = 0;
						$fd_cash_db = 0;
						$fd_adj_db = 0;
						
						$fd_cash_cr_total = 0;
						$fd_adj_cr_total = 0;
						$fd_cash_db_total = 0;
						$fd_adj_db_total = 0;
					?>
					
					
					<?php /***************** KCC PAID AMT - INTEREST *******************/?>
					@foreach ($trandaily['fdpayamt'] as $fdpayamt)
						@if($fdpayamt->FdTid == 1)
							<?php
								$fd_cash_db = $fdpayamt->interest_amount;
								$fd_cash_db_total += $fd_cash_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>FD Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>{{ $fdpayamt->interest_amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->FD_PayAmount_pamentvoucher }}</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach
					@foreach ($trandaily['fdpayamt_adjust'] as $fdpayamt)
						@if($fdpayamt->FdTid == 1)
							<?php
								$fd_adj_db = $fdpayamt->interest_amount;
								$fd_adj_db_total += $fd_adj_db;
							?>
							<tr>
								<td>{{ $fdpayamt->FDPayAmtReport_PayDate }}</td>
								<td>{{ $fdpayamt->FDPayAmt_AccNum }}</td>
								<td>KCC Paid Amount - {{ $fdpayamt->name }}({{ $fdpayamt->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->interest_amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $fdpayamt->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					<?php /***************** KCC PAID AMT - INTEREST *******************/?>
					<tr>
						<th colspan =3>Total KCC INTEREST AMOUNT </th>
						<td><?php echo $fd_cash_cr_total; ?></td>
						<td><?php echo $fd_cash_db_total; ?></td>
						<td><?php echo $fd_adj_cr_total; ?></td>
						<td><?php echo $fd_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $fd_cash_cr_total;
						$gt_adj_cr += $fd_adj_cr_total;
						$gt_cash_db += $fd_cash_db_total;
						$gt_adj_db += $fd_adj_db_total;
					?>
				<?php /****************** KCC INTEREST ****************/?>
					


					
		
					
				<!------------------ MD PAID AMOUNT  -------------------->
					<tr><td colspan="10"><h5><b><center>MATURITY DEPOSIT PAID AMOUNT<center></b></h5></td></tr>
					<?php
						$cash_db = 0;
						$adj_db = 0;
						
						$cash_db_total = 0;
						$adj_db_total = 0;
					?>
					@foreach ($trandaily['mdpayamt'] as $row)
						@if(strcasecmp($row->payment_mode, "CASH") == 0)
							<?php
								$cash_db = $row->md_amount;
								$cash_db_total += $cash_db;
							?>
							<tr>
								<td>{{$row->md_tran_date}}</td>
								<td>{{$row->md_acc_no}}</td>
								<td>Maturiy dposit Paid Amount - {{ $row->name }}({{ $row->Uid }})</td>
								<td>-</td>
								<td>{{$cash_db}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->voucher_no}}</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$adj_db = $row->md_amount;
								$adj_db_total += $adj_db;
							?>
							<tr>
								<td>{{$row->md_tran_date}}</td>
								<td>{{$row->md_acc_no}}</td>
								<td>Maturiy dposit Paid Amount - {{ $row->name }}({{ $row->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$adj_db}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->adj_no}}</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan=3>MD Amount Paid</th>
						<td>-</td>
						<td><?php echo $cash_db_total; ?></td>
						<td>-</td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_db += $cash_db_total;
						$gt_adj_db += $adj_db_total;
					?>
				<!------------------ MD PAID AMOUNT END -------------------->


					
				<!------------------ CD TRANSACTION  -------------------->
					<tr><td colspan="10"><h5><b><center>CD<center></b></h5></td></tr>
						<?php
							$cash_cr = 0;
							$cash_db = 0;
							$adj_cr = 0;
							$adj_db = 0;
							
							$cash_cr_total = 0;
							$cash_db_total = 0;
							$adj_cr_total = 0;
							$adj_db_total = 0;
						?>
						@foreach ($trandaily['cd_tran'] as $row)
						<?php
							if($row->interest_tran !=  2) {
								if($row->payment_mode == 1) {				//CASH
									if($row->transaction_type == 1)	{					//CASH CREDIT
											$cash_cr = $row->amount;
											$cash_cr_total += $cash_cr;
							?>
										<tr>
											<td>{{$row->date}}</td>
											<td>{{$row->cdsd_acc_no}}</td>
											<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
											<td>{{$cash_cr}}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
							<?php
									} else	{										//CASH DEBIT
							?>
										<?php
											$cash_db = $row->amount;
											$cash_db_total += $cash_db;
										?>
										<tr>
											<td>{{$row->date}}</td>
											<td>{{$row->cdsd_acc_no}}</td>
											<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
											<td>-</td>
											<td>{{$cash_db}}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
							<?php
									}
								} else	{										//ADJUSTMENT
									if($row->transaction_type == 1) {						//ADJUSTMENT CREDIT
											$adj_cr = $row->amount;
											$adj_cr_total += $adj_cr;
							?>
										<tr>
											<td>{{$row->date}}</td>
											<td>{{$row->cdsd_acc_no}}</td>
											<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
											<td>-</td>
											<td>-</td>
											<td>{{$adj_cr}}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
									<?php
										} else {										//ADJUSTMENT DEBIT
									?>
										<?php
											$adj_db = $row->amount;
											$adj_db_total += $adj_db;
										?>
										<tr>
											<td>{{$row->date}}</td>
											<td>{{$row->cdsd_acc_no}}</td>
											<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>{{$adj_db}}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
							<?php	
									}
								}
							}
						?>
						@endforeach
						<tr>
							<th colspan=3>CD Total</th>
							<td><?php echo $cash_cr_total; ?></td>
							<td><?php echo $cash_db_total; ?></td>
							<td><?php echo $adj_cr_total; ?></td>
							<td><?php echo $adj_db_total; ?></td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<?php
							$gt_cash_cr += $cash_cr_total;
							$gt_cash_db += $cash_db_total;
							$gt_adj_cr += $adj_cr_total;
							$gt_adj_db += $adj_db_total;
						?>
				<!------------------ CD TRANSACTION  -------------------->
				<!------------------ CD INTEREST  -------------------->
				<tr><td colspan="10"><h5><b><center>CD INTEREST<center></b></h5></td></tr>
						<?php
							$cash_cr = 0;
							$cash_db = 0;
							$adj_cr = 0;
							$adj_db = 0;
							
							$cash_cr_total = 0;
							$cash_db_total = 0;
							$adj_cr_total = 0;
							$adj_db_total = 0;
						?>
						@foreach ($trandaily['cd_tran'] as $row)
						<?php
							if($row->interest_tran ==  1 || $row->interest_tran ==  2) {
						?>
							<?php
								if($row->payment_mode == 1) {//	CASH DEBIT
							?>
									<?php
										$cash_db = $row->amount;
										$cash_db_total += $cash_db;
									?>
									<tr>
										<td>{{$row->date}}</td>
										<td>{{$row->cdsd_acc_no}}</td>
										<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
										<td>-</td>
										<td>{{$cash_db}}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
							<?php
								} else {	// ADJ DEBIT
							?>
								<?php
									$adj_db = $row->amount;
									$adj_db_total += $adj_db;
								?>
								<tr>
									<td>{{$row->date}}</td>
									<td>{{$row->cdsd_acc_no}}</td>
									<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>{{$adj_db}}</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
							<?php
								}
							?>

						<?php 
							}
						
						?>
						@endforeach
						<tr>
							<th colspan=3>CD Interest Total</th>
							<td><?php echo $cash_cr_total; ?></td>
							<td><?php echo $cash_db_total; ?></td>
							<td><?php echo $adj_cr_total; ?></td>
							<td><?php echo $adj_db_total; ?></td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<?php
							$gt_cash_cr += $cash_cr_total;
							$gt_cash_db += $cash_db_total;
							$gt_adj_cr += $adj_cr_total;
							$gt_adj_db += $adj_db_total;
						?>
				<!------------------ CD INTEREST  -------------------->

					
				<!------------------ SD TRANSACTION  -------------------->
						<tr><td colspan="10"><h5><b><center>SD<center></b></h5></td></tr>
							<?php
								$cash_cr = 0;
								$cash_db = 0;
								$adj_cr = 0;
								$adj_db = 0;
								
								$cash_cr_total = 0;
								$cash_db_total = 0;
								$adj_cr_total = 0;
								$adj_db_total = 0;
							?>
							@foreach ($trandaily['sd_tran'] as $row)
							<?php
								if($row->interest_tran !=  2) {
									if(!($row->user_type == 2 && ($row->interest_tran ==1 || $row->interest_tran ==3) )) {//dont show agent yearly interest
										if($row->payment_mode == 1) {				//CASH
											if($row->transaction_type == 1)	{					//CASH CREDIT
													$cash_cr = $row->amount;
													$cash_cr_total += $cash_cr;
									?>
												<tr>
													<td>{{$row->date}}</td>
													<td>{{$row->cdsd_acc_no}}</td>
													<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
													<td>{{$cash_cr}}</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												</tr>
									<?php
											} else	{										//CASH DEBIT
									?>
												<?php
													$cash_db = $row->amount;
													$cash_db_total += $cash_db;
												?>
												<tr>
													<td>{{$row->date}}</td>
													<td>{{$row->cdsd_acc_no}}</td>
													<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
													<td>-</td>
													<td>{{$cash_db}}</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												</tr>
									<?php
											}
										} else	{										//ADJUSTMENT
											if($row->transaction_type == 1) {						//ADJUSTMENT CREDIT
													$adj_cr = $row->amount;
													$adj_cr_total += $adj_cr;
									?>
												<tr>
													<td>{{$row->date}}</td>
													<td>{{$row->cdsd_acc_no}}</td>
													<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
													<td>-</td>
													<td>-</td>
													<td>{{$adj_cr}}</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												</tr>
											<?php
												} else {										//ADJUSTMENT DEBIT
											?>
												<?php
													$adj_db = $row->amount;
													$adj_db_total += $adj_db;
												?>
												<tr>
													<td>{{$row->date}}</td>
													<td>{{$row->cdsd_acc_no}}</td>
													<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>{{$adj_db}}</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												</tr>
									<?php	
											}
										}
									}
								}
							?>
							@endforeach
							<tr>
								<th colspan=3>SD Total</th>
								<td><?php echo $cash_cr_total; ?></td>
								<td><?php echo $cash_db_total; ?></td>
								<td><?php echo $adj_cr_total; ?></td>
								<td><?php echo $adj_db_total; ?></td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
							<?php
								$gt_cash_cr += $cash_cr_total;
								$gt_cash_db += $cash_db_total;
								$gt_adj_cr += $adj_cr_total;
								$gt_adj_db += $adj_db_total;
							?>
					<!------------------ SD TRANSACTION  -------------------->
					<!------------------ SD INTEREST  -------------------->
					<tr><td colspan="10"><h5><b><center>SD INTEREST<center></b></h5></td></tr>
							<?php
								$cash_cr = 0;
								$cash_db = 0;
								$adj_cr = 0;
								$adj_db = 0;
								
								$cash_cr_total = 0;
								$cash_db_total = 0;
								$adj_cr_total = 0;
								$adj_db_total = 0;
							?>
							@foreach ($trandaily['sd_tran'] as $row)
							<?php
								if($row->interest_tran ==  1 || $row->interest_tran ==  2) {
							?>
								<?php
									if($row->payment_mode == 1) {//	CASH DEBIT
								?>
										<?php
											$cash_db = $row->amount;
											$cash_db_total += $cash_db;
										?>
										<tr>
											<td>{{$row->date}}</td>
											<td>{{$row->cdsd_acc_no}}</td>
											<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
											<td>-</td>
											<td>{{$cash_db}}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
								<?php
									} else {	// ADJ DEBIT
								?>
									<?php
										$adj_db = $row->amount;
										$adj_db_total += $adj_db;
									?>
									<tr>
										<td>{{$row->date}}</td>
										<td>{{$row->cdsd_acc_no}}</td>
										<td>{{$row->particulars}} - {{ $row->name }}({{ $row->Uid }})</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>{{$adj_db}}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								<?php
									}
								?>

							<?php 
								}
							?>
							@endforeach
							<tr>
								<th colspan=3>SD Interest Total</th>
								<td><?php echo $cash_cr_total; ?></td>
								<td><?php echo $cash_db_total; ?></td>
								<td><?php echo $adj_cr_total; ?></td>
								<td><?php echo $adj_db_total; ?></td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
							<?php
								$gt_cash_cr += $cash_cr_total;
								$gt_cash_db += $cash_db_total;
								$gt_adj_cr += $adj_cr_total;
								$gt_adj_db += $adj_db_total;
							?>
					<!------------------ SD INTEREST  -------------------->


					



					
					<tr><td colspan="10"><h5><b><center>Share Allocated<center></b></h5></td></tr>
					<?php
						$share_cash_cr = 0;
						$share_cash_cr_total = 0;
					?>
					@foreach ($trandaily['share'] as $share)
						<?php
							$share_cash_cr = $share->PURSH_Totalamt;
							$share_cash_cr_total += $share_cash_cr;
						?>
						<tr>
							<td>{{ $share->PURSH_Date }}</td>
							<td>{{ $share->PURSH_Memshareid }}</td>
							<td>Purchased Shares - {{ $share->name }}({{ $share->Uid }})</td>
							<td>{{ $share->PURSH_Totalamt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$share->PURSH_Share_resp_no}}</td>
							<td>-</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total Shares Amount </th>
						<td><?php echo $share_cash_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $share_cash_cr_total;
					?>
							
							
							
							
							
					<tr><td colspan="10"><h5><b><center>Member Allocated<center></b></h5></td></tr>
					<?php
						$member_cash_cr = 0;
						$member_cash_cr_total = 0;
					?>
					@foreach ($trandaily['membshare'] as $membshare)
						<?php
							$member_cash_cr = $membshare->Member_Fee;
							$member_cash_cr_total += $member_cash_cr;
						?>
						<tr>
							<td>{{ $membshare->CreatedDate }}</td>
							<td>{{ $membshare->Memid }}</td>
							<td>Member Fees - {{ $membshare->name }}({{$membshare->Uid}})</td>
							<td>{{ $membshare->Member_Fee }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $membshare->member_resp_no }}</td>
							<td>-</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total Member Fee </th>
						<td><?php echo $member_cash_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $member_cash_cr_total;
					?>
					
					
					
<?php /*
					<tr><td colspan="10"><h5><b><center>D Class<center></b></h5></td></tr>
					< ?php
						$classd_cash_cr = 0;
						$classd_cash_cr_total = 0;
					?>
					@foreach ($trandaily['classd'] as $classd)
						< ?php
							$classd_cash_cr = $classd->Customer_Fee;
							$classd_cash_cr_total += $classd_cash_cr;
						?>
						<tr>
							<td>{{ $classd->Created_on }}</td>
							<td>{{ $classd->FirstName }}</td>
							<td>Class D Fees- {{ $classd->name }}({{$classd->Uid}})</td>
							<td>{{ $classd->Customer_Fee }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $classd->Customer_ReceiptNum }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total D class Fee </th>
						<td>< ?php echo $classd_cash_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					< ?php
						$gt_cash_cr += $classd_cash_cr_total;
					?>
*/?>






					<tr><td colspan="10"><h5><b><center>Expense<center></b></h5></td></tr>
					<?php
						$exp_cash_db = 0;
						$exp_adj_db = 0;
						$exp_cash_db_total = 0;
						$exp_adj_db_total = 0;
					?>
					@foreach ($trandaily['expence'] as $expencetran)
						@if(strcasecmp($expencetran->pay_mode, 'INHAND') == 0)
							<?php
								$exp_cash_db = $expencetran->amount;
								$exp_cash_db_total += $exp_cash_db;
							?>
							<tr>
								<td>{{ $expencetran->e_date }}</td>
								<td>{{ $expencetran->lname }}</td>
								<td>{{ $expencetran->Particulars }}</td>
								<td>-</td>
								<td>{{ $expencetran->amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $expencetran->Expence_PamentVoucher }}</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$exp_adj_db = $expencetran->amount;
								$exp_adj_db_total += $exp_adj_db;
							?>
							<tr>
								<td>{{ $expencetran->e_date }}</td>
								<td>{{ $expencetran->lname }}</td>
								<td>{{ $expencetran->Particulars }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $expencetran->amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $expencetran->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					@foreach ($trandaily['staff_addition_ta'] as $row)
						@if(strcasecmp($row->pay_mode, 'INHAND') == 0)
							<?php
								$exp_cash_db = $row->salpay_extra_amt;
								$exp_cash_db_total += $exp_cash_db;
							?>
							<tr>
								<td>{{ $row->date }}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
								<td>{{ $row->sal_extra_name }}</td>
								<td>-</td>
								<td>{{ $row->salpay_extra_amt }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$exp_adj_db = $row->salpay_extra_amt;
								$exp_adj_db_total += $exp_adj_db;
							?>
							<tr>
								<td>{{ $row->date }}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
								<td>{{ $row->sal_extra_name }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $row->salpay_extra_amt }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total expence </th>
						<td>-</td>
						<td><?php echo $exp_cash_db_total; ?></td>
						<td>-</td>
						<td><?php echo $exp_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_db += $exp_cash_db_total;
						$gt_adj_db += $exp_adj_db_total;
					?>
						
						
						
						
						
					<tr><td colspan="10"><h5><b><center>Other Income<center></b></h5></td></tr>
					<?php
						$inc_cash_cr = 0;
						$inc_adj_cr = 0;
						$inc_cash_cr_total = 0;
						$inc_adj_cr_total = 0;
					?>
					@foreach ($trandaily['income'] as $income)
						@if(strcasecmp($income->Income_pay_mode, 'INHAND') == 0)
							<?php
								$inc_cash_cr = $income->Income_amount;
								$inc_cash_cr_total += $inc_cash_cr;
							?>
							<tr>
								<td>{{ $income->Income_date }}</td>
								<td>{{ $income->lname }}</td>
								<td>{{ $income->Income_Particulars }}</td>
								<td>{{ $income->Income_amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $income->Income_Expence_PamentVoucher }}</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$inc_adj_cr = $income->Income_amount;
								$inc_adj_cr_total += $inc_adj_cr;
							?>
							<tr>
								<td>{{ $income->Income_date }}</td>
								<td>{{ $income->lname }}</td>
								<td>{{ $income->Income_Particulars }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $income->Income_amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $income->adj_no }}</td>
							</tr>
						@endif
					@endforeach

<?php /*
					< ?php /****************** FROM JL ALLOCATION ******************* / ?>
					@foreach ($trandaily['jewel_charges'] as $row)
						< ?php if(strcasecmp($row->JewelLoan_PaymentMode, "CASH")  == 0 || strcasecmp($row->JewelLoan_PaymentMode, "INHAND") ==0) {?><?php //CASH ?>
										< ?php
											$inc_cash_cr = $row->JewelLoan_OtherCharge;
											$inc_cash_cr_total += $inc_cash_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>{{ $inc_cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
								< ?php /*	<td>{{ $row->receipt_voucher_no }}</td> * /?>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php  } else { ?>< ?php //ADJ ?>
										< ?php
											$inc_adj_cr = $row->JewelLoan_OtherCharge;
											$inc_adj_cr_total += $inc_adj_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $inc_adj_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
						< php } ?>
					@endforeach
					< ?php /****************** FROM JL ALLOCATION ******************* / ?>

					< ?php /****************** FROM PG PREWITHDRAWAL Deduct_Amount ******************* / ?>
					@foreach ($trandaily['pg_prewithdrawal_charges'] as $row)
						< ?php if(strcasecmp($row->PayAmount_PaymentMode, "CASH")  == 0 || strcasecmp($row->PayAmount_PaymentMode, "INHAND") ==0) {?><?php //CASH ?>
										< ?php
											$inc_cash_cr = $row->Deduct_Amount;
											if($inc_cash_cr <= 0) {
												continue;
											}
											$inc_cash_cr_total += $inc_cash_cr;
										?>
										<tr>
											<td title="{{$row->PgmPrewithdraw_ID}}" >{{ $row->Withdraw_Date }}</td>
											<td>{{ $row->PigmiAcc_No }}</td>
											<td>PG DEDUCT AMOUNT - {{ $row->name }}({{$row->Uid}})</td>
											<td>{{ $inc_cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
								< ?php /*	<td>{{ $row->receipt_voucher_no }}</td> * /?>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php  } else { ?>< ?php //ADJ ?>
										< ?php
											$inc_adj_cr = $row->Deduct_Amount;
											if($inc_adj_cr <= 0) {
												continue;
											}
											$inc_adj_cr_total += $inc_adj_cr;
										?>
										<tr>
											<td title="{{$row->PgmPrewithdraw_ID}}" >{{ $row->Withdraw_Date }}</td>
											<td>{{ $row->PigmiAcc_No }}</td>
											<td>PG DEDUCT AMOUNT - {{ $row->name }}({{$row->Uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $inc_adj_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php } ?>
					@endforeach
					< ?php /****************** FROM PG PREWITHDRAWAL Deduct_Amount ******************* / ?>
*/?>
					
					<tr>
						<th colspan =3>Total Income </th>
						<td><?php echo $inc_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $inc_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $inc_cash_cr_total;
						$gt_adj_cr += $inc_adj_cr_total;
					?>
					
					
					
					
					
					<tr><td colspan="10"><h5><b><center>DL Allocated<center></b></h5></td></tr>
					<?php
						$dl_cash_cr = 0;
						$dl_cash_db = 0;
						$dl_adj_cr = 0;
						$dl_adj_db = 0;
						$dl_cash_cr_total = 0;
						$dl_cash_db_total = 0;
						$dl_adj_cr_total = 0;
						$dl_adj_db_total = 0;
					?>
					@foreach ($trandaily['dlallocation'] as $dlallocation)
						<?php
							$dl_cash_db = $dlallocation->DepLoan_LoanAmount;
							$dl_cash_db_total += $dl_cash_db;
						?>
						<tr>
							<td>{{ $dlallocation->DepLoan_LoanStartDate }}</td>
							<td>{{ $dlallocation->DepLoan_LoanNum }}</td>
							<td>{{ $dlallocation->name }}({{$dlallocation->Uid}})</td>
							<td>-</td>
							<td>{{ $dlallocation->DepLoan_LoanAmount }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$dlallocation->voucher_no}}</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['dlallocation_adjust'] as $dlallocation)
						<?php
							$dl_adj_db = $dlallocation->DepLoan_LoanAmount;
							$dl_adj_db_total += $dl_adj_db;
						?>
						<tr>
							<td>{{ $dlallocation->DepLoan_LoanStartDate }}</td>
							<td>{{ $dlallocation->DepLoan_LoanNum }}</td>
							<td>{{ $dlallocation->name }}({{$dlallocation->Uid}})</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlallocation->DepLoan_LoanAmount }}</td>
							<td>-</td>
							<td>-</td>
							<td>{{$dlallocation->adj_no}}</td>
						</tr>
					@endforeach

<?php /*
					@foreach ($trandaily['dlallocation_charg'] as $dlallocation)
						< ?php
							$dl_cash_cr = $dlallocation->DepLoan_LoanCharge;
							$dl_cash_cr_total += $dl_cash_cr;
						?>
						<tr>
							<td>{{ $dlallocation->DepLoan_LoanStartDate }}</td>
							<td>{{ $dlallocation->DepLoan_LoanNum }}</td>
							<td>-</td>
							<td>{{ $dlallocation->DepLoan_LoanCharge }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$dlallocation->receipt_no}}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach		
					@foreach ($trandaily['dlallocation_charg_adjust'] as $dlallocation)
						< ?php
							$dl_adj_cr = $dlallocation->DepLoan_LoanCharge;
							$dl_adj_cr_total += $dl_adj_cr;
						?>
						<tr>
							<td>{{ $dlallocation->DepLoan_LoanStartDate }}</td>
							<td>{{ $dlallocation->DepLoan_LoanNum }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlallocation->DepLoan_LoanCharge }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$dlallocation->adj_no}}</td>
						</tr>
					@endforeach
*/?>

					<tr>
						<th colspan =3>Total Deposit Loan </th>
						<td><?php echo $dl_cash_cr_total; ?></td>
						<td><?php echo $dl_cash_db_total; ?></td>
						<td><?php echo $dl_adj_cr_total; ?></td>
						<td><?php echo $dl_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $dl_cash_cr_total;
						$gt_cash_db += $dl_cash_db_total;
						$gt_adj_cr += $dl_adj_cr_total;
						$gt_adj_db += $dl_adj_db_total;
					?>
					
					
					
					
					
					<tr><td colspan="10"><h5><b><center>DL REPAY<center></b></h5></td></tr>
					<?php
						$dlrepay_cash_cr = 0;
						$dlrepay_adj_cr = 0;
						$dlrepay_cash_cr_total = 0;
						$dlrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['dlrepay'] as $dlrepay)
						<?php
							$dlrepay_cash_cr = $dlrepay->DLRepay_PrincipalPaid;
							$dlrepay_cash_cr_total += $dlrepay_cash_cr;
						?>
						<tr>
							<td>{{ $dlrepay->DLRepay_Date }}</td>
							<td>{{ $dlrepay->DepLoan_LoanNum }}</td>
							<td>- {{ $dlrepay->name }}({{$dlrepay->Uid}})</td>
							<td>{{ $dlrepay->DLRepay_PrincipalPaid }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlrepay->dL_ReceiptNum }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['dlrepay_adjust'] as $dlrepay)
						<?php
							$dlrepay_adj_cr = $dlrepay->DLRepay_PrincipalPaid;
							$dlrepay_adj_cr_total += $dlrepay_adj_cr;
						?>
						<tr>
							<td>{{ $dlrepay->DLRepay_Date }}</td>
							<td>{{ $dlrepay->DepLoan_LoanNum }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlrepay->DLRepay_PrincipalPaid }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlrepay->adj_no }}</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total Deposit Loan repay </th>
						<td><?php echo $dlrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $dlrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $dlrepay_cash_cr_total;
						$gt_adj_cr += $dlrepay_adj_cr_total;
					?>
						
					
					
					<tr><td colspan="10"><h5><b><center>DL REPAY INTEREST<center></b></h5></td></tr>
					<?php
						$dlrepay_cash_cr = 0;
						$dlrepay_adj_cr = 0;
						$dlrepay_cash_cr_total = 0;
						$dlrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['dlrepay'] as $dlrepay)
						<?php
							$dlrepay_cash_cr = $dlrepay->DLRepay_InterestPaid;
							$dlrepay_cash_cr_total += $dlrepay_cash_cr;
						?>
						<tr>
							<td>{{ $dlrepay->DLRepay_Date }}</td>
							<td>{{ $dlrepay->DepLoan_LoanNum }}</td>
							<td>- {{ $dlrepay->name }}({{$dlrepay->Uid}})</td>
							<td>{{ $dlrepay->DLRepay_InterestPaid }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlrepay->dL_ReceiptNum }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['dlrepay_adjust'] as $dlrepay)
						<?php
							$dlrepay_adj_cr = $dlrepay->DLRepay_InterestPaid;
							$dlrepay_adj_cr_total += $dlrepay_adj_cr;
						?>
						<tr>
							<td>{{ $dlrepay->DLRepay_Date }}</td>
							<td>{{ $dlrepay->DepLoan_LoanNum }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlrepay->DLRepay_InterestPaid }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dlrepay->adj_no }}</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total Deposit Loan repay interest</th>
						<td><?php echo $dlrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $dlrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $dlrepay_cash_cr_total;
						$gt_adj_cr += $dlrepay_adj_cr_total;
					?>
						
						
						
						
						
					<tr><td colspan="10"><h5><b><center>PL Allocated<center></b></h5></td></tr>
					<?php
						$pl_cash_cr = 0;
						$pl_cash_db = 0;
						$pl_adj_cr = 0;
						$pl_adj_db = 0;
						
						$pl_cash_cr_total = 0;
						$pl_cash_db_total = 0;
						$pl_adj_cr_total = 0;
						$pl_adj_db_total = 0;
					?>
					@foreach ($trandaily['plallocation'] as $plallocation)
						<?php
							$pl_cash_db = $plallocation->paid_amount;
							$pl_cash_db_total += $pl_cash_db;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>{{ $plallocation->name }}({{$plallocation->Uid}})</td>
							<td>-</td>
							<td>{{ $plallocation->paid_amount }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$plallocation->voucher_no}}</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_adjust'] as $plallocation)
						<?php
							$pl_adj_db = $plallocation->paid_amount;
							$pl_adj_db_total += $pl_adj_db;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>{{ $plallocation->name }}({{$plallocation->Uid}})</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plallocation->paid_amount }}</td>
							<td>-</td>
							<td>-</td>
							<td>{{$plallocation->adj_no}}</td>
						</tr>
					@endforeach

<?php /*
					@foreach ($trandaily['plallocation_chargcash'] as $plallocation)
						< ?php
							$pl_cash_cr = $plallocation->otherCharges;
							$pl_cash_cr_total += $pl_cash_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>{{ $plallocation->otherCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$plallocation->receipt_no}}</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_chargcash'] as $plallocation)
						< ?php
							$pl_cash_cr = $plallocation->Book_FormCharges;
							$pl_cash_cr_total += $pl_cash_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>{{ $plallocation->Book_FormCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_chargcash'] as $plallocation)
						< ?php
							$pl_cash_cr = $plallocation->AjustmentCharges;
							$pl_cash_cr_total += $pl_cash_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>{{ $plallocation->AjustmentCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_chargcash'] as $plallocation)
						< ?php
							$pl_cash_cr = $plallocation->ShareCharges;
							$pl_cash_cr_total += $pl_cash_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>{{ $plallocation->ShareCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_chargcash'] as $plallocation)
						< ?php
							$pl_cash_cr = $plallocation->Insurance;
							$pl_cash_cr_total += $pl_cash_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>{{ $plallocation->Insurance }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					
					@foreach ($trandaily['plallocation_charg'] as $plallocation)
						< ?php
							$pl_adj_cr = $plallocation->otherCharges;
							$pl_adj_cr_total += $pl_adj_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plallocation->otherCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_charg'] as $plallocation)
						< ?php
							$pl_adj_cr = $plallocation->Book_FormCharges;
							$pl_adj_cr_total += $pl_adj_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plallocation->Book_FormCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_charg'] as $plallocation)
						< ?php
							$pl_adj_cr = $plallocation->AjustmentCharges;
							$pl_adj_cr_total += $pl_adj_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plallocation->AjustmentCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_charg'] as $plallocation)
						< ?php
							$pl_adj_cr = $plallocation->ShareCharges;
							$pl_adj_cr_total += $pl_adj_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plallocation->ShareCharges }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plallocation_charg'] as $plallocation)
						< ?php
							$pl_adj_cr = $plallocation->Insurance;
							$pl_adj_cr_total += $pl_adj_cr;
						?>
						<tr>
							<td>{{ $plallocation->pl_payment_date }}</td>
							<td>{{ $plallocation->PersLoan_Number }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plallocation->Insurance }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
*/?>

					<tr>
						<th colspan =3>Total Personal Loan </th>
						<td><?php echo $pl_cash_cr_total; ?></td>
						<td><?php echo $pl_cash_db_total; ?></td>
						<td><?php echo $pl_adj_cr_total; ?></td>
						<td><?php echo $pl_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $pl_cash_cr_total;
						$gt_cash_db += $pl_cash_db_total;
						$gt_adj_cr += $pl_adj_cr_total;
						$gt_adj_db += $pl_adj_db_total;
					?>
						
						
						
						
						
						
						
					<tr><td colspan="10"><h5><b><center>PL REPAY<center></b></h5></td></tr>
					<?php
						$plrepay_cash_cr = 0;
						$plrepay_adj_cr = 0;
						$plrepay_cash_cr_total = 0;
						$plrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['plrepay'] as $plrepay)
						<?php
							$plrepay_cash_cr = $plrepay->PLRepay_Amtpaidtoprincpalamt;
							$plrepay_cash_cr_total += $plrepay_cash_cr;
						?>
						<tr>
							<td>{{ $plrepay->PLRepay_Date }}</td>
							<td>{{ $plrepay->PersLoan_Number }}</td>
							<td>- {{ $plrepay->name }}({{$plrepay->Uid}})</td>
							<td>{{ $plrepay->PLRepay_Amtpaidtoprincpalamt }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plrepay->PL_ReceiptNum }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plrepay_adjust'] as $plrepay)
						<?php
							$plrepay_adj_cr = $plrepay->PLRepay_Amtpaidtoprincpalamt;
							$plrepay_adj_cr_total += $plrepay_adj_cr;
						?>
						<tr>
							<td>{{ $plrepay->PLRepay_Date }}</td>
							<td>{{ $plrepay->PersLoan_Number }}</td>
							<td>- {{ $plrepay->name }}({{$plrepay->Uid}})</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plrepay->PLRepay_Amtpaidtoprincpalamt }}</td>
							<td>-</td>
							<td>{{ $plrepay->PL_ReceiptNum }}</td>	
							<td>-</td>				
							<td>-</td>				
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total PL Repay </th>
						<td><?php echo $plrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $plrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $plrepay_cash_cr_total;
						$gt_adj_cr += $plrepay_adj_cr_total;
					?>
						
					<tr><td colspan="10"><h5><b><center>PL REPAY INTEREST<center></b></h5></td></tr>
					<?php
						$plrepay_cash_cr = 0;
						$plrepay_adj_cr = 0;
						$plrepay_cash_cr_total = 0;
						$plrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['plrepay'] as $plrepay)
						<?php
							$plrepay_cash_cr = $plrepay->PLRepay_PaidInterest;
							if($plrepay_cash_cr <= 0) {
								continue;
							}
							$plrepay_cash_cr_total += $plrepay_cash_cr;
						?>
						<tr>
							<td>{{ $plrepay->PLRepay_Date }}</td>
							<td>{{ $plrepay->PersLoan_Number }}</td>
							<td>- {{ $plrepay->name }}({{$plrepay->Uid}})</td>
							<td>{{$plrepay_cash_cr}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plrepay->PL_ReceiptNum }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['plrepay_adjust'] as $plrepay)
						<?php
							$plrepay_adj_cr = $plrepay->PLRepay_PaidInterest;
							if($plrepay_adj_cr <= 0) {
								continue;
							}
							$plrepay_adj_cr_total += $plrepay_adj_cr;
						?>
						<tr>
							<td>{{ $plrepay->PLRepay_Date }}</td>
							<td>{{ $plrepay->PersLoan_Number }}</td>
							<td>- {{ $plrepay->name }}({{$plrepay->Uid}})</td>
							<td>-</td>
							<td>-</td>
							<td>{{$plrepay_adj_cr}}</td>
							<td>-</td>
							<td>{{ $plrepay->PL_ReceiptNum }}</td>	
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total PL Repay Interest </th>
						<td><?php echo $plrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $plrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $plrepay_cash_cr_total;
						$gt_adj_cr += $plrepay_adj_cr_total;
					?>
					
					
					
					
					
			
					<tr><td colspan="10"><h5><b><center>JL Allocated<center></b></h5></td></tr>
					<?php
						$jl_cash_db = 0;
						$jl_adj_db = 0;
						
						$jl_cash_db_total = 0;
						$jl_adj_db_total = 0;
					?>
					@foreach ($trandaily['jlallocation'] as $jlallocation)
						<?php
							$jl_cash_db = $jlallocation->JewelLoan_LoanAmount;
							$jl_cash_db_total += $jl_cash_db;
						?>
						<tr>
							<td>{{ $jlallocation->JewelLoan_StartDate }}</td>
							<td>{{ $jlallocation->JewelLoan_LoanNumber }}</td>
							<td>- {{$jlallocation->name}}({{$jlallocation->Uid}})</td>
							<td>-</td>
							<td>{{ $jlallocation->JewelLoan_LoanAmount }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$jlallocation->voucher_no}}</td>
						</tr>
					@endforeach
					@foreach ($trandaily['jlallocation_adjust'] as $jlallocation)
						<?php
							$jl_adj_db = $jlallocation->JewelLoan_LoanAmount;
							$jl_adj_db_total += $jl_adj_db;
						?>
						<tr>
							<td>{{ $jlallocation->JewelLoan_StartDate }}</td>
							<td>{{ $jlallocation->JewelLoan_LoanNumber }}</td>
							<td>-{{$jlallocation->name}}({{$jlallocation->Uid}})</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $jlallocation->JewelLoan_LoanAmount }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total Jewel Loan </th>
						<td>-</td>
						<td><?php echo $jl_cash_db_total; ?></td>
						<td>-</td>
						<td><?php echo $jl_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_db += $jl_cash_db_total;
						$gt_adj_db += $jl_adj_db_total;
					?>
					
					
					
					
<?php /*		
					<tr><td colspan="10"><h5><b><center>JL charges<center></b></h5></td></tr>
					<?php
						$jl_cash_cr = 0;
						$jl_adj_cr = 0;
						
						$jl_cash_cr_total = 0;
						$jl_adj_cr_total = 0;
					?>
					@foreach ($trandaily['jlcharges']['num'] as $jlcharges)
						<?php
							$jl_cash_cr = $trandaily['jlcharges']['val'][$jlcharges];
							$jl_cash_cr_total += $jl_cash_cr;
						?>
						<tr>
							<td><?php echo $jlcharges; ?></td>
							<td>-</td>
							<td>-{{$trandaily['jlcharges']['name'][$jlcharges]}}({{$trandaily['jlcharges']['Uid'][$jlcharges]}})</td>
							<td><?php echo $trandaily['jlcharges']['val'][$jlcharges]; ?></td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$trandaily['jlcharges']['receipt_no'][$jlcharges]}}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					@foreach ($trandaily['jlcharges_adjust']['num'] as $jlcharges)
						<?php
							$jl_adj_cr = $trandaily['jlcharges_adjust']['val'][$jlcharges];
							$jl_adj_cr_total += $jl_adj_cr;
						?>
						<tr>
							<td><?php echo $jlcharges; ?></td>
							<td>-</td>
							<td>-{{$trandaily['jlcharges_adjust']['name'][$jlcharges]}}({{$trandaily['jlcharges_adjust']['Uid'][$jlcharges]}})</td>
							<td>-</td>
							<td>-</td>
							<td><?php echo $trandaily['jlcharges_adjust']['val'][$jlcharges]; ?></td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$trandaily['jlcharges_adjust']['adj_no'][$jlcharges]}}</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Total Jewel Loan </th>
						<td><?php echo $jl_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $jl_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $jl_cash_cr_total;
						$gt_adj_cr += $jl_adj_cr_total;
					?>
*/?>
					
<?php /****************** APPRAISER COMMISSION ********************/ ?>
					<tr><td colspan="10"><h5><b><center>APPRAISER COMMISSION<center></b></h5></td></tr>
					<?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>
					
<?php /*
					@foreach ($trandaily['jewel_charges'] as $row)
						< ?php if(strcasecmp($row->JewelLoan_PaymentMode, "CASH")  == 0 || strcasecmp($row->JewelLoan_PaymentMode, "INHAND") ==0) {?>< ?php //CASH ?>
										< ?php
											$cash_cr = $row->JewelLoan_SaraparaCharge;
											$cash_cr_total += $cash_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>{{ $cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											< ?php /*	<td>{{ $row->receipt_voucher_no }}</td> * /?>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php  } else { ?>< ?php //ADJ ?>
										< ?php
											$adj_cr = $row->JewelLoan_SaraparaCharge;
											$adj_cr_total += $adj_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $adj_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php } ?>
					@endforeach
*/?>

					<?php /************* APPRAISER SALARY **********/?>
					@foreach ($trandaily['agent_sal_appraiser'] as $row)	<?php /* AGENT SALARY - PG, RD, APPRAISER */?>
						<?php
							// $adj_db = $row->Agent_Commission_PaidAmount + $row->Tds + $row->securityDeposit ;
							$adj_db = $row->total_commission;
							if($adj_db <= 0) {
								continue;
							}
							$adj_db_total += $adj_db;
						?>
						<tr>
							<td>{{$row->Agent_Commission_PaidDate}}</td>
							<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
							<td>Commission</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$adj_db}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					<?php /************* APPRAISER SALARY **********/ ?>

					<tr>
						<th colspan="3">Total APPRAISER COMMISSION</th>
						<td><?php echo $cash_cr_total; ?></td>
						<td><?php echo $cash_db_total; ?></td>
						<td><?php echo $adj_cr_total; ?></td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $cash_cr_total;
						$gt_cash_db += $cash_db_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>
<?php /****************** APPRAISER COMMISSION ********************/ ?>

<?php /*	
< ?php /****************** INSURANCE ******************** / ?>
					<tr><td colspan="10"><h5><b><center>INSURANCE<center></b></h5></td></tr>
					< ?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>
					@foreach ($trandaily['jewel_charges'] as $row)
						< ?php if(strcasecmp($row->JewelLoan_PaymentMode, "CASH")  == 0 || strcasecmp($row->JewelLoan_PaymentMode, "INHAND") ==0) {?>< ?php //CASH ?>
										< ?php
											$cash_cr = $row->JewelLoan_InsuranceCharge;
											$cash_cr_total += $cash_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>{{ $cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
								< ?php /*	<td>{{ $row->receipt_voucher_no }}</td> * /?>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php  } else { ?>< ?php //ADJ ?>
										< ?php
											$adj_cr = $row->JewelLoan_InsuranceCharge;
											$adj_cr_total += $adj_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $adj_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php } ?>
					@endforeach
					<tr>
						<th colspan =3>Total APPRAISER INSURANCE AMOUNT</th>
						<td>< ?php echo $cash_cr_total; ?></td>
						<td>< ?php echo $cash_db_total; ?></td>
						<td>< ?php echo $adj_cr_total; ?></td>
						<td>< ?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					< ?php
						$gt_cash_cr += $cash_cr_total;
						$gt_cash_db += $cash_db_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>
< ?php /****************** INSURANCE ******************** / ?>

					
< ?php /****************** BOOKS & FORMS ******************** / ?>
					<tr><td colspan="10"><h5><b><center>BOOKS & FORMS<center></b></h5></td></tr>
					< ?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>
					@foreach ($trandaily['jewel_charges'] as $row)
						< ?php if(strcasecmp($row->JewelLoan_PaymentMode, "CASH")  == 0 || strcasecmp($row->JewelLoan_PaymentMode, "INHAND") ==0) {?>< ?php //CASH ?>
										< ?php
											$cash_cr = $row->JewelLoan_BookAndFormCharge;
											$cash_cr_total += $cash_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>{{ $cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											< ?php /*		<td>{{ $row->receipt_voucher_no }}</td> * /?>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php  } else { ?>< ?php //ADJ ?>
										< ?php
											$adj_cr = $row->JewelLoan_BookAndFormCharge;
											$adj_cr_total += $adj_cr;
										?>
										<tr>
											<td title="{{$row->JewelLoanId}}" >{{ $row->JewelLoan_StartDate }}</td>
											<td>{{ $row->JewelLoan_LoanNumber }}</td>
											<td>{{ $row->name }}({{$row->Uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $adj_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php } ?>
					@endforeach
					<tr>
						<th colspan =3>Total BOOKS & FORMS CHARGE</th>
						<td>< ?php echo $cash_cr_total; ?></td>
						<td>< ?php echo $cash_db_total; ?></td>
						<td>< ?php echo $adj_cr_total; ?></td>
						<td>< ?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					< ?php
						$gt_cash_cr += $cash_cr_total;
						$gt_cash_db += $cash_db_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>
< ?php /****************** BOOKS & FORMS ******************** / ?>			
*/?>
					
					
<?php /***************************** LOAN TRANSACTION ******************************* / ?>
					<tr><td colspan="10"><h5><b><center>LOAN TRANSACTION<center></b></h5></td></tr>
					< ?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>
< ?php /***************************** LOAN TRANSACTION *******************************/ ?>
					
					<tr><td colspan="10"><h5><b><center>JL REPAY<center></b></h5></td></tr>
					<?php
						$jlrepay_cash_cr = 0;
						$jlrepay_adj_cr = 0;
						
						$jlrepay_cash_cr_total = 0;
						$jlrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['jlrepay'] as $jlrepay)
						@if(strcasecmp($jlrepay->JLRepay_PayMode, 'CASH') == 0)
							<?php
								$jlrepay_cash_cr = $jlrepay->JLRepay_paidtoprincipalamt;
								$jlrepay_cash_cr_total += $jlrepay_cash_cr;
							?>
							<tr>
								<td>{{ $jlrepay->JLRepay_Date }}</td>
								<td>{{ $jlrepay->JewelLoan_LoanNumber }}</td>
								<td>- {{ $jlrepay->name }}({{$jlrepay->Uid}})</td>
								<td>{{$jlrepay_cash_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $jlrepay->jL_ReceiptNum }}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$jlrepay_adj_cr = $jlrepay->JLRepay_paidtoprincipalamt;
								$jlrepay_adj_cr_total += $jlrepay_adj_cr;
							?>
							<tr>
								<td>{{ $jlrepay->JLRepay_Date }}</td>
								<td>{{ $jlrepay->JewelLoan_LoanNumber }}</td>
								<td>- {{ $jlrepay->name }}({{ $jlrepay->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>{{$jlrepay_adj_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $jlrepay->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total Deposit Loan repay </th>
						<td><?php echo $jlrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $jlrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $jlrepay_cash_cr_total;
						$gt_adj_cr += $jlrepay_adj_cr_total;
					?>
					
					<tr><td colspan="10"><h5><b><center>JL REPAY INTEREST<center></b></h5></td></tr>
					<?php
						$jlrepay_cash_cr = 0;
						$jlrepay_adj_cr = 0;
						
						$jlrepay_cash_cr_total = 0;
						$jlrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['jlrepay'] as $jlrepay)
						@if(strcasecmp($jlrepay->JLRepay_PayMode, 'CASH') == 0)
							<?php
								$jlrepay_cash_cr = $jlrepay->JLRepay_interestpaid;
								$jlrepay_cash_cr_total += $jlrepay_cash_cr;
							?>
							<tr>
								<td>{{ $jlrepay->JLRepay_Date }}</td>
								<td>{{ $jlrepay->JewelLoan_LoanNumber }}</td>
								<td>-{{ $jlrepay->name }}({{ $jlrepay->Uid }})</td>
								<td>{{$jlrepay_cash_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $jlrepay->jL_ReceiptNum }}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$jlrepay_adj_cr = $jlrepay->JLRepay_interestpaid;
								$jlrepay_adj_cr_total += $jlrepay_adj_cr;
							?>
							<tr>
								<td>{{ $jlrepay->JLRepay_Date }}</td>
								<td>{{ $jlrepay->JewelLoan_LoanNumber }}</td>
								<td>-{{ $jlrepay->name }}({{ $jlrepay->Uid }})</td>
								<td>-</td>
								<td>-</td>
								<td>{{$jlrepay_adj_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $jlrepay->adj_no }}</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total Deposit Loan repay </th>
						<td><?php echo $jlrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $jlrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $jlrepay_cash_cr_total;
						$gt_adj_cr += $jlrepay_adj_cr_total;
					?>

<?php /****************************************** JEWEL AUCTION - (IN HO)  ******************************************/?>
					<tr><td colspan="10"><h5><b><center>JL AUCTION ACCOUNT<center></b></h5></td></tr>
					<?php
						$cash_cr = 0;
						$adj_cr = 0;
						$adj_db = 0;
						
						$cash_cr_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>
					@foreach ($trandaily['jewel_auction_account'] as $row_jew)
						@if(strcasecmp($row_jew->pay_mode, 'CASH') == 0)
							<?php
								$cash_cr = $row_jew->jewel_auction_amount;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{ $row_jew->auction_date }}</td>
								<td>{{ $row_jew->JewelLoan_LoanNumber }}</td>
								<td>{{ $row_jew->name }}</td>
								<td>{{$cash_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$adj_cr = $row_jew->jewel_auction_amount;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{ $row_jew->auction_date }}</td>
								<td>{{ $row_jew->JewelLoan_LoanNumber }}</td>
								<td>{{ $row_jew->name }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$adj_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach

					<?php /********************* opposit entry to b2b amt - ADJ DEBIT **********************/?>
					@foreach ($trandaily['jewel_auction_account'] as $row_jew)
							<?php
								$adj_db = $row_jew->jewel_auction_amount;
								$adj_db_total += $adj_db;
							?>
							<tr>
								<td>{{ $row_jew->auction_date }}</td>
								<td>{{ $row_jew->JewelLoan_LoanNumber }}</td>
								<td>{{ $row_jew->name }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$adj_db}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
					@endforeach
					<?php /********************* opposit entry to b2b amt - ADJ DEBIT **********************/?>

					<tr>
						<th colspan="3">Total Auction Account Pay</th>
						<td><?php echo $cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $adj_cr_total; ?></td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $cash_cr_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>
<?php /****************************************** JEWEL AUCTION - (IN HO)  ******************************************/?>

<?php /****************************************** JEWEL AUCTION SUSPENSE - (IN BRANCH) ******************************************/?>
					<tr><td colspan="10"><h5><b><center>JL AUCTION SUSPENSE<center></b></h5></td></tr>
					<?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>
					
					<?php /********************* SUSPENSE CREATION  - (jewel_auction TABLE) - ALWAYS ADJUSTMENT CREDIT *********************/?>
					@foreach ($trandaily['jewel_auction_suspense_creation'] as $row_jew)
							<?php
								$adj_cr = $row_jew->extra_amount;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{ $row_jew->jl_auction_suspense_create_date }}</td>
								<td>{{ $row_jew->JewelLoan_LoanNumber }}</td>
								<td>-{{ $row_jew->name }}({{$row_jew->Uid}})</td>
								<td>-</td>
								<td>-</td>
								<td>{{$adj_cr}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
					@endforeach
					<?php /********************* SUSPENSE CREATION  - (jewel_auction TABLE) *********************/?>

					<?php /********************* SUSPENSE PAYMENT  - (auction_amount_transaction TABLE) *********************/?>
					@foreach ($trandaily['jewel_auction_suspense'] as $row_jew)
						@if(strcasecmp($row_jew->pay_mode, 'CASH') == 0)
							<?php
								$cash_db = $row_jew->amt_piad;
								$cash_db_total += $cash_db;
							?>
							<tr>
								<td>{{ $row_jew->tran_date }}</td>
								<td>{{ $row_jew->JewelLoan_LoanNumber }}</td>
								<td>-{{ $row_jew->name }}({{$row_jew->Uid}})</td>
								<td>-</td>
								<td>{{$cash_db}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row_jew->voucher_no}}</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$adj_db = $row_jew->amt_piad;
								$adj_db_total += $adj_db;
							?>
							<tr>
								<td>{{ $row_jew->tran_date }}</td>
								<td>{{ $row_jew->JewelLoan_LoanNumber }}</td>
								<td>-{{ $row_jew->name }}({{$row_jew->Uid}})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$adj_db}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row_jew->adj_no}}</td>
							</tr>
						@endif
					@endforeach
					<?php /********************* SUSPENSE PAYMENT  - (auction_amount_transaction TABLE) *********************/?>
					<tr>
						<th colspan="3">Total Auction Suspense Pay</th>
						<td><?php echo $cash_cr_total; ?></td>
						<td><?php echo $cash_db_total; ?></td>
						<td><?php echo $adj_cr_total; ?></td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $cash_cr_total;
						$gt_cash_db += $cash_db_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>
<?php /****************************************** JEWEL AUCTION SUSPENSE - (IN BRANCH) ******************************************/?>
					
					
					
					
					
					<tr><td colspan="10"><h5><b><center>SL Allocated<center></b></h5></td></tr>
					<?php
						$sl_cash_db = 0;
						$sl_adj_db = 0;
						
						$sl_cash_db_total = 0;
						$sl_adj_db_total = 0;
					?>
					@foreach ($trandaily['slallocation'] as $slallocation)
						@if(strcasecmp($slallocation->PayMode, 'CASH') == 0)
							<?php
								$sl_cash_db = $slallocation->LoanAmt;
								$sl_cash_db_total += $sl_cash_db;
							?>
							<tr>
								<td>{{ $slallocation->StartDate }}</td>
								<td>{{ $slallocation->StfLoan_Number }}</td>
								<td>-{{ $slallocation->name }}({{$slallocation->Uid}})</td>
								<td>-</td>
								<td>{{ $slallocation->LoanAmt }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$slallocation->voucher_no}}</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$sl_adj_db = $slallocation->LoanAmt;
								$sl_adj_db_total += $sl_adj_db;
							?>
							<tr>
								<td>{{ $slallocation->StartDate }}</td>
								<td>{{ $slallocation->StfLoan_Number }}</td>
								<td>-{{ $slallocation->name }}({{$slallocation->Uid}})</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $slallocation->LoanAmt }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$slallocation->adj_no}}</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total Staff Loan</th>
						<td>-</td>
						<td><?php echo $sl_cash_db_total; ?></td>
						<td>-</td>
						<td><?php echo $sl_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_db += $sl_cash_db_total;
						$gt_adj_db += $sl_adj_db_total;
					?>
					
					
					
					
					<tr><td colspan="10"><h5><b><center>SL REPAY<center></b></h5></td></tr>
					<?php
						$slrepay_cash_cr = 0;
						$slrepay_adj_cr = 0;
						
						$slrepay_cash_cr_total = 0;
						$slrepay_adj_cr_total = 0;
					?>
					@foreach ($trandaily['slrepay'] as $slrepay)
						@if(strcasecmp($slrepay->SLRepay_PayMode, 'CASH') == 0)
							<?php
								$slrepay_cash_cr = $slrepay->paid_principle;
								$slrepay_cash_cr_total += $slrepay_cash_cr;
							?>
							<tr>
								<td>{{ $slrepay->SLRepay_Date }}</td>
								<td>{{ $slrepay->StfLoan_Number }}</td>
								<td>{{ $slrepay->name }}({{$slrepay->Uid}})</td>
								<td>{{ $slrepay->paid_principle }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$slrepay->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$slrepay_adj_cr = $slrepay->paid_principle;
								$slrepay_adj_cr_total += $slrepay_adj_cr;
							?>
							<tr>
								<td>{{ $slrepay->SLRepay_Date }}</td>
								<td>{{ $slrepay->StfLoan_Number }}</td>
								<td>{{ $slrepay->name }}({{$slrepay->Uid}})</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $slrepay->paid_principle }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$slrepay->adj_no}}</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total Deposit Loan repay </th>
						<td><?php echo $slrepay_cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $slrepay_adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $slrepay_cash_cr_total;
						$gt_adj_cr += $slrepay_adj_cr_total;
					?>
					
					
					
					<tr><td colspan="10"><h5><b><center>SL REPAY INTEREST<center></b></h5></td></tr>
					<?php
						$cash_cr = 0;
						$adj_cr = 0;
						
						$cash_cr_total = 0;
						$adj_cr_total = 0;
					?>
					@foreach ($trandaily['show_slrepay_interest'] as $row)
						@if(strcasecmp($row->SLRepay_PayMode, 'CASH') == 0)
							<?php
								$cash_cr = $row->SLRepay_Interest;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{ $row->SLRepay_Date }}</td>
								<td>{{ $row->StfLoan_Number }}</td>
								<td>-{{ $row->name }}({{$row->Uid}})</td>
								<td>{{ $cash_cr }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$adj_cr = $row->SLRepay_Interest;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{ $row->SLRepay_Date }}</td>
								<td>{{ $row->StfLoan_Number }}</td>
								<td>{{ $row->name }}({{$row->Uid}})</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $adj_cr }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->adj_no}}</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total Deposit Loan repay </th>
						<td><?php echo $cash_cr_total; ?></td>
						<td>-</td>
						<td><?php echo $adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $cash_cr_total;
						$gt_adj_cr += $adj_cr_total;
					?>
					
					
					
<!-- ------------------------------- loan charges ------------------------------- -->

<?php /*
					<tr><td colspan="10"><h5><b><center>LOAN CHARGES TRANSACTION<center></b></h5></td></tr>
					< ?php
						$cash_cr = 0;
						$adj_cr = 0;
						
						$cash_cr_total = 0;
						$adj_cr_total = 0;
					?>
					@foreach ($trandaily['loan_charge'] as $row)
						@if( strcasecmp($row->pay_mode, "CASH") == 0 || strcasecmp($row->pay_mode, "INHAND") == 0)
							< ?php
								$cash_cr = $row->amount;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{ $row->charg_tran_date }}</td>
								<td>{{ $row->ln_no }}</td>
								<td>{{ $row->lname }}< ?php /* - {{ $row->name }}({{ $row->Uid }}) * / ?></td>
								<td><p class="text-right">< ?php echo $cash_cr; ?></p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">-</p></td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							< ?php
								$adj_cr = $row->amount;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{ $row->charg_tran_date }}</td>
								<td>{{ $row->ln_no }}</td>
								<td>{{ $row->lname }} < ?php /* - {{ $row->name }}({{ $row->Uid }}) * / ?></td>
								<td><p class="text-right">-</p></td>
								<td><p class="text-center">-</p></td>
								<td><p class="text-center">< ?php echo $adj_cr; ?></p></td>
								<td><p class="text-center">-</p></td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan =3>Total Loan Charges </th>
						<td>< ?php echo $cash_cr_total; ?></td>
						<td>-</td>
						<td>< ?php echo $adj_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					< ?php
						$gt_cash_cr += $cash_cr_total;
						$gt_adj_cr += $adj_cr_total;
					?>
*/?>


<!-- ------------------------------- loan charges end ------------------------------- -->




<!-- ------------------------------- b 2 b ------------------------------- -->
					<?php
						$b2b_name = "Branch to Branch";
						if($trandaily["bid"] == 6) {
							$b2b_name = "Branch Account";
						} else {
							$b2b_name = "Head Office";
						}
					?>
					
					
					<?php /*<tr><td colspan="10"><h5><b><center>Head Office<center></b></h5></td></tr>*/ ?>
					<tr><td colspan="10"><h5><b><center>{{$b2b_name}}<center></b></h5></td></tr>
					<?php
						$b2b_cash_cr = 0;
						$b2b_cash_db = 0;
						$b2b_adj_cr = 0;
						$b2b_adj_db = 0;
						
						$b2b_cash_cr_total = 0;
						$b2b_cash_db_total = 0;
						$b2b_adj_cr_total = 0;
						$b2b_adj_db_total = 0;
					?>
			<?php	/*	*/?>
					@foreach ($trandaily['branch_branch_tran'] as $branch_branch_tran)<?php /*DEBIT*/?>
						@if(strcasecmp($branch_branch_tran->Branch_payment_Mode,'CASH') == 0 || (strcasecmp($branch_branch_tran->Branch_payment_Mode,'INHAND') == 0))<?php /*DEBIT CASH*/?>
						<?php
							$b2b_cash_db = $branch_branch_tran->Branch_Amount;
							$b2b_cash_db_total += $b2b_cash_db;
						?>
							<tr>
								<td>{{ $branch_branch_tran->Branch_Tran_Date }}</td>
								<td>{{ $branch_branch_tran->BName }}</td>
								<td>{{ $branch_branch_tran->Branch_per }}</td>
								<td>-</td>
								<td>{{ $branch_branch_tran->Branch_Amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$branch_branch_tran->voucher_no}}</td>
								<td>-</td>
							</tr>
						@else	<?php /*DEBIT ADJUSTMENT*/?>
						<?php
							$b2b_adj_db = $branch_branch_tran->Branch_Amount;
							$b2b_adj_db_total += $b2b_adj_db;
						?>
							<tr>
								<td>{{ $branch_branch_tran->Branch_Tran_Date }}</td>
								<td>{{ $branch_branch_tran->BName }}</td>
								<td>{{ $branch_branch_tran->Branch_per }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $branch_branch_tran->Branch_Amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$branch_branch_tran->adj_no}}</td>
							</tr>
							
						@endif
					@endforeach
					
					@foreach ($trandaily['branch_branch_tran_credit'] as $branch_branch_tran)<?php /*CREDIT*/?>
						@if(strcasecmp($branch_branch_tran->Branch_payment_Mode,'CASH') == 0 || (strcasecmp($branch_branch_tran->Branch_payment_Mode,'INHAND') == 0))<?php /*CREDIT CASH*/?>
							<?php
								$b2b_cash_cr = $branch_branch_tran->Branch_Amount;
								$b2b_cash_cr_total += $b2b_cash_cr;
							?>
							<tr>
								<td>{{ $branch_branch_tran->Branch_Tran_Date }}</td>
								<td>{{ $branch_branch_tran->BName }}</td>
								<td>{{ $branch_branch_tran->Branch_per }}</td>
								<td>{{ $branch_branch_tran->Branch_Amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$branch_branch_tran->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else	<?php /*CREDIT ADJUSTMENT*/?>
						<?php
							$b2b_adj_cr = $branch_branch_tran->Branch_Amount;
							$b2b_adj_cr_total += $b2b_adj_cr;
						?>
							<tr>
								<td>{{ $branch_branch_tran->Branch_Tran_Date }}</td>
								<td>{{ $branch_branch_tran->BName }}</td>
								<td>{{ $branch_branch_tran->Branch_per }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $branch_branch_tran->Branch_Amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$branch_branch_tran->adj_no}}</td>
							</tr>
							
						@endif
					@endforeach
						
<?php /*					@foreach($trandaily["b2b_adj_tran"]["amt"] as $key=>$value)
					<tr>
						<td><?php echo date("Y-m-d"); ?></td>
						<td>{{$trandaily["b2b_adj_tran"]["lname"][$key]}}</td>
						<td>ADJUSTMENT TO HEAD OFFICE</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>{{$value}}</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php 	
						$b2b_adj_db_total += $value;
					?>
					@endforeach //*/?>
				
		<?php	/*		
					@foreach ($trandaily['Bank_Branch_extra'] as $branch_branch_tran)
						
						
							<tr>
								<td>{{ $branch_branch_tran->date }}</td>
								<td>{{ $branch_branch_tran->BankName }}</td>
								<td>{{ $branch_branch_tran->reason }}</td>
								<td>{{ $branch_branch_tran->amount }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						
					@endforeach
					
					*/?>	
						
					<tr>
						<th colspan =3>Branch To Branch </th>
						<td><?php echo $b2b_cash_cr_total; ?></td>
						<td><?php echo $b2b_cash_db_total; ?></td>
						<td><?php echo $b2b_adj_cr_total; ?></td>
						<td><?php echo $b2b_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $b2b_cash_cr_total;
						$gt_cash_db += $b2b_cash_db_total;
						$gt_adj_cr += $b2b_adj_cr_total;
						$gt_adj_db += $b2b_adj_db_total;
					?>
<!-- ------------------------------- b 2 b ------------------------------- -->



<!-- ------------------------------- b 2 b - HO Account ------------------------------- -->

<?php if($trandaily['bid'] == 6) {?>
					<?php /***************** HO ACCOUNT *********************/ ?>
									<tr><td colspan="10"><h5><b><center>HO ACCOUNT<center></b></h5></td></tr>
									<?php
										$cash_cr = 0;
										$cash_db = 0;
										$adj_cr = 0;
										$adj_db = 0;
										$cash_cr_total = 0;
										$cash_db_total = 0;
										$adj_cr_total = 0;
										$adj_db_total = 0;
									?>
									@foreach ($trandaily['sal_extra_from_ho'] as $row)
												<?php if(strcasecmp($row->transaction_type,"CREDIT") == 0 ) {?><?php //ADJ CR ?>
<?php /*		DON'T SHOW CREDIT ENTR
												< ?php
															$adj_cr = $row->salpay_extra_amt;
															$adj_cr_total += $adj_cr;
														?>
														<tr>
															<td title="{{$row->salpay_extra_id}}">{{ $row->date }}</td>
															<td>{{ $row->name }}({{$row->Uid}})</td>
															<td>{{ $row->salpay_extra_particulars }}</td>
															<td>-</td>
															<td>-</td>
															<td>{{ $adj_cr }}</td>
															<td>-</td>
															<td>-</td>
															<td>-</td>
															<td>-</td>
														</tr>
*/?>
												<?php } else { ?><?php //ADJ DB ?>
														<?php
															$adj_db = $row->salpay_extra_amt;
															$adj_db_total += $adj_db;
														?>
														<tr>
															<td title="{{$row->salpay_extra_id}}">{{ $row->date }}</td>
															<td>{{ $row->name }}({{$row->Uid}})</td>
															<td>{{ $row->salpay_extra_particulars }}</td>
															<td>-</td>
															<td>-</td>
															<td>-</td>
															<td>{{ $adj_db }}</td>
															<td>-</td>
															<td>-</td>
															<td>-</td>
														</tr>
												<?php } ?>
									@endforeach
									<tr>
										<th colspan =3>Total HO ACCOUNT</th>
										<td><?php echo $cash_cr_total; ?></td>
										<td><?php echo $cash_db_total; ?></td>
										<td><?php echo $adj_cr_total; ?></td>
										<td><?php echo $adj_db_total; ?></td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
									<?php
										$gt_cash_cr += $cash_cr_total;
										$gt_cash_db += $cash_db_total;
										$gt_adj_cr += $adj_cr_total;
										$gt_adj_db += $adj_db_total;
									?>
				<?php /***************** HO ACCOUNT *********************/ ?>
<?php } ?>
<!-- ------------------------------- b 2 b - HO Account ------------------------------- -->


<!-- ------------------------------- B2B - OPPOSITE ENTRTY (ADJ DEBIT) ------------------------------- -->
		<?php /***************** B2B - OPPOSITE ENTRTY (ADJ DEBIT) *********************/ ?>
				<tr><td colspan="10"><h5><b><center>ADJUSTMENTS<center></b></h5></td></tr>
				<?php foreach($trandaily["b2b_opp_adj_db"] as $key_allch => $row_allch) {?>
					<tr><td colspan="10" title="{{$key_allch}}"><b><center>{{$row_allch["subhead_name"]}}<center></b></td></tr>
						
					<?php
							$cash_cr = 0;
							$cash_db = 0;
							$adj_cr = 0;
							$adj_db = 0;
							$cash_cr_total = 0;
							$cash_db_total = 0;
							$adj_cr_total = 0;
							$adj_db_total = 0;
						?>

						<?php foreach($row_allch["subhead_tran"] as $key_tran => $row_tran) { //print_r($row_tran); ?>
							<?php
								$tran_id = $row_tran->Branch_Id;
								$amt = $row_tran->Branch_Amount;
								$acc_no = $row_tran->acc_no;
								$date = $row_tran->Branch_Tran_Date;
								$particulars = $row_tran->Branch_per;
								$name = $row_tran->name;
								$uid = $row_tran->uid;
								$rv_cr = "";
								$rv_db = "";
								$rv_adj = "";
							?>
							<?php //ADJ ?>
											<?php
												$adj_db = $amt;
												$adj_db_total += $adj_db;
											?>
											<tr>
												<td title="{{$tran_id}}">{{$date}}</td>
												<td>{{$acc_no}}</td>
												<td>{{$particulars}}</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>{{ $adj_db }}</td>
												<td>{{$rv_cr}}</td>
												<td>{{$rv_db}}</td>
												<td>{{$rv_adj}}</td>
											</tr>
						<?php } ?>
						
						<tr>
							<th colspan =3>Total {{$row_allch["subhead_name"]}}</th>
							<td><?php echo $cash_cr_total; ?></td>
							<td><?php echo $cash_db_total; ?></td>
							<td><?php echo $adj_cr_total; ?></td>
							<td><?php echo $adj_db_total; ?></td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<?php
							$gt_cash_cr += $cash_cr_total;
							$gt_cash_db += $cash_db_total;
							$gt_adj_cr += $adj_cr_total;
							$gt_adj_db += $adj_db_total;
						?>

				<?php }?>
		<?php /***************** B2B - OPPOSITE ENTRTY (ADJ DEBIT) *********************/ ?>
<!-- ------------------------------- B2B - OPPOSITE ENTRTY (ADJ DEBIT) ------------------------------- -->


<!-- ------------------------------- BONUS ------------------------------- -->
				<?php /***************** BONUS ********************* / ?>
								<tr><td colspan="10"><h5><b><center>BONUS<center></b></h5></td></tr>
								< ?php
									$cash_cr = 0;
									$cash_db = 0;
									$adj_cr = 0;
									$adj_db = 0;
									$cash_cr_total = 0;
									$cash_db_total = 0;
									$adj_cr_total = 0;
									$adj_db_total = 0;
								?>
								@foreach($trandaily['branch_branch_tran_credit'] as $row)
									< ?php if($row->SubLedgerId == 197) {?>
														< ?php
															$adj_db = $row->Branch_Amount;
															$adj_db_total += $adj_db;
														?>
														<tr>
															<td>{{ $row->Branch_Tran_Date }}</td>
															<td></td>
															<td>{{ $row->Branch_per }}</td>
															<td>-</td>
															<td>-</td>
															<td>-</td>
															<td>{{ $adj_db }}</td>
															<td>-</td>
															<td>-</td>
															<td>-</td>
														</tr>
									< ?php } ?>
								@endforeach
								<tr>
									<th colspan =3>Total BONUS</th>
									<td>< ?php echo $cash_cr_total; ?></td>
									<td>< ?php echo $cash_db_total; ?></td>
									<td>< ?php echo $adj_cr_total; ?></td>
									<td>< ?php echo $adj_db_total; ?></td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
								< ?php
									$gt_cash_cr += $cash_cr_total;
									$gt_cash_db += $cash_db_total;
									$gt_adj_cr += $adj_cr_total;
									$gt_adj_db += $adj_db_total;
								?>
				< ?php /***************** BONUS *********************/ ?>

<!-- ------------------------------- BONUS ------------------------------- -->



					
					
		<!-- BANK TRANSACTIONS -->
					<tr><td colspan="10"><h5><b><center>Bank Transactions<center></b></h5></td></tr>
					<?php
						$b2b_cash_cr = 0;
						$b2b_cash_db = 0;
						$b2b_adj_cr = 0;
						$b2b_adj_db = 0;
						
						$b2b_cash_cr_total = 0;
						$b2b_cash_db_total = 0;
						$b2b_adj_cr_total = 0;
						$b2b_adj_db_total = 0;
					?>
					
					@foreach ($trandaily['Bank_Branch'] as $Bank_Branch)
						<?php
							if(strcasecmp($Bank_Branch->Deposit_type, 'WITHDRAWL') == 0) {
								if(strcasecmp($Bank_Branch->pay_mode, 'INHAND') == 0 ) {	// CASH WITHDRAW
									$b2b_cash_cr = $Bank_Branch->amount;
									$b2b_cash_cr_total += $b2b_cash_cr;
						?>
									<tr>
										<td>{{ $Bank_Branch->date }}</td>
										<td>{{ $Bank_Branch->BankName }}</td>
										<td>{{ $Bank_Branch->reason }}</td>
										<td>{{ $Bank_Branch->amount }}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>{{$Bank_Branch->receipt_no}}</td>
										<td>-</td>
										<td>-</td>
									</tr>
						<?php
								} else {	// ADJ WITHDRAW
									$b2b_adj_cr = $Bank_Branch->amount;
									$b2b_adj_cr_total += $b2b_adj_cr;
						?>
									<tr>
										<td>{{ $Bank_Branch->date }}</td>
										<td>{{ $Bank_Branch->BankName }}</td>
										<td>{{ $Bank_Branch->reason }}</td>
										<td>-</td>
										<td>-</td>
										<td>{{ $Bank_Branch->amount }}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>{{$Bank_Branch->adj_no}}</td>
									</tr>
						<?php
								}
							} else
								if(strcasecmp($Bank_Branch->pay_mode, 'INHAND') == 0) {	// CASH DEPOSIT
									$b2b_cash_db = $Bank_Branch->amount;
									$b2b_cash_db_total += $b2b_cash_db;
						?>
									<tr>
										<td>{{ $Bank_Branch->date }}</td>
										<td>{{ $Bank_Branch->BankName }}</td>
										<td>{{ $Bank_Branch->reason }}</td>
										<td>-</td>
										<td>{{ $Bank_Branch->amount }}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>{{$Bank_Branch->voucher_no}}</td>
										<td>-</td>
									</tr>
						<?php
								} else {	// ADJ DEPOSIT
									$b2b_adj_db = $Bank_Branch->amount;
									$b2b_adj_db_total += $b2b_adj_db;
						?>
									<tr>
										<td>{{ $Bank_Branch->date }}</td>
										<td>{{ $Bank_Branch->BankName }}</td>
										<td>{{ $Bank_Branch->reason }}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>{{ $Bank_Branch->amount }}</td>
										<td>-</td>
										<td>-</td>
										<td>{{$Bank_Branch->adj_no}}</td>
									</tr>
						<?php
								}
						?>
					@endforeach

					<tr>
						<th colspan =3>Bank Transactions</th>
						<td><?php echo $b2b_cash_cr_total; ?></td>
						<td><?php echo $b2b_cash_db_total; ?></td>
						<td><?php echo $b2b_adj_cr_total; ?></td>
						<td><?php echo $b2b_adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $b2b_cash_cr_total;
						$gt_cash_db += $b2b_cash_db_total;
						$gt_adj_cr += $b2b_adj_cr_total;
						$gt_adj_db += $b2b_adj_db_total;
					?>
		<!-- BANK TRANSACTIONS -->
					
					



					
					
					
					<tr><td colspan="10"><h5><b><center>Agent collection<center></b></h5></td></tr>
					<?php
						$agent_cash_cr = 0;
						
						$agent_cash_cr_total = 0;
					?>
					@foreach ($trandaily['agentcoll_tran'] as $agentcoll_tran)
						<?php
							$agent_cash_cr = $agentcoll_tran->PenPigmy_AmountReceived;
							$agent_cash_cr_total += $agent_cash_cr;
						?>
						<tr>
							<td>{{ $agentcoll_tran->PendPigmy_ReceivedDate }}</td>
							<td>{{ $agentcoll_tran->FirstName }}{{ $agentcoll_tran->MiddleName }}{{ $agentcoll_tran->LastName }}({{ $agentcoll_tran->Uid }})</td>
							<td>-</td>
							<td>{{ $agentcoll_tran->PenPigmy_AmountReceived }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$agentcoll_tran->receipt_no}}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					<tr>
						<th colspan =3>Agent collection </th>
						<td><?php echo $agent_cash_cr_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $agent_cash_cr_total;
					?>
					
					
					
	<!-- -------------salary----------------- -->
	
				<tr><td colspan="10"><h5><b><center>Employee Salary<center></b></h5></td></tr>
				<?php
					$adj_db = 0;
					$adj_db_total = 0;
				?>
				@foreach ($trandaily['emp_sal'] as $row)
					<?php
						$adj_db = $row->gearning;
						$adj_db_total += $adj_db;
					?>
					<tr>
						<td>{{$row->date}}</td>
						<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{ $row->Uid }})</td>
						<td>Salary</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>{{$adj_db}}</td>
						<td>-</td>
						<td>-</td>
					</tr>
				@endforeach
				
				<tr>
					<th colspan =3>Employee Salary </th>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td><?php echo $adj_db_total; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_adj_db += $adj_db_total;
				?>
					
					
				<tr><td colspan="10"><h5><b><center>Commission<center></b></h5></td></tr>
				<?php
					$cash_cr = 0;
					$cash_db = 0;
					$adj_cr = 0;
					$adj_db = 0;
					$cash_cr_total = 0;
					$cash_db_total = 0;
					$adj_cr_total = 0;
					$adj_db_total = 0;
				?>
				@foreach ($trandaily['agent_sal'] as $row)	<?php /* AGENT SALARY - PG, RD, APPRAISER */?>
					<?php
						// $adj_db = $row->Agent_Commission_PaidAmount + $row->Tds + $row->securityDeposit ;
						$adj_db = $row->total_commission;
						if($adj_db <= 0) {
							continue;
						}
						$adj_db_total += $adj_db;
					?>
					<tr>
						<td>{{$row->Agent_Commission_PaidDate}}</td>
						<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
						<td>Commission</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>{{$adj_db}}</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				@endforeach
				
				<?php /* COMMISSION CUT DURING PL REPAY */ ?>
					<?php /* CASH */ ?>
					@foreach ($trandaily['plrepay'] as $plrepay)
						<?php
							$cash_cr = $plrepay->pigmy_commission;
							if($cash_cr <= 0) {
								continue;
							}
							$cash_cr_total += $cash_cr;
						?>
						<tr>
							<td>{{ $plrepay->PLRepay_Date }}</td>
							<td>{{ $plrepay->PersLoan_Number }}</td>
							<td>- {{ $plrepay->name }}({{$plrepay->Uid}})</td>
							<td>{{ $plrepay->pigmy_commission }}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plrepay->PL_ReceiptNum }}</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endforeach
					
					<?php /* ADJ */ ?>
					@foreach ($trandaily['plrepay_adjust'] as $plrepay)
						<?php
							$adj_cr = $plrepay->pigmy_commission;
							if($adj_cr <= 0) {
								continue;
							}
							$adj_cr_total += $adj_cr;
						?>
						<tr>
							<td>{{ $plrepay->PLRepay_Date }}</td>
							<td>{{ $plrepay->PersLoan_Number }}</td>
							<td>- {{ $plrepay->name }}({{$plrepay->Uid}})</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $plrepay->pigmy_commission }}</td>
							<td>-</td>
							<td>{{ $plrepay->PL_ReceiptNum }}</td>	
							<td>-</td>				
							<td>-</td>				
						</tr>
					@endforeach

<?php /*
					< ?php /****************** FROM PG PREWITHDRAWAL Deduct_Commission ******************* / ?>
					@foreach ($trandaily['pg_prewithdrawal_charges'] as $row)
						< ?php if(strcasecmp($row->PayAmount_PaymentMode, "CASH")  == 0 || strcasecmp($row->PayAmount_PaymentMode, "INHAND") ==0) {?>< ?php //CASH ?>
										< ?php
											$cash_cr = $row->Deduct_Commission;
											if($cash_cr <= 0) {
												continue;
											}
											$cash_cr_total += $cash_cr;
										?>
										<tr>
											<td title="{{$row->PgmPrewithdraw_ID}}" >{{ $row->Withdraw_Date }}</td>
											<td>{{ $row->PigmiAcc_No }}</td>
											<td>PG DEDUCT COMMISSION - {{ $row->name }}({{$row->Uid}})</td>
											<td>{{ $cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
								< ?php /*	<td>{{ $row->receipt_voucher_no }}</td> * /?>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php  } else { ?>< ?php //ADJ ?>
										< ?php
											$adj_cr = $row->Deduct_Commission;
											if($inc_adj_cr <= 0) {
												continue;
											}
											$adj_cr_total += $adj_cr;
										?>
										<tr>
											<td title="{{$row->PgmPrewithdraw_ID}}" >{{ $row->Withdraw_Date }}</td>
											<td>{{ $row->PigmiAcc_No }}</td>
											<td>PG DEDUCT COMMISSION - {{ $row->name }}({{$row->Uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $adj_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
										</tr>
						< ?php } ?>
					@endforeach
					< ?php /****************** FROM PG PREWITHDRAWAL Deduct_Commission ******************* / ?>
*/?>
				
				<tr>
					<th colspan =3>Agent Salary </th>
					<td><?php echo $cash_cr_total; ?></td>
					<td>-</td>
					<td><?php echo $adj_cr_total; ?></td>
					<td><?php echo $adj_db_total; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $cash_cr_total;
					$gt_adj_cr += $adj_cr_total;
					$gt_adj_db += $adj_db_total;
				?>
	
	
	
	<!-- -------------salary----------------- -->
	
	
	<!-- -------------salary Extra Pay----------------- -->
	<!-- -------------Staff Addition----------------- -->
				<tr><td colspan="10"><h5><b><center>Employee Salary Extra<center></b></h5></td></tr>
								
				<?php
					$cash_cr = 0;
					$cash_db = 0;
					$adj_cr = 0;
					$adj_db = 0;
					
					$cash_cr_total = 0;
					$cash_db_total = 0;
					$adj_cr_total = 0;
					$adj_db_total = 0;
				?>
				
				<tr><td colspan="10"><b><center>Staff Additions<center></b></td></tr>
				<?php
					$adj_db_1 = 0;//1 - Staff Additions
					$adj_db_total_1 = 0;
				?>
				@foreach ($trandaily['emp_sal_extra'] as $row)
					@if($row->sal_extra_type == 1)
						<?php
							$adj_db_1 = $row->salpay_extra_amt;
							$adj_db_total_1 += $adj_db_1;
						?>
						<tr>
							<td>{{$row->date}}</td>
							<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
							<td>{{$row->sal_extra_name}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$row->salpay_extra_amt}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endif
				@endforeach
			
				<tr>
					<th colspan =3>Staff Additions</th>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td><?php echo $adj_db_total_1; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
	<!-- -------------Staff Addition----------------- -->
	<!-- -------------Staff Addition----------------- -->
				<tr><td colspan="10"><b><center>Staff Deductions<center></b></td></tr>
				<?php
					$adj_cr_2 = 0;//2 - Staff Deductions
					$adj_cr_total_2 = 0;
				?>
				@foreach ($trandaily['emp_sal_extra'] as $row)
					@if($row->sal_extra_type == 2)
						<?php
							$adj_cr_2 = $row->salpay_extra_amt;
							$adj_cr_total_2 += $adj_cr_2;
						?>
						<tr>
							<td>{{$row->date}}</td>
							<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
							<td>{{$row->sal_extra_name}}</td>
							<td>-</td>
							<td>-</td>
							<td>{{$row->salpay_extra_amt}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endif
				@endforeach
				
				<tr>
					<th colspan =3>Staff Deductions</th>
					<td>-</td>
					<td>-</td>
					<td><?php echo $adj_cr_total_2; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
	<!-- -------------Staff Addition----------------- -->
	<!-- -------------Staff Addition----------------- -->
				<tr><td colspan="10"><b><center>Society Contribution<center></b></td></tr>
				<?php
					$adj_db_3 = 0;
					$adj_db_total_3 = 0;
					$adj_cr_3 = 0;
					$adj_cr_total_3 = 0;
				?>
				@foreach ($trandaily['emp_sal_extra'] as $row)
					@if($row->sal_extra_type == 3)
						<?php
							$adj_db_3 = $row->salpay_extra_amt;
							$adj_db_total_3 += $adj_db_3;
						?>
						<tr>
							<td>{{$row->date}}</td>
							<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
							<td>{{$row->sal_extra_name}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{$row->salpay_extra_amt}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endif
				@endforeach
				@foreach ($trandaily['emp_sal_extra'] as $row)
					@if($row->sal_extra_type == 3)
						<?php
							$adj_cr_3 = $row->salpay_extra_amt;
							$adj_cr_total_3 += $adj_cr_3;
						?>
						<tr>
							<td>{{$row->date}}</td>
							<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}} ({{$row->Uid}})</td>
							<td>{{$row->sal_extra_name}}</td>
							<td>-</td>
							<td>-</td>
							<td>{{$row->salpay_extra_amt}}</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
					@endif
				@endforeach
				
				<tr>
					<th colspan =3>Society Contribution</th>
					<td>-</td>
					<td>-</td>
					<td><?php echo $adj_cr_total_3; ?></td>
					<td><?php echo $adj_db_total_3; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
	<!-- -------------Staff Addition----------------- -->
	<!-- -------------Staff Addition----------------- -->
				<tr><td colspan="10"><b><center>Agent Deductions<center></b></td></tr>
				<?php
					$cash_cr_4 = 0;
					$adj_cr_4 = 0;
					
					$cash_cr_total_4 = 0;
					$adj_cr_total_4 = 0;
				?>
				@foreach ($trandaily['agent_sal_extra'] as $row)
					@if($row->sal_extra_type == 4)
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)
							<?php
								$cash_cr_4 = $row->salpay_extra_amt;
								$cash_cr_total_4 += $cash_cr_4;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->sal_extra_name}}</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else
							<?php
								$adj_cr_4 = $row->salpay_extra_amt;
								$adj_cr_total_4 += $adj_cr_4;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->sal_extra_name}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
					@endif
				@endforeach
				
				<tr>
					<th colspan =3>Agent Deductions</th>
					<td><?php echo $cash_cr_total_4; ?></td>
					<td>-</td>
					<td><?php echo $adj_cr_total_4; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>


				<?php
					$cash_cr_total = $cash_cr_total_4;
					$cash_db_total = 0;
					$adj_cr_total = $adj_cr_total_2 + $adj_cr_total_4 + $adj_cr_total_3;
					$adj_db_total = $adj_db_total_1 + $adj_db_total_3;
				
				
				
					$gt_cash_cr += $cash_cr_total;
					$gt_cash_db += $cash_db_total;
					$gt_adj_cr += $adj_cr_total;
					$gt_adj_db += $adj_db_total;
				?>
	<!-- -------------Staff Addition----------------- -->
	
	<!------------------ TDS  -------------------->
		<tr><td colspan="10"><h5><b><center>TDS<center></b></h5></td></tr>
				<?php
					$cash_cr = 0;
					$cash_db = 0;
					$adj_cr = 0;
					$adj_db = 0;
					
					$cash_cr_total = 0;
					$cash_db_total = 0;
					$adj_cr_total = 0;
					$adj_db_total = 0;
				?>
				@foreach ($trandaily['tds'] as $row)
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
							<?php
								$cash_cr = $row->salpay_extra_amt;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_cr = $row->salpay_extra_amt;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
				@endforeach

				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY ************/?>
				@foreach ($trandaily['tds'] as $row)
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_db = $row->salpay_extra_amt;
								$adj_db_total += $adj_db;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
				@endforeach
				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY ************/?>
				
				<tr>
					<th colspan =3>TOTAL TDS</th>
					<td><?php echo $cash_cr_total; ?></td>
					<td>-</td>
					<td><?php echo $adj_cr_total; ?></td>
					<td><?php echo $adj_db_total; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $cash_cr_total;
					$gt_cash_db += $cash_db_total;
					$gt_adj_cr += $adj_cr_total;
					$gt_adj_db += $adj_db_total;
				?>
	<!------------------ TDS  -------------------->
	
	<!------------------ PF  -------------------->
		<tr><td colspan="10"><h5><b><center>PF<center></b></h5></td></tr>
				<?php
					$cash_cr = 0;
					$cash_db = 0;
					$adj_cr = 0;
					$adj_db = 0;
					
					$cash_cr_total = 0;
					$cash_db_total = 0;
					$adj_cr_total = 0;
					$adj_db_total = 0;
				?>
				@foreach ($trandaily['pf'] as $row)
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
							<?php
								$cash_cr = $row->salpay_extra_amt;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_cr = $row->salpay_extra_amt;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
				@endforeach

				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY AND BRANCH IS NOT HO ************/?>
				@foreach ($trandaily['pf'] as $row)
					<?php if($trandaily['bid'] != 6) { // DON'T SHOW THESE ENTRIES FOR HO ?>
							@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
							@else<?php //ADJ CREDIT?>
								<?php
									$adj_db = $row->salpay_extra_amt;
									$adj_db_total += $adj_db;
								?>
								<tr>
									<td>{{$row->date}}</td>
									<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
									<td>{{$row->salpay_extra_particulars}}</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>{{$row->salpay_extra_amt}}</td>
									<td>-</td>
									<td>-</td>
								</tr>
							@endif
					<?php } ?>
				@endforeach
				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY AND BRANCH IS NOT HO ************/?>
				
				<tr>
					<th colspan =3>TOTAL PF</th>
					<td><?php echo $cash_cr_total; ?></td>
					<td>-</td>
					<td><?php echo $adj_cr_total; ?></td>
					<td><?php echo $adj_db_total; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $cash_cr_total;
					$gt_cash_db += $cash_db_total;
					$gt_adj_cr += $adj_cr_total;
					$gt_adj_db += $adj_db_total;
				?>
	<!------------------ PF  -------------------->
	
	<!------------------ ESI  -------------------->
		<tr><td colspan="10"><h5><b><center>ESI<center></b></h5></td></tr>
				<?php
					$cash_cr = 0;
					$cash_db = 0;
					$adj_cr = 0;
					$adj_db = 0;
					
					$cash_cr_total = 0;
					$cash_db_total = 0;
					$adj_cr_total = 0;
					$adj_db_total = 0;
				?>
				@foreach ($trandaily['esi'] as $row)
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
							<?php
								$cash_cr = $row->salpay_extra_amt;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_cr = $row->salpay_extra_amt;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
				@endforeach

				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY AND BRANCH IS NOT HO ************/?>
				@foreach ($trandaily['esi'] as $row)
					<?php if($trandaily['bid'] != 6) { // DON'T SHOW THESE ENTRIES FOR HO ?>
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_db = $row->salpay_extra_amt;
								$adj_db_total += $adj_db;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
					<?php } ?>
				@endforeach
				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY AND BRANCH IS NOT HO ************/?>
				
				<tr>
					<th colspan =3>TOTAL PF</th>
					<td><?php echo $cash_cr_total; ?></td>
					<td>-</td>
					<td><?php echo $adj_cr_total; ?></td>
					<td><?php echo $adj_db_total; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $cash_cr_total;
					$gt_cash_db += $cash_db_total;
					$gt_adj_cr += $adj_cr_total;
					$gt_adj_db += $adj_db_total;
				?>
	<!------------------ ESI  -------------------->
	
	<!------------------ PROFESSIONAL TAX  -------------------->
		<tr><td colspan="10"><h5><b><center>PROFESSIONAL TAX<center></b></h5></td></tr>
				<?php
					$cash_cr = 0;
					$cash_db = 0;
					$adj_cr = 0;
					$adj_db = 0;
					
					$cash_cr_total = 0;
					$cash_db_total = 0;
					$adj_cr_total = 0;
					$adj_db_total = 0;
				?>
				@foreach ($trandaily['professional_tax'] as $row)
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
							<?php
								$cash_cr = $row->salpay_extra_amt;
								$cash_cr_total += $cash_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>{{$row->receipt_no}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_cr = $row->salpay_extra_amt;
								$adj_cr_total += $adj_cr;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
				@endforeach

				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY AND BRANCH IS NOT HO ************/?>
				@foreach ($trandaily['professional_tax'] as $row)
					<?php if($trandaily['bid'] != 6) { // DON'T SHOW THESE ENTRIES FOR HO ?>
						@if(strcasecmp($row->paymentmode, "CASH") == 0 || strcasecmp($row->paymentmode, "INHAND") == 0)<?php //CASH CREDIT?>
						@else<?php //ADJ CREDIT?>
							<?php
								$adj_db = $row->salpay_extra_amt;
								$adj_db_total += $adj_db;
							?>
							<tr>
								<td>{{$row->date}}</td>
								<td>{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</td>
								<td>{{$row->salpay_extra_particulars}}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>{{$row->salpay_extra_amt}}</td>
								<td>-</td>
								<td>-</td>
							</tr>
						@endif
					<?php } ?>
				@endforeach
				<?php /********** SHOW A REVERSE ENTRY IF IT IS ADJ ENTRY AND BRANCH IS NOT HO ************/?>
				
				<tr>
					<th colspan =3>TOTAL PF</th>
					<td><?php echo $cash_cr_total; ?></td>
					<td><?php echo $cash_db_total; ?></td>
					<td><?php echo $adj_cr_total; ?></td>
					<td><?php echo $adj_db_total; ?></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<?php
					$gt_cash_cr += $cash_cr_total;
					$gt_cash_db += $cash_db_total;
					$gt_adj_cr += $adj_cr_total;
					$gt_adj_db += $adj_db_total;
				?>
	<!------------------ PROFESSIONAL TAX  -------------------->



	<!------------------ ALL CHARGES  -------------------->
			<tr><td colspan="10"><h5><b><center>ALL CHARGES<center></b></h5></td></tr>
			<?php foreach($trandaily["daily_rep_all_charges"] as $key_allch => $row_allch) {?>
				<tr><td colspan="10"><b><center>{{$row_allch["subhead_name"]}}<center></b></td></tr>
					
				<?php
						$cash_cr = 0;
						$cash_db = 0;
						$adj_cr = 0;
						$adj_db = 0;
						$cash_cr_total = 0;
						$cash_db_total = 0;
						$adj_cr_total = 0;
						$adj_db_total = 0;
					?>

					<?php foreach($row_allch["subhead_tran"] as $key_tran => $row_tran) { //print_r($row_tran); ?>
						<?php
							$amt = $row_tran->amount;
							$acc_no = $row_tran->acc_no;
							$date = $row_tran->date;
							$particulars = $row_tran->particulars;
							$name = $row_tran->name;
							$uid = $row_tran->uid;
							$rv_cr = "";
							$rv_db = "";
							$rv_adj = "";
						?>
						<?php if(strcasecmp($row_tran->payment_mode,"CASH") == 0  ||  strcasecmp($row_tran->payment_mode,"INHAND") == 0) {?><?php //CASH ?>
										<?php
											$cash_cr = $amt;
											$cash_cr_total += $cash_cr;
										?>
										<tr>
											<td title="{{$row_tran->all_charges_id}}">{{$date}}</td>
											<td>{{$acc_no}}</td>
											<td><?php /*{{$particulars}} - */?>{{ $name }}({{$uid}})</td>
											<td>{{ $cash_cr }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>{{$rv_cr}}</td>
											<td>{{$rv_db}}</td>
											<td>{{$rv_adj}}</td>
										</tr>
						<?php } else { ?><?php //ADJ ?>
										<?php
											$adj_cr = $amt;
											$adj_cr_total += $adj_cr;
										?>
										<tr>
											<td title="{{$row_tran->all_charges_id}}">{{$date}}</td>
											<td>{{$acc_no}}</td>
											<td><?php /*{{$particulars}} - */?>{{ $name }}({{$uid}})</td>
											<td>-</td>
											<td>-</td>
											<td>{{ $adj_cr }}</td>
											<td>-</td>
											<td>{{$rv_cr}}</td>
											<td>{{$rv_db}}</td>
											<td>{{$rv_adj}}</td>
										</tr>
						<?php } ?>
					<?php } ?>
					
					<tr>
						<th colspan =3>Total {{$row_allch["subhead_name"]}}</th>
						<td><?php echo $cash_cr_total; ?></td>
						<td><?php echo $cash_db_total; ?></td>
						<td><?php echo $adj_cr_total; ?></td>
						<td><?php echo $adj_db_total; ?></td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						$gt_cash_cr += $cash_cr_total;
						$gt_cash_db += $cash_db_total;
						$gt_adj_cr += $adj_cr_total;
						$gt_adj_db += $adj_db_total;
					?>

			<?php }?>
	<!------------------ ALL CHARGES  -------------------->



	
	
	
	
	
	<!-- -------------salary Extra Pay----------------- -->
	
	
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<th colspan =3>Grand Total</th>
						<td><b><?php echo $gt_cash_cr;?></td>
						<td><b><?php echo $gt_cash_db;?></td>
						<td><b><?php echo $gt_adj_cr;?></td>
						<td><b><?php echo $gt_adj_db;?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				</tbody>
				</table>
			</div>
			</div>
		</div>
																									
																									
																									<script>
																										$('.datepicker').datepicker().on('changeDate',function(e){
																											$(this).datepicker('hide');
																										});
																										
																										
																										SBcredit="<?php echo $trandaily['sbcredit']; ?>";
																										rdcredit="<?php echo $trandaily['rdcredit']; ?>";
																										pigmycredit="<?php echo $trandaily['pigmycredit']; ?>";
																										//pigmycredit="<?php echo $x=0 ?>";
																										fdcredit="<?php echo $trandaily['fdallocamttot']; ?>";
																										sharecredit="<?php echo $trandaily['sharetot']; ?>";
																										membfee="<?php echo $trandaily['membsharetot']; ?>";
																										classdfee="<?php echo $trandaily['classdtot']; ?>";
																										income="<?php echo $trandaily['incomebal']; ?>";
																										dlrepay="<?php echo $trandaily['dlrepaytot']; ?>";
																										plrepay="<?php echo $trandaily['plrepaytot']; ?>";
																										jlrepay="<?php echo $trandaily['jlrepaytot']; ?>";
																										slrepay="<?php echo $trandaily['slrepaytot']; ?>";
																										jlcharges="<?php echo $trandaily['jlcharges']['sum']; ?>";
																										//branch_branch_tot_credit="<?php echo $trandaily['branch_branch_tot_credit']; ?>";
																										agentcoll_tot="<?php echo $trandaily['agentcoll_tot']; ?>";
																										pigmichargtot_amt="<?php echo $trandaily['pigmicharg_amt']; ?>";
																										pigmichargtot_comm="<?php echo $trandaily['pigmicharg_comm']; ?>";
																										dlallocationbal_charg="<?php echo $trandaily['dlallocationbal_charg']; ?>";
																										Bank_Branch_tot="<?php echo $trandaily['Bank_Branch_tot']; ?>";
			branch_branch_tot_credit="0";																							
																										
																										//alert(SBcredit+","+rdcredit+","+pigmycredit+","+fdcredit+","+sharecredit+","+membfee+","+income+","+jlrepay+","+dlrepay+","+plrepay+","+slrepay+","+jlcharges+","+branch_branch_tot+","+agentcoll_tot+","+pigmichargtot_amt+","+pigmichargtot_comm+","+dlrepaytot);																						
																										credit=((parseFloat(SBcredit))+(parseFloat(rdcredit))+(parseFloat(pigmycredit))+(parseFloat(fdcredit))+(parseFloat(sharecredit))+(parseFloat(membfee))+(parseFloat(classdfee))+(parseFloat(income))+(parseFloat(dlrepay))+(parseFloat(plrepay))+(parseFloat(jlrepay))+(parseFloat(slrepay))+(parseFloat(agentcoll_tot))+(parseFloat(jlcharges))+(parseFloat(pigmichargtot_amt))+(parseFloat(pigmichargtot_comm))+(parseFloat(dlallocationbal_charg))+(parseFloat(branch_branch_tot_credit))+(parseFloat(Bank_Branch_tot)));
																										$('.CreditSum').html(credit);
																										//alert(credit);
																										
																										SBdebit="<?php echo $trandaily['sbdebit']; ?>";
																										rddebit="<?php echo $trandaily['rddebit']; ?>";
																										pigmydebit="<?php echo $trandaily['pigmycashdebit']; ?>";
																										//pigmydebit="<?php echo $c=0; ?>";
																										pigmypatamtdebit="<?php echo $trandaily['pigmypayamttot']; ?>";
																										rdpatamtdebit="<?php echo $trandaily['rdpayamttot']; ?>";
																										fdpatamtdebit="<?php echo $trandaily['fdpayamttot']; ?>";
																										expencetdebit="<?php echo $trandaily['expencebal']; ?>";
																										//expencetdebit=0;
																										jldebit="<?php echo $trandaily['jlallocationbal']; ?>";
																										dlallocationbal="<?php echo $trandaily['dlallocationbal']; ?>";
																										plallocationbal="<?php echo $trandaily['plallocationbal']; ?>";
																										slallocationbal="<?php echo $trandaily['slallocationbal']; ?>";
																										branch_branch_tot="<?php echo $trandaily['branch_branch_tot']; ?>";																										pigmypayamttot_per="<?php echo $trandaily['pigmypayamttot_per']; ?>";
																									
																										debit=((parseFloat(SBdebit))+(parseFloat(rddebit))+(parseFloat(pigmydebit))+(parseFloat(pigmypatamtdebit))+(parseFloat(rdpatamtdebit))+(parseFloat(fdpatamtdebit))+(parseFloat(expencetdebit))+(parseFloat(jldebit))+(parseFloat(dlallocationbal))+(parseFloat(plallocationbal))+(parseFloat(slallocationbal))+(parseFloat(pigmypayamttot_per))+(parseFloat(branch_branch_tot)));
																										$('.DebitSum').html(debit);
																										//alert(debit);
																										
				//ADjustmencredit	
				
				pigmycashcredit="<?php echo $trandaily['pigmycashcredit']; ?>";
				sbcredit_adjust="<?php echo $trandaily['sbcredit_adjust']; ?>";
				rdcredit_adjust="<?php echo $trandaily['rdcredit_adjust']; ?>";
				
				Adjustcredit=((parseFloat(pigmycashcredit))+(parseFloat(sbcredit_adjust))+(parseFloat(rdcredit_adjust)));
				
				$('.CreditSumadjust').html(Adjustcredit);
				
				//ADjustmendebit	
				
				pigmycashdebit="<?php echo $trandaily['pigmycashdebit']; ?>";
				sbdebit_adjust="<?php echo $trandaily['sbdebit_adjust']; ?>";
				rddebit_adjust="<?php echo $trandaily['rddebit_adjust']; ?>";
				
				Adjustdebit=((parseFloat(pigmycashdebit))+(parseFloat(sbdebit_adjust))+(parseFloat(rddebit_adjust)));
																										$('.DebitSumadjust').html(Adjustdebit);
																										
																										$('.clickme').click(function(e){
																											$('.companyclassid').click();
																										}); 
																										
																										$('.crtds').click(function(e){
																											e.preventDefault();
																											//alert($(this).attr('href'));
																											$('.box-inner').load($(this).attr('href'));
																										});
																										
																										$('.viewreport').click(function(e){
																											
																											finddate=$('#pdate').val();
																											alert(finddate);
																											$.ajax({
																												url:'dailytrandate_details',
																												type:'get',
																												data:'&finddate='+finddate,
																												success:function(data)
																												{  
																													$('.SearchRes').html('');
																													$('.SearchRes').html(data);
																												}
																											});
																										});
																										$('.CreateAcc').click(function(e)
																										{
																											e.preventDefault();
																											//alert($(this).attr('href'));
																											$('.box').load($(this).attr('href'));
																											//$('.box_bdy_').load($(this).attr('href'));
																										});	
																										
				
	$(document).ready(function() {																						
	/*SB*/
			var sum = 0;
			var sb_cash_cr_total = 0;
			var sb_cash_db_total = 0;
			var sb_adj_cr_total = 0;
			var sb_adj_db_total = 0;
					
				/*CASH*/
				// CASH CREDIT
				$('.sb_cash_cr').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.sb_cash_cr_total').html(sum);
				// CASH DEBIT
				sum = 0;
				$('.sb_cash_db').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.sb_cash_db_total').html(sum);
				/*ADJUSTMENT*/
				// ADJUSTMENT CREDIT
				sum = 0;
				$('.sb_adj_cr').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.sb_adj_cr_total').html(sum);
				// ADJUSTMENT DEBIT
				sum = 0;
				$('.sb_adj_db').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.sb_adj_db_total').html(sum);
			
			
		/*RD	*/
			var sum = 0;
			var rd_cash_cr_total = 0;
			var rd_cash_db_total = 0;
			var rd_adj_cr_total = 0;
			var rd_adj_db_total = 0;
					
				/*CASH*/
				// CASH CREDIT
				$('.rd_cash_cr').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.rd_cash_cr_total').html(sum);
				// CASH DEBIT
				sum = 0;
				$('.rd_cash_db').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.rd_cash_db_total').html(sum);
				/*ADJUSTMENT*/
				// ADJUSTMENT CREDIT
				sum = 0;
				$('.rd_adj_cr').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.rd_adj_cr_total').html(sum);
				// ADJUSTMENT DEBIT
				sum = 0;
				$('.rd_adj_db').each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.rd_adj_db_total').html(sum);
			
			
			
			
		/*GT*/	
				sum = 0;
				$("[class*='cash_cr_total']").each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.cash_cr_total').html(sum);
			
				sum = 0;
				$("[class*='cash_db_total']").each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.cash_db_total').html(sum);
			
				sum = 0;
				$("[class*='adj_cr_total']").each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.adj_cr_total').html(sum);
			
				sum = 0;
				$("[class*='adj_db_total']").each(function(){
					value = parseInt($(this).html());
					if(! isNaN(value))
						sum += value;
				});$('.adj_db_total').html(sum);
			
			
			
			
			
			
			
			var sum = 0;
			var branch_to_branch_credit_cash_sum=0;
			var branch_to_branch_debit_cash_sum=0;
			var branch_to_branch_credit_adj_sum=0;
			var branch_to_branch_debit_adj_sum=0;
			
			
		/*CASH*/
		// CASH CREDIT
		$('.branch_to_branch_credit_cash').each(function(){
			value = parseInt($(this).html());
			if(! isNaN(value))
				sum += value;
		});$('#branch_to_branch_credit_cash_sum').html(sum);
		// CASH DEBIT
		sum = 0;
		$('.branch_to_branch_debit_cash').each(function(){
			value = parseInt($(this).html());
			if(! isNaN(value))
				sum += value;
		});$('#branch_to_branch_debit_cash_sum').html(sum);
		
		/*ADJUSTMENT*/
		// ADJUSTMENT CREDIT
		sum = 0;
		$('.branch_to_branch_credit_adj').each(function(){
			value = parseInt($(this).html());
			if(! isNaN(value))
				sum += value;
		});$('#branch_to_branch_credit_adj_sum').html(sum);
		// ADJUSTMENT DEBIT
		sum = 0;
		$('.branch_to_branch_debit_adj').each(function(){
			value = parseInt($(this).html());
			if(! isNaN(value))
				sum += value;
		});$('#branch_to_branch_debit_adj_sum').html(sum);
	});
																										
																									</script>

<script>
	<?php 
		$opening_balance = $trandaily['opbal'];
		$running_balance = $opening_balance + $gt_cash_cr - $gt_cash_db;
	?>
	
	$(document).ready(function() {
	
		var running_balance = {{$running_balance}};
		console.log(running_balance);
		$("#running_balance").html(running_balance);
		<?php if($trandaily["date"] == date("Y-m-d")) {?>
			$.ajax({
				url : "update_cash_details",
				type : "post",
				data : "amount="+running_balance,
				success : function() {
					console.log("done");
				}
			});
		<?php } ?>
	});
</script>

