

<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

			</div>
        </noscript>

    <div id="content<?php echo $OpCls['module']->Mid; ?>" class="col-lg-10 col-sm-10">
        <!-- content starts -->
    	
		
		<div class="row">
			<div class="box col-md-12">
				<div class="bdy_<?php echo $OpCls['module']->Mid; ?> box-inner">
					<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Balance Details </h2>
						
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="viewdailybal1" style="margin-right:50px;" class="btn btn-info DailyTranBtn<?php echo $OpCls['module']->Mid; ?>" id="daily_transaction" >Daily Transaction</a>
						@if($OpCls['did'] != 2) <!--  Don't show this for clerks -->
							<a href="fdinterstmonthly" style="margin-right:10px;" class="btn btn-info DailyTranBtn<?php echo $OpCls['module']->Mid; ?>" data="FD_MONTHLY_INT">FD Month Pay</a>
							<a href="viewFDInterest" class="btn btn-info DailyTranBtn<?php echo $OpCls['module']->Mid; ?>">View FD Interest</a>
							<button id="refresh" class="btn-sm glyphicon glyphicon-refresh"></button>
							<a href="viewclosebal" style="margin-left:15px;" class="btn btn-danger pull-right ClsBalBtn<?php echo $OpCls['module']->Mid; ?>">Day Close</a>
							<a href="viewbal"  class="btn btn-success pull-right OpenBalBtn<?php echo $OpCls['module']->Mid; ?>" >Day Open</a>
						@endif
					</div>
					<div id="cash_details">
					</div>
					<div id="bank_details">
					</div>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function(){
		$.ajax({
					url:'/view_cash_details',
					type:'post',
					data:'',
					success:function(data)
					{
						//$("#cash_details").html(data);//CASH EDITING TEMPERARILY DISABLED
					}
		});
	});
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.OpenBalBtn<?php echo $OpCls['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $OpCls['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.ClsBalBtn<?php echo $OpCls['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $OpCls['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.DailyTranBtn<?php echo $OpCls['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		var flag = true;
		var data = $(this).attr("data");
		if(data == "FD_MONTHLY_INT") {
			flag = confirm("Are you sure?");
		}
		if(flag) {
			var id = $(this).attr("id");
			var is_day_open = "{{$OpCls['is_day_open']}}";
			console.log(is_day_open);
			if(id == "daily_transaction" && is_day_open == "no") {
				alert("Day is not open");
				return;
			}
		
			$('.bdy_<?php echo $OpCls['module']->Mid; ?>').load($(this).attr('href'));
		}
	});
	
	
	$('.accustpbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.custdet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $OpCls['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $OpCls['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $OpCls['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $OpCls['module']->Mid; ?>_content').load($(this).attr('href'));
	});
</script>

<script>
	view_bank_details();
	function view_bank_details() {
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$("#bank_details").html(loading_img);
		$.ajax({
					url:'/view_bank_details',
					type:'post',
					data:'',
					success:function(data)
					{
						$("#bank_details").html(data);
					}
		});
	}
	$("#refresh").click(function() {
		view_bank_details();
	});
</script>
