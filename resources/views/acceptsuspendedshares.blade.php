<div class="bdy_<?php echo $m['module']->Mid; ?> box-inner">
	<div class="box-header well" data-original-title="">
		<h2><i class="glyphicon glyphicon-user"></i> Member Detail</h2>
		
	</div>
	
	<div class="box-content">
		
		<div class="alert alert-info">
			<a href="autoriseindividualshares" class="btn btn-default crtmem">view Individual shares</a>
			<!--<a href="memberejectview" class="btn btn-default crtmem">view rejected shares</a>-->
			
		</div>
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Share Class</th>
					<th>Number Of Shares</th>
					<th>Total Share Price</th>
					<th>Remaining Amount</th>
					<th>Enter Amount</th>
					<th>Remarks</th>
					<th>Status</th>
					<th colspan=2><center>ACTION</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($m['data'] as $members)
				<tr>
					<td class="hidden">{{ $members->Memid }}</td>
					<td class="hidden pursid<?php echo $members->PURSH_Pid;?>">{{ $members->PURSH_Pid }}</td>
					<td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}.{{ $members->MiddleName }}.{{ $members->LastName }}</a></td>
					<td>{{$members->CreatedDate}}</td>
					<td>{{$members->PURSH_Shrclass}}</td>
					<td>{{$members->PURSH_Noofshares}}</td>
					<td>{{$members->PURSH_TotalShareValue}}</td>
					<td class="pendamt<?php echo $members->PURSH_Pid;?>">{{$members->PURSH_PendingAmount}}</td>
					<td>
						<div class="form-group ">
							<div class="col-md-12">
								<input type="text" class="form-control" id="amt<?php echo "$members->PURSH_Pid";?>" name="amt<?php echo $members->PURSH_Pid;?>"  />
							</div>
						</div>
					</td>
					<td>{{$members->Remarks}}</td>
					<td>{{$members->Status}}</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $m['module']->Mid; ?>" href="memberdetails/{{ $members->Memid }}/edit"/>
							</div>
						</div>
					</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" class="btn btn-info btn-sm accept_suspended_share accbtn<?php echo $members->PURSH_Pid;?>" href="acceptsuspendshares/{{ $members->PURSH_Pid }}/{{$members->PURSH_PendingAmount}}" onclick="accept_suspended_share({{$members->PURSH_Pid}})"/>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</div>







