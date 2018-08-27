
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
			<thead>
				<tr>
                    <th><input type="checkbox" id="cdsd_int_select_all" /></th>
					<th>Sl. No.</th>
					<th>Customer ID</th>
					<th>Customer Name</th>
					<th>Account Number</th>
					<th>Interest Amount</th>
				</tr>
			</thead>
		<tbody>
			<?php $i=0;?>
			<tr>
				@foreach ($data['calculated_int'] as $row)
					<tr>
                        <td><input type="checkbox" id="select_{{$row->cdsd_id}}" class="select_cdsd_int" data="{{$row->cdsd_id}}" ></td>
						<td>{{++$i}}</td>
						<td>{{ $row->uid }}</td>
						<td></td>	
						<td>{{$row->cdsd_acc_no}} / {{$row->cdsd_oldacc_no}}</td>
						<td>{{$row->int_prev}}</td>
					</tr>
				@endforeach
			</tbody>
        </table>
                    
        <center>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="button" id="cdsd_int_create" value="CREATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
                </div>
            </div>
        </center>
        
        <script>
            $("#cdsd_int_select_all").click(function() {
                if($(this).is(":checked")) {
                    $(".select_cdsd_int").prop("checked", true);
                } else {
                    $(".select_cdsd_int").prop("checked", false);
                }
            });
        </script>