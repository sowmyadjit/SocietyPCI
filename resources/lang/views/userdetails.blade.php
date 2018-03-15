
<div id="content" class="col-md-12">
<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> Customer Details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
			<div class="box-content">
				{!! Form::open(['url' => 'updatecust','class' => 'form-horizontal','id' => 'form_custupdate','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
				
				<?php // print_r($ud);
						$edit=$cd['type'];?>
			
			
			
			@foreach ($cd['customer'] as $customer)
				
					<div class="col-md-6"> <!-- CUSTOMER SECTION-->
					<div class="row">
			
						<div class="box-header well col-md-12">
							<h2>CUSTOMER DETAILS</h2>
						</div>
						
						<div class="alert alert-info">	
						<!--Member Detail-->
						
						<div class="hidden"><input type="text" class="form-control" id="cid" name="cid" value="{{ $customer->Custid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="aid" name="aid" value="{{ $customer->Aid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="docid" name="docid" value="{{$customer->DocProvid}}">
								</div>
								<div class="hidden"><input type="text" class="form-control" id="uid" name="uid" value="{{$customer->Uid}}">
								</div>
								<div class="hidden"><input type="text" class="form-control" id="nid" name="nid" value="{{ $customer->Nid }}"></div>
						
						
							<div class="form-group">
								<label class="control-label col-sm-4">Customer Id:</label>
								<div class="col-md-8">
							<input type="text" class="form-control" id="cid" name="cid" value="{{ $customer->Uid }}"readonly >
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">FIRST NAME:</label>
								<div class="col-md-8">
							<input type="text" class="form-control" id="fname" name="fname" value="{{ $customer->FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ಮೊದಲ ಹೆಸರು:</label>
								<div class="col-md-8">
							<input type="text" class="form-control" id="KaFname" name="KaFname" value="{{ $customer->Kan_FirstName }}" placeholder="ಮೊದಲ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
							<label class="control-label col-sm-4">MIDDLE NAME:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="mname" name="mname" value="{{ $customer->MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
							<label class="control-label col-sm-4">ಮಧ್ಯದ ಹೆಸರು:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="KaMname" name="KaMname" value="{{ $customer->Kan_MiddleName }}" placeholder="ಮಧ್ಯದ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">LAST NAME:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="lname" name="lname" value="{{ $customer->LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ಕೊನೆಯ ಹೆಸರು:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaLname" name="KaLname" value="{{ $customer->Kan_LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">FATHER NAME:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="fthrnme" name="fthrnme" value="{{ $customer->FatherName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ತಂದೆಯ ಹೆಸರು:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaFather" name="KaFather" value="{{ $customer->Kan_FatherName }}" placeholder="ತಂದೆಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">SPOUSE NAME:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="spousenme" name="spousenme" value="{{ $customer->SpouseName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ಪತಿಯ ಯಾ ಪತ್ನಿಯ ಹೆಸರು:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaSpouse" name="KaSpouse" value="{{ $customer->Kan_SpouseName }}" placeholder="ಪತಿಯ ಯಾ ಪತ್ನಿಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
								
							<div class="form-group">
								<label class="control-label col-sm-4">BRANCH:</label>
									<div id="the-basics" class="col-sm-8">
										<input class="typeahead form-control"  type="text" value="{{ $customer->BName }}" id="custbid" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
							</div>
							
							<div class="col-sm-8 hidden">
										<input class="form-control"  type="text" id="branchid" name="branchid">
									</div>

							<!--<div class="form-group">
								<label class="control-label col-sm-4">ACCOUNT NUMBER:</label>
									<div class="col-md-8">
									<input type="text" class="form-control" id="acno" name="acno" value="{{ $customer->AccNum }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
							<label class="control-label col-sm-4">OPENING BALANCE</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="opbal" name="opbal" value="{{ $customer->OpeningBalance }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>-->
								
							<div class="form-group">
							<label class="control-label col-sm-4">EMAIL ID:</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" value="{{ $customer->Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<!--<div class="form-group">
							<label class="control-label col-sm-4">GENDER:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" name="gender" id="gender" value="{{ $customer->Gender }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>-->
							<div class="form-group">
								<label class="control-label col-sm-4">GENDER:</label>
								<div class="col-sm-8">
									<select id="gender" name="gender" class="form-control" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
										<option value="{{ $customer->Gender }}">{{ $customer->Gender }}</option>
										<option value="MALE">MALE</option>
										<option value="FEMALE">FEMALE</option>
									</select>
								</div>
							</div>

					
							<!--<div class="form-group">
							<label class="control-label col-sm-4">MARITAL STATUS:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="ms" id="ms" width="" value="{{ $customer->MaritalStatus }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>-->
							<div class="form-group">
							<label class="control-label col-sm-4">MARITAL STATUS:</label>
							<div class="col-sm-8">
								<select class="form-control" id="ms" name="ms" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
									<option value="{{ $customer->MaritalStatus }}">{{ $customer->MaritalStatus }}</option>
									<option value="MARRIED">MARRIED</option>
									<option value="UNMARRIED">UNMARRIED</option>
								</select>
							</div>
							</div>
							
							<div class="form-group">
							
								<label class="control-label col-sm-4">OCCUPATION:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="oc" name="oc" value="{{ $customer->Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
					
					
					
						
							
								
								
					
											
						
						<div class="form-group">
							
								<label class="control-label col-sm-4" >AGE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="age" name="age" value="{{ $customer->Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
							<label class="control-label col-sm-4" >BIRTH DATE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="bd" name="bd" value="{{ $customer->Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
		
							<div class="form-group">
							<label class="control-label col-sm-4">PHONE NUMBER:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">MOBILE NUMBER:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="mn" name="mn" value="{{ $customer->MobileNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
						

						<div class="form-group">
							<label class="control-label col-sm-4">ADDRESS:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="address" name="address" value="{{ $customer->Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
							<label class="control-label col-sm-4">ವಿಳಾಸ:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="KaAddress" name="KaAddress" value="{{ $customer->Kan_Address }}" placeholder="ವಿಳಾಸ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

					<div class="form-group">
							<label class="control-label col-sm-4">CITY:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="city" name="city" value="{{ $customer->City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
							<label class="control-label col-sm-4">ಪಟ್ಟಣ:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="KaCity" name="KaCity" value="{{ $customer->Kan_City }}" placeholder="ಪಟ್ಟಣ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">DISTRICT:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="dist" name="dist" value="{{ $customer->District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">ಜಿಲ್ಲೆ:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="KaDist" name="KaDist" value="{{ $customer->Kan_District }}" placeholder="ಜಿಲ್ಲೆ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
						</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">STATE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="state" name="state" value="{{ $customer->State }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
							<label class="control-label col-sm-4">ರಾಜ್ಯ:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="KaState" name="KaState" value="{{ $customer->Kan_State }}" placeholder="ರಾಜ್ಯ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
							<label class="control-label col-sm-4">PINCODE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="pc" name="pc" value="{{ $customer->Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							
							
						</div> <!--CUSTOMER alert-INFO div ends-->
					</div>
				</div> <!-- CUSTOMER SECTION ENDS-->	
							
							
							
							
						
							
							
							
							
							
							
							
							
							
							
				<div class="col-md-6">
					<div class="row">

						<div class="box-header well col-md-12">
							<h2>NOMINEE DETAILS</h2>
						</div>
						
						<div class="alert alert-danger">
				
						<!--Nominee Detail-->
						
						 <div class="form-group" >
							<label class="control-label col-sm-4">First Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nfname" name="nfname" value="{{ $customer->Nom_FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group" >
							<label class="control-label col-sm-4">ಮೊದಲ ಹೆಸರು:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="KaNFname" name="KaNFname" value="{{ $customer->Kan_Nom_FirstName }}" placeholder="ಮೊದಲ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nmname" name="nmname" value="{{ $customer->Nom_MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">ಮಧ್ಯದ ಹೆಸರು:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaNMname" name="KaNMname" value="{{ $customer->Kan_Nom_MiddleName }}" placeholder="ಮಧ್ಯದ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-4">Last Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nlname" name="nlname" value="{{ $customer->Nom_LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">ಕೊನೆಯ ಹೆಸರು:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="KaNLname" name="KaNLname" value="{{ $customer->Kan_Nom_LastName }}" placeholder="ಕೊನೆಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Relationship:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="rltn" name="rltn" value="{{ $customer->Relationship }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">ಸಂಬಂಧ:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="KaRelation" name="KaRelation" value="{{ $customer->Kan_Relationship }}" placeholder="ಸಂಬಂಧ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">EMail ID:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nemail" name="nemail" value="{{ $customer->Nom_Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Gender:</label>
							<div class="col-md-8">
								 <select class="form-control" id="ngender" name="ngender" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $customer->Nom_Gender }}" selected>{{ $customer->Nom_Gender }} </option>
												<option value="MALE">MALE</option>
												<option value="FEMALE">FEMALE</option>
								 </select>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Marital Status:</label>
							<div class="col-md-8">
								 <select class="form-control" id="nmstate" name="nmstate" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $customer->Nom_Marital_Status }}" selected>{{ $customer->Nom_Marital_Status }}</option>
												<option value="MARRIED">MARRIED</option>
												<option value="UNMARRIED">UNMARRIED</option>
								 </select>
							</div>
						</div>
					 
						<div class="form-group">
								<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nage" name="nage" value="{{ $customer->Nom_Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Birth Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nbdate" name="nbdate" value="{{ $customer->Nom_Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Occupation:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="noccup" name="noccup" value="{{ $customer->Nom_Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Mobile Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nmno" name="nmno" value="{{ $customer->Nom_MobNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Phone Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npno" name="npno" value="{{ $customer->Nom_PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
											
						
					
						 <div class="form-group">
								<label class="control-label col-sm-4">Address:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nadd" name="nadd" value="{{ $customer->Nom_Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">City:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ncity" name="ncity" value="{{ $customer->Nom_City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">District:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ndist" name="ndist" value="{{ $customer->Nom_District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">State:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nstate" name="nstate" value="{{ $customer->Nom_State }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Pincode:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npin" name="npin" value="{{ $customer->Nom_Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
					
						
					
						
						

					</div>   <!-- DIV alert-danger ends here-->
					</div>
					</div>
							
					
					
						
						
						
						
						
						
					</br>
				
				<div class="alert alert-success col-md-12">
					<div class="row">
					
					
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
						
									<div class="form-group">
										<label class="control-label col-sm-4">ID Proof:</label>
										<div class="col-md-8">
										<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">
										<input type="file" id="custeidp" name="custeidp" accept="image/*" onchange="loadFile1(event)">
										</div>
										
										</div>
									</div>
									
								</div>
								
								<div class="col-md-8">
								
								<img src="{{ $customer->ID_Proof }}" id="idproof" height="150" width="250"/></br>
								
								</div>
								
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Address Proof:</label>
									<div class="col-md-8">
									
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">
									<input type="file" id="custeadrpf" name="custeadrpf" accept="image/*" onchange="loadFile2(event)" >
									</div>
									
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{  $customer->Address_Proof }}" id="addproof" height="150" width="250"/></br>
									</div>
								
							</div>
						</div>
						
						</div>
						
						
						
						
						
						
						@endforeach
						
						
						
						
						
						
						
						
						</br>
						
						
						<div class="row">
							
							<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Photo:</label>
									<div class="col-md-8">
									
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">	<input type="file" id="custephoto" name="custephoto" accept="image/*" onchange="loadFile3(event)" ></div>
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $customer->photo }}" id="emppic" height="150" width="120"/></br>
									</div>
								
							</div>
							</div>
							
							
							<div class="col-md-6">
							<div class="row table-row">
									<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Signature:</label>
									<div class="col-md-8">
									
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>"><input type="file" id="custesign" name="custesign" accept="image/*" onchange="loadFile4(event)"></div>
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $customer->Signature }}" id="sign" height="150" width="250"/></br>
									</div>
								
							</div>
							</div>
							
						</div>
					
					</div> <!--alert-success ends-->	
						
					
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<!--<input type="button" value="Upload" class="btn btn-info btn-sm sbmbtn"/>-->
								<input type="<?php if($edit=='edit'){echo 'submit';} else {echo 'hidden';} ?>" value="UPDATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="<?php if($edit=='edit'){echo 'hidden';} else {echo 'button';} ?>" value="CLOSE" class="btn btn-danger btn-sm clsbtn"/>
							</div>
						</div>
						</center>
						{!! Form::close() !!}
						</div>
						</div>
						
			
				</div>
			</div>
</div>


<script src="js/bootstrap-typeahead.js"/>
<script>

//To get BranchID
var branch='<?php echo $customer->Bid;?>';
m=$('#branchid').val(branch);


$('#custbid').change(function(){
	var br=$('#custbid').data('value');
	//alert(br);
	$.ajax({
		success:function()
		{
			$('#branchid').val(br);
			//alert(m1);
		}
	});
});
//Cancel Button

$('.cnclbtn').click(function(e){
		
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.custclassid').click();
                return true;
            }
            else{
                  return false;
            }
	});
	
//Close Button
	$('.clsbtn').click(function(e){
		
		
            $('.custclassid').click();
               
	});
	
/*	$('.sbmbtn').click( function(e) {
		
		branchid=$('ul.typeahead li.active').data('value');
		a=$('ul.typeahead li.active').data('value');
		branchid=a;
		//alert(a);
		e.preventDefault();
		cid={{ $customer->Custid }};
		aid={{ $customer->Aid }};
		dcid={{$customer->DocProvid}};
		//alert(addid);
		
		
		$.ajax({
				url: 'updatecust',
				type: 'post',
				data: $('#form_custupdate').serialize() + '&branchid=' + a + '&cid=' + cid + '&aid=' + aid+'&docid='+dcid,
				success: function(data) {
						 //alert('success');
						 $('.custclassid').click();
                }
		}); 
	});*/

	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('input.typeahead').typeahead({
		ajax: '/GetBranches'
	});
	
	
</script>

<style>
input[type=file]{ 
        color:transparent;
    }
</style>


<script>

	var loadFile1 = function(event) {
		var idproof = document.getElementById('idproof');
		idproof.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile2 = function(event) {
		var addproof = document.getElementById('addproof');
		addproof.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile3 = function(event) {
		var emppic = document.getElementById('emppic');
		emppic.src = URL.createObjectURL(event.target.files[0]);
	};
	
	 var loadFile4 = function(event) {
		 var sign = document.getElementById('sign');
		 sign.src = URL.createObjectURL(event.target.files[0]);
	 };


</script>