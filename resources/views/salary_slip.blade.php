<style>
/* td{
    width:160px !important;
} */
.bg_color_head{
    background-color: #32b700ad !important;
}
.earn_deduction_class{
    display: inline-block;
    width: 49.5% !important;
    float: left;
}
.boldclass{
    font-weight: bold !important;
}
</style>
<div class="col-md-12">
	<script src="js/FileSaver.js"/>			
    <script src="js/tableExport.js"/>
    <style>
/* td{
    width:160px !important;
} */
.bg_color_head{
    background-color: #32b700ad !important;
}
.earn_deduction_class{
    display: inline-block;
    width: 49.5% !important;
    float: left;
}
.boldclass{
    font-weight: bold !important;
}
</style>
	<!--<a href="salcreate" class="btn btn-default salcrt">Salary</a>-->
    <h3 style="background-color:green;color:white; ">Salary Slip</h3>
    <?php
    //print_r($salary_slip_data);
    $total_addition=0;
    $total_deduction=0;
    for($i=0;$i<count($salary_slip_data['adition']);$i++)
    {
        $total_addition=$total_addition+$salary_slip_data['adition'][$i]->salpay_extra_amt;
    }
    for($i=0;$i<count($salary_slip_data['deduction']);$i++)
    {
        $total_deduction=$total_deduction+$salary_slip_data['deduction'][$i]->salpay_extra_amt;
    }
    //print_r($total_addition);
    //print_r($total_deduction);
    $net_pay=$total_addition-$total_deduction;
    ?>
    <h5 style="text-align: center;color: black;font-weight: bold;">Salary Slip for {{$salary_slip_data['sal_details']->month}} {{$salary_slip_data['sal_details']->year}}</h5>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export">
    <tr>
        <td class="bg_color_head boldclass">
            Employee Name:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->full_name}}
        </td>
        <td class="bg_color_head boldclass">
            PF No:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->pf_no}}
        </td>
    </tr>
    <tr>
        <td class="bg_color_head boldclass">
            Date of Joining:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->date_of_joining}}
        </td>
        <td class="bg_color_head boldclass">
            SB No:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->sb_no}}
        </td>
    </tr>
    <tr>
        <td class="bg_color_head boldclass">
            Worked days:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->worked_days}}
        </td>
        <td class="bg_color_head boldclass">
            LOP Days:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->lop_days}}
        </td>
    </tr>
    <tr>
        <td class="bg_color_head boldclass">
            Designation:
        </td>
        <td>
            {{$salary_slip_data['sal_details']->designation}}
        </td>
        <td>
        </td>
        <td>
        </td>
    </tr>
    </table>
<div>
<div class="earn_deduction_class">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
        <tr>
            <td class="bg_color_head boldclass"> 
                Earnings
            </td>
            <td class="bg_color_head boldclass">
                Amounts in Rs.
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach( $salary_slip_data['adition'] as $earnings)
        <tr>
            <td>
                {{$earnings->sal_extra_display_name}}
            </td>
            <td>
                {{$earnings->salpay_extra_amt}}               
            </td>
        </tr>
        @endforeach

        <tr>
            <td class="boldclass" style="font-weight:bold;">
                Gross Earnings
            </td>
            <td class="boldclass" style="font-weight:bold;">
                {{$total_addition}}
            </td>
        </tr>
    </tbody>
    </table>
</div>
<div class="earn_deduction_class">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <td class="bg_color_head boldclass">
                        Deduction
                    </td>
                    <td class="bg_color_head boldclass">
                        Amounts in Rs.
                    </td>
                </tr>
            </thead>
            <tbody>
                    @foreach( $salary_slip_data['deduction'] as $earnings)
                    <tr>
                        <td>
                            {{$earnings->sal_extra_display_name}}
                        </td>
                        <td>
                            {{$earnings->salpay_extra_amt}}               
                        </td>
                    </tr>
                    @endforeach
                <tr>
                    <td class="boldclass" style="font-weight:bold;">
                        Gross Deduction
                    </td>
                    <td class="boldclass" style="font-weight:bold;">
                        {{$total_deduction}} 
                    </td>
                </tr>
            </tbody>
            </table>
</div>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
        <!-- <tr>
            <td>
                Gross Earnings
            </td>
            <td>
                {{$total_addition}}
            </td>
            <td>
                Gross Deduction
            </td>
            <td>
                {{$total_deduction}} 
            </td>
        </tr> -->
        <tr>
            <td colspan="2" class="boldclass" style="width:52px;">
                Net Pay
            </td>
            <td colspan="2" class="boldclass">
                {{$net_pay}}  
            </td>
        </tr>
    </thead>
