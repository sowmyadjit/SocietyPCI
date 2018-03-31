<div>
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
	<tr>
	<th>
	Loan Id
	</th>
	<th>
	Loan No
	</th>
	<th>
	View Report
	</th>
	</tr>
	</thead>
	<tbody>
	@foreach ($return_data as $data)
	<tr>
	<td>
	{{$data->loan_id}}
	</td>
	<td>
	{{$data->loan_no}}
	</td>
	<td>
	<button class="btn btn-info btn-sm view" id='view' data='{{$data->loan_id}}' data-toggle="modal" data-target="#loan_individual_details">View Report</button>
	</td>
	</tr>
	@endforeach
	</tbody>
	</table>
</div>

<!-- Modal -->
<div id="loan_individual_details" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:90%;">

    <!-- Modal content-->
	
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  <input type="button" value="Print" class="btn btn-info btn-sm print" style="float:right;margin:15px;" id="print">
	  <div id="toprinta">
		<h2 style="text-align:center;">POTTERS COTTAGE INDUSTRIAL CO-OP SOCIETY LTD.</h2>
		<h3 style="text-align:center;">CHAKRASOUDHA, KULAI.</h3>
		<h3 style="text-align:center;">Report</h3>
        <div id="loan_individual_details_modal"></div>
      </div>
	  </div>
    </div>

  </div>
</div>

<script>
	$('.view').click(function(){
	loan_id=$(this).attr('data');
		console.log(loan_id);
				$.ajax({
					url:'/jewel_loan_repay_report_data',
					type:'post',
					data:'&loan_allocation_id='+loan_id+'&loan_type=JL',
					success:function(data)
					{
						$('#loan_individual_details_modal').html(data);
					}
	});
	});
</script>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			alert("print");
			$ac_no=10;
			var divContents = $("#toprinta").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>POTTERS COTTAGE INDUSTRIAL CO-OP SOCIETY LTD &nbsp;&nbsp;&nbsp;&nbsp; AC No-'+$ac_no+'</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});	
</script>