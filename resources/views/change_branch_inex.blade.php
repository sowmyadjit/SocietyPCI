
	<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>CHANGE BRANCH</h2>
					</div>
					
					<div class="box-content">
						<div class="alert alert-info">
							<a class="btn btn-default change_btn" id="1" >KUL</a>
							<a class="btn btn-default change_btn" id="2" >TOK</a>
							<a class="btn btn-default change_btn" id="3" >KRI</a>
							<a class="btn btn-default change_btn" id="4" >JOK</a>
							<a class="btn btn-default change_btn" id="5" >TAL</a>
							<a class="btn btn-default change_btn" id="6" >HO</a>
						</div>
					</div>
					
					<div id="msg">
						
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$(".change_btn").click(function(e) {
		e.preventDefault();
		console.log("change_branch");
		
		branch_id = $(this).attr("id");
		$.ajax({
			url:"change_branch",
			data:"&branch_id="+branch_id,
			type:"get",
			success:function(data){
				console.log("done");
				document.location.reload();
			}
		});
	});
</script>

<style>
	#msg {
		margin:0 0 15px 40px;
		color: green;
	}
</style>