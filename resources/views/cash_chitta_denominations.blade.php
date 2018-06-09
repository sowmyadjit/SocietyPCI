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

		$value_2000_total = $value_2000*2000;
		$value_500_total = $value_500*500;
		$value_200_total = $value_200*200;
		$value_100_total = $value_100*100;
		$value_50_total = $value_50*50;
		$value_20_total = $value_20*20;
		$value_10_total = $value_10*10;
		$value_5_total = $value_5*5;
		$value_2_total = $value_2*2;
		$value_1_total = $value_1*1;
		$total_value=$value_2000_total+$value_500_total+$value_200_total+$value_100_total+$value_50_total+$value_20_total+$value_10_total+$value_5_total+$value_2_total+$value_1_total+$value_other;
		// echo $total_value;exit;
		$number = $total_value;
	 	$no = round($number);
	 	$point = round($number - $no, 2) * 100;
	 	$hundred = null;
	 	$digits_1 = strlen($no);
	 	$i = 0;
	 	$str = array();
	 	$words = array('0' => '', '1' => 'one', '2' => 'two',
	  	'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
	  	'7' => 'seven', '8' => 'eight', '9' => 'nine',
	  	'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
	  	'13' => 'thirteen', '14' => 'fourteen',
	  	'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
	  	'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
	  	'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
	  	'60' => 'sixty', '70' => 'seventy',
	  	'80' => 'eighty', '90' => 'ninety');
	 	$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		 while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
	 		$no = floor($no / $divider);
	  	 $i += ($divider == 10) ? 1 : 2;
	  	 if ($number) {
			  $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			  $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			  $str [] = ($number < 21) ? $words[$number] .
			  " " . $digits[$counter] . $plural . " " . $hundred
			  :
			  $words[floor($number / 10) * 10]
			  . " " . $words[$number % 10] . " "
			  . $digits[$counter] . $plural . " " . $hundred;
	  	 } else $str[] = null;
	}
	$str = array_reverse($str);
	$result = implode('', $str);
	$points = ($point) ?
	  "." . $words[$point / 10] . " " . 
			$words[$point = $point % 10] : '';
	//echo $result . "Rupees  " . $points . " ,Paise";

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
		$value_2000_total = 0;
		$value_500_total = 0;
		$value_200_total = 0;
		$value_100_total = 0;
		$value_50_total = 0;
		$value_20_total = 0;
		$value_10_total = 0;
		$value_5_total = 0;
		$value_2_total = 0;
		$value_1_total = 0;
		$value_other = 0;
		$total_value=0;
		$result = 0;
	}
?>
<style>
	.no_border {
		border:1px solid;
	}
	.denomination_css{
		width: 50px !important;
		float: left;
		text-align: right;
    	padding-top: 2px;
	}
</style>
	<h2 style="font-size:17px;">Denominations</h2>
	<form id="form_denominations">
		<input class="hidden" name="date" value="{{$date}}" />
		<input class="hidden" name="denominations_id" value="{{$denominations_id}}" />
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
				<tr>
					<th>
						<span class="value denomination_css">2000</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_2000" name="value_2000" type="number" min="0" value="{{$value_2000}}"  style="width:60px;"  />
						=
						<input id="value_2000_total" value="{{$value_2000_total}}" style="width:100px;">
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">500</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_500" name="value_500" type="number" min="0" value="{{$value_500}}" style="width:60px;" />
						=
						<input id="value_500_total" value="{{$value_500_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">200</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_200" name="value_200" type="number" min="0"  value="{{$value_200}}" style="width:60px;"  />
						=
						<input id="value_200_total" value="{{$value_200_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">100</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_100" name="value_100" type="number" min="0" value="{{$value_100}}"  style="width:60px;" />
						=
						<input id="value_100_total" value="{{$value_100_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">50</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_50" name="value_50" type="number" min="0" value="{{$value_50}}"  style="width:60px;" />
						=
						<input id="value_50_total" value="{{$value_50_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">20</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_20" name="value_20" type="number" min="0" value="{{$value_20}}" style="width:60px;"  />
						=
						<input id="value_20_total" value="{{$value_20_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">10</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_10" name="value_10" type="number" min="0" value="{{$value_10}}" style="width:60px;"  />
						=
						<input id="value_10_total" value="{{$value_10_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">5</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_5" name="value_5" type="number" min="0" value="{{$value_5}}"  style="width:60px;" />
						=
						<input id="value_5_total" value="{{$value_5_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">2</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_2" name="value_2" type="number" min="0" value="{{$value_2}}"  style="width:60px;" />
						=
						<input id="value_2_total" value="{{$value_2_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">1</span>
						<span class="glyphicon glyphicon-remove" />
						<input class="no_border count" id="value_1" name="value_1" type="number" min="0" value="{{$value_1}}" style="width:60px;"  />
						=
						<input id="value_1_total" value="{{$value_1_total}}" style="width:100px;" readonly>
					</th>
				</tr>
				<tr>
					<th>
						<span class="value denomination_css">coins</span>
						<!-- <span class="glyphicon glyphicon-remove" /> -->
						<!-- <input class="no_border other_val" id="value_other" style="width:60px;" type="number" min="0" value="{{$value_other}}" />
						= -->
						<input id="value_other_total" name="value_other" type="number" min="0" value="{{$value_other}}" style="width:100px;margin-left:93px;">
					</th>
				</tr>
				<tr>
					<td>
						<b>Total : <span id="grand_total"></span> (<span id="container"> <?php echo $result . "Rupees.";  ?> </span> )</b>
							<input type="hidden" name="rupees" value="" id="rupees" />
					</td>
				</tr>
		</table>
		<br>
		<p style="text-align: right;padding-right: 200px;">Manager Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cashier Signature</p>
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
			$("#rupees").val(grand_total.toFixed(2));
			convert_amount_into_rupees_paisa();
		}
	</script>



