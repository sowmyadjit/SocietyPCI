
<?php
	
	$entry_id = $entry_data["ledger_field_info"]->TableAndFiled_Id;
	$lid = $entry_data["ledger_field_info"]->TableAndFiled_Lid;
	$table_name = $entry_data["ledger_field_info"]->TableAndFiled_TableName;
	$amt_field = $entry_data["ledger_field_info"]->TableAndFiled_Amount;
	$type = $entry_data["ledger_field_info"]->Type;
	if($type == "CREDIT") {
		$cr_checked = "checked";
		$db_checked = "";
	} else {
		$db_checked = "checked";
		$cr_checked = "";
	}
	$date_field = $entry_data["ledger_field_info"]->TableAndFiled_Date;
	$bid_field = $entry_data["ledger_field_info"]->TableAndFiled_Bid;
	
	$count = $entry_data["count"];
	
	
	
	
	
	
	
	
?>
<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>

<?php /*
<div id="content" class="col-md-10">
*/?>
<!-- content starts -->
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Update Ledger Head Subhead</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_data','method'=>'post']) !!}
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Select Head :</label>
						<div class="col-md-5">
							<select class="form-control" id="head">
								<option>-----select----</option>
								@foreach($data['head'] as $row)
									<?php
										if($row->lid == $lid) {
											$selected = "selected";
										} else {
											$selected = "";
										}
									?>
									<option value="{{$row->lid}}" {{$selected}}><?php echo $row->lname;?></option>
								@endforeach
							<select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Table Name :</label>
						<div class="col-sm-5">
							<select class="form-control" id="table">
									<option>-----select----</option>
									@foreach($data['tablename'] as $key=>$val)
										<?php
											if($val == $table_name) {
												$selected = "selected";
											} else {
												$selected = "";
											}
										?>
										<option {{$selected}} >{{$val}}</option>
									@endforeach
								<select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Amount Field :</label>
						<div class="col-sm-5" id="">
							<select class="form-control col-sm-4" id="amt_field" name="amt_field">
								<option>{{$amt_field}}</option>
							</select>
						</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4"></label>
						<div class="col-sm-5" id="">
							<label><input id="type1" class="" name="type" type="radio" value="CREDIT" {{$cr_checked}} />CREDIT</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input id="type2" class="" name="type" type="radio"  value="DEBIT" {{$db_checked}} />DEBIT</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Date Field :</label>
						<div class="col-sm-5" id="">
							<select class="form-control col-sm-4" id="date_field" name="date_field">
								<option>{{$date_field}}</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">BID Field :</label>
						<div class="col-sm-5" id="">
							<select class="form-control col-sm-4" id="bid_field" name="bid_field">
								<option>{{$bid_field}}</option>
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
								<button class="btn btn-danger" id="submit">Update</button>
							</div>
						</div>
					</center>
					
					
					
				</div>
			</div>
		</div>
	</div>
	<?php /*
</div>
*/?>

	
<script>
	$(document).ready(function(){
	
	
		var entry_id = {{$entry_id}};
		var lid = {{$lid}};
		var table_name = "{{$table_name}}";
		var amt_field = "{{$amt_field}}";
		var type = "{{$type}}";
		var cr_checked = "{{$cr_checked}}";
		var db_checked = "{{$db_checked}}";
		var date_field = "{{$date_field}}";
		var bid_field = "{{$bid_field}}";
		var count = {{$count}};
	
		
		
		<?php
			$temp_field = array();
			$temp_val = array();
			$i = 0;
			foreach($entry_data["whereclaus"] as $row) {
				$temp_id[$i] = $row->whereclaus_id;
				$temp_field[$i] = $row->whereclaus;
				$temp_val[$i] = $row->whereclaus_value;
				$i++;
			}
			$script3 = 'var whereclaus_id = new Array("' . implode('","', $temp_id) . '");';
			$script = 'var whereclaus = new Array("' . implode('","', $temp_field) . '");';
			$script2 = 'var whereclaus_val = new Array("' . implode('","', $temp_val) . '");';
			echo $script; 
			echo $script2;
			echo $script3;
		?>
		
		
		console.log(whereclaus_id);
		console.log(whereclaus);
		console.log(whereclaus_val);
		
			for(var i=1; i<= count; i++) {
				$("#add_where").click();
			}
			
		$.when(ajax_table_change()).done(function() {
			$("#amt_field").val(amt_field);
		//	$("#amt_field option[value="+amt_field+"]").attr('selected', 'selected');
			$("#date_field").val(date_field);
			$("#bid_field").val(bid_field);
			
			
			for(var i=0;i<count;i++) {
				$("#wrn"+(i+1)+"_field").attr("data",whereclaus_id[i]);
				$("#wrn"+(i+1)+"_field").val(whereclaus[i]);
				$("#wrv"+(i+1)).val(whereclaus_val[i]);
			}
			
			
		});
		
		
		
	});
</script>




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
			var where_id = get_wr_ids();
			var where_clause = get_wr_names();
			var where_clause_value = get_wr_values();
			var where_clause_num = count;
			var entry_id = {{$entry_id}};
			
			$.ajax({
					url:'update_head_subhead',
					type:'post',
					data:'&update=3&entry_id='+entry_id+'&Headid='+Headid+'&table_name='+table_name+'&Amount_field='+Amount_field+'&Date_field='+Date_field+'&where_id='+where_id+'&where_clause='+where_clause+'&where_clause_value='+where_clause_value+'&where_clause_num='+where_clause_num+'&bid_field='+bid_field+'&type='+type,
					success:function(data)
					{
							
						console.log("ajax update_head_subhead success");
						
					}
				});
			
		}
	);
	
	
	$("#table").change(function() {
	//	console.log("grsfg");
	//	var table = $("#table").val();
	//	console.log(table);
		ajax_table_change();
	});
	
	function ajax_table_change()
	{
		console.log("grsfg");
		var table = $("#table").val();
	//	console.log(table);
		
		return $.ajax({
					url:'GetFieldNames',
					type:'post',
					data:'&table='+table,
					success:function(data)
					{
							
							$("[id$='_field']").html("<option>-----select----</option>");//"<option>-----select----</option>");
							for (var i = 0; i < data.length; i++) {
								var field_name = data[i];
							//	console.log(field_name);
								$("[id$='_field']").append("<option value='" + field_name +"'>"+field_name+"</option>");
							}
							$("[id$='_field']").append("<option value='-delete-'>-----delete----</option>");
								
					}
				});
	}
	
	
	
</script>




	
<script>
	
	
	function get_wr_ids() {
		var wr_id = "";
	
		$("[id^='wrn']").each(function() {
			var temp_id = $(this).attr("data");
			console.log(temp_id);
			
			if(wr_id == "") {
				wr_id = temp_id;
			} else {
				wr_id = wr_id + "," +temp_id;
			}
			
		});
		
		console.log(wr_id);
		return wr_id;
	}
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
		
		//console.log(wr_value);
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
										<select class="form-control col-sm-4 fname " id="wrn`+ count +`_field" data="-1">
											<option>-----select----</option>
										</select>
									</div>
									<div class="col-sm-2" id="">
										<input class="form-control fvalue" id="wrv`+ count +`" name="wr1_value" placeholder="value"/>
									</div>
								</div>
								`;
			$("#where_box").append(where_cluase);
			//ajax_add_where();
			
			
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
								//console.log(field_name);
								$("#wrn"+count+"_field").append("<option value='" + field_name +"'>"+field_name+"</option>");
							}
								
					}
				});
			
		}
	);
	
	function ajax_add_where()
	{
		;
	}
	
	
	
</script>
