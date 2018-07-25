<!--<style>
	tr.spaceUnder > td
	{
	padding-bottom: 1em;
	}
	}
</style>-->



<div class="English">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<!--<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Savings Bank Account  </h3></br></br>
		</center>-->
		
		
		
		<table class="table bootstrap-datatable responsive" style='font-family:arial;font-size:16;margin-top: 15%;
		margin-left: 25%;'>
			<tr style="border:none">
				<td style="border-top: none;" >
					
					<b>Name And Address Of The Branch:</b></br>
					{{ $SbprintPerData['CustomerDetails']['data']->BName }} BRANCH</br>
					{{ $SbprintPerData['CustomerDetails']['data']->BAddress }} ,
					{{ $SbprintPerData['CustomerDetails']['data']->BCity }}</br>
					{{ $SbprintPerData['CustomerDetails']['data']->BState }} ,
					{{ $SbprintPerData['CustomerDetails']['data']->BPincode }}</br>
					{{ $SbprintPerData['CustomerDetails']['data']->BPhoneNo }}</br></br>
					
					&nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp TIMING</br></br>
					
					Monday TO Friday:09:30 &nbsp AM TO 04:00 &nbsp PM</br>
					Saturday :09:30 &nbsp AM TO 01:00 &nbsp PM</br>
					Sunday :Holiday
					
				</tr>
			</table>
			
			<table class="table bootstrap-datatable responsive" style='font-family:arial;font-size:16;margin-top: 2%; margin-left: 5%;'>
				<tr >
					<td style="border-top: none;" ><b>Account No  &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp </b>
						{{ $SbprintPerData['CustomerDetails']['data']->AccNum }}
					</td>
					
				</tr>
				
				<tr>
					</br><td style="border-top: none;"><b>Name &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp </b>
						{{ $SbprintPerData['CustomerDetails']['data']->FirstName }} &nbsp {{ $SbprintPerData['CustomerDetails']['data']->MiddleName }} &nbsp {{ $SbprintPerData['CustomerDetails']['data']->LastName }}
					</td>
					<?php
					if($SbprintPerData["usre2"]["is_joint_acc"]) {?>
						<td style="border-top: none;"><b>,   &nbsp &nbsp </b>
							{{ $SbprintPerData['usre2']['uid2_name'] }}
						</td>
					<?php } ?>
				</tr>
				<!--<tr>
					
					<td style="border-top: none;"><b>Father Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp   </b>
						{{ $SbprintPerData['CustomerDetails']['fa_name']}}
					</td>
				</tr>-->
				<tr>
						@if($SbprintPerData['CustomerDetails']['fa_name'] != '')
							<td style="border-top: none;"><b>Father Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp   </b>
							{{ $SbprintPerData['CustomerDetails']['fa_name']}}
						@elseif($SbprintPerData['CustomerDetails']['spouse_name'] !='')
							<td style="border-top: none;"><b>Spouse Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp   </b>
							{{ $SbprintPerData['CustomerDetails']['spouse_name']}}
						@endif
					</td>
				</tr>
			
				<tr>
					<td style="border-top: none;" colspan=3><b>Address &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp </b>
						{{ $SbprintPerData['CustomerDetails']['data']->Address }}&nbsp </br>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp	{{ $SbprintPerData['CustomerDetails']['data']->City }}&nbsp,
						{{ $SbprintPerData['CustomerDetails']['data']->District }}&nbsp </br>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{ $SbprintPerData['CustomerDetails']['data']->State }}&nbsp,
						{{ $SbprintPerData['CustomerDetails']['data']->Pincode }}&nbsp &nbsp
						
						
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;"><b>Acc Open Date &nbsp  &nbsp &nbsp &nbsp &nbsp </b> <?php $trandate=date("d-m-Y",strtotime($SbprintPerData['CustomerDetails']['data']->Created_on ));  echo $trandate; ?>
					</td>
					<td style="border-top: none;"><b>Nominee:</b>
						{{ $SbprintPerData['CustomerDetails']['data']->Nom_FirstName }} &nbsp {{ $SbprintPerData['CustomerDetails']['data']->Nom_MiddleName }} &nbsp {{ $SbprintPerData['CustomerDetails']['data']->Nom_LastName }}
					</td>
				</tr>
				
				<hr>
				
				<tr>
					<td>&nbsp </br> &nbsp </br> &nbsp <b>Date  of Issue Of passBook:</b> <?php echo date('d-m-Y') ;?></td>
					
					
					<td>&nbsp </br> &nbsp </br> &nbsp <b>Authorised Signatory:</b> </td>
				</tr>
			</table>
				
	</div>
			
	<center>
		<div class="col-sm-12">
			<input type="button" value="PRINT" class="btn btn-info btn-md print" id="print">
		</div>
	</center></br></br>	
			
			
