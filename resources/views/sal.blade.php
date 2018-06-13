 	<div class="SearchRes">
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
                <a class="clickme" >SALARY</a>
            </li>
        </ul>
    </div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SALARY</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content" >
					<div>
					<script src="js/FileSaver.js"/>			
					<script src="js/tableExport.js"/>
					<div class="alert alert-info" id='salary_list'>
						<!--<a href="salcreate" class="btn btn-default salcrt">Salary</a>-->
						<div class="form-group">
							<label class="control-label col-sm-4">Salary TYPE:</label>
							<div class="col-md-4">
								<select class="form-control" id="sal" name="sal">
									<option value="">--Select SALARY TYPE--</option>
									<option value="Employee">Employee Salary</option>
									<option value="Agent">Agent Commission</option>
									<option value="RDagent">RD Agent Commission</option>
									<option value="sarapara">Sarapara Commission</option>	
								</select>
							</div>
							<div class="col-md-4"> 
								<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
								<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">									   
							</div>
						</div>
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export">
				
					<thead>
					
						<tr>
						
						<th>Employee Name</th>
						<th>BASIC PAY</th>
						<th>DATE</th>
						<th>NET PAY</th>
						<th>Salary Slip</th>
						</tr>
						
					</thead>
					
					<tbody>

					
						@foreach ($s as $salary)
						<tr>
							<td class="hidden">{{ $salary->salid }}</td>
							<td>{{$salary->FirstName}}</td>
							<td>{{$salary->basicpay}}</td>
							<td>{{$salary->date}}</td>
							<td>{{$salary->netpay}}</td>
							<td><button class="salary_slip">view</button></td>
						</tr>

						@endforeach

					</tbody>
				</table>
				<div id="toprint" style="position:fixed;opacity:0;">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export">
						<thead>
							<tr>
								<th>Employee Name</th>
								<th>BASIC PAY</th>
								<th>DATE</th>
								<th>NET PAY</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($s as $salary)
							<tr>
								<td class="hidden">{{ $salary->salid }}</td>
								<td>{{$salary->FirstName}}</td>
								<td>{{$salary->basicpay}}</td>
								<td>{{$salary->date}}</td>
								<td>{{$salary->netpay}}</td> 
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>	
			</div>
			<div id="sal_slip_show" style="height:500px;"></div>
		</div>
				
		</div>
	</div>
	
</div>
</div>
</div>

<script>
	  
	$('.clickme').click(function(e)
	{
		$('.salclassid').click();
	}); 
	
	$('.salcrt').click(function(e)
	{
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('#sal').change(function(e)
	{
		//e.preventDefault();
		$saltyp=$('#sal').val();
		alert($saltyp)
		if($saltyp=="Employee")
		{
			$.ajax({
				url: 'salcreate',
				type: 'get',
				success: function(data) {
						 $('.SearchRes').html(data);
                }
			});
		}
		else if($saltyp=="Agent")
		{
			$.ajax({
				url: 'salagent',
				type: 'get',
				success: function(data) {	 
					$('.SearchRes').html(data);
                }
			});
		}   
		else if($saltyp=="RDagent")
		{
			$.ajax({
				url: 'RDagent',
				type: 'get',
				success: function(data) {	 
					$('.SearchRes').html(data);
                }
			});
		}
		else if($saltyp=="sarapara")
		{
			$.ajax({
				url: 'sarapara',
				type: 'get',
				success: function(data) {
					$('.SearchRes').html(data);
                }
			});
		}
	});
	$('#excel').click(function(e){
		$('#excel_export').tableExport({type:'excel',escape:'false'});
	});								
</script>														   
<script src="js/jQuery.print.js"></script>
<script>
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint").html();
        	var printWindow = window.open('', '', 'height=600,width=800');
        	printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
        	printWindow.document.write('</head><body>');
        	printWindow.document.write(divContents);
        	printWindow.document.write('</body></html>');
        	printWindow.document.close();
			//$("#toprint").print();
        	printWindow.print(); 
		});
	});	
</script>
<script>
$('.salary_slip').click(function(){
	$.ajax({
		url: 'salary_slip',
		type: 'get',
		success: function(data) {
			$('#salary_list').hide();
			$('#sal_slip_show').show();
			$('#sal_slip_show').html(data);
		}
	});
});
</script>
