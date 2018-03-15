<link href="css/loader.css" rel='stylesheet'> 

<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
	<div class="sidebar-nav">
		<div class="nav-canvas">
			<div class="nav-sm nav nav-stacked">
				
			</div>
			<ul class="nav nav-pills nav-stacked main-menu ">
				<li class="nav-header">		Main</li>
				
				<li class='side'><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span>		Dashboard</span></a>
				</li>
				<!--auto-->
				<?php 
					
					foreach($Side_Detail['modules'] as $mod)
					{
						if($mod->MStatus=="true")
						{
							foreach($Side_Detail['permission'] as $perms)
							{
								
								if($perms->Mid==$mod->Mid && $perms->View==1) 
								
								{
									
									$r=explode('>',$mod->MName);
									//print_r($r);
									//$sidebar['main'][]=$r[0];
									$sidebar['main']['temp'][]=$r[0];
									
									foreach ($sidebar['main']['temp'] as $side_tsingle)
									{
										if(!empty($sidebar['main']['outer']))
										foreach ($sidebar['main']['outer'] as $side_osingle)
										{
											if(empty($sidebar['main']['outer']))
											$sidebar['main']['outer'][]=$r[0];
											if($side_tsingle!=$side_osingle)
											if($side_osingle!=$r[0])
											$sidebar['main']['outer'][]=$r[0];
										}
										else
										$sidebar['main']['outer'][]=$r[0];
									}
									$sidebar['main']['outer']=array_unique ( $sidebar['main']['outer']);
									$sidebar['main'][$r[0]]['inner'][]=$r[1];
									$sidebar['main'][$r[0]][$r[1]]['href']=$mod->MUrl;
									$sidebar['main'][$r[0]][$r[1]]['mname']=$mod->Mid;
									$sidebar['main'][$r[0]][$r[1]]['classid']=$mod->MClassId;
									$sidebar['main'][$r[0]][$r[1]]['tooltip']=$mod->MToolTip;
									$sidebar['main'][$r[0]][$r[1]]['icon']=$mod->MIcon;
								}
								
							}
						}
						
					}
					
					foreach ($sidebar['main']['outer'] as $side_single)
					{
						//print_r($sidebar['main'][$side_single]['inner']);
						echo '<li class="accordion">
						<a href="#" data-toggle="tooltip" data-placement="right" title=""><i class="glyphicon glyphicon-plus"></i> <span>'.$side_single.'</span></a>
						<ul class="nav nav-pills nav-stacked"  id="SideLink">';
						
						foreach ($sidebar['main'][$side_single]['inner'] as $side_single_inner)
						{
							
							echo '<li class="side"><a rel="'.$sidebar['main'][$side_single][$side_single_inner]['mname'].'"data-toggle="tooltip" data-placement="right" title="'.$sidebar['main'][$side_single][$side_single_inner]['tooltip'].'" class="ajax-link sidebarlink '.$sidebar['main'][$side_single][$side_single_inner]['classid'].'" href="'.$sidebar['main'][$side_single][$side_single_inner]['href'].'"><i class="'.$sidebar['main'][$side_single][$side_single_inner]['icon'].'"></i>		<span>		'.$side_single_inner.'</span></a></li>';
						}
						echo '	</ul>
						</li>';
						
					}
				?>
				<!--end auto -->
				
				
				<!-- HARDCODED LINK-->
				<!--<li class="accordion">
					<a href="#" data-toggle="tooltip" data-placement="right" title="Links For Managers Only!"><i class="glyphicon glyphicon-plus"></i><span>		ADMIN MODULE</span></a>
					<ul class="nav nav-pills nav-stacked">
					
					
					
					<li class='side'><a class="ajax-link sidebarlink companyclassid" href="company"><i class="glyphicon glyphicon-globe"></i>		<span>		COMPANY</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink branchclassid" href="branch"><i class="glyphicon glyphicon-random"></i><span>		BRANCH</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink designationclassid" href="designation"><i class="glyphicon glyphicon-briefcase"></i><span>		DESIGNATION</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink empclassid" href="emp"><i class="glyphicon glyphicon-eye-open"></i><span>EMPLOYEE</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink salclassid" href="salary"><i class="glyphicon glyphicon-eye-open"></i><span>SALARY</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink modulesclassid" href="modules"><i class="glyphicon glyphicon-tasks"></i><span>		MODULES</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink permissionclassid" href="permissions"><i class="glyphicon glyphicon-ban-circle"></i><span>		PERMISSIONS</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink custauhclassid" href="custauth"><i class="glyphicon glyphicon-eye-open"></i><span>		AUTHORISE</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink acctypclassid" href="acctype"><i class="glyphicon glyphicon-ban-circle"></i><span>		 TYPES  OF ACCOUNT</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink fdtypclassid" href="fdtype"><i class="glyphicon glyphicon-ban-circle"></i><span>		FD TYPE</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink bankclassid" href="bank"><i class="glyphicon glyphicon-ban-circle"></i><span>		ADD BANK</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink depositclassid" href="deposit"><i class="glyphicon glyphicon-ban-circle"></i><span> Deposit to BANK</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink expenceclassid" href="expence"><i class="glyphicon glyphicon-ban-circle"></i><span> Expense</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink opencloseclassid" href="openclose"><i class="glyphicon glyphicon-eye-open"></i><span>		Open Close Balance</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink loanclassid" href="Loantype"><i class="glyphicon glyphicon-eye-open"></i><span>		LOAN TYPE</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink clearclassid" href="unclearedcheque"><i class="glyphicon glyphicon-eye-open"></i><span>		UNCLEARED CHEQUE</span></a>
					</li>
					
					
					
					
					</ul>
					</li>
					
					
					
					<li class="accordion">
					<a href="#" data-toggle="tooltip" data-placement="right" title="Links For Staff and Managers!"><i class="glyphicon glyphicon-plus"></i><span>		STAFF MODULE</span></a>
				<ul class="nav nav-pills nav-stacked">-->
				
				
				
				<!--<li class='side'><a class="ajax-link sidebarlink userclassid" href="user"><i class="glyphicon glyphicon-user"></i><span>		USER</span></a>
				</li>-->
				
				
				<!--<li class='side'><a class="ajax-link sidebarlink custclassid" href="customer"><i class="glyphicon glyphicon-eye-open"></i><span>		CUSTOMER</span></a>
					</li>
					
					
					
					<li class='side'><a class="ajax-link sidebarlink accclassid" href="AccountCreation"><i class="glyphicon glyphicon-eye-open"></i><span>		ACCOUNT CREATION</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink fdallocclassid" href="fdallocation"><i class="glyphicon glyphicon-eye-open"></i><span>		FD ALLOCATION</span></a>
					</li>
					
					
					
					
					<li class='side'><a class="ajax-link sidebarlink tranclassid" href="transation"><i class="glyphicon glyphicon-eye-open"></i><span>		TELLER</span></a>
					</li>
					
					
					
					<li class="accordion">
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span>		PAY AMOUNT</span></a>
					<ul class="nav nav-pills nav-stacked">
					
					
					<li class='side'><a class="ajax-link sidebarlink payclassid" href="PayAmountIndex"><i class="glyphicon glyphicon-eye-open"></i><span> PIGMY PAY AMOUNT</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink rdpayclassid" href="RDPayAmountIndex"><i class="glyphicon glyphicon-eye-open"></i><span>		RD PAY AMOUNT</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink fdpayclassid" href="FDPayAmountIndex"><i class="glyphicon glyphicon-eye-open"></i><span>		FD PAY AMOUNT</span></a>
					</li>
					
					
					
					</ul>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink pigmiintclassid" href="pigmiinterest"><i class="glyphicon glyphicon-eye-open"></i><span>		INTEREST CALCULATION</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink pigmiintclassid" href="prepigmiinterest"><i class="glyphicon glyphicon-eye-open"></i><span>		PRE WITHDRAWAL</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink Reqploanclassid" href="ReqPersonalLoan"><i class="glyphicon glyphicon-eye-open"></i><span>		REQUEST FOR LOAN</span></a>
					</li>
					
					
					<li class="accordion">
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span>		LOAN ALLOCATION</span></a>
					<ul class="nav nav-pills nav-stacked">
					
					
					<li class='side'><a class="ajax-link sidebarlink loanalcclassid" href="Loanallocation"><i class="glyphicon glyphicon-eye-open"></i><span>		DEPOSITE LOAN</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink ploanclassid" href="PersonalLoan"><i class="glyphicon glyphicon-eye-open"></i><span>		PERSONAL LOAN</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink stloanclassid" href="StffLoan"><i class="glyphicon glyphicon-eye-open"></i><span>		STAFF LOAN</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink jewloanclassid" href="jewelLoan"><i class="glyphicon glyphicon-eye-open"></i><span>		JEWEL LOAN</span></a>
					</li>
					
					
					
					</ul>
					</li>
					<li class='side'><a class="ajax-link sidebarlink pigmidlrepayclassid" href="pigmiDLPigmy"><i class="glyphicon glyphicon-eye-open"></i><span>		Pygmy DL Repayment</span></a>
					</li>
					
					
					
					</ul>
					</li>
					
					
					
					
					
					
					<li class="accordion">
					<a href="#" data-toggle="tooltip" data-placement="right" title="Members List,Request For Shares,Purchase Share Details"><i class="glyphicon glyphicon-plus"></i><span>   SHARES</span></a>
					<ul class="nav nav-pills nav-stacked">
					
					<li class='side'><a class="ajax-link sidebarlink memclassid" href="member"><i class="glyphicon glyphicon-eye-open"></i><span>		MEMBER</span></a>
					</li>
					
					
					
					<li class='side'><a class="ajax-link sidebarlink reqclassid" href="requestshares"><i class="glyphicon glyphicon-eye-open"></i><span>		REQUEST FOR SHARES</span></a>
					</li>
					
					
					
					<li class='side'><a class="ajax-link sidebarlink shareclassid" href="shares"><i class="glyphicon glyphicon-eye-open"></i><span>   SHARE TYPE</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink purshareclassid" href="purchaseshare"><i class="glyphicon glyphicon-eye-open"></i><span>		PURCHASE SHARES</span></a>
				</li> -->
				
				<!--<li class='side'><a class="ajax-link sidebarlink ShareReceiptClassId" href="ShareReceipt"><i class="glyphicon glyphicon-eye-open"></i><span>		SHARES RECEIPT</span></a>
				</li>-->
				
				
				<!--
					</ul>
					</li>
					
					
					
					
					
					
					<li class="accordion">
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span>		PIGMY</span></a>
					<ul class="nav nav-pills nav-stacked">
					
					
					<li class='side'><a class="ajax-link sidebarlink pigmeclassid" href="pigmetype"><i class="glyphicon glyphicon-eye-open"></i><span>   PIGMY TYPE</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink pigmiallocclassid" href="pigmiallocation"><i class="glyphicon glyphicon-eye-open"></i><span>		PIGMY ALLOCATION</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink PigmiPendingAmtclassid" href="PigmiPendingAmt"><i class="glyphicon glyphicon-eye-open"></i><span>PIGMY AMOUNT PENDING</span></a>
					</li>
					
					
					
					</ul>
					</li>
					
					
					<li class="accordion">
					
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span> PASSBOOK PRINT</span></a>
					
					<ul class="nav nav-pills nav-stacked">
					
					<li class='side'><a class="ajax-link sidebarlink classid" href="passbookprint"><i class="glyphicon glyphicon-globe"></i>		<span>		SB Pass Book</span></a>
					</li>
					
					
					
					</ul>
					
					</li>	
					
					
					<li class="accordion">
					
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span> DEPOSITE LEDGER</span></a>
					
					<ul class="nav nav-pills nav-stacked">
					<li class='side'><a class="ajax-link sidebarlink SbLedgerClassId" href="SbLedgerIndex"><i class="glyphicon glyphicon-globe"></i>		<span>		Sb Ledger</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink RdLedgerClassId" href="RdLedgerIndex"><i class="glyphicon glyphicon-globe"></i>		<span>		Rd Ledger</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink FdLedgerClassId" href="FdLedgerIndex"><i class="glyphicon glyphicon-globe"></i>		<span>		Fd Ledger</span></a>
					</li>
					
					<li class='side'><a class="ajax-link sidebarlink PigmiLedgerClassId" href="PigmiLedgerIndex"><i class="glyphicon glyphicon-globe"></i>		<span>		Pigmi Ledger</span></a>
					</li>
					
					</ul>
					
					</li>
					
					<li class="accordion">
					
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span> REPORT</span></a>
					
					<ul class="nav nav-pills nav-stacked">
					
					<li class='side'><a class="ajax-link sidebarlink sbclassid"  href="sbreport">SB Report</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink pigmiclassid" href="RDreport">RD Report</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink pigmiclassid" href="pigmireport">PIGMY Report</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink ClosedPigmyClassId" href="ClosedPigmyReport">Closed PIGMY Accounts</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink LoanReportClassid" href="LoanReport">LOAN Report</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink LoanReportClassid" href="depositReport">DEPOSIT  Report</a></li>
					
					
					
					</ul>
					
					</li>
					
					
					<li class="accordion">
					
					<a href="#"><i class="glyphicon glyphicon-plus"></i><span> BRANCH WISE REPORT</span></a>
					
					<ul class="nav nav-pills nav-stacked">
					
					<li class='side'><a class="ajax-link sidebarlink PigmiBranchWiseReportClassid" href="PigmiBranchWiseReport">PIGMY BRANCHWISE</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink SbBranchWiseReportClassid" href="SbBranchWiseReport">SB BRANCHWISE</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink RdBranchWiseReportClassid" href="RDBranchWiseReport">RD BRANCHWISE</a></li>
					
					<li class='side'><a class="ajax-link sidebarlink FdBranchWiseReportClassid" href="FDBranchWiseReport">FD BRANCHWISE</a></li>
					
					
					
					</ul>
					
					</li>
					
					
					
					
					
					
					
					</ul>
				-->
				
			</div>
		</div>
	</div>
	
	
	
	<script  src="js/pace.min.js"></script>
	<script src="js/sidebar/sidebar.js"></script>
	
	<script>
		$('[data-toggle="tooltip"]').tooltip();
	</script>										