</div>

		<div class="Kannada">
			<table class="table bootstrap-datatable" style='font-size:12;width:100%;'>
				<tbody>
				
					<?php
						$running_amt = $SbprintPerData['prev_balance'];
					?>
				
				
					@foreach($SbprintPerData['TransactionDetails']['id'] as $SLPD)
					
						<?php
							if(!empty($SLPD->Uncleared_Bal)) {
								continue;
							}?>
							
					<tr class="small">
						<?php $b=0;?>
						<td><input type="radio" name="sele" value="<?php $temp=$SLPD->Tranid; echo $temp;?>" onclick="setid($id=<?php $temp=$SLPD->Tranid; echo $temp;?>);"></td>
						<td>{{$SLPD->Tranid}}</td>
						<td  width="10%"><?php $trandate=date("d-m-Y",strtotime($SLPD->SBReport_TranDate));  echo $trandate; ?></td>
						<td  width="33%"><?php  echo $s=$SLPD->particulars; $f=strlen($s);if($f>=43){$d=($f/43);$b=$b+intval($d);}?></td>
						<td width="10%">1234</td>
						@if($SLPD->TransactionType=="Credit"||$SLPD->TransactionType=="CREDIT"||$SLPD->TransactionType=="credit")
						
							<td  width="10%"align="right"><p class="text">-</p></td>
							<td  width="10%" align="right"><p class="text"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td>
							
							<?php 
								if($SLPD->Cleared_State != "UNCLEARED" && !($SLPD->Uncleared_Bal > 0) ) {
									$running_amt += $temp;
								}?>
						@else
						
						
						<td  width="10%" align="right"><p class="text"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
						<td  width="10%"align="right"><p class="text">-</p></td>
						
							<?php 
								if($SLPD->Cleared_State != "UNCLEARED"&& !($SLPD->Uncleared_Bal > 0) ) {
									$running_amt -= $temp;
								}?>
						@endif
						<td width="10%" align="right"><p class="text"><?php echo $running_amt; ?></p></td>
							<?php /*		<td width="10%" align="right"><p class="text">{{ $SLPD->Total_Bal }}</p></td> */?>
						<td width="10%"></td>
						<td><input type="checkbox" class="swap" id="{{$SLPD->Tranid}}" /></td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
			<input type="text"class="hidden"id="t"/>
			<div class="col-sm-6">
				<input type="button" value="print" class="btn btn-info btn-md Knprint" id="Knprint">
			</div>
			<div class="col-sm-5">
				<input type="button" value="SWAP" class="btn btn-info btn-md btn_swap pull-right" id="btn_swap">
			</div>
			<div class="col-sm-1">
				<input type="button" value="DELETE" class="btn btn-danger btn-md btn_swap pull-right" id="btn_delete">
			</div>
