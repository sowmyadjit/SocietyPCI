				
		<?php
			$row = $data["chitta"][0];
			$zz = $data["tables"];
			print_r($zz);
		?>
				
				<td colspan="4" id="">
					cash_chitta_id				:	<input value="{{$row['cash_chitta_id']}}" readonly /> <br /><br />
					prefix						:	<input value="{{$row['prefix']}}" /> <br />
					table_name					:	
													<select class="edit_table_name">
														@foreach($data["tables"] as $row_table)
															<option>{{$row_table}}</option>
														@endforeach
													</select>	<br />
					pk_field					:	<input value="{{$row['pk_field']}}" /> <br />
					amount_field				:	<input value="{{$row['amount_field']}}"/> <br />
					bid_field					:	<input value="{{$row['bid_field']}}" /> <br />
					date_field					:	<input value="{{$row['date_field']}}" /> <br />
					transaction_type			:	
													<select class="edit_transaction_type">
															<option value="1">CREDIT</option>
															<option value="2">DEBIT</option>
															<option value="3">BOTH</option>
													</select> <br />
					transaction_type_field		:	<input value="{{$row['transaction_type_field']}}" /> <br />
					table_containing_account_no	:	
													<select class="edit_table_name">
														@foreach($data["tables"] as $row_table)
															<option>{{$row_table}}</option>
														@endforeach
													</select>	<br />
					account_no_field			:	<input value="{{$row['account_no_field']}}" /> <br />
					<button class="btn-xs cancel">cancel</button>
				</td>
				
	<script>
		$(".cancel").click(function() {
			var zz = $(this).parent();
			console.log(zz);
			$(zz).remove();
		});
	</script>