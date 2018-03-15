<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>UnAuthorised Loans </h2>
					
				</div>
				</br>
				
				<div class="form-group">
					<label class="control-label col-md-2">Loan Category:</label>
					<div class="col-md-4">
						<select class="form-control LoanTypeDD"  id="LoanCategory" name="LoanCategory" placeholder="SELECT LoanCategory">  
							<option value="">--Select Loan Type--</option>
							<?php foreach($LoanCat as $key){
								echo "<option value='".$key->LoanCategoryName."' >" .$key->LoanCategoryName."";
								echo "</option>";
							}?>
						</select>
					</div>
				</div>
				</br>
				
				<div class="box-content">
				</div>
			</div>
			<div class="displayloan">
			</div>
		</div>
	</div>
</div>

<script>
	
	$('#LoanCategory').change(function(e)
	{
		ddtyp=$('#LoanCategory').val();
		
		if(ddtyp=="PERSONAL LOAN")
		{
			$.ajax({
				url:'/authPL',
				type:'get',
				data:'Loan_Cat='+ddtyp,
				success:function(data)
				{
					$('.displayloan').html('');
					$('.displayloan').html(data);
				}
			});
		}
		else if(ddtyp=="DEPOSITE LOAN")
		{
			$.ajax({
				url:'/authDL',
				type:'get',
				data:'Loan_Cat='+ddtyp,
				success:function(data)
				{
					$('.displayloan').html('');
					$('.displayloan').html(data);
				}
			});
		}
		else if(ddtyp=="STAFF LOAN")
		{
			$.ajax({
				url:'/authSL',
				type:'get',
				data:'Loan_Cat='+ddtyp,
				success:function(data)
				{
					$('.displayloan').html('');
					$('.displayloan').html(data);
				}
			});
		}
		
		else if(ddtyp=="JEWEL LOAN")
		{
			$.ajax({
				url:'/authJL',
				type:'get',
				data:'Loan_Cat='+ddtyp,
				success:function(data)
				{
					$('.displayloan').html('');
					$('.displayloan').html(data);
				}
			});
		}
	});
	
</script>					