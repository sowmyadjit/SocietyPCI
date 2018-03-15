     <script src="js/bootstrap-typeahead.js"></script>
	 <script src="js/moment.min.js"></script>    <!--for daterange picker-->
	 <script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
	 <link href="css/daterangepicker.css" rel='stylesheet'>
	 
	<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>
			</div>
    </noscript>

	<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
				<div>
					<ul class="breadcrumb">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a class="clickme" >Report</a>
					</li>
					</ul>
				</div>
		
		<div class="row sb">
			<div class="box col-md-12">
				<div class="box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   Loan REPORT</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<!--<div class="box-content">
					<!--<div class="alert alert-info">
						<a href="companydetail" class="btn btn-default crtds">Create Company</a>
					</div>-->
					
					<!--<div class="form-group">
					<div class="col-md-4">
					  <input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SEARCH SB or RD ACCOUNT"> 
					  </div>
					  </div></br></br>-->
					  
					 
					<div class="col-md-12">
					<div class="form-group">
					<div class="row table-row alert alert-info">
					
					
							
							<div class="col-md-4">
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT ACCOUNT"> 
							</div>
							 
							  
							
							<div class="col-md-3">
							  <div id="reportrange" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
							  
							 <!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
							  
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
								<span></span> <b class="caret"></b>
								
							</div>
							</div>
							
							<div class="col-md-2">
							<a class="btn btn-default SearchLoan pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-3 pull-left">
							<a class="btn btn-default PrintRd">PRINT</a>
							
							<a class="btn btn-default PrintAllRd">PRINT ALL</a>
							</div>
				
					
					
					</div>
					</div>
					</div>
					  
					  
					  
					  </br></br>
					  
					  
					<div class='SearchRes'> 
						<div  id="toprint">
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						
						<th>Loan Transaction Date</th>
						<th>FirstName</th>
						<th>MiddleName</th>
						<th>LastName</th>
						<th>Loan Type</th>
						<th>Branch Name</th>
						<th>Loan Amount</th>
						<th>Loan Amount Paid</th>
						<th>Remaining Loan Amount</th>
						<th>Loan Duration</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Action</th>
						
					</tr>
					</thead>
					
					<tbody>
						
						@foreach ($LoanRepo as $Loan_Report)
        <tr>
             <td class="hidden">{{ $Loan_Report->LoanTrans_LoanAlloc_ID }}</td>
             <td class="hidden">{{ $Loan_Report->LoanTrans_ID }}</td>
			
			 <td><?php $trandate=date("d-m-Y",strtotime($Loan_Report->LoanReport_TranDate)); echo $trandate; ?> </td>
			 <td>{{ $Loan_Report->FirstName }}</td>
			 <td>{{ $Loan_Report->MiddleName }}</td>
			 <td>{{ $Loan_Report->LastName }}</td>
			 <td>{{ $Loan_Report->LoanType_Name }}</td>
              <td>{{$Loan_Report->BName}}
			 <td>{{ $Loan_Report->LoanAlloc_LoanAmt}}</td>
			 <td>{{ $Loan_Report->LoanTrans_AmtPaid}}</td>
			 <td>{{ $Loan_Report->LoanTrans_RemTotal}}</td>
			  <td>{{ $Loan_Report->LoanAlloc_Duration}}</td>
			  <td>{{ $Loan_Report->LoanAlloc_SDate}}</td>
			  <td>{{$Loan_Report->LoanAlloc_EDate}}</td>
        </tr>
     @endforeach
					</tbody>
					</table>
					</div>
				
				<div id='pagei'>
				{!! $LoanRepo->render() !!}
				</div>
				
				</div>
				
				</div>
				</div>
			</div>
		
		</div>
	

<script>

	  $('.clickme').click(function(e){
			$('.LoanClassId').click();
		}); 
		
	  $('.SearchLoan').click(function(e){
			
			
			
			e.preventDefault();
			
			
			searchvalue=$('#searchacc').data('value');
	
			//alert(searchvalue);
			
			$.ajax({
				url:'getLoanacc',
				type:'get',
				data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate,
				success:function(data)
				{
					//alert("success");
					//$('.box').html(data);
					$('.SearchRes').html('');
					$('.SearchRes').html(data);
					
					
					
				}
			});
			
			
			
			
			
		
		});
		
		
		
		
$("ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc");
  
});
$('.loadmc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('#maincontents').load($(this).attr('href'));
});		
		
		

$('input.SearchTypeahead').typeahead({
      ajax: '/GetSearchLoanAcc' //SEND BID OF THE LOGGED IN USER ALONG WITH  THIS
});



		
</script>


<!--DATE RANGE PICKER-->

<script type="text/javascript">
var sdate;
var edate;
$(function() {

    function cb(start, end) {
        //$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); //original code
        //$('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
        $('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
		//alert(start.format('DD-MM-YYYY'));
		//alert(start.format('DD-MM-YYYY'));
		sdate=start.format('YYYY-MM-DD');
		//sdate=start.format('DD-MM-YYYY');
		edate=end.format('YYYY-MM-DD');
		//edate=end.format('DD-MM-YYYY');
		//sdate=start.format('DD/MM/YYYY');
		//edate=end.format('DD/MM/YYYY');
		//alert(sdate);
		//alert(edate);
		//alert(moment());
		
    }
    cb(moment().subtract(29, 'days'), moment());
  

    $('#reportrange').daterangepicker({
		
		 locale: {
			
		    format: 'DD-MM-YYYY'
	   	},
		 "showDropdowns": true,
		 //"autoApply": true,
		  //"minDate": "01-01-1950"
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
</script>

<script>

$(function() {
	$(".PrintRd").click(function() {
		//alert('test');
		//$("#toprint").print();
		
		var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Loan transaction</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
	//$.print("#toprint");
	});
});


</script>