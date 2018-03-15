<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-md-12">
	<div class="row">
		
			<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> MEMBER DETAILS</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				{!! Form::open(['url' => 'updatemem','class' => 'form-horizontal','id' => 'form_memberup','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
						<?php // print_r($ud);
							$edit=$md['type'];?>
						
						@foreach ($md['member'] as $member)
			
				<div class="col-md-6"> <!-- MEMBER SECTION-->
					<div class="row">
			
						<div class="box-header well col-md-12">
							<h2>MEMBER DETAILS</h2>
						</div>
						
						<div class="alert alert-success">	
						<!--Member Detail-->
								<div class="hidden"><input type="text" class="form-control" id="memid" name="memid" value="{{ $member->Memid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="uid" name="uid" value="{{ $member->Uid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="bid" name="bid" value="{{ $member->Bid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="aid" name="aid" value="{{ $member->Aid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="nid" name="nid" value="{{ $member->Nid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="dcid" name="dcid" value="{{ $member->DocProvid }}"></div>
								
							<div class="form-group" >
								<label class="control-label col-sm-4">First Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mfname" name="mfname" value="{{ $member->FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group" >
								<label class="control-label col-sm-4">ಮೊದಲ ಹೆಸರು:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaMFname" name="KaMFname" value="{{ $member->Kan_FirstName }}" placeholder="ಮೊದಲ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
			
							<div class="form-group">
									<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="mmname" name="mmname" value="{{ $member->MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">ಮಧ್ಯದ ಹೆಸರು:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="KaMMname" name="KaMMname" value="{{ $member->Kan_MiddleName }}" placeholder="ಮಧ್ಯದ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-sm-4">Last Name:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="mlname" name="mlname" value="{{ $member->LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ಕೊನೆಯ ಹೆಸರು:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="KaMLname" name="KaMLname" value="{{ $member->Kan_LastName }}" placeholder="ಕೊನೆಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-4">Father Name:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="fthrname" name="fthrname" value="{{ $member->FatherName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ತಂದೆಯ ಹೆಸರು:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="KaMFather" name="KaMFather" value="{{ $member->Kan_FatherName }}" placeholder="ತಂದೆಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Spouse Name:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="spousename" name="spousename" value="{{ $member->SpouseName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ಪತಿ ಯಾ ಪತ್ನಿಯ ಹೆಸರು:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="KaMSpouse" name="KaMSpouse" value="{{ $member->Kan_SpouseName }}" placeholder="ಪತಿ ಯಾ ಪತ್ನಿಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Branch Name:</label>
									<div  class="col-sm-8">
										<input style="border-color:red" class="typeahead form-control"  type="text" name="branch" id="bid1" value="{{ $member->BName }}" <?php if($edit=='edit'){}else {echo 'disabled';} ?>>  
									</div>
							</div>
							
							
							<div class="col-md-8 hidden">
								<input type="text" id="branchid" name="branchid" value="{{ $member->Bid }}">
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Login Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="lgname" name="lgname" value="{{ $member->LoginName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
	
							<!--<div class="form-group">
								<label class="control-label col-sm-4">Password:</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="pwd" name="pwd" placeholder="PASSWORD">
								</div>
							</div>
	
							<div class="form-group">
								<label class="control-label col-sm-4">Passcode:</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="pscd" name="pscd" placeholder="PASSCODE">
								</div>
							</div>-->
						
							<div class="form-group">
								<label class="control-label col-sm-4">Join Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="mdte" name="mdte" value="{{ $member->CreatedDate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
							</div>
							
						
							<div class="form-group">
									<label class="control-label col-sm-4">Member Fees:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="mfee" name="mfee" value="{{ $member->Member_Fee }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="memail" name="memail" value="{{ $member->Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Gender:</label>
										<div class="col-md-8">
											 <select class="form-control" id="mgender" name="mgender" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $member->Gender }}" selected>{{ $member->Gender }} </option>
												 <option value="MALE">Male</option>
												 <option value="FEMALE">Female</option>
											 </select>
										</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Marital Status:</label>
								<div class="col-md-8">
									 <select class="form-control" id="mmrstate" name="mmrstate" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
										<option value="{{ $member->MaritalStatus }}" selected>{{ $member->MaritalStatus }}</option>
										<option value="MARRIED">MARRIED</option>
										<option value="UNMARRIED">UNMARRIED</option>
									 </select>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="mage" name="mage" value="{{ $member->Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Birth Date:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mbdate" name="mbdate" value="{{ $member->Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							

							<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="moccup" name="moccup" value="{{ $member->Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mmno" name="mmno" value="{{ $member->MobileNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mpno" name="mpno" value="{{ $member->PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="madd" name="madd" value="{{ $member->Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">ವಿಳಾಸ:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaMAdd" name="KaMAdd" value="{{ $member->Kan_Address }}" placeholder="ವಿಳಾಸ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mcity" name="mcity" value="{{ $member->City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">ಪಟ್ಟಣ:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaMCity" name="KaMCity" value="{{ $member->Kan_City }}" placeholder="ಪಟ್ಟಣ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mdist" name="mdist" value="{{ $member->District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">ಜಿಲ್ಲೆ:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaMDistrict" name="KaMDistrict" value="{{ $member->Kan_District }}" placeholder="ಜಿಲ್ಲೆ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mstate" name="mstate" value="{{ $member->State }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">ರಾಜ್ಯ:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaMState" name="KaMState" value="{{ $member->Kan_State }}" placeholder="ರಾಜ್ಯ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mpin" name="mpin" value="{{ $member->Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-4"> Pancard Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="pncrdno" name="pncrdno" value="{{ $member->PancardNum }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
	
						   
							
							
	
						</div> <!--members alert-success div ends-->
					</div>
				</div> <!-- MEMBER SECTION ENDS-->


				
				<div class="col-md-6"> <!-- MEMBER SECTION-->
					<div class="row">
			
						<div class="box-header well col-md-12">
							<h2>MEMBER DETAILS(Continued)</h2>
						</div>
						
						<div class="alert alert-success">
				
				
				
				<div class="form-group">
								<label class="control-label col-sm-4"> Adharcard Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="adcrdno" name="adcrdno" value="{{ $member->AdharCardNum }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
		
						   <div class="form-group">
								<label class="control-label col-sm-4">VoterID Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="voterid" name="voterid" value="{{ $member->VoteridNum }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
		
							<div class="form-group">
								<label class="control-label col-sm-4">Passport Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="passportnum" name="passportnum" value="{{ $member->PassportNum }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
							</div>
		
							<div class="form-group">
								<label class="control-label col-sm-4">Remarks:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="remark" name="remark" value="{{ $member->Remarks }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>/>
								</div>
							</div>
				
				
				
				</div> <!--members continued alert-success div ends-->
					</div>
				</div> <!-- MEMBER Continued SECTION ENDS-->
				
				
				

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
								<input type="text" class="form-control" id="nfname" name="nfname" value="{{ $member->Nom_FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group" >
							<label class="control-label col-sm-4">ಮೊದಲ ಹೆಸರು:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="KaNFname" name="KaNFname" value="{{ $member->Kan_Nom_FirstName }}" placeholder="ಮೊದಲ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nmname" name="nmname" value="{{ $member->Nom_MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">ಮಧ್ಯದ ಹೆಸರು:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="KaNMname" name="KaNMname" value="{{ $member->Kan_Nom_MiddleName }}" placeholder="ಮಧ್ಯದ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-4">Last Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nlname" name="nlname" value="{{ $member->Nom_LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">ಕೊನೆಯ ಹೆಸರು:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="KaNLname" name="KaNLname" value="{{ $member->Kan_Nom_LastName }}" placeholder="ಕೊನೆಯ ಹೆಸರು" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Relationship:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="rltn" name="rltn" value="{{ $member->Relationship }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">ಸಂಬಂಧ:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="KaRelation" name="KaRelation" value="{{ $member->Kan_Relationship }}" placeholder="ಸಂಬಂಧ" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">EMail ID:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nemail" name="nemail" value="{{ $member->Nom_Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Gender:</label>
							<div class="col-md-8">
								 <select class="form-control" id="ngender" name="ngender" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $member->Nom_Gender }}" selected>{{ $member->Nom_Gender }} </option>
												<option value="MALE">MALE</option>
												<option value="FEMALE">FEMALE</option>
								 </select>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Marital Status:</label>
							<div class="col-md-8">
								 <select class="form-control" id="nmstate" name="nmstate" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $member->Nom_Marital_Status }}" selected>{{ $member->Nom_Marital_Status }}</option>
												<option value="MARRIED">MARRIED</option>
												<option value="UNMARRIED">UNMARRIED</option>
								 </select>
							</div>
						</div>
					 
						<div class="form-group">
								<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nage" name="nage" value="{{ $member->Nom_Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Birth Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nbdate" name="nbdate" value="{{ $member->Nom_Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Occupation:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="noccup" name="noccup" value="{{ $member->Nom_Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Mobile Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nmno" name="nmno" value="{{ $member->Nom_MobNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Phone Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npno" name="npno" value="{{ $member->Nom_PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
					
						 <div class="form-group">
								<label class="control-label col-sm-4">Address:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nadd" name="nadd" value="{{ $member->Nom_Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">City:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ncity" name="ncity" value="{{ $member->Nom_City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">District:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ndist" name="ndist" value="{{ $member->Nom_District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">State:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nstate" name="nstate" value="{{ $member->Nom_State }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Pincode:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npin" name="npin" value="{{ $member->Nom_Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
					
						
					
						
						

					</div>   <!-- DIV alert-danger ends here-->
					
					
						<!--<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="Purchase Share" class="btn btn-info btn-sm nxtbtn"/>
								</div>
							 </div>
						</center>-->
	  
	  
	  
					

@endforeach

					</div>				
				</div>
					
					
					<!--
					
					
					
					
					<div class="form-group">
								<label class="control-label col-sm-4">ID Proof:</label>
								<div class="col-md-8">
								</br></br></br>
								<img src="{{ $member->ID_Proof }}" width="30%" height="30%">
									<input type="file" id="memidp" name="memidp" <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Address Proof:</label>
								<div class="col-md-8">
								</br></br></br>
								<img src="{{ $member->Address_Proof }}" width="30%" height="30%">
									<input type="file" id="memadrp" name="memadrp" <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Photo:</label>
								<div class="col-md-8">
								</br></br>
								<img src="{{ $member->Photo }}" width="30%" height="30%">
									<input type="file" id="memphoto" name="memphoto" <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Signature:</label>
								<div class="col-md-8">
								</br></br>
								<img src="{{ $member->Signature }}" width="30%" height="30%">
									<input type="file" id="memsign" name="memsign" <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
								</div>
							</div>
					
					
					
					
					
					
					-->
					
					
					
					
					
					
					
					</br>
				
				<div class="alert alert-success col-md-12">
					<div class="row">
					
					
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
						
									<div class="form-group">
										<label class="control-label col-sm-4">ID Proof:</label>
										<div class="col-md-8">
										</br></br></br>
										<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">
										<input type="file" id="memidp" name="memidp" accept="image/*" onchange="loadFile1(event)">
										</div>
										
										</div>
									</div>
									
								</div>
								
								<div class="col-md-8">
								
								<img src="{{ $member->ID_Proof }}" id="idproof" height="150" width="250"/></br>
								
								</div>
								
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Address Proof:</label>
									<div class="col-md-8">
									</br></br></br>
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">
									<input type="file" id="memadrp" name="memadrp" accept="image/*" onchange="loadFile2(event)" >
									</div>
									
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $member->Address_Proof }}" id="addproof" height="150" width="250"/></br>
									</div>
								
							</div>
						</div>
						
						</div>
						
						
						</br>
						
						
						<div class="row">
							
							<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Photo:</label>
									<div class="col-md-8">
									</br></br>
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">	<input type="file" id="memphoto" name="memphoto" accept="image/*" onchange="loadFile3(event)" ></div>
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $member->Photo }}" id="emppic" height="150" width="130"/></br>
									</div>
								
							</div>
							</div>
							
							
							<div class="col-md-6">
							<div class="row table-row">
									<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Signature:</label>
									<div class="col-md-8">
									</br></br>
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>"><input type="file" id="memsign" name="memsign" accept="image/*" onchange="loadFile4(event)"></div>
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $member->Signature }}" id="sign" height="150" width="250"/></br>
									</div>
								
							</div>
							</div>
							
						</div>
					
					</div> <!--alert-success ends-->
					
					
					
					
					
					
					
					
					
        
						<center>
							<div class="form-group">
								<div class="col-sm-12">
								 
								 
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
  
<script>
var branch='<?php echo $member->Bid;?>';
m=$('#branchid').val(branch);

$('#bid1').change(function(){
	var br=$('#bid1').data('value');
	//alert(br);
	$.ajax({
		success:function()
		{
			$('#branchid').val(br);
			//alert(m1);
		}
	});
});

$('input.typeahead').typeahead({
      ajax: '/GetBranches'
});


/*function calculate()
{
	//alert("Hello");
	shamt=$('#shamt').val();
	shpr=$('#shprice').val();
	nosh=$('#totshare').val();
	tot=shamt*nosh;
	tot1=shpr*nosh;
	total=tot+tot1;
	$('#totshrval').val(tot);
	$('#totamt').val(total);
}

$('#shclass').change(function(e){
	//alert("hii");
	e.preventDefault();
	$.ajax({
		url:'retrieveinfo',
		type:'post',
		data:$('#shclass'),
		success:function(data){
			$('#shamt').val(data['face']);
			$('#shprice').val(data['sharep']);
		}
	});
});

function maxvl()
{
	//alert("max");
	totshr=$('#totshare').val();
	$.ajax({
		url:'retrievemax',
		type:'get',
		success:function(data){
			countval=data;
			max=(parseInt(totshr)+parseInt(countval));
			//alert("max:"+max);
			min=(parseInt(countval)+1);
			//alert("min:"+min);
			sid=min+"-"+max;
			$("#memshr").val(sid);
			$("#count").val(max);
			//alert(sid);
		}
	});
}*/


//$('.purdetail').hide();

/*$('.nxtbtn').click(function(){
	$('.purdetail').show();
});*/

//Cancel Button
 $('.cnclbtn').click(function(e)
{
	var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.memclassid').click();
                return true;
            }
            else{
                return false;
            }
});

//Close Button
$('.clsbtn').click(function(e){
		$('.memclassid').click();
	});

/*$('.sbmbtn').click( function(e) {
$("#form_memberup").validate({
rules:{
mfname:"required",

branch:"required",

mdte:{
required:true,
date:true
},
mfee:
{
required:true,
number:true
},

mgender:"required",
mmrstate:"required",

moccup:"required",
mmno:
{
required:true,
number:true,
maxlength:10,
minlength:10
},
madd:"required",
mcity:"required",
mdist:"required",
mstate:"required",
mpin:{
required:true,
number:true,
maxlength:6,
minlength:6
},

remark:"required",
nfname:"required",

ngender:"required",
nmstate:"required",

noccup:"required",
nmno:{
required:true,
number:true,
maxlength:10,
minlength:10
},
nadd:"required",
ncity:"required",
ndist:"required",
nstate:"required",
npin:{
required:true,
number:true,
maxlength:6,
minlength:6

},
shclass:"required",
shamt:{
required:true,
number:true
},
shprice:{
required:true,
number:true
},
totshare:{
required:true,
number:true
},
totshrval:{
required:true,
number:true
},
totamt:{
required:true,
number:true
},
memshr:"required",
}
});*/
/*if($("#form_memberup").valid())
{
	 a=$('ul.typeahead li.active').data('value');
		uid={{ $member->Uid }};
		aid={{ $member->Aid }};
		nid={{ $member->Nid }};
		memid={{ $member->Memid }}
	e.preventDefault();
    $.ajax({
		
        url: 'updatemember',
        type: 'post',
        data: $('#form_memberup').serialize() + '&bid=' + a + '&uid=' + uid + '&aid=' + aid + '&nid=' + nid + '&memid=' + memid,
        success: function(data) {

                   $('.memclassid').click();
                 }
    });
	}
});*/

//Typeahead for Branches

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