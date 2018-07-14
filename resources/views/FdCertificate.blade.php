<div id="content" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> FD Certificate</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<div  id="toprint">
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
						
						<style type="text/css" media="all">
							.borderprint {
							border:2px solid black;
							}
							.lettersize {
							font-size:9px;
							
							}.sizeofletter {
							font-size:14px;
							
							}
							
						</style>
						<style type="text/css">
							@media print {
							input#print {
							display: none;
							}
							.table-bordered > tbody > tr > th,.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
							border: 2px solid #000 !important;
							}
							}
							.table-bordered > tbody > tr > th,.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
							border: 2px solid #000 !important;
							}
						</style> 
						<div class="ori">
							<center><b>FD CERTIFICATE</b></center>
						</div>
						<div class="kcc">
							<center><b>KCC CERTIFICATE</b></center>
						</div>
						<div class="dup">
							<center><b>FD CERTIFICATE (DUPLICATE)</b></center>
						</div>
						
						
						
						@foreach ($FdCert['FdCertificate'] as $FdCertiDetails)
						
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive borderprint" style='font-family:arial;font-size:12'>
							
							
							
							<tr class="borderprint">
								<td rowspan="6" width="60%" class="borderprint ">
									<b>NAME&nbsp:</b>&nbsp
										{{ $FdCertiDetails->FirstName}}&nbsp{{ $FdCertiDetails->MiddleName }}&nbsp{{ $FdCertiDetails->LastName }}<br/>
										
										<?php if(!empty($FdCertiDetails->SpouseName)){ echo '( Spouse Name ) :'.$FdCertiDetails->SpouseName;  }  else { echo '( Father/Mother ): '.  $FdCertiDetails->FatherName ; } ?><br/>
										<b>ADDRESS &nbsp:</b> &nbsp
											{{ $FdCertiDetails->Address}}</br>{{ $FdCertiDetails->City}}
											
											
										</td>
									</tr>
									
									
									<tr class="borderprint">
										<th class="borderprint">
											DATE OF ISSUE:
										</th>
										<td class="borderprint">
											<?php $strdate=date('d-m-Y'); echo $strdate;?>
										</td>
									</tr>
									
									<tr class="borderprint">
										<th class="borderprint ori">
											FD NUMBER:
										</th>
										<th class="borderprint kcc">
											KCC NUMBER:
										</th>
										<td class="borderprint">
											{{ $FdCertiDetails->Fd_CertificateNum }}
										</td>
									</tr>
									
									<tr class="borderprint">
										<th class="borderprint">
											DEPOSIT AMOUNT:
										</th>
										<td class="borderprint">
											{{ $FdCertiDetails->Fd_DepositAmt }} /-
										</td>
									</tr>
									
									<tr class="borderprint">
										<th class="borderprint">
											PERIOD:
										</th>
										<td class="borderprint">
											{{ $FdCertiDetails->Days }} Days
										</td>
									</tr>
									
									<tr class="borderprint">
										<th class="borderprint">
											START DATE:
										</th>
										<td class="borderprint">
											<?php $strdate=date("d-m-Y",strtotime($FdCertiDetails->FdReport_StartDate)); echo $strdate;?>
										</td>
									</tr>
									
									<tr class="borderprint">
										<td rowspan="3"width="60%" class="borderprint">
											<b>AMOUNT &nbsp:</b>
												<div class='rup'></div>
												<input class='rupees hidden' id="rupees" value="{{ $FdCertiDetails->Fd_DepositAmt }}"/>
											</td>
										</tr>
										
										
										<tr class="borderprint">
											<th class="borderprint">
												DUE DATE:
											</th>
											<td class="borderprint">
												<?php $maturedate=date("d-m-Y",strtotime($FdCertiDetails->FdReport_MatureDate)); echo $maturedate;?>
											</td>
										</tr>
										
										<tr class="borderprint">
											<th class="borderprint">
												INTEREST RATE:
											</th>
											<td class="borderprint">
												{{ $FdCertiDetails->FdInterest }} %
											</td>
										</tr>
										
										<tr class="borderprint">
											<td rowspan="3"width="60%" class="borderprint">
												
												<b>NOMINEE &nbsp:</b>&nbsp
													{{ $FdCertiDetails->Nom_FirstName }}&nbsp{{ $FdCertiDetails->Nom_MiddleName }}&nbsp{{ $FdCertiDetails->Nom_LastName }}<br/>
													<b>RELATIONSHIP &nbsp:</b>&nbsp
														{{ $FdCertiDetails->Relationship }}
													</td>
												</tr>
												
												<tr class="borderprint">
													<th class="borderprint">
														MATURITY VALUE:
													</th>
													<td class="borderprint">
														{{ $FdCertiDetails->Fd_TotalAmt }}
													</td>
												</tr>
												
												<tr class="borderprint">
													<th class="borderprint">
														INTEREST PERIOD:
													</th>
													<td class="borderprint">
														
													</td>
												</tr>
												
												
												
												
												
												
											</table>
											
											
											
											
											
											
											
											</br>
											
											</br>
										
											
											<div class="lettersize">
												Note:Interest will cease at the expiration of the period.The receipt should be surrendered duly endorsed with a letter for payment/renewal.No notice will be issused by the society
											</div>
											
											
											
											@endforeach
											
										</div>
										
										<center>
											
											<div class="col-sm-12">
												<input type="button" value="PRINT" class="btn btn-info btn-sm print" id="print">
											</div>
											
										</center>
										
										<br/>
										<br/>
									</div>
									
									
								</div>
								
							</div>
						</div>
					</div>
					
					
					
					
					<script src="js/jQuery.print.js"></script>
					<script src="js/AmountToRupee.js"></script>
					<script type="text/javascript">
						rupee="<?php echo $FdCertiDetails->Fd_DepositAmt; ?>";
						//alert(rupee);
						//rupee=parseFloat(rup);
						InWords=AmountToRupee(rupee);
						//alert(InWords);
						$('.fdln3').html(InWords);
						$('.rup').html(InWords);
						
						
					</script>
					<script>
						cerStat="<?php echo $FdCertiDetails->Fd_CertiPrint;?>"
						KCC="<?php echo $FdCertiDetails->FDkcc;?>"
						
						if(KCC.toUpperCase()=="KCC")
						{
							$('.ori').hide();
							$('.dup').hide();
							$('.kcc').show();
						}
						else
						{
							if(cerStat.toUpperCase()=="NO" )
							{
								$('.ori').show();
								$('.dup').hide();	
								$('.kcc').hide();
							}
							else if(cerStat.toUpperCase()=="YES")
							{
								$('.ori').hide();
								$('.dup').show();
								$('.kcc').hide();
							}
							if(KCC.toUpperCase()=="KCC")
							{
								$('.ori').hide();
								$('.dup').hide();
								$('.kcc').show();
							}
						}
						$('.clickme').click(function(e)
						{
							$('.fdallocclassid').click();
						});
						
						
						
						$(function() {
							$(".print").click(function() {
								//alert('test');
								//$("#toprint").print();
								//$cert={{ $FdCertiDetails->Fd_CertificateNum }};
							var divContents = $("#toprint").html();
							var printWindow = window.open('', '', 'height=400,width=800');
							printWindow.document.write('<html><head><title>FD CERTIFICATE</title>');
							printWindow.document.write('</head><body >');
							printWindow.document.write(divContents);
							printWindow.document.write('</body></html>');
							printWindow.document.close();
							printWindow.print();
							//$.print("#toprint");
							
							Fdid="<?php echo $FdCertiDetails->Fdid;?>";
							// alert(Fdid);
							$.ajax({
								url:'FdCertStatUpdate',
								type:'post',
								data:'&Fdid='+Fdid,
								success:function(data)
								{
									
									
									
									
								}
							});
							
							});
						});
						
						
					</script>																																				