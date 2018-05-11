
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
								<thead>
									<tr>
										<th>Sl. No.</th>
										<th>Date</th>
										<th>Jewel Allocaiton Amount</th>
										<th>Appraiser Commission</th>
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($data['appraiser_commission_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{$row["date"]}}</td>
											<td>{{$row["loan_amount_daily_sum"]}}</td>
											<td>{{$row["appraiser_charge_daily_sum"]}}</td>
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td>{{$data["loan_amount_total_sum"]}}</td>
										<td>{{$data["appraiser_charge_total_sum"]}}</td>
									</tr>
								</tbody>
							</table>
							
							