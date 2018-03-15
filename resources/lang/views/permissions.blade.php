        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>
			</div>
        </noscript>

    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a class="clickme" >PERMISSIONS</a>
            </li>
        </ul>
		</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-ban-circle"></i> PERMISSIONS</h2>
						<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
						<thead>
						<tr>
							<th>DESIGNATION</th>
							<th>LEVEL</th>
							<th>MODULES</th>
							<th>CREATE</th>
							<th>READ</th>
							<th>UPDATE</th>
							<th>DELETE</th>
						</tr>
						</thead>
						
						<tbody>
							@foreach ($p as $permissions)
							<tr>
								<td class="hidden">{{ $permissions->Pid }}</td>
								<td>{{ $permissions->DName }}</td>
								<td>{{ $permissions->DLevel }}</td>
								<td>{{ $permissions->MName}}</td>
								<td><input data-src="{{ $permissions->Pid }}" type="checkbox" value="1" <?php  if($permissions->Create)  echo 'checked'; ?> class="pcreate"> </td>
								<td><input data-src="{{ $permissions->Pid }}" type="checkbox" value="2" <?php  if($permissions->View)  echo 'checked'; ?> class="pread"> </td>
								<td><input data-src="{{ $permissions->Pid }}" type="checkbox" value="3" <?php  if($permissions->UDate)  echo 'checked'; ?> class="pupdate"> </td>
								<td><input data-src="{{ $permissions->Pid }}" type="checkbox" value="4" <?php  if($permissions->Delete)  echo 'checked'; ?> class="pdelete"> </td>
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
					<div id='pagei'>
				{!! $p->render() !!}
				</div>
				</div>
			</div>
		</div>
	</div>
					
<script>
	$('.clickme').click(function(e){
		$('.permissionclassid').click();
	}); 

	$('.crtds').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});

	$('.pcreate').change(function(e){
		Pid=$(this).attr('data-src');
		
		if($(this).is(":checked"))
		{
			//alert('checked');
			val='1';
		}
		else
		{
			//alert('unchecked');
			val='0';
		}
		
		$.ajax({
				type: 'POST',
				url: "PermissionUpdateC",
				data : { val : val, Pid : Pid },
				success: function(result)
				{}
		});
	});

	$('.pread').change(function(e){
		Pid=$(this).attr('data-src');
		
		if($(this).is(":checked"))
		{
			//alert('checked');
			val='1';
		}
		else
		{
			//alert('unchecked');
			val='0';
		}
		
		$.ajax({
				type: 'POST',
				url: "PermissionUpdateR",
				data : { val : val, Pid : Pid },
				success: function(result)
				{}
		});
	});

	$('.pupdate').change(function(e)
	{
		Pid=$(this).attr('data-src');
		
		if($(this).is(":checked"))
		{
			//alert('checked');
			val='1';
		}
		else
		{
			//alert('unchecked');
			val='0';
		}
	
		$.ajax({
				type: 'POST',
				url: "PermissionUpdateU",
				data : { val : val, Pid : Pid },
				success: function(result)
				{}
		});
	});

	$('.pdelete').change(function(e)
	{
		Pid=$(this).attr('data-src');
	
		if($(this).is(":checked"))
		{
			//alert('checked');
			val='1';
		}
		else
		{
			//alert('unchecked');
			val='0';
		}
		
		$.ajax({
				type: 'POST',
				url: "PermissionUpdateD",
				data : { val : val, Pid : Pid },
				success: function(result)
				{}
		});
	});
	
	$("ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc");
  
});
$('.loadmc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('#maincontents').load($(this).attr('href'));
});
	
</script>