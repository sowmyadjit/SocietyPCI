
<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<div id="content" class="col-md-10">
	<!-- content starts -->
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create Ledger Head Subhead</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_addbank','method'=>'post']) !!}
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Select Head :</label>
						<div class="col-md-5">
							<select class="form-control" id="head">
								<option>-----select----</option>
								@foreach($data['head'] as $row)
									<option value="{{$row->lid}}"><?php echo $row->lname;?></option>
								@endforeach
							<select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Table Name :</label>
						<div class="col-sm-5">
							<select class="form-control" id="table">
									<option>-----select----</option>
									<?php
									foreach($data['tablename'] as $row) {
									?>
										
									<option><?php echo $row;?></option>
									
								<?php	
									}
									?>
								<select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Amount Field :</label>
						<div class="col-sm-5" id="">
							<select class="form-control col-sm-4" id="amt_field" name="amt_field">
								<option>-----select----</option>
							</select>
						</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4"></label>
						<div class="col-sm-5" id="">
							<label><input id="type1" class="" name="type" type="radio" value="CREDIT" checked />CREDIT</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input id="type2" class="" name="type" type="radio"  value="DEBIT"/>DEBIT</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Date Field :</label>
						<div class="col-sm-5" id="">
							<select class="form-control col-sm-4" id="date_field" name="date_field">
								<option>-----select----</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">BID Field :</label>
						<div class="col-sm-5" id="">
							<select class="form-control col-sm-4" id="bid_field" name="bid_field">
								<option>-----select----</option>
							</select>
						</div>
					</div>
					
<!------------------------->
					<div id="where_box">
						
					</div>
					
					<center>
						<div class="form-group">
							<div class="col-sm-12" id="">
								<button class="btn btn-info" id="add_where">ADD WHERE</button>
							</div>
						</div>
					</center>
					
					<center>
						<div class="form-group">
							<div class="col-sm-12" id="">
								<button class="btn btn-danger" id="submit">Submit</button>
							</div>
						</div>
					</center>
					
					
					
				</div>
			</div>
		</div>
	</div>
</div>

	
<script>
	
	$("#submit").click(function( event ) {
			event.preventDefault();
			console.log("submit clicked");
		//	var where_all = get_values();
			var Headid = $("#head").val();
			var table_name = $("#table").val();
			var Amount_field = $("#amt_field").val();
			var type = $("[name='type']:checked").val();
			var Date_field = $("#date_field").val();
			var bid_field = $("#bid_field").val();
			var where_clause = get_wr_names();
			var where_clause_value = get_wr_values();
			var where_clause_num = count;
			
			
			
			$.ajax({
					url:'create_all_head_subhead',
					type:'post',
					data:'&Headid='+Headid+'&table_name='+table_name+'&Amount_field='+Amount_field+'&Date_field='+Date_field+'&where_clause='+where_clause+'&where_clause_value='+where_clause_value+'&where_clause_num='+where_clause_num+'&bid_field='+bid_field+'&type='+type,
					success:function(data)
					{
							
						console.log("success");
								
					}
				});
			
		}
	);
	
	
	$("#table").change(function() {
		console.log("grsfg");
		var table = $("#table").val();
		console.log(table);
		$.ajax({
				url:'GetFieldNames',
				type:'post',
				data:'&table='+table,
				success:function(data)
				{
						
						$("[id$='_field']").html("<option>-----select----</option>");//"<option>-----select----</option>");
						for (var i = 0; i < data.length; i++) {
							var field_name = data[i];
							console.log(field_name);
							$("[id$='_field']").append("<option value='" + field_name +"'>"+field_name+"</option>");
						}
							
				}
			});
	});
	
</script>




	
<script>
	
	
	function get_wr_names() {
		var wr_name = "";
	
		$("[id^='wrn']").each(function() {
			var fname = $(this).val();
			//console.log(fname);
			
			if(wr_name == "") {
				wr_name = fname;
			} else {
				wr_name = wr_name + "," +fname;
			}
			
		});
		
		console.log(wr_name);
		return wr_name;
	}
	
	function get_wr_values() {
		var wr_value = "";
		
		$("[id^='wrv']").each(function() {
			var fvalue = $(this).val();
			//console.log(fvalue);
			
			if(wr_value == "") {
				wr_value = fvalue;
			} else {
				wr_value = wr_value + "," +fvalue;
			}
			
		});
		
		console.log(wr_value);
		return wr_value;
	}
	
	
	
	
	
	
</script>



<script>
	
	var count = 0;
	$("#add_where").click(function( event ) {
	
	
	
	
	
			event.preventDefault();
			console.log("\nadding new where clause\n");
			count++
			var where_cluase = `
								<div class="form-group ">
									<label class="control-label col-sm-4">Where `+ count +` :</label>
									<div class="col-sm-3 " id="">
										<select class="form-control col-sm-4 fname " id="wrn`+ count +`_field">
											<option>-----select----</option>
										</select>
									</div>
									<div class="col-sm-2" id="">
										<input class="form-control fvalue" id="wrv`+ count +`" name="wr1_value" placeholder="value"/>
									</div>
								</div>
								`;
			$("#where_box").append(where_cluase);
			
			
			
			var table = $("#table").val();
			console.log(table);
			$.ajax({
				url:'GetFieldNames',
					type:'post',
					data:'&table='+table,
					success:function(data)
					{
							
							$("#wrn"+count+"_field").html("<option>-----select----</option>");
							for (var i = 0; i < data.length; i++) {
								var field_name = data[i];
								console.log(field_name);
								$("#wrn"+count+"_field").append("<option value='" + field_name +"'>"+field_name+"</option>");
							}
								
					}
				});
			
		}
	);
	
</script>
