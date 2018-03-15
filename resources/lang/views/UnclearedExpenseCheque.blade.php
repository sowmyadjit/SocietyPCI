

    
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> EXPENSE UNCLEARED CHEQUE DETAIL </h2>

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
						<input type="text" class="form-control" id="rdchqrjct" name="rdchqrjct" placeholder="CHEQUE REJECT AMOUNT">
					</div>
	</div>
   <!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
  <!--<div class="alert alert-info">

  <a href="pigmedetail" class="btn btn-default crtds">Create PIGME TYPES</a>
   </div>-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
	    <th>Expense Date</th>
		<th>Branch Name</th>
		<th>Bank Name</th>
		<th>Account Number</th>
		<th>Bank Branch</th>
		<th>IFSC Code</th>
		<th>Cheque Number</th>
		<th>Cheque Date</th>
		<th>Amount</th>
		<th>Action<th>
	
		</tr>
    </thead>
    <tbody>

  <tr>
       @foreach ($exp as $expense)
        <tr>
             <td class="hidden rejecttransid">{{ $expense->id }}</td>
             <td class="hidden">{{ $expense->Bankid }}</td>
			 
             <td><?php $transcdte=date("d-m-Y",strtotime($expense->e_date));echo $transcdte;?></td>
			 <td>{{$expense->SocietyBranch}}</td>
             <td>{{ $expense->BankName }}</td>
             <td>{{ $expense->AccountNo }}</td>
             <td>{{ $expense->Branch }}</td>
			 <td>{{ $expense->AddBank_IFSC}}</td>	
			 <td>{{ $expense->cheque_no}}</td>
			 <td>{{$expense->cheque_date}}</td>
			 <td>{{$expense->amount}}</td>
			 <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accpbtn" href="expclearcheque/{{ $expense->id }}"/>
											
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
		m=$('#rdchqrjct').val();
		a=$('.rejecttransid').html();
		//alert(a);
		if(m=="")
		{
			alert("Please Enter the Cheque Reject Amount");
		}
		else
		{
			$.ajax({
				url:'exprejectcheque',
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