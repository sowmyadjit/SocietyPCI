
<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li> <a href="#">Home</a> </li>
			<li> <a class="clickme" >REPORT TYPE</a> </li>
		</ul>
	</div>
	
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
							<tr>
								<th>Type</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<td colspan="2"><center><h4><b>Account Details</b></h4></center></td>
							</tr>
							<tr>
								<td>SB</td>
								<td>{{ $tot['sb'] }}</td>
							</tr>
							<tr>
								<td>PIGMY</td>
								<td>{{ $tot['pigmy'] }}</td>
							</tr>
							<tr>
								<td>RD</td>
								<td>{{ $tot['rd'] }}</td>
							</tr>
							<tr>
								<td>FD</td>
								<td>{{ $tot['fd'] }}</td>
							</tr>
							<tr>
								<td>KCC</td>
								<td>{{ $tot['kcc'] }}</td>
							</tr>
							
							<tr>
								<td colspan="2"><center><h4><b>Deposit Loan Details</b></h4></center></td>
							</tr>
							<tr>
								<td>Deposit Loan</td>
								<td>{{ $tot['dl_remaing'] }}</td>
							</tr>
							<tr>
								<td>PIGMY Deposit Loan</td>
								<td>{{ $tot['dl_remaing_pigmi'] }}</td>
							</tr>
							<tr>
								<td>RD Deposit Loan</td>
								<td>{{ $tot['dl_remaing_rd'] }}</td>
							</tr>
							<tr>
								<td>FD Deposit Loan</td>
								<td>{{ $tot['dl_remaing_fd'] }}</td>
							</tr>
							<tr>
								<td>KCC Deposit Loan</td>
								<td>{{ $tot['dl_remaing_kcc'] }}</td>
							</tr>
							
							<tr>
								<td colspan="2"><center><h4><b>Personal Loan Details</b></h4></center></td>
							</tr>
							<tr>
								<td>Personal Loan</td>
								<td>{{ $tot['pl_remaing'] }}</td>
							</tr>
							<tr>
								<td>ASL</td>
								<td>{{ $tot['pl_remaing_asl'] }}</td>
							</tr>
							<tr>
								<td>CSL</td>
								<td>{{ $tot['pl_remaing_csl'] }}</td>
							</tr>
							<tr>
								<td>AMTL</td>
								<td>{{ $tot['pl_remaing_amtl'] }}</td>
							</tr>
							<tr>
								<td>CMTL</td>
								<td>{{ $tot['pl_remaing_cmtl'] }}</td>
							</tr>
							
							<tr>
								<td colspan="2"><center><h4><b>Jewel AND Staff Loan Details</b></h4></center></td>
							</tr>
							<tr>
								<td>Jewel Loan</td>
								<td>{{ $tot['jl_remaing'] }}</td>
							</tr>
							<tr>
								<td>Staff Loan</td>
								<td>{{ $tot['sl_remaing'] }}</td>
							</tr>
						</tbody>
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