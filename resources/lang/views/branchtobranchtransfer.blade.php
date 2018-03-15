
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>



<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		
		<div class="box-inner">
			
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i>  Branch TO Branch Transfer</h2>
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			
			<!--<div class="box-content">
				<div class="alert alert-info">
				<a href="#" class="btn btn-default crtds">Create Company</a>
			</div>-->
			
			
			
			
			<div class="col-md-12">
				<div class="form-group">
					<div class="row table-row alert alert-info">
						
						
						
						
						<label class="control-label inline col-md-2">BRANCH:
							<select class="form-control BranchList1"  id="BranchList1" name="BranchList1">  
								
								<?php foreach($branch as $key){
									echo "<option value='".$key->Bid."' >" .$key->BName."";
									echo "</option>";
								}?>
							</select>
						</label>
						
						
						
						
						<label class="control-label inline col-md-2">BRANCH:
							<select class="form-control BranchList2"  id="BranchList2" name="BranchList2">  
								
								<?php foreach($branch as $key){
									echo "<option value='".$key->Bid."' >" .$key->BName."";
									echo "</option>";
								}?>
							</select>
						</label>
						
						<label class="control-label inline col-md-2" >Amount :
							
							<input type="text" class="form-control" id="amt" name="amt" placeholder="Amount"/>
						</label>
						
						<div class="col-md-2">
							<a class="btn btn-default SearchBWPig pull-left">Transfer</a>
						</div>
						
					</div>
					
					
					
					</br></br>
					
				</div>
			</div>
		</div>
		
		
		
		
	</div>
	
	
	<script>
		
		
		$("ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc");
			
		});
		
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('#maincontents').load($(this).attr('href'));
		});
		
		
		$('.clickme').click(function(e){
			$('.companyclassid').click();
		}); 
		
		indexid=0;
		$('.SearchBWPig').click(function(e){
			if(indexid==0)
			{
			indexid++;
				Br1=$('#BranchList1').val();
				//alert(Br1);
				//Br1id=$('#BranchList1').data('value');
				//alert(Br1id);
				//Br2id=$('#BranchList2').data('value');
				Br2=$('#BranchList2').val();
				amt=$('#amt').val();
				
				
				e.preventDefault();
				$.ajax({
					url:'transferbranchamt',
					type:'post',
					data:'&Br1='+Br1+'&Br2='+Br2+'&amt='+amt,
					success:function(data)
					{
						$('.expenceclassid').click();
					}
				});
			}
		});
		
		
		
	</script>
	
	
