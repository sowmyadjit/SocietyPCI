

    
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> PIGMI UNCLEARED CHEQUE DETAIL </h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
	<div class="chequereject">
<label class="control-label col-sm-4">Cheque Reject Amount:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="loanchqrjct" name="loanchqrjct" placeholder="CHEQUE REJECT AMOUNT">
					</div>
	</div>
   <!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
  <!--<div class="alert alert-info">

  <a href="pigmedetail" class="btn btn-default crtds">Create PIGME TYPES</a>
   </div>-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
		<th>Transaction Date</th>
		<th>Account Number</th>
		<th>First Name</th>
		<th>Middle Name</th>
		<th>Last Name</th>
		<th>Cheque Number</th>
		<th>Cheque Date</th>
        <th>Bank Name</th>
		<th>Bank Branch</th>
		<th>IFSC Code</th>
		<th>Amount</th>
		<th>Action<th>
	
		</tr>
    </thead>
    <tbody>

  <tr>
       @foreach ($loancheque as $loan_transaction)
        <tr>
             <td class="hidden rejecttransid">{{ $loan_transaction->LoanTrans_ID }}</td>
             <td class="hidden">{{ $loan_transaction->Uid }}</td>
			 
             <td><?php $transcdte=date("d-m-Y",strtotime($loan_transaction->LoanTrans_Date));echo $transcdte;?></td>
			 <td>{{$loan_transaction->AccNum}}</td>
             <td>{{ $loan_transaction->FirstName }}</td>
             <td>{{ $loan_transaction->MiddleName }}</td>
             <td>{{ $loan_transaction->LastName }}</td>
			 <td>{{ $loan_transaction->LoanTrans_Chqno}}</td>	
			 <td>{{ $loan_transaction->LoanTrans_Chqdte}}</td>
			 <td>{{$loan_transaction->LoanTrans_bnkname}}</td>
			 <td>{{$loan_transaction->LoanTrans_bnkbranch}}</td>
			 <td>{{$loan_transaction->LoanTrans_ifsc}}</td>
			 <td>{{$loan_transaction->LoanUncleared_Bal}}</td>
			 <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accpbtn" href="loanclearcheque/{{ $loan_transaction->LoanTrans_ID }}"/>
											
										</div>
									</div>
								</td>
									<td>
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Reject" class="btn btn-info btn-sm rejbtn" />
										</div>
									</div>
									</td>
			 
        </tr>
		
		
			 
     @endforeach
	 
      <script>
	 
	 $('.chequereject').hide();

/*$('.crtds').click(function(e)
{
	e.preventDefault();
	$('.box-inner').load($(this).attr('href'));
});*/
$('.accpbtn').click(function(e){
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
		$('.clearclassid').click();
	});
	
	$('.rejbtn').click(function(e){
		e.preventDefault();
		$('.chequereject').show();
		m=$('#loanchqrjct').val();
		a=$('.rejecttransid').html();
		//alert(a);
		if(m=="")
		{
			alert("Please Enter the Cheque Reject Amount");
		}
		else
		{
			$.ajax({
				url:'loanrejectcheque',
				type:'post',
				data:'&cheqchrge='+m+'&tid='+a,
				success:function()
				{
					$('.clearclassid').click();
				}
			});
		/*$('.box-inner').load($(this).attr('href'));*/
		
		}
	});

	  </script>