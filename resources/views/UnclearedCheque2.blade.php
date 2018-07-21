

<div id="content<?php echo $uc->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
		<div class="row">
			<div class="box_bdy_<?php echo $uc->Mid; ?> box col-md-12">
				<div class="bdy_<?php echo $uc->Mid; ?> box-inner">

							<div class="box-header well" data-original-title="">
								<h2><i class="glyphicon glyphicon-user"></i> Uncleared Cheque Details </h2>
							</div>
							
							<div class="box-content">


									<div class="alert alert-info">
										<a href="unclearsb" class="btn btn-default crtsb<?php echo $uc->Mid; ?>">UnCleared SB Cheque</a>
										<a href="unclearrd" class="btn btn-default crtrd<?php echo $uc->Mid; ?>">UnCleared RD Cheque</a>
										<a href="unclearpgm" class="btn btn-default crtpgm<?php echo $uc->Mid; ?>">UnCleared Pigmi Cheque</a>
										<a href="unclearloan" class="btn btn-default crtloan<?php echo $uc->Mid; ?>">UnCleared Loan Cheque</a>
										<a href="unclearfd" class="btn btn-default crtfd<?php echo $uc->Mid; ?>">UnCleared FD Cheque</a>
									</div>

									<div class="alert alert-info" style="height:100px">
										<div class="form-group">
											<label class="control-label col-sm-4">Select Cheque Type:</label>
											<div class="col-md-4">
												<select class="form-control" id="chq_type" name="">
													<option>SB Cheque</option>
													<option>RD Cheque</option>
													<option>Pigmi Cheque</option>
													<option>Loan Cheque</option>
													<option>FD Cheque</option>
													<option>Expense Cheque</option>
												</select>
											</div>
											<button id="refresh_uc" class="btn-sm	 glyphicon glyphicon-refresh" ></button>
										</div>
									</div>

									<div class="b_main">
											b_main
									</div>
									<div class="b_sub_1">
											b_sub_1
									</div>
									<div class="b_sub_2">
											b_sub_2
									</div>
									<div class="b_back">
											<button>back</button>
									</div>


						<?php	/*	<button type="button" class=" btn-sm" data-toggle="modal" data-target="#popup">Open Modal</button> */?>
									<!-- Modal -->
									<div class="modal fade" id="popup" role="dialog">
										<div class="modal-dialog">

										<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title popup_title">Modal Header</h4>
												</div>
												<div class="modal-body ">
													<div class="popup_data" style="min-height:100px;min-width:200px;"></div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-success popup_submit" data="" data-dismiss="modal">Submit</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>

										</div>
									</div>















								
							</div>

				</div>
			</div>
		</div>
</div>


<script>
	$("#chq_type").change(function(e) {
		// console.log($(this).val());
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$(".b_main").html(loading_img);
		var chq_type = $(this).val();
		switch(chq_type) {
			case "SB Cheque" : 
						$(".b_main").load("unclearsb");
						break;
			case "RD Cheque" : 
						$(".b_main").load("unclearrd");
						break;
			case "Pigmi Cheque" : 
						$(".b_main").load("unclearpgm");
						break;
			case "Loan Cheque" : 
						$(".b_main").load("unclearloan");
						break;
			case "FD Cheque" : 
						$(".b_main").load("unclearfd");
						break;
			case "Expense Cheque" : 
						$(".b_main").load("unclearexp");
						break;
		}
	});
</script>

<script>
	$("document").ready(function() {
		$("#chq_type").trigger("change");
	});
</script>

<script>

	$(".b_back").click(function() {
		console.log("back");
	});
</script>

<script>
	$("#refresh_uc").click(function() {
		$("#chq_type").trigger("change");
	});
</script>