<script>
	$("#btn_swap").click(function() {
		console.log("click");
		var count = 0;
		var flag;
		var sb_tran_id_1, sb_tran_id_2;
		$(".swap").each(function() {
			if($(this).prop("checked")) {
				count++;
				if(count == 1)
					sb_tran_id_1 = $(this).attr("id");
				if(count == 2)
					sb_tran_id_2 = $(this).attr("id");
			};
		});
		if(count == 2) {
			swap(sb_tran_id_1,sb_tran_id_2);
		} else {
			alert("SELECT EXACTLY '2' ENTRIES\n("+count+" entries selected)");
		}
		console.log(count+" entries selected");
		count = 0;
	});
	
	function swap(sb_tran_id_1,sb_tran_id_2)
	{
		console.log(sb_tran_id_1+","+sb_tran_id_2);
		
		//ajax call
		
		$.ajax({
			url: "swap_sb_tranid",
			type: "post",
			data: "&sb_tran_id_1="+sb_tran_id_1+"&sb_tran_id_2="+sb_tran_id_2,
			success: function(data) {
				console.log("swap_sb_tranid: done");
				$(".sb_print_refresh").trigger("click");
			}
		});
	}
	
	$("#btn_delete").click(function() {
		console.log("click");
		var count = 0;
		var flag;
		var sb_tran_id;
		$(".swap").each(function() {
			if($(this).prop("checked")) {
				count++;
				if(count == 1)
					sb_tran_id = $(this).attr("id");
			};
		});
		if(count == 1) {
			delete_tran(sb_tran_id);
		} else {
			alert("SELECT ONLY '1' ENTRIY\n("+count+" entries selected)");
		}
		console.log(count+" entries selected");
		count = 0;
	});
	
	function delete_tran(sb_tran_id)
	{
		console.log(sb_tran_id+","+sb_tran_id);
		
		//ajax call
		
		$.ajax({
			url: "delete_sb_tranid",
			type: "post",
			data: "&sb_tran_id="+sb_tran_id,
			success: function(data) {
				console.log("delete_sb_tranid: done");
				$(".sb_print_refresh").trigger("click");
			}
		});
	}
