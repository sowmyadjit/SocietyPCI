<div class="col-md-12">
	<script src="js/FileSaver.js"/>			
	<script src="js/tableExport.js"/>
	<!--<a href="salcreate" class="btn btn-default salcrt">Salary</a>-->
    <h3 style="background-color:green;color:white; ">Salary Slip</h3>
    <h5 style="text-align: center;color: black;font-weight: bold;">Salary Slip for Month 2017</h5>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export">
    <tr>
        <td>
            Employee Name:
        </td>
        <td>
            ABC
        </td>
        <td>
            Employee Name:
        </td>
        <td>
            ABC
        </td>
    </tr>
    <tr>
        <td>
            Date of Joining:
        </td>
        <td>
            ABC
        </td>
        <td>
            Employee Name:
        </td>
        <td>
            ABC
        </td>
    </tr>
    <tr>
        <td>
            Basic Pay:
        </td>
        <td>
            ABC
        </td>
        <td>
            Employee Name:
        </td>
        <td>
            ABC
        </td>
    </tr>
    <tr>
        <td>
            Date:
        </td>
        <td>
            ABC
        </td>
        <td>
            Employee Name:
        </td>
        <td>
            ABC
        </td>
    </tr>
    <tr>
        <td>
            Net Pay:
        </td>
        <td>
            ABC
        </td>
        <td>
            Employee Name:
        </td>
        <td>
            ABC
        </td>
    </tr>
    </table>
    <div class="form-group">
            <div class="col-md-4">
            </div>
            <div class="col-md-4"> 
                <input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel_sal">
                <input type="button" value="Print" class="btn btn-info btn-sm print" id="print_sal">				
                <input type="button" value="Back" class="btn btn-info btn-sm baack" id="baack">									   					   
            </div>
        </div>
	<div id="toprint_sal" style="position:fixed;opacity:0;">
            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export_sal">
            <tr>
                <td>
                    Employee Name:
                </td>
                <td>
                    ABC
                </td>
            </tr>
            <tr>
                <td>
                    Date of Joining:
                </td>
                <td>
                    ABC
                </td>
            </tr>
            <tr>
                <td>
                    Basic Pay:
                </td>
                <td>
                    ABC
                </td>
            </tr>
            <tr>
                <td>
                    Date:
                </td>
                <td>
                    ABC
                </td>
            </tr>
            <tr>
                <td>
                    Net Pay:
                </td>
                <td>
                    ABC
                </td>
            </tr>
        </table>
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