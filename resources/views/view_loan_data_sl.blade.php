
<link href="css/datepicker.css" rel='stylesheet'></link>
<script src="js/bootstrap-datepicker.js" ></script>

<div id="content" class="col-md-12">
    <div class="row">
        <div class="box col-md-12">
            <div class="bdy_ box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-usd"></i> LOAN DETAILS  </h2>
                </div>
					
			    <div class="box-content">

                    <div class="form-horizontal">
                        <div class="col-md-6"> <!-- CUSTOMER SECTION-->
                            <div class="row">
                    
                                <div class="box-header well col-md-12">
                                    <h2>CUSTOMER DETAILS</h2>
                                </div>
                                
                                <div class="alert alert-info">	
                                <!--Member Detail-->
                                
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">USER ID:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="user_id" value="{{$loan_data['user_id']}}" readonly />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">USER NAME:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="name" value="{{$loan_data['name']}}" readonly />
                                        </div>
                                    </div>
                                    
                                    
                                </div> <!--CUSTOMER alert-INFO div ends-->
                            </div>
                        </div> <!-- CUSTOMER SECTION ENDS-->	
                                
                        

                        <div class="col-md-6">
                            <div class="row">
                                <div class="box-header well col-md-12">
                                    <h2>LOAN DETAILS</h2>
                                </div>
                                <div class="alert alert-danger">
                                    <!--Loan Detail-->
                                
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN ID:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="loan_id" value="{{$loan_data['loan_id']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN NO:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="loan_no" value="{{$loan_data['loan_no']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN OLD NO:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="loan_old_no" value="{{$loan_data['loan_old_no']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN AMOUTN:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="loan_amount" value="{{$loan_data['loan_amount']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN START DATE:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="start_date" value="{{$loan_data['start_date']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN END DATE:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control datepicker" id ="end_date" data-date-format="yyyy-mm-dd" value="{{$loan_data['end_date']}}"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN CLOSED DATE:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control datepicker" id ="closed_date" data-date-format="yyyy-mm-dd" value="{{$loan_data['closed_date']}}"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LOAN EMI:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="emi" value="{{$loan_data['emi']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">RAMAINING AMOUNT:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="ramaining_amount" value="{{$loan_data['ramaining_amount']}}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4">LAST PAID DATE:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id ="last_paid_date" value="{{$loan_data['last_paid_date']}}" readonly />
                                        </div>
                                    </div>

                            
                                </div>   <!-- DIV alert-danger ends here-->
                            </div>
                        </div>
                        </br>
                    
                    
                        <center>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input value="UPDATE" id="update_btn" class="btn btn-success btn-sm"/>
                                    <input value="CANCEL" id="cancel_btn" class="btn btn-danger btn-sm"/>
                                </div>
                            </div>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('.datepicker').datepicker().on('changeDate',function(e){
        $(this).datepicker('hide');
    });
</script>

<script>
    $('#update_btn').click(function(e) {
        e.preventDefault();

        var confirmed = confirm("Are you sure?");
        if(!confirmed) {
            return;
        }

        var loan_id = $("#loan_id").val();
        var closed_date = $("#closed_date").val();
        var end_date = $("#end_date").val();

        var loan_data = {};
        loan_data.loan_id = loan_id;
        loan_data.end_date = end_date;
        loan_data.closed_date = closed_date;

        var loan_data_json = JSON.stringify(loan_data);
        console.log(loan_data_json);
        
		$.ajax({
			url:"update_loan_data",
			type:"post",
			data:"&category=SL"+"&loan_id="+loan_id +"&loan_data_json="+loan_data_json,
			success: function(data) {
                console.log("done");
                alert("SUCCESS");
			}
        });
        
    });
</script>

<script>
    $("#cancel_btn").click(function(e) {
        e.preventDefault();
        
        var confirmed = confirm("Are you sure?");
        if(!confirmed) {
            return;
        }

        // console.log("cancel");
        e.preventDefault();
        $("#back").trigger("click");
    });
</script>

