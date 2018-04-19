<div>
	<label><input type="radio" name="editable" class="editable" id="enabled" />enable editing</label>
	<label><input type="radio" name="editable" class="editable" id="disabled" checked />disable editing</label>
	<table>
	<thead>
		<tr>
			<th>
				Branch
			</th>
			<th>
				Cash
			</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $row) 
		<tr>
			<td>
			{{$row->Branch}}
			</td>
			<td>
				<input class="cash_inhand" id="{{$row->cashId}}" value="{{$row->InHandCash}}"/>
			</td>
		</tr>
	@endforeach
	</tbody>
	</table>
</div>
<script>
$(".cash_inhand").change(function(){
		$("#disabled").trigger("click");
		id=$(this).attr('id');
		amount=$(this).val();
		$.ajax({
					url:'/edit_cash_details',
					type:'post',
					data:'&cash_id='+id+'&amount='+amount,
					success:function(data)
					{
						console.log(data);
					}
	});
});
</script>

<script>
	disable_edit();
	$(".editable").change(function(){
		var val = $(this).attr('id');
            //console.log(val);
			if(val == "enabled") {
				enable_edit();
			} else {
				disable_edit();
			}
    });
	
	
	function enable_edit() {
		$('.cash_inhand').prop("disabled",false);
	}
	
	function disable_edit() {
		$('.cash_inhand').prop("disabled",true);
	}
	
</script>