</table>
</div>
    <!-- <tr>
            <td colspan="2">
                Net Pay
            </td>
            <td colspan="2">
                  $net_pay  
            </td>
        </tr> -->

        <div id="toprint_sal" style="position:fixed;opacity:0;">
                <script src="js/bootstrap-table.js"/>
                <script src="js/FileSaver.js"/>			
                <script src="js/tableExport.js"/>			
                <script src="js/jquery.base64.js"/>			
                <script src="js/sprintf.js"/>
                <script src="js/jspdf.js"/>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
                
                <script src="js/bootstrap-table-export.js"/>
                <link href="css/bootstrap-table.css" rel='stylesheet' type="text/css" media="all">
                <link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
                <link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
                <style>
                        /* td{
                            width:160px !important;
                        } */
                        .bg_color_head{
                            background-color: #32b700ad !important;
                        }
                        .earn_deduction_class{
                            display: inline-block;
                            width: 49.5% !important;
                            float: left;
                        }
                        .boldclass{
                            font-weight: bold !important;
                        }
                        </style>
                <h5 style="text-align: center;color: black;font-weight: bold;">Salary Slip for {{$salary_slip_data['sal_details']->month}} {{$salary_slip_data['sal_details']->year}}</h5>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <tr>
                    <td class="bg_color_head boldclass">
                        Employee Name:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->full_name}}
                    </td>
                    <td class="bg_color_head boldclass">
                        PF No:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->pf_no}}
                    </td>
                </tr>
                <tr>
                    <td class="bg_color_head boldclass">
                        Date of Joining:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->date_of_joining}}
                    </td>
                    <td class="bg_color_head boldclass">
                        SB No:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->sb_no}}
                    </td>
                </tr>
                <tr>
                    <td class="bg_color_head boldclass">
                        Worked days:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->worked_days}}
                    </td>
                    <td class="bg_color_head boldclass">
                        LOP Days:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->lop_days}}
                    </td>
                </tr>
                <tr>
                    <td class="bg_color_head boldclass">
                        Designation:
                    </td>
                    <td>
                        {{$salary_slip_data['sal_details']->designation}}
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                </table>
            <div>
            <div class="earn_deduction_class">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                    <tr>
                        <td class="bg_color_head boldclass"> 
                            Earnings
                        </td>
                        <td class="bg_color_head boldclass">
                            Amounts in Rs.
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $salary_slip_data['adition'] as $earnings)
                    <tr>
                        <td>
                            {{$earnings->sal_extra_display_name}}
                        </td>
                        <td>
                            {{$earnings->salpay_extra_amt}}               
                        </td>
                    </tr>
                    @endforeach
            
                    <tr>
                        <td class="boldclass" style="font-weight:bold;">
                            Gross Earnings
                        </td>
                        <td class="boldclass" style="font-weight:bold;">
                            {{$total_addition}}
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="earn_deduction_class">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                            <tr>
                                <td class="bg_color_head boldclass">
                                    Deductions
                                </td>
                                <td class="bg_color_head boldclass">
                                    Amounts in Rs.
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach( $salary_slip_data['deduction'] as $earnings)
                                <tr>
                                    <td>
                                        {{$earnings->sal_extra_display_name}}
                                    </td>
                                    <td>
                                        {{$earnings->salpay_extra_amt}}               
                                    </td>
                                </tr>
                                @endforeach
                            <tr>
                                <td class="boldclass" style="font-weight:bold;">
                                    Gross Deduction
                                </td>
                                <td class="boldclass" style="font-weight:bold;">
                                    {{$total_deduction}} 
                                </td>
                            </tr>
                        </tbody>
                        </table>
            </div>
            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                    <!-- <tr>
                        <td>
                            Gross Earnings
                        </td>
                        <td>
                            {{$total_addition}}
                        </td>
                        <td>
                            Gross Deduction
                        </td>
                        <td>
                            {{$total_deduction}} 
                        </td>
                    </tr> -->
                    <tr>
                        <td colspan="2" class="boldclass" style="width:52px;">
                            Net Pay
                        </td>
                        <td colspan="2" class="boldclass">
                            {{$net_pay}}  
                        </td>
                    </tr>
                </thead>
            </table>
            </div>
        </div>	
    <div class="form-group">
            <div class="col-md-4">
            </div>
            <div class="col-md-4"> 
                <!-- <input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel_sal"> -->
                <input type="button" value="Print" class="btn btn-info btn-sm print" id="print_sal">				
                <input type="button" value="Back" class="btn btn-info btn-sm baack" id="baack">									   					   
            </div>
        </div>
											
</div>
<script src="js/jQuery.print.js"></script>
<script>

$(function() {
    $("#print_sal").click(function() {
        console.log("to_print");
        var divContents = $("#toprint_sal").html();
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        //$("#toprint").print();
        printWindow.print(); 
    });
});


</script>
<script>
    $('#excel_sal').click(function(e){
	    $('#excel_export_sal').tableExport({type:'excel',escape:'false'});
	});		
</script>
<script>
$('#baack').click(function(){
    $('#salary_list').show();
    $('#sal_slip_show').hide();
});
</script>