<script type="text/javascript">
    $("#aa").click(function()
    {
        console.log("sdfsdlfhd");
        convert_amount_into_rupees_paisa() ;
    });

    function test_value(){
        var junkVal=document.getElementById('rupees').value;
        junkVal = Math.floor(junkVal);
        var obStr = new String(junkVal);
        numReversed= obStr.split("");
        actnumber=numReversed.reverse();
        if(Number(junkVal) >=0){
          //do nothing
        }
        else{
            alert('wrong Number cannot be converted');
            return false;
        }
        if(Number(junkVal)==0){
            document.getElementById('container').innerHTML=obStr+''+'Rupees Zero Only';
            return false;
        }
        if(actnumber.length>9){
            alert('Oops!!!! the Number is too big to covertes');
            return false;
        }
        var iWords=["Zero", " One", " Two", " Three", " Four", " Five", " Six", " Seven", " Eight", " Nine"];
        var ePlace=['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', 'Nineteen'];
        var tensPlace=['dummy',' Ten',' Twenty',' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety' ];
        var iWordsLength=numReversed.length;
        var totalWords="";
        var inWords=new Array();
        var finalWord="";
        j=0;
        
        for(i=0; i<iWordsLength; i++) {
            switch(i) {
                case 0:
                        if(actnumber[i]==0 || actnumber[i+1]==1 ) {
                          inWords[j]='';
                        } else {
                        inWords[j]=iWords[actnumber[i]];
                        }
                        inWords[j]=inWords[j];
                        break;
                case 1:
                        tens_complication();
                        break;
                        case 2:
                        if(actnumber[i]==0) {
                        inWords[j]='';
                        }
                        else if(actnumber[i-1]!=0 && actnumber[i-2]!=0) {
                        inWords[j]=iWords[actnumber[i]]+' Hundred and';
                        }
                        else {
                        inWords[j]=iWords[actnumber[i]]+' Hundred';
                        }
                        break;
                case 3:
                        if(actnumber[i]==0 || actnumber[i+1]==1) {
                        inWords[j]='';
                        }
                        else {
                        inWords[j]=iWords[actnumber[i]];
                        }
                        if(actnumber[i+1] != 0 || actnumber[i] > 0){ //here
                        inWords[j]=inWords[j]+" Thousand";
                        }
                        break;
                case 4:
                        tens_complication();
                        break;
                case 5:
                        if(actnumber[i]=="0" || actnumber[i+1]==1 ) {
                        inWords[j]='';
                        }
                        else {
                        inWords[j]=iWords[actnumber[i]];
                        }
                        if(actnumber[i+1] != 0 || actnumber[i] > 0){ //here
                        inWords[j]=inWords[j]+" Lakh";
                        }
                        break;
                case 6:
                        tens_complication();
                        break;
                case 7:
                        if(actnumber[i]=="0" || actnumber[i+1]==1 ){
                        inWords[j]='';
                        }
                        else {
                        inWords[j]=iWords[actnumber[i]];
                        }
                        if(actnumber[i+1] != 0 || actnumber[i] > 0){ // changed here
                        inWords[j]=inWords[j]+" Crore";
                        }
                        break;
                case 8:
                        tens_complication();
                        break;
                default:
                        break;
            }
            j++;
        }
        function tens_complication() {
            if(actnumber[i]==0) {
                inWords[j]='';
            } else if(actnumber[i]==1) {
                inWords[j]=ePlace[actnumber[i-1]];
            } else {
                inWords[j]=tensPlace[actnumber[i]];
            }
        }
        inWords.reverse();
        for(i=0; i<inWords.length; i++) {
         finalWord+=inWords[i];
        }
        return finalWord;
    }

    function convert_amount_into_rupees_paisa(){
        var val = document.getElementById('rupees').value;
        if(val.length==0 || val=='00'|| val=='0'|| val=='0.00'|| val=='0.0'|| val=='00.00'|| val=='00.0') {
            document.getElementById('container').innerHTML="Zero Rupees Only";
            return false;
        }
        var finalWord1 = test_value();
        var finalWord2 = "";
        var val = document.getElementById('rupees').value;
        var actual_val = document.getElementById('rupees').value;
        document.getElementById('rupees').value = val;
        if(val.indexOf('.')!=-1) {
            val = val.substring(val.indexOf('.')+1,val.length);
            if(val.length==0 || val=='00'|| val=='0') {
                finalWord2 = "zero paisa only";
            } else {
                document.getElementById('rupees').value = val;
                finalWord2 = test_value() + " paisa only";
            }
            var n=finalWord1.match(false);
            if(n=='false')
                document.getElementById('container').innerHTML=finalWord2+ " paisa only";
            else
                document.getElementById('container').innerHTML=finalWord1 +" Rupees and "+finalWord2;
        } else{
            //finalWord2 = " Zero paisa only";
            document.getElementById('container').innerHTML=finalWord1 +" Rupees Only";
        }
        document.getElementById('rupees').value = actual_val;
    }
</script>