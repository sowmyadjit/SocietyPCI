<?php
	//print_r($data["denomination_row"]);exit();
	if(!empty($data["denomination_row"])) {
		$date = $data["denomination_row"]["date"];
		$denominations_id = $data["denomination_row"]["denominations_id"];
		$value_2000 = $data["denomination_row"]["value_2000"];
		$value_500 = $data["denomination_row"]["value_500"];
		$value_200 = $data["denomination_row"]["value_200"];
		$value_100 = $data["denomination_row"]["value_100"];
		$value_50 = $data["denomination_row"]["value_50"];
		$value_20 = $data["denomination_row"]["value_20"];
		$value_10 = $data["denomination_row"]["value_10"];
		$value_5 = $data["denomination_row"]["value_5"];
		$value_2 = $data["denomination_row"]["value_2"];
		$value_1 = $data["denomination_row"]["value_1"];
		$value_other = $data["denomination_row"]["value_other"];
	} else {
		$date = $data["date"];
		$denominations_id = 0;
		$value_2000 = 0;
		$value_500 = 0;
		$value_200 = 0;
		$value_100 = 0;
		$value_50 = 0;
		$value_20 = 0;
		$value_10 = 0;
		$value_5 = 0;
		$value_2 = 0;
		$value_1 = 0;
		$value_other = 0;
	}

?>

<style>
	.no_border {
		border:1px solid;
	}
</style>
	<h2>Denominations</h2>
	<form id="form_denominations">
		<input class="hidden" name="date" value="{{$date}}" />
		<input class="hidden" name="denominations_id" value="{{$denominations_id}}" />
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
				<tr>
					<th>
						<span class="value">2000</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_2000" name="value_2000" type="number" min="0" value="{{$value_2000}}"  />
						=
						<input id="value_2000_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						500
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_500" name="value_500" type="number" min="0" value="{{$value_500}}"   />
						=
						<input id="value_500_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						200
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_200" name="value_200" type="number" min="0"  value="{{$value_200}}"  />
						=
						<input id="value_200_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						100
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_100" name="value_100" type="number" min="0" value="{{$value_100}}"   />
						=
						<input id="value_100_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						50
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_50" name="value_50" type="number" min="0" value="{{$value_50}}"   />
						=
						<input id="value_50_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						20
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_20" name="value_20" type="number" min="0" value="{{$value_20}}"   />
						=
						<input id="value_20_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						10
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_10" name="value_10" type="number" min="0" value="{{$value_10}}"   />
						=
						<input id="value_10_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						5
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_5" name="value_5" type="number" min="0" value="{{$value_5}}"   />
						=
						<input id="value_5_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						2
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_2" name="value_2" type="number" min="0" value="{{$value_2}}"   />
						=
						<input id="value_2_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						1
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_1" name="value_1" type="number" min="0" value="{{$value_1}}"   />
						=
						<input id="value_1_total" value="">
					</th>
				</tr>
				<tr>
					<th>
						coins
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border other_val" id="value_other" readonly />
						=
						<input id="value_other_total" name="value_other" type="number" min="0" value="{{$value_other}}">
					</th>
				</tr>
				<tr>
					<td><b>Total : <span id="grand_total"></span></b></td>
				</tr>
		</table>
		<button id="save_denominations">save</button>
	</form>
	
	<script>
		$("#save_denominations").click(function(e) {
			e.preventDefault();
			var form_data = $("#form_denominations").serialize();
			console.log("form_data: "+form_data);
			$.ajax({
				url : "save_denominations",
				type : "post",
				data : form_data,
				success : function(data) {
					console.log(data);
				}
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$(".count").each(function() {
				var id,count;
				id = $(this).attr("id");
				count = $(this).val();
				find_cash_amount(id,count);
			});
		});

		$(".count, #value_other_total").on("keyup change click",function(e) {
			var id = $(this).attr("id");
			var count = $(this).val();
			find_cash_amount(id,count);
		});

		function find_cash_amount(id,count) {
			var total_id = id + "_total";
			var value = 0;
			switch(id) {
				case "value_2000"	:	value = 2000;	break;
				case "value_500"	:	value = 500;	break;
				case "value_200"	:	value = 200;	break;
				case "value_100"	:	value = 100;	break;
				case "value_50"		:	value = 50;		break;
				case "value_20"		:	value = 20;		break;
				case "value_10"		:	value = 10;		break;
				case "value_5"		:	value = 5;		break;
				case "value_2"		:	value = 2;		break;
				case "value_1"		:	value = 1;		break;
			}
			$("#"+total_id).val(value * count);
			get_grand_total();
		}

		function get_grand_total() {
			var grand_total = 0;
			var amt = 0;
			var value_other_total = 0;
			$(".count").each(function() {
				var id = $(this).attr("id");
				amt = parseInt($("#"+id+"_total").val());
				if(!isNaN(amt)) {
					grand_total += parseInt(amt);
				}
			});
			value_other_total += parseFloat($("#value_other_total").val());
			if(!isNaN(value_other_total)) {
				grand_total += value_other_total;
			}
			$("#grand_total").html(grand_total);
		}
	</script>