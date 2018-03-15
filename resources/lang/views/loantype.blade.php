		<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

			</div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
					<ul class="breadcrumb">
						<li> <a href="#">Home</a> </li>
						<li> <a class="clickme" >LOAN TYPE</a> </li>
					</ul>
				</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i> LOAN DETAIL</h2>

						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
   
						<div class="alert alert-info">
						<a href="loantypedetail" class="btn btn-default crtds">CREATE LOAN TYPE</a>
						</div>
						
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
							<th>LOAN TYPE</th>
							<th>LOAN INTEREST</th>
							<th>ACTION</th>
						</tr>
					</thead>
					
					<tbody>
						
						@foreach ($lt as $loan_type)
						<tr>
							<td class="hidden">{{ $loan_type->LoanType_ID }}</td>
							<td>{{ $loan_type->LoanType_Name }}</td>
							<td>{{ $loan_type->LoanType_Interest }}</td>
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href=""/>
										
										</div>
									</div>
								</td>
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
	  $('.clickme').click(function(e){
			$('.loanclassid').click();
		});
		
	  $('.crtds').click(function(e){
			e.preventDefault();
			$('.box-inner').load($(this).attr('href'));
		});
	</script>