<script>
		$(".popup_submit").click(function() {
			var type = $(this).attr("data");
			console.log("-"+type+"-");
			
			switch(type) {
				case "sb_accept": console.log("sb_accept");
									var id = $("#id").val();console.log("id="+id);
									var amt = $("#chaccept").val();
									if(amt == "") {
										alert("Please enter amount");
										return;
									}
									$.ajax({
										url:'clearcheque',
										type:'post',
										data:'&cheqchrge='+amt+'&tid='+id,
										success:function()
										{
											alert("Success");
										}
									});
									break;
				case "sb_reject":
									// console.log("sb_reject");
									var id = $("#id").val();console.log("id="+id);
									var chqrjct = $("#chqrjct").val();
									var chqrjctbank = $("#chqrjctbank").val();
									if(chqrjct == "" || chqrjctbank == "") {
										alert("Please enter amount");
										return;
									}
									$.ajax({
										url:'rejectcheque',
										type:'post',
										data:'&cheqchrge='+chqrjct+'&tid='+id+'&bankamt='+chqrjctbank,
										success:function()
										{
											alert("Success");
										}
									});
									break;
				case "rd_reject":
									// console.log("rd_reject");
									var id = $("#id").val();console.log("id="+id);
									var rdchqrjct = $("#rdchqrjct").val();
									if(rdchqrjct == "") {
										alert("Please enter amount");
										return;
									}
									
									$.ajax({
										url:'rdrejectcheque',
										type:'post',
										data:'&cheqchrge='+rdchqrjct+'&tid='+id,
										success:function()
										{
											disable_row(id);
											alert("Success");
										}
									});
									break;
				case "pg_reject":
									// console.log("rd_reject");
									var id = $("#id").val();console.log("id="+id);
									var pgmchqrjct = $("#pgmchqrjct").val();
									if(pgmchqrjct == "") {
										alert("Please enter amount");
									} else {
										$.ajax({
											url:'pgmrejectcheque',
											type:'post',
											data:'&cheqchrge='+pgmchqrjct+'&tid='+id,
											success:function()
											{
												disable_row(id);
												alert("Success");
											}
										});
									}
									break;
				case "ln_dl_reject":
									// console.log("rd_reject");
									var id = $("#id").val();console.log("id="+id);
									var loanchqrjct = $("#loanchqrjct").val();
									if(loanchqrjct == "") {
										alert("Please enter amount");
									} else {
										$.ajax({
											url:'loanrejectcheque',
											type:'post',
											data:'&cheqchrge='+loanchqrjct+'&tid='+id,
											success:function()
											{
												disable_row_dl(id);
												alert("Success");
											}
										});
									}
									break;
				case "ln_pl_reject":
									// console.log("rd_reject");
									var id = $("#id").val();console.log("id="+id);
									var loanchqrjct = $("#loanchqrjct").val();
									if(loanchqrjct == "") {
										alert("Please enter amount");
									} else {
										$.ajax({
											url:'loanrejectcheque',
											type:'post',
											data:'&cheqchrge='+loanchqrjct+'&tid='+id,
											success:function()
											{
												disable_row_pl(id);
												alert("Success");
											}
										});
									}
									break;
				case "ln_jl_reject":
									// console.log("rd_reject");
									var id = $("#id").val();console.log("id="+id);
									var loanchqrjct = $("#loanchqrjct").val();
									if(loanchqrjct == "") {
										alert("Please enter amount");
									} else {
										$.ajax({
											url:'loanrejectcheque',
											type:'post',
											data:'&cheqchrge='+loanchqrjct+'&tid='+id,
											success:function()
											{
												disable_row_jl(id);
												alert("Success");
											}
										});
									}
									break;
				case "fd_reject":
									// console.log("rd_reject");
									var id = $("#id").val();console.log("id="+id);
									var rdchqrjct = $("#rdchqrjct").val();
									if(rdchqrjct == "") {
										alert("Please enter amount");
									} else {
										$.ajax({
											url:'fdrejectcheque',
											type:'post',
											data:'&cheqchrge='+rdchqrjct+'&tid='+id,
											success:function()
											{
												disable_row(id);
												alert("Success");
											}
										});
									}
									break;
			}
		});
</script>