
	<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>CACHE</h2>
					</div>
					
					<div class="box-content">
						<div class="alert alert-info">
							<a class="btn btn-default " id="clear_btn" >Clear Cache</a>
						</div>
					</div>
					
					<div id="msg">
						
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$("#clear_btn").click(function(e) {
		e.preventDefault();
		console.log("clear_btn");
		
		$.ajax({
			url:"clear-cache",
			type:"get",
			success:function(data){
				console.log("cleared");
				$("#msg").html("Cache, View cleared");
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