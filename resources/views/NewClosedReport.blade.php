<br>
<br>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<script src="js/bootstrap-typeahead.js"></script>    

<link href="css/daterangepicker.css" rel='stylesheet'>
<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
               

 <div class="bdy_ box-inner col-md-12">   
    <div class="box-content"> 
	
   	
	            
					<div class="form-group ">
						<div class="row table-row alert alert-info">
							
							<label class="control-label inline col-md-4 loan">SELECT LOAN:
								<select class="form-control BranchListDDBWSB"  id="BranchListDDBWSB" name="BranchListDDBWSB" onchange="BranchDDChange();">  
									<option value="ALL"></option>
									<?php foreach($closedLoan['select'] as $key){
										echo "<option value='".$key->LoanCategoryId."' >" .$key->LoanCategoryName."";
										echo "</option>";
									}?>
								</select>
								
							</label>
							
							<label class="control-label inline col-md-4 type">SELECT PERSONAL LOAN TYPE:
								<select class="form-control BranchListDDBWSB1"  id="BranchListDDBWSB1" name="BranchListDDBWSB1">  
									<option value="ALL">PERSONAL LOAN</option>
									<?php foreach($closedLoan['select1'] as $key){
										echo "<option value='".$key->LoanType_ID."' >" .$key->LoanType_Name."";
										echo "</option>";
									}?>
								</select>
								
							</label>
							<label class="control-label inline col-md-4 type1">SELECT DEPOSIT LOAN TYPE:
								<select class="form-control BranchListDDBWSB1"  id="BranchListDDBWSB3" name="BranchListDDBWSB3">  
									<option value="ALL">DEPOSIT LOAN</option>
									<?php foreach($closedLoan['select2'] as $key){
										echo "<option value='".$key->LoanType_ID."' >" .$key->LoanType_Name."";
										echo "</option>";
									}?>
								</select>
								
							</label>
							
							
							
							<div class="inline col-md-3">  
								<label class="control-label pull-left">DATE RANGE:
									
									<div id="reportrange"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
								
								
							</div>
							
							
							
							<div class="col-md-2 loanserach">
								<a class="btn btn-default SearchBWSB pull-left">SEARCH</a>
							</div>
							<div class="col-md-2 typeserach">
								<a class="btn btn-default SearchIDDD pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-2 type1serach">
								<a class="btn btn-default SearchIDDDL pull-left">SEARCH</a>
							</div>
							
							<!--<div class="col-md-1 pull-left">
								<a class="btn btn-default PrintBWSB">PRINT</a>
								
								
							</div>-->
							
							
							
						</div>
					</div>
				</div>
				 <div class='SearchRes'></div>
	</div>
	</div>
	
	
	
   
	<script>
	$('document').ready(function(){
		
		BranchDD=$('#BranchListDDBWSB').val();
		//GetAgent(BranchDD);
		
	});
	
	
	
</script>

<script>
	var $searchvalue;
	
	$("#pagei > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		$('#_content').load($(this).attr('href'));
	});
	
	
	
	
	
</script>




<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var $stdate=sdate;
	var edate;
	var $endate=edate;
	$(function() {
		
		function cb(start, end) {
			
			$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			//sdate=start.format('DD/MM/YYYY');
			//edate=end.format('DD/MM/YYYY');
			//alert(sdate);
			//alert(edate);
			//alert(moment());
			
		}
		cb(moment(), moment());
		
		
		$('#reportrange').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY',
				
			},
			"showDropdowns": true,
			"opens": "left",
			
			//"autoApply": true,
			
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				
			}
		}, cb);
		
	});
	/********************###DEPOSIT LOAN###******************************/
	$('.SearchIDDDL').click(function(e){
		
	   loanId=$('#BranchListDDBWSB3').val();
	   types=2;
		e.preventDefault();
		$.ajax({
			url:'closedLoanDetails1',
			type:'get',
			data:'&loanId='+loanId+'&startdate='+sdate+'&enddate='+edate+'&types='+types,
			success:function(data)
			{
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
			}
		});
		
	});
	/********************###PERSONAL LOAN###******************************/
	$('.SearchIDDD').click(function(e){
		
	   loanId=$('#BranchListDDBWSB1').val();
	   types=1;
		e.preventDefault();
		$.ajax({
			url:'closedLoanDetails',
			type:'get',
			data:'&loanId='+loanId+'&startdate='+sdate+'&enddate='+edate+'&types='+types,
			success:function(data)
			{
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
			}
		});
		
	});
	/********************### STAFF LOAN NAD JUWEL LOAN ###******************************/
	$('.SearchBWSB').click(function(e){
		
	   loanId=$('#BranchListDDBWSB').val();
	   if(loanId==3)
	   {
		   types1=1;
	   }
	   else
	   {
		   types1=2;
	   }
	   //types1=1;
		e.preventDefault();
		$.ajax({
			url:'closedStaffJLDetails',
			type:'get',
			data:'&loanId='+loanId+'&startdate='+sdate+'&enddate='+edate+'&types1='+types1,
			success:function(data)
			{
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
			}
		});
		
	});
	
	
	$('.type').hide();
	$('.type1').hide();
	$('.typeserach').hide();
	$('.type1serach').hide();
	$('#BranchListDDBWSB').change(function(e)
	{
	  mode=$('#BranchListDDBWSB').val();
	  //alert(mode);
	  if(mode==1)
	  {
	   $('.type').show();
	   $('.loan').hide();
	   $('.type1').hide();
	   $('.typeserach').show();
	   $('.loanserach').hide();
	  }
	  else if(mode==2)
	  {
       $('.type').hide();
	   $('.loan').hide();
	   $('.type1').show();
	   $('.type1serach').show();
	   $('.loanserach').hide();
	  }
	  else
	  {
        $('.type1').hide();
        $('.type').hide();
	    $('.loan').show();
	    $('.typeserach').hide();
		$('.loanserach').show();
	}
	});
</script>

<script>
	
	$(function() {
		$(".PrintBWSB").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>SB transaction</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
	
	
</script>
      
      