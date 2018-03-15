

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
							<a class="clickme" >PIGMI DETAIL</a>
						</li>
					</ul>
				</div>
  <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> PIGMI DETAIL</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
   <!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
  <div class="alert alert-info">

  <!--<a href="pigmedetail" class="btn btn-default crtds">Create PIGME TYPES</a>-->
   </div>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
		<th>PIGMI Type</th>
		<th>Max Interest</th>
        <th>Interest</th>
		<th>Max Commission</th>
		<th>Commission</th>
		</tr>
    </thead>
    <tbody>


       @foreach ($p as $pigmitype)
        <tr>
             <td class="hidden">{{ $pigmitype->PigmiTypeid }}</td>
             <td>{{ $pigmitype->Pigmi_Type }}</td>
			 <td>{{ $pigmitype->max_Interest}}</td>	
			 <td>{{ $pigmitype->Interest}}</td>
			 <td>{{$pigmitype->Max_Commission}}</td>
			 <td>{{$pigmitype->Commission}}</td>
        </tr>
		
		
			 
     @endforeach
	 </tbody>
	 </table>
	 </div>
	 </div>
	 </div>
	 </div>
	 </div>
	
	 
	 
	 
	 
      <script>
	  
	 

$('.crtds').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box-inner').load($(this).attr('href'));
});


	  </script>