<link href="css/loader.css" rel='stylesheet'> 
<link href="css/calci.css" rel='stylesheet'> 
<link href="css/floating-box.css" rel='stylesheet'> 

<!-- contact form start -->
<div class="floating-form" id="contact_form">
	<div class="contact-opener tran">ಭಾಷಾಂತರ</div>
	<center>
		
		
		<div id='trans'>
			<div class="floating-form-heading">Type the Word and Press Enter/Space Key</div>
			<div id="contact_results"></div>
			<div id="contact_body">
				<form runat="server">
					
					<textarea rows="8" class="form-control" ID="transliterateTextarea" runat="server"></textarea>
					
				</form>
			</div>
		</div>
		
		
		
	</center>
</div>
<!-- contact form end -->
<!-- contact form start -->
<div class="floating-form2" id="contact_form2">
	<div class="below1 cal"> CAL </div>
	<center>
		
		
		<div id='calc'>
			
			<div id="contact_results"></div>
			<div id="contact_body">
				
				
				<table class="calculator" id="calc">
					<tr>
						<td colspan="4" class="calc_td_result">
							
							<input type="text" readonly="readonly" name="calc_result" id="calc_result" class="calc_result" onkeydown="javascript:key_detect_calc('calc',event);" />
							
						</td>
					</tr>
					<tr>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="CE" onclick="javascript:f_calc('calc','ce');" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="&larr;" onclick="javascript:f_calc('calc','nbs');" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="%" onclick="javascript:f_calc('calc','%');" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="+" onclick="javascript:f_calc('calc','+');" />
						</td>
					</tr>
					<tr>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="7" onclick="javascript:add_calc('calc',7);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="8" onclick="javascript:add_calc('calc',8);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="9" onclick="javascript:add_calc('calc',9);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="-" onclick="javascript:f_calc('calc','-');" />
						</td>
					</tr>
					<tr>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="4" onclick="javascript:add_calc('calc',4);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="5" onclick="javascript:add_calc('calc',5);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="6" onclick="javascript:add_calc('calc',6);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="x" onclick="javascript:f_calc('calc','*');" />
						</td>
					</tr>
					<tr>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="1" onclick="javascript:add_calc('calc',1);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="2" onclick="javascript:add_calc('calc',2);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="3" onclick="javascript:add_calc('calc',3);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="&divide;" onclick="javascript:f_calc('calc','');" />
						</td>
					</tr>
					<tr>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="0" onclick="javascript:add_calc('calc',0);" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="&plusmn;" onclick="javascript:f_calc('calc','+-');" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="," onclick="javascript:add_calc('calc','.');" />
						</td>
						<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="=" onclick="javascript:f_calc('calc','=');" />
						</td>
					</tr>
				</table>
				
			</div>
		</div>
		
		
		
		
	</center>
</div>
<!-- contact form end -->







<script  type="text/javascript" src="js/calci.js"></script>



<script type="text/javascript">
	document.getElementById('calc').onload=init_calc('calc');
</script>



<script>
	
	function reset()
	{
		$('#contact-form').hide();
		$('#contact-form1').hide();	
	}
	$('.tran').click(function(e){
		reset();
		$('#contact-form').show();	
		
		
		
	});
	
	$('.cal').click(function(e){
		reset();
		$('#contact-form1').show();	
		
		
		
	});
	
	
</script>

