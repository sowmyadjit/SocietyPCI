<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>

<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> CREATE PURCHASE SHARE</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => 'createpurshare','class' => 'form-horizontal','id' => 'form_purshare','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Member Name:</label>
						<div id="the-basics" class="col-sm-4">
							<input style="border-color:red"  class="typeahead form-control"  type="text" placeholder="SELECT NAME"/>  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Share Class:</label>
						<div class="col-sm-4">
							<select class="form-control shclass"  id="shclass" name="shclass" placeholder="SELECT SHARE CLASS">  
								<option value="">--Select Class--</option>
								<?php foreach($shares as $key){
									echo "<option value='".$key->Share_Class."' >" .$key->Share_Class."";
									echo "</option>";
								}?>
							</select>
						</div>
					</div>
					
					<div class ="col">
						<div class="form-group">
							<label class="control-label col-sm-4"> Face Value:</label>
							<div class="col-md-4">
								<input style="border-color:red" type="text" class="form-control" id="shamt" name="shamt" placeholder="SAHARE AMOUNT">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Share PRICE:</label>
						<div class="col-md-4">
							<input style="border-color:red"  type="text" class="form-control" id="shprice" name="shprice" placeholder="SHARE PRICE">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Share Fees:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="shfee" name="shfee" placeholder="SHARE FEES">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Shares:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="totshare" name="totshare" placeholder="TOTAL SHARES" onblur="calculate();maxvl();" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Share Value:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="totshrval" name="totshrval" placeholder="TOTAL SHARE VALUE" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Amount Payable:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="totamt" name="totamt" placeholder="TOTAL AMOUNT PAYABLE" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Member Share ID:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="memshr" name="memshr" placeholder="MEMBER SHARE ID" />
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-4 control-label">CREATED DATE</label>
						<div class="col-md-4 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="spdate" id="spdate" placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					
					
					
					<!--<div class="form-group">
						<label class="control-label col-sm-4">Share Purchase Date:</label>
						<div class="col-sm-4">
						<input type="text" class="form-control" id="spdate" name="spdate" value="" />
						</div>
					</div>-->
					
					<div class="form-group">
						<label class="control-label col-sm-4">Board Resoution Number:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="brn" name="brn" placeholder="Board Resoution Number" />
						</div>
					</div>
					
					<div class="form-group hidden">
						<div class="col-sm-4">
							<input type="text" class="form-control" id="count" name="count"/>
						</div>
					</div>
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
					{!! form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/bootstrap-datepicker.js"/>
<script>
	function calculate()
	{
		//alert("Hello");
		shamt=$('#shamt').val();
		shpr=$('#shprice').val();
		nosh=$('#totshare').val();
		shfee=$('#shfee').val();
		tot=shamt*nosh;
		tot1=shpr*nosh;
		total1=tot+tot1;
		total=parseInt(total1)+parseInt(shfee);
		$('#totshrval').val(tot);
		$('#totamt').val(total);
	}
	
	$('.cnclbtn').click(function(e)
	{
		alert('are you sure?');
		$('.reqclassid').click();
		//alert(a);
	});
	
	indexid=0;
	$('.sbmbtn').click( function(e) {
		if(indexid==0)
		{
			indexid++;
			$("#form_purshare").validate({
				rules:
				{
					mname:"required",
					shclass:
					{
						required:true,
					},
					shamt:{
						required:true,
						number:true
					},
					shprice:{
						required:true,
						number:true
					},
					totshare:{
						required:true,
						number:true
					},
					totshrval:
					{
						required:true,
						number:true
					},
					totamt:
					{
						required:true,
						number:true
					},
					memshr:"required",
					spdate:{
						required:true,
						date:true
					},
				}
			});
			
			if($("#form_purshare").valid())
			{
				a=$('ul.typeahead li.active').data('value');
				e.preventDefault();
				$.ajax({
					
					url: 'createpurshare',
					type: 'post',
					data: $('#form_purshare').serialize() + '&mid=' + a ,
					success: function(data) {
						//alert('success');
						$('.purshareclassid').click();
					}
				});
			}
		}
	});
	
	$('#shclass').change(function(e){
		//alert("hii");
		e.preventDefault();
		$.ajax({
			url:'retrieveval',
			type:'post',
			data:$('#shclass'),
			success:function(data){
				$('#shamt').val(data['face']);
				$('#shprice').val(data['sharep']);
			}
		});
	});
	
	function maxvl()
	{
		//alert("max");
		totshr=$('#totshare').val();
		$.ajax({
			url:'retrievemaxcount',
			type:'get',
			success:function(data){
				countval=data;
				max=(parseInt(totshr)+parseInt(countval));
				//alert("max:"+max);
				min=(parseInt(countval)+1);
				//alert("min:"+min);
				sid=min+"-"+max;
				$("#memshr").val(sid);
				$("#count").val(max);
				//alert(sid);
			}
		});
	}
	
	$('input.typeahead').typeahead({
		ajax: '/GetMembers'
	});
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	
	</script>	