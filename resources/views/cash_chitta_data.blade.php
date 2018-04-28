<?php
	function dmy($date)
	{
		return date("d-m-Y",strtotime($date));
	}
?>
<div>
<script src="js/FileSaver.js"/>			
<script src="js/tableExport.js"/>	
<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="view_excel">
<input type="button" value="Print" class="btn btn-info btn-sm print" id="view_print">
<div class="alert alert-info" style="height:125px;">
	<div class="form-group col-sm-12">
		<label class="control-label col-sm-5 right_text" for="first_name">Date :</label>
		<div class="input-group input-append date col-sm-7" id="" style="padding-left:15px;padding-right:15px;">
			<input type="text" class="form-control datepicker" name="from_date" id="from_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
			<span class="input-group-addon add-on">
			<span class="glyphicon glyphicon-calendar">
			</span>
			</span> 
		</div>
		<div class="col-md-1 pull-right" style='display:inline-block;'>
			<button class="btn btn-info btn-sm" >View</button>
		</div>
	</div>
</div>
</div>