</script>
			
		</center>
	</div>
	<div class="Kannada1 hidden">
		<div  id="toprint1">
			<?php
				print_passbook($SbprintPerData['TransactionDetails']['id'],$SbprintPerData['pnum'],$SbprintPerData['lineval'],$SbprintPerData['num'],$SbprintPerData['previous_bal'],$SbprintPerData['TransactionDetails']['pb'],$SbprintPerData['prev_balance']);
				
				
				
				function print_p($page_no,$line_no,$trdata,$printtabledata,$x,$pb)
				{
					//echo $page_no.'-'.$line_no.'</br>';
					$total_no_of_page = 15;
					$lines_on_one_page = 18;
					$line_to_exclude_on_odd_pages = 2;
					$line_to_exclude_on_even_pages = 0;
					$line_to_exclude_on_odd_pages_end = 1;
					$line_to_exclude_on_even_pages_end = 1;
					$line_height ="2px";
					
					$zxc = '<tr><td width="3%">-</td>';
					$zxc .= '<td width="10%">-</td>';
					$zxc .= '<td width="33%">previous Balance</td>';
					$zxc .= '<td width="10%">-</td>';
					$zxc .= '<td width="10%">-</td>';
					$zxc .= '<td width="10%">-</td>';
					$zxc .= '<td width="10%">'.$pb.'</td></tr>';
					if($page_no <= $total_no_of_page)
					{
						if($page_no % 2)
						{
							//odd
							//echo "odd";
							if(($line_no + $line_to_exclude_on_odd_pages) <= ($lines_on_one_page - $line_to_exclude_on_odd_pages_end))
							{
								
								
								if(($line_no + $line_to_exclude_on_odd_pages) == 3)
								{
									//print padding * 2
									$printtabledata.='<tr><td><br/><br/><br/></td></tr>';
								}
								//print trdata
								if($x==0)
								{
									$printtabledata.=$zxc;
									
								}
								$printtabledata.=$trdata;
							}
							else
							{
								$printtabledata.='<tr><td><br/></td></tr>';
							}
						}
						else
						{
							//even
							if(($line_no + $line_to_exclude_on_even_pages) <= ($lines_on_one_page - $line_to_exclude_on_even_pages_end))
							{
								if(($line_no + $line_to_exclude_on_even_pages) == 1)
								{
									//print padding * 2
									$printtabledata.='<tr><td><br/></td></tr>';
									$printtabledata.='<tr><td><br/></td></tr>';
								}
								//print trdata
								if($x==0)
								{
									$printtabledata.=$zxc;
									
								}
								$printtabledata.=$trdata;
							}
							
						}
					}
					else
					{
						//please insert new book
					}
					return $printtabledata;
				}
				
				function print_passbook($array_to_print,$user_input_page_number,$user_input_line_number,$slno,$x,$pb,$prev_balance)
				{
					$total_no_of_page = 15;
					$lines_on_one_page = 18;
					$line_to_exclude_on_odd_pages = 2;
					$line_to_exclude_on_even_pages = 4;
					$line_to_exclude_on_odd_pages_end = 2;
					$line_to_exclude_on_even_pages_end = 0;
					$line_height ="2px";
					$page_num = $user_input_page_number;
					$line_num = $user_input_line_number;
					
					$sl = $slno;
					$printabletable="<style>@media print {
						.page_break {page-break-after: always;}
					}</style>";
					$printabletable.='<table class="table bootstrap-datatable" style="font-size:12;width:100%;">';
					
					if($page_num%2)
					{
						
					}
					else
					{
						//echo 'hi';
						$v = $lines_on_one_page - 2;
						for($i = 1; $i <= $v; $i++)
						{
							//echo 'hi2';
							$printabletable.='<tr><td><br/></td></tr>';
						}
					}
					if($user_input_line_number > 1)
					{
						$v = $user_input_line_number ;
						for($i = 1; $i <= $v; $i++)
						{
							//echo 'hi3';
							$printabletable.='<tr><td><br/></td></tr>';
						}
					}
					//echo '<pre>'.$printabletable.'</pre>';
					
					$running_amt = $prev_balance;
					foreach($array_to_print as $val)
					{
						if(!empty($val->Uncleared_Bal)) {
							continue;
						}
						
					 $trandate=date("d-m-Y",strtotime($val->SBReport_TranDate));
						$extra_lines = 0;
						$trdata='';
						if($page_num <= $total_no_of_page )
						{
							$particulars_length = 0;
							if($page_num%2)
							{
								//odd
								$page_no = $page_num;
								$line_no = $line_num;
								$trdata = '<tr><td width="3%">'.$sl.'</td>';
								//$trdata .= '<td width="10%">'.$val->SBReport_TranDate.'</td>';
								$trdata .= '<td width="10%">'.$trandate.'</td>';

								$particulars = substr($val->particulars,0,50); // MAXIMUM 50 CHARACTERS
								$particulars_length = strlen($particulars);
								// var_dump("particulars_length: {$particulars_length}");

								$trdata .= '<td width="33%">'.$particulars.'</td>';
								$trdata .= '<td width="10%">-</td>';
								if($val->TransactionType=="Credit"||$val->TransactionType=="CREDIT"||$val->TransactionType=="credit")
								{
									
									if($val->Cleared_State != "UNCLEARED" && !($val->Uncleared_Bal > 0) ) {
										$running_amt += $val->Amount;
									}
									$trdata .= '<td width="10%" align="right">-</td>';
									$trdata .= '<td width="10%" align="right">'.number_format($val->Amount, 2).'</td>';
									
								}
								else
								{
							
									if($val->Cleared_State != "UNCLEARED"&& !($val->Uncleared_Bal > 0) ) {
										$running_amt -= $val->Amount;
									}
									$trdata .= '<td width="10%" align="right">'.number_format($val->Amount, 2).'</td>';
									$trdata .= '<td width="10%" align="right">-</td>';
									
								}
								$trdata .= '<td width="10%" align="right">'.number_format($running_amt, 2).'</td>';
//								$trdata .= '<td width="10%" align="right">'.number_format($val->Total_Bal, 2).'</td>';
								$trdata .= '<td width="10%" align="right"></td></tr>';
								$printabletable=print_p($page_no,$line_no,$trdata,$printabletable,$x,$pb);
								$x=$x+1;
								$extra_lines =  $line_to_exclude_on_odd_pages + $line_to_exclude_on_odd_pages_end;
							}
							else
							{
								//even
								$page_no = $page_num;
								$line_no = $line_num;
								$trdata = '<tr><td width="3%">'.$sl.'</td>';
								$trdata .= '<td width="10%">'.$trandate.'</td>';
								
								$particulars = substr($val->particulars,0,50); // MAXIMUM 50 CHARACTERS
								$particulars_length = strlen($particulars);
								// var_dump("particulars_length: {$particulars_length}");

								$trdata .= '<td width="33%">'.$particulars.'</td>';
								$trdata .= '<td width="10%">-</td>';
								if($val->TransactionType=="Credit"||$val->TransactionType=="CREDIT"||$val->TransactionType=="credit")
								{
									if($val->Cleared_State != "UNCLEARED" && !($val->Uncleared_Bal > 0) ) {
										$running_amt += $val->Amount;
									}
									$trdata .= '<td width="10%" align="right">-</td>';
									$trdata .= '<td width="10%" align="right">'.number_format($val->Amount, 2).'</td>';
									
								}
								else
								{
							
									if($val->Cleared_State != "UNCLEARED"&& !($val->Uncleared_Bal > 0) ) {
										$running_amt -= $val->Amount;
									}
									$trdata .= '<td width="10%" align="right">'.number_format($val->Amount, 2).'</td>';
									$trdata .= '<td width="10%" align="right">-</td>';
								}
								$trdata .= '<td width="10%" align="right">'.number_format($running_amt, 2).'</td>';
//								$trdata .= '<td width="10%" align="right">'.number_format($val->Total_Bal, 2).'</td>';
								$trdata .= '<td width="10%"></td></tr>';
								
								$printabletable=print_p($page_no,$line_no,$trdata,$printabletable,$x,$pb);
								$x=$x+1;
								$extra_lines = $line_to_exclude_on_even_pages + $line_to_exclude_on_even_pages_end;
							}
							$line_num++;
							
							while($particulars_length > 30) {
								$particulars_length = $particulars_length - 30;
								$line_num++;
							}
							// var_dump("line_num: {$line_num}");

							if(($line_num + $extra_lines) <= $lines_on_one_page)
							{
								//same page
								//next line
							}
							else
							{
								$line_num = 1;
								$page_num++;
								if($page_num%2)
								{
									// $printabletable.='<tr><td>*<br/>*<br/>*<br/>*</td></tr>';
									$printabletable.='';
									$printabletable.='<tr><td><p class="page_break"></p>&nbsp;</td></tr>';
								}
							}
						}
						else
						{
							//new book
						}
						$sl++;
					}
					$printabletable .='</table>';
					echo $printabletable;
				}
				
			?>
			
			
			
			
		</div>
		
		
	</div>
	
	
	
	
	
	
	
	
	<style type="text/css">
		@media print {
		input#print {
		display: none;
		}
		}
	</style> 
	<style type="text/css">
		@media Knprint {
		input#Knprint {
		display: none;
		}
		
		
		}
	</style> 
	<style type="text/css" media="all">
		.small {
		line-height: 2;
		}
		
	</style>
	
	
	
	<script src="js/jQuery.print.js"></script>
	<script>
		
		CheckVal="<?php echo $SbprintPerData['Kannada']; ?>";
		
		$('document').ready(function(){
			
			if(CheckVal==0)
			{
				$('.English').hide();
				$('.Kannada').show();
			}
			
			else
			{
				$('.English').show();
				$('.Kannada').hide();
			}
			
			
		});
	</script>
	
	
	
	<script>
		
		
		
		
		
		$('.clickme').click(function(e)
		{
			$('.purshareclassid').click();
		});
		
		$('.purshrcrt').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		
		$('.edtbtn').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		
		$(function() {
			$(".print").click(function() {
				
				var divContents = $("#toprint").html();
				var printWindow = window.open('', '', 'height=600,width=800');
				printWindow.document.write('<html><head><title>SB LEDGER</title>');
				printWindow.document.write('</head><body>');
				printWindow.document.write(divContents);
				printWindow.document.write('</body></html>');
				printWindow.document.close();
				// printWindow.print();
				setTimeout(function() {
					printWindow.print();
				}, 5000);

				
				
				
				
				
				
				
				//$.print("#toprint");
			});
			
			$(".Knprint").click(function() {
				
				var divContents = $("#toprint1").html();
				var printWindow = window.open('', '', 'height=600,width=800');
				printWindow.document.write('<html><head><title>ಎಸ್.ಬಿ ಲೆಡ್ಜರ್</title>');
				printWindow.document.write('</head><body>');
				printWindow.document.write(divContents);
				printWindow.document.write('</body></html>');
				printWindow.document.close();
				// printWindow.print();
				setTimeout(function() {
					printWindow.print();
				}, 5000);
				
				
				
				
				
				
				
				//$.print("#toprint");
			});
		});
		
		
	</script>
	
	<script>
		
		$("ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc");
			
		});
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.SearchRes').load($(this).attr('href'));
		});
		
		var a=0;
		function setid($temp)
		{
			a=$temp;
			$('#t').val(a);
			
			
		}
	</script>
	
	