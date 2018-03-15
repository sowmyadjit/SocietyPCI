
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $shares['module']->Mid; ?> box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SHARE DIVIDEND</h2>
				</div>

				<div class="box-content">
					<div class="alert alert-info">
						<a href="getdivident" class="btn btn-default page_load <?php echo $shares['module']->Mid; ?>">Add Dividend</a>
						<a href="divident_amt_view" class="btn btn-default page_load <?php echo $shares['module']->Mid; ?>">View Dividend</a>
						<a href="divident_pay_list_get_branch" class="btn btn-default page_load <?php echo $shares['module']->Mid; ?>">Pay Dividend</a>
						<a href="divident_report" class="btn btn-default page_load <?php echo $shares['module']->Mid; ?>">View Dividend Report</a>
					</div>

					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th>Share Class</th>
								<th>Face Value</th>
								<th>Share Price</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($shares['det'] as $row)
								<tr>
									<td>{{ $row->Share_Class }}</td>
									<td>{{ $row->Facevalue }}</td>
									<td>{{ $row->Share_Price }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(".page_load").click(function(event){
		event.preventDefault();
		$(".box").load($(this).attr("href"));
	});
</script>