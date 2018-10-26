<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\SettingsModel;
	use App\Http\Model\AllChargesModel;
	
	
	class CustomerModel extends Model
	{
		//
		protected $table = 'customer';

		public function __construct()
		{
			$this->rv_no = new ReceiptVoucherController;
			$this->settings = new SettingsModel;
			$this->all_ch = new AllChargesModel;
		}
		
		public function insert($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$udetail= DB::table('user')->select('Uid','FirstName','MiddleName','LastName','Bid')
			->where('Uid','=',$UID)
		    ->first();
			$dte=date('Y-m-d');
			$b=$udetail->Bid;
			
			$CustBid=$id['branchid'];
			
			$cbc= DB::table('branch')->select('BCode')
			->where('Bid',$CustBid)
			->first();
			
			$CustBCode=$cbc->BCode;
			
			$CustType=$id['custtyp'];
			$CreatedDate=date('Y-m-d');
			$count=1;
			$ReceiptNum;
			
			$RecYear=date('my');
			$RecNo = DB::table('customer')
			->where('custtyp','=',"CLASS D")
			->where('Bid','=',$CustBid)
			->count();
			
			if($RecNo==0)
			{
				
				$ReceiptNum=$CustBCode.$RecYear."CF-".$count;
				
			}
			else
			{
				$ReceiptNum=$CustBCode.$RecYear."CF-".($RecNo+1);
			}
			
			
			$docid = DB::table('docprovided')->insertGetId(['Photo'=>$id['custphoto'],'Signature'=>$id['custsign'],'ID_Proof'=>$id['custidp'],'Address_Proof'=>$id['custadprf']]);
			
			$Aid = DB::table('address')->insertGetId(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'MaritalStatus' => $id['ms'],'Occupation' => $id['oc'],'Age' => $id['age'],'Birthdate' => $id['bd'],'Email' => $id['email'],'Address' => $id['address'],'City' => $id['city'],'District' => $id['dist'],'State' => $id['state'],'MobileNo' => $id['mn'],'Pincode' => $id['pc'],'PhoneNo'=>$id['phone']]); 
			
			$uid= DB::table('user')->insertGetId(['LoginName'=>$id['lon'],'Password'=>$id['pass'],'PassCode'=>$id['passcode'],'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'Email'=>$id['email'],'LastName' => $id['lname'],'Aid'=>$Aid,'Bid'=>$id['branchid'],'Member_No'=>$id['mebn']]);
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$uid,'Relationship'=>$id['reltn']]);
			
			
			if($CustType=="CLASS D")
			{
				$cid = DB::table('customer')->insertGetId(['Aid'=>$Aid,'Nid'=>$Nid,'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Bid'=>$id['branchid'],'Uid'=>$uid,'DocProvid'=>$docid,'FatherName'=>$id['fthrname'],'SpouseName'=>$id['spousename'],'Customer_Fee'=>$id['custfee'],'custtyp'=>$id['custtyp'],'Customer_ReceiptNum'=>$r,'Created_on'=>$dte,'LedgerHeadId'=>"32",'SubLedgerId'=>"35"]);
				
				/***********/
				$fn_data["rv_payment_mode"] = "CASH";
				$fn_data["rv_transaction_id"] = $cid;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::CUSTOMER_FEE;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

				/******************** ALL CHARGES ******************/
				unset($fd);
				$fd["date"] = $dte;
				$fd["bid"] = $id['branchid'];
				$fd["transaction_type"] = 2; // DEBIT
				$fd["payment_mode"] = "CASH";
				$fd["amount"] = $id['custfee'];
				$fd["particulars"] = "MEMBER FEES";
				$fd["paid"] = 1;
				$fd["tran_table"] = 6; // customer
				$fd["tran_id"] = $cid;
				$fd["created_by"] = $UID;
				$fd["SubLedgerId"] = 86; // MEMBER FEES
				$fd["deleted"] = 0;
				$this->all_ch->clear_row_data();
				$this->all_ch->set_row_data($fd);
				$this->all_ch->insert_row();
				/******************** ALL CHARGES ******************/
				
			}
			else if($CustType=="CUSTOMER")
			{
				$cid = DB::table('customer')->insertGetId(['Aid'=>$Aid,'Nid'=>$Nid,'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Bid'=>$id['branchid'],'Uid'=>$uid,'DocProvid'=>$docid,'FatherName'=>$id['fthrname'],'SpouseName'=>$id['spousename'],'Customer_Fee'=>"0",'custtyp'=>$id['custtyp'],'Customer_ReceiptNum'=>"0",'Created_on'=>$dte]);
			}
			
			
		    
			
			$incash=DB::table('cash')
			->select('InHandCash')
			->where('BID','=',$b)
			->first();
			
			$fee=$id['custfee'];
			$cash=$incash->InHandCash;
			$tot=$cash+$fee;
			
			$id=DB::table('cash')->where('BID',$b)
			->update(['InHandCash'=>$tot]);
			
			return $id;
		}
		
		
		public function InsertMinorCustomer($id)
		{
			$docid = DB::table('docprovided')->insertGetId(['Photo'=>$id['custphoto'],'ID_Proof'=>$id['custidp']]);
			
			$Aid = DB::table('address')->insertGetId(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'Age' => $id['age'],'Birthdate' => $id['bd'],'Address' => $id['address'],'City' => $id['city'],'District' => $id['dist'],'State' => $id['state'],'MobileNo' => $id['mn'],'Pincode' => $id['pc']]); 
			
			$uid= DB::table('user')->insertGetId(['LoginName'=>$id['lon'],'Password'=>$id['pass'],'PassCode'=>$id['passcode'],'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Aid'=>$Aid,'Bid'=>$id['branchid'],'UserType'=>"MINOR"]);
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$uid,'Relationship'=>$id['reltn']]);
			
			$id = DB::table('customer')->insertGetId(['Aid'=>$Aid,'Nid'=>$Nid,'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Bid'=>$id['branchid'],'Uid'=>$uid,'DocProvid'=>$docid,'FatherName'=>$id['fthrname'],'CustomerType'=>"MINOR"]);
			return $id;
		}
		
		
		
		
		public function updatecustomer($id)
		{
			
			DB::table('address')->where('Aid',$id['aid'])
			->update(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'MaritalStatus' => $id['ms'],'Occupation' => $id['oc'],'Age' => $id['age'],'Birthdate' => $id['bd'],'Email' => $id['email'],'Address' => $id['address'],'City' => $id['city'],'District' => $id['dist'],'State' => $id['state'],'Kan_Address' => $id['KaAddress'],'Kan_City' => $id['KaCity'],'Kan_District' => $id['KaDist'],'Kan_State' => $id['KaState'],'MobileNo' => $id['mn'],'Pincode' => $id['pc'],'PhoneNo'=>$id['phone']]);
			
			/*DB::table('docprovided')->where('DocProvid',$id['docid'])
			->update(['ID_Proof'=>$id['custeidp'],'Address_Proof'=>$id['custeadrpf'],'Photo'=>$id['custephoto'],'Signature'=>$id['custesign']]);*/
			
			DB::table('user')->where('Uid',$id['uid'])
			->update(['FirstName'=> $id['fname'],'Kan_FirstName'=> $id['KaFname'],'MiddleName' => $id['mname'],'Kan_MiddleName' => $id['KaMname'],'Email'=>$id['email'],'LastName' => $id['lname'],'Kan_LastName' => $id['KaLname'],'Aid'=>$id['aid'],'Bid'=>$id['branchid'],'Member_No'=>$id['Member_No']]);
			
			DB::table('nominee')->where('Nid',$id['nid'])
			->update(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Kan_Nom_FirstName'=>$id['KaNFname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Kan_Nom_LastName'=>$id['KaNLname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Kan_Nom_MiddleName'=>$id['KaNMname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$id['uid'],'Relationship'=>$id['rltn'],'Kan_Relationship'=>$id['KaRelation']]);
			
			
			$id = DB::table('customer')->where('Uid',$id['uid'])//->where('Custid',$id['cid'])
			->update(['Aid'=>$id['aid'],'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Bid'=>$id['branchid'],'FatherName'=>$id['fthrnme'],'SpouseName'=>$id['spousenme'],'Kan_FatherName'=>$id['KaFather'],'Kan_SpouseName'=>$id['KaSpouse'],'Customer_Fee'=>$id['Customer_Fee']]);
			return $id;
		}
		
		public function GetData($data)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$id = DB::table('customer')->select('Custid','customer.FirstName','customer.MiddleName','customer.LastName','BName','AccNum','Gender','OpeningBalance','address.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo','custtyp','user.Uid','Member_No')
			->leftJoin('branch', 'branch.Bid', '=' , 'customer.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'customer.Aid')
			->leftJoin('user', 'user.Uid', '=' , 'customer.Uid');
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$id = $id->where('customer.Bid','=',$BID);
			}
			if(!empty($data["customer_id"])) {
				$id = $id->where("Custid",$data["customer_id"]);
			}
			$id = $id->where("customer.AuthStatus","AUTHORISED")
				->orderBy('Custid','desc')
				// ->paginate(10);
				->get();
			
			return $id;
		}
		
		public function GetSearchData($id)//M 19-4-16 For CutomerSearch.blade, searched customer data
		{
			$id = DB::table('customer')->select('Custid','customer.FirstName','customer.MiddleName','customer.LastName','BName','AccNum','Gender','OpeningBalance','Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo','custtyp')
			->leftJoin('branch', 'branch.Bid', '=' , 'customer.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'customer.Aid')
			->where('Custid','=',$id)
			->get();
			return $id;
		}
		
		public function GetCustomer($id)
		{
			return DB::table('customer')->select('Custid','customer.Nid','customer.Aid','user.FirstName','user.Kan_FirstName','user.MiddleName','FatherName','user.LastName','user.Kan_MiddleName','Kan_FatherName','user.Kan_LastName','BName','AccNum','Gender','OpeningBalance','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','Kan_Address','Kan_City','Kan_District','Kan_State','MobileNo','Pincode','PhoneNo','ID_Proof','Address_Proof','photo','Signature','customer.DocProvid','customer.Bid','customer.Uid','SpouseName','Kan_SpouseName','Nom_Address','Nom_Age','Nom_Birthdate','Nom_City','Nom_District','Nom_Email','Nom_FirstName','Nom_MiddleName','Nom_LastName','Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','Kan_Relationship','Nom_Gender','Nom_Marital_Status','Nom_MobNo','Nom_Occupation','Nom_PhoneNo','Nom_Pincode','Nom_State','Customer_ReceiptNum','custtyp','Customer_Fee','customer.Created_on','user.Member_No','customer.Customer_Fee')
			->leftJoin('branch', 'branch.Bid', '=' , 'customer.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'customer.Aid')
			->leftJoin('user', 'user.Uid', '=' , 'customer.Uid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'customer.Nid')
			->leftJoin('docprovided', 'docprovided.DocProvid', '=' , 'customer.DocProvid')
			->where('Custid',$id)
			->get();
		}
		
		public function GetCustomer1($id)
		{
			return DB::table('customer')->select('Custid','ID_Proof','Address_Proof','Photo','Signature','customer.DocProvid','customer.Bid','Uid')
			->leftJoin('docprovided', 'docprovided.DocProvid', '=' , 'customer.DocProvid')
			->where('Custid',$id)
			->first();
		}
		
		public function maxid()
		{
			$id=DB::table('user')
			->max('Uid');
			return $id;
		}
		
		public function GetMaxUid()
		{
			$id=DB::table('user')
			->max('Uid');
			return $id;
		}
		
		public function GetMinorUser($q)
		
		{
			return DB::table('user')
			
			->select(DB::raw('user.Uid as id, user.FirstName name'))
			->join('customer','customer.Uid','=','user.Uid')
			->where('user.AuthStatus','=',"AUTHORISED")
			->where('customer.CustomerType','=','MINOR')
			->get();
		}
		
		public function SearchCustomer($q)//M 19-4-16 For Cutomer.blade to search customer
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;

			$ret_data =  DB::table('customer')
			->select(DB::raw('Custid as id, CONCAT(`Uid`,"-",customer.`FirstName`,"-",customer.`MiddleName`,"-",customer.`LastName`," , ",`FatherName`,"(Father)","-",`Address`) as name'))
			->join('address','address.Aid','=','customer.Aid');
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("Bid",$BID);
			}
			$ret_data = $ret_data->get();
		
			return $ret_data;
			
		}
		
		public function SearchCustomer2($q)//M 19-4-16 For Cutomer.blade to search customer
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$ret_data =  DB::table('customer')
			->select(DB::raw('customer.Custid as id, CONCAT(`customer`.`Uid`,"/",`Custid`,"-",customer.`FirstName`,"-",customer.`MiddleName`,"-",customer.`LastName`," , ",`FatherName`,"(Father)","-",COALESCE(`Address`,"")) as name'))
			->leftJoin('address','address.Aid','=','customer.Aid')
			->leftJoin('user','user.Uid','=','customer.Uid');
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("customer.Bid",$BID);
			}
			$ret_data = $ret_data//->where("customer.Uid","like","%{$q}%")
				->get();
		
			return $ret_data;
			
		}
		
		public function SearchCustomer_d_class($q)//M 19-4-16 For Cutomer.blade to search customer
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$ret_data =  DB::table('customer')
			->select(DB::raw('customer.Custid as id, CONCAT(`customer`.`Uid`,"/",`Custid`,"-",customer.`FirstName`,"-",customer.`MiddleName`,"-",customer.`LastName`," , ",`FatherName`,"(Father)","-",COALESCE(`Address`,"")) as name'))
			->leftJoin('address','address.Aid','=','customer.Aid')
			->leftJoin('user','user.Uid','=','customer.Uid')
			->where('custtyp','=',"CLASS D");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("customer.Bid",$BID);
			}
			$ret_data = $ret_data//->where("customer.Uid","like","%{$q}%")
				->get();
		
			return $ret_data;
			
		}

		public function SearchCustomer_usertable($q)//M 19-4-16 For Cutomer.blade to search customer
		{
			
			return DB::table('user')
			->select(DB::raw('Uid as id, CONCAT(`Uid`,"-",user.`FirstName`,"-",user.`MiddleName`,"-",user.`LastName`,"-",`Address`) as name'))
			->join('address','address.Aid','=','user.Aid')
			->get();
		
			
		}
		public function GetSearchData1($data)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$id = DB::table('customer')->select('Custid','customer.FirstName','customer.MiddleName','customer.LastName','BName','AccNum','Gender','OpeningBalance','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo','custtyp','Member_No','Customer_Fee','user.Uid')
			->leftJoin('branch', 'branch.Bid', '=' , 'customer.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'customer.Aid')
			->leftJoin('user', 'user.Uid', '=' , 'customer.Uid')
			->where('custtyp','=',"CLASS D")
			->where('user.Bid','=',$BID)
			->where('customer.AuthStatus','AUTHORISED');
			if(!empty($data["customer_id"])) {
				$id = $id->where("Custid",$data["customer_id"]);
			}
			//->orderBy('Member_No','desc')
			$id = $id->orderBy('Custid','desc')
			->get();
			return $id;
		}
		public function userdetails($id)
		{
			$id= DB::table('user')->select('Custid','customer.Nid','customer.Aid','user.FirstName','user.Kan_FirstName','user.MiddleName','FatherName','user.LastName','user.Kan_MiddleName','Kan_FatherName','user.Kan_LastName','BName','AccNum','Gender','OpeningBalance','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','Kan_Address','Kan_City','Kan_District','Kan_State','MobileNo','Pincode','PhoneNo','ID_Proof','Address_Proof','photo','Signature','customer.DocProvid','customer.Bid','customer.Uid','SpouseName','Kan_SpouseName','Nom_Address','Nom_Age','Nom_Birthdate','Nom_City','Nom_District','Nom_Email','Nom_FirstName','Nom_MiddleName','Nom_LastName','Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','Kan_Relationship','Nom_Gender','Nom_Marital_Status','Nom_MobNo','Nom_Occupation','Nom_PhoneNo','Nom_Pincode','Nom_State','Customer_ReceiptNum','custtyp','Customer_Fee','customer.Created_on','DName')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->leftJoin('customer', 'customer.Uid', '=' , 'user.Uid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'customer.Nid')
			->leftJoin('designation', 'designation.Did', '=' , 'user.Did')
			->leftJoin('docprovided', 'docprovided.DocProvid', '=' , 'customer.DocProvid')
			->where('user.Uid','=',$id)
			->get();
			
			return $id;
			
		}
	}
