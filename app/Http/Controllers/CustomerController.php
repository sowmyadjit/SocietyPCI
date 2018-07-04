<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\CustomerModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\OpenCloseModel;
	use Input;
	use File;
	
	
	class CustomerController extends Controller
	{
		
		public function __construct()
		{
			$this->cust_model= new CustomerModel;
			$this->customer= new CustomerModel;
			$this->Modules= new ModulesModel;
			$this->OP_model=new OpenCloseModel;
		}
		public function show_cust()
		{
			$Url="customer";
			$id['module']=$this->Modules->GetAnyMid($Url);
			
			$id['open']=$this->OP_model->openstate();
			$id['close']=$this->OP_model->openclosestate();
			$id['customer']=$this->customer->GetData();
			if(empty($id['open']))
			{
				$id['open']=0;
			}
			else
			{
				$id['open']=1;
			} 
			if(empty($id['close']))
			{
				$id['close']=0;
			}
			else
			{
				$id['close']=1;
			}
			
			
			


			return view('customer',compact('id'));
		}
		
		public function Show_CustDetails($id,$type=null)
		{
			$Url="customer";
			
			$cd['customer']=$this->customer->GetCustomer($id);
			$cd['module']=$this->Modules->GetAnyMid($Url);
			//print_r($cd);
			if($type!=null)
			$cd['type']='edit';
			else
			$cd['type']='';
			return view('customerdetails',compact('cd'));
			
		}
		
		
		
		public function CustSearchView(Request $request)//M 19-4-16
		{
			$Url="customer";
			$id=$request->input('SearchAccId');
			$c['CustData']=$this->customer->GetSearchData($id);
			$c['module']=$this->Modules->GetAnyMid($Url);
			return view('CustomerSearch',compact('c'));
		}
		
		public function CustomerReceipt($id) //M 13-4-16
		{
			$Url="customer";
			$CustRecDetail['customer']=$this->customer->GetCustomer($id);
			$CustRecDetail['module']=$this->Modules->GetAnyMid($Url);
			return view('CustomerReceipt',compact('CustRecDetail'));
			
		}
		
		public function show_createcust()
		{
			$Url="customer";
			$cc['module']=$this->Modules->GetAnyMid($Url);
			return view('createcustomer',compact('cc'));
		}
		
		
		
		public function GetUid()
		{
			$id=$this->customer->maxid();
			return $id;
		}
		
		public function ShowGetMinDetails()
		{
			$Url="AccountCreation";
			$MCustCreate['module']=$this->Modules->GetAnyMid($Url);
			return view('CreateMinorCustomer',compact('MCustCreate'));
		}
		
		public function GetMaxUid()
		{
			$id=$this->customer->GetMaxUid();
			return $id;
		}
		
		public function create_cust(Request $request)
		{
			//
			//$customer['acno']=$request->input('acno');
			//$customer['opbal']=$request->input('opbal');
			
			$customer['email']=$request->input('email');
			//$user['bid']=$request->input('bid');
			$customer['fname']=$request->input('fname');
			$customer['mname']=$request->input('mname');
			$customer['lname']=$request->input('lname');
			$customer['gender']=$request->input('gender');
			$customer['ms']=$request->input('ms');
			$customer['oc']=$request->input('oc');
			$customer['age']=$request->input('age');
			$customer['bd']=$request->input('bd');
			$customer['address']=$request->input('address');
			$customer['city']=$request->input('city');
			$customer['dist']=$request->input('dist');
			$customer['state']=$request->input('state');
			$customer['mn']=$request->input('mn');
			$customer['pc']=$request->input('pc');
			$customer['phone']=$request->input('phone');
			$customer['branchid']=$request->input('branchid');
			$customer['lon']=$request->input('lon');
			$customer['pass']=$request->input('pass');
			$customer['passcode']=$request->input('passcode');
			$customer['fthrname']=$request->input('fthrname');
			$customer['spousename']=$request->input('spousename');
			
			$customer['nfname']=$request->input('nfname');
			$customer['nmname']=$request->input('nmname');
			$customer['nlname']=$request->input('nlname');
			$customer['ngender']=$request->input('ngender');
			$customer['nage']=$request->input('nage');
			$customer['nbdate']=$request->input('nbdate');
			$customer['nemail']=$request->input('nemail');
			$customer['nmstate']=$request->input('nmstate');
			$customer['nadd']=$request->input('nadd');
			$customer['ncity']=$request->input('ncity');
			$customer['npno']=$request->input('npno');
			$customer['nmno']=$request->input('nmno');
			$customer['noccup']=$request->input('noccup');
			$customer['npin']=$request->input('npin');
			$customer['ndist']=$request->input('ndist');
			$customer['nstate']=$request->input('nstate');
			$customer['reltn']=$request->input('reltn');
			$customer['custfee']=$request->input('custfee');//Newly Added
			$customer['custtyp']=$request->input('custtyp');
			$customer['mebn']=$request->input('mebn');
			//$customer['cd']=$request->input('cd');
			
			
			$fnme=$request->input('fname');
			$mnme=$request->input('mname');
			$lnme=$request->input('lname');
			$userid=$request->input('usrid');
			
			$path = 'Upload/'.$userid."_".$fnme."_".$mnme."_".$lnme;
			
			
			if(!File::exists($path)) {
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				$fn=Input::file('custphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('custphoto')->getClientOriginalName();
					$customer['custphoto']=Input::file('custphoto')->move($destinationPath,$f);
				}
				else
				{
					$customer['custphoto']=$request->input('custphoto');
				}
				
				$fn1=Input::file('custidp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('custidp')->getClientOriginalName();
					$customer['custidp']=Input::file('custidp')->move($destinationPath,$f1);
				}
				else
				{
					$customer['custidp']=$request->input('custidp');
				}
				
				$fn2=Input::file('custadprf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('custadprf')->getClientOriginalName();
					$customer['custadprf']=Input::file('custadprf')->move($destinationPath,$f2);
				}
				else
				{
					$customer['custadprf']=$request->input('custadprf');
				}
				
				$fn3=Input::file('custsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('custsign')->getClientOriginalName();
					$customer['custsign']=Input::file('custsign')->move($destinationPath,$f3);
				}
				else
				{
					$customer['custsign']=$request->input('custsign');
				}
			}
			else
			{
				$destinationPath=$path;
				
				$fn=Input::file('custphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('custphoto')->getClientOriginalName();
					$customer['custphoto']=Input::file('custphoto')->move($destinationPath,$f);
				}
				else
				{
					$customer['custphoto']=$request->input('custphoto');
				}
				
				$fn1=Input::file('custidp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('custidp')->getClientOriginalName();
					$customer['custidp']=Input::file('custidp')->move($destinationPath,$f1);
				}
				else
				{
					$customer['custidp']=$request->input('custidp');
				}
				
				$fn2=Input::file('custadprf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('custadprf')->getClientOriginalName();
					$customer['custadprf']=Input::file('custadprf')->move($destinationPath,$f2);
				}
				else
				{
					$customer['custadprf']=$request->input('custadprf');
				}
				
				$fn3=Input::file('custsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('custsign')->getClientOriginalName();
					$customer['custsign']=Input::file('custsign')->move($destinationPath,$f3);
				}
				else
				{
					$customer['custsign']=$request->input('custsign');
				}
			}
			$id=$this->cust_model->insert($customer);
			
			return redirect('/home');
		}
		
		
		
		
		
		
		
		public function CreateMinorCust(Request $request)
		{
			
			$customer['fname']=$request->input('fname');
			$customer['mname']=$request->input('mname');
			$customer['lname']=$request->input('lname');
			$customer['gender']=$request->input('gender');
			$customer['age']=$request->input('age');
			$customer['bd']=$request->input('bd');
			$customer['address']=$request->input('address');
			$customer['city']=$request->input('city');
			$customer['dist']=$request->input('dist');
			$customer['state']=$request->input('state');
			$customer['mn']=$request->input('mn');
			$customer['pc']=$request->input('pc');
			$customer['branchid']=$request->input('branchid');
			$customer['lon']=$request->input('lon');
			$customer['pass']=$request->input('pass');
			$customer['passcode']=$request->input('passcode');
			$customer['fthrname']=$request->input('fthrname');
			
			
			$customer['nfname']=$request->input('nfname');
			$customer['nmname']=$request->input('nmname');
			$customer['nlname']=$request->input('nlname');
			$customer['ngender']=$request->input('ngender');
			$customer['nage']=$request->input('nage');
			$customer['nbdate']=$request->input('nbdate');
			$customer['nemail']=$request->input('nemail');
			$customer['nmstate']=$request->input('nmstate');
			$customer['nadd']=$request->input('nadd');
			$customer['ncity']=$request->input('ncity');
			$customer['npno']=$request->input('npno');
			$customer['nmno']=$request->input('nmno');
			$customer['noccup']=$request->input('noccup');
			$customer['npin']=$request->input('npin');
			$customer['ndist']=$request->input('ndist');
			$customer['nstate']=$request->input('nstate');
			$customer['reltn']=$request->input('reltn');
			
			
			$fnme=$request->input('fname');
			$mnme=$request->input('mname');
			$lnme=$request->input('lname');
			$userid=$request->input('usrid');
			
			$path = 'Upload/'.$userid."_".$fnme."_".$mnme."_".$lnme;
			
			
			if(!File::exists($path)) {
				//$result = File::makeDirectory($path);  for WINDOWS
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$fn=Input::file('custphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('custphoto')->getClientOriginalName();
					$customer['custphoto']=Input::file('custphoto')->move($destinationPath,$f);
				}
				else
				{
					$customer['custphoto']=$request->input('custphoto');
				}
				
				$fn1=Input::file('custidp');
				if($fn1!="")
				{
					$f1="Birth_Certificate.jpg";
					$fname1=Input::file('custidp')->getClientOriginalName();
					$customer['custidp']=Input::file('custidp')->move($destinationPath,$f1);
				}
				else
				{
					$customer['custidp']=$request->input('custidp');
				}
				
			}
			else
			{
				$destinationPath=$path;
				$fn=Input::file('custphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('custphoto')->getClientOriginalName();
					$customer['custphoto']=Input::file('custphoto')->move($destinationPath,$f);
				}
				else
				{
					$customer['custphoto']=$request->input('custphoto');
				}
				
				$fn1=Input::file('custidp');
				if($fn1!="")
				{
					$f1="Birth_Certificate.jpg";
					$fname1=Input::file('custidp')->getClientOriginalName();
					$customer['custidp']=Input::file('custidp')->move($destinationPath,$f1);
				}
				else
				{
					$customer['custidp']=$request->input('custidp');
				}
				
				
			}
			$id=$this->cust_model->InsertMinorCustomer($customer);
			
			return redirect('/home');
		}
		
		
		
		
		
		
		
		
		public function UpdateCustomer(Request $request)
		{
			$customer['cid']=$request->input('cid');
			$customer['aid']=$request->input('aid');
			$customer['nid']=$request->input('nid');
			$customer['uid']=$request->input('uid');
			$customer['acno']=$request->input('acno');
			$customer['opbal']=$request->input('opbal');
			$customer['docid']=$request->input('docid');
			$customer['email']=$request->input('email');
			//$user['bid']=$request->input('bid');
			$customer['fname']=$request->input('fname');
			$customer['KaFname']=$request->input('KaFname');
			$customer['mname']=$request->input('mname');
			$customer['KaMname']=$request->input('KaMname');
			$customer['lname']=$request->input('lname');
			$customer['KaLname']=$request->input('KaLname');
			$customer['gender']=$request->input('gender');
			$customer['ms']=$request->input('ms');
			$customer['oc']=$request->input('oc');
			$customer['age']=$request->input('age');
			$customer['bd']=$request->input('bd');
			$customer['address']=$request->input('address');
			$customer['KaAddress']=$request->input('KaAddress');
			$customer['city']=$request->input('city');
			$customer['KaCity']=$request->input('KaCity');
			$customer['dist']=$request->input('dist');
			$customer['KaDist']=$request->input('KaDist');
			$customer['state']=$request->input('state');
			$customer['KaState']=$request->input('KaState');
			$customer['mn']=$request->input('mn');
			$customer['pc']=$request->input('pc');
			$customer['phone']=$request->input('phone');
			$customer['branchid']=$request->input('branchid');
			$customer['fthrnme']=$request->input('fthrnme');
			$customer['KaFather']=$request->input('KaFather');
			$customer['spousenme']=$request->input('spousenme');
			$customer['KaSpouse']=$request->input('KaSpouse');
			$customer['Member_No']=$request->input('mem_no');
			
			
			
			$customer['nfname']=$request->input('nfname');
			$customer['nmname']=$request->input('nmname');
			$customer['nlname']=$request->input('nlname');
			$customer['KaNFname']=$request->input('KaNFname');
			$customer['KaNMname']=$request->input('KaNMname');
			$customer['KaNLname']=$request->input('KaNLname');
			$customer['ngender']=$request->input('ngender');
			$customer['nage']=$request->input('nage');
			$customer['nbdate']=$request->input('nbdate');
			$customer['nemail']=$request->input('nemail');
			$customer['nmstate']=$request->input('nmstate');
			$customer['nadd']=$request->input('nadd');
			$customer['ncity']=$request->input('ncity');
			$customer['npno']=$request->input('npno');
			$customer['nmno']=$request->input('nmno');
			$customer['noccup']=$request->input('noccup');
			$customer['npin']=$request->input('npin');
			$customer['ndist']=$request->input('ndist');
			$customer['nstate']=$request->input('nstate');
			$customer['rltn']=$request->input('rltn');
			$customer['KaRelation']=$request->input('KaRelation');
			
			
		/*	$userid=$request->input('uid');
			$fnme=$request->input('fname');
			$mnme=$request->input('mname');
			$lnme=$request->input('lname');
			$cust = $this->customer->GetCustomer1($customer['cid']);
			//print_r($cust);
			$path = 'Upload/'.$userid."_".$fnme."_".$mnme."_".$lnme;
			
			
			if(!File::exists($path)) {
				//$result = File::makeDirectory($path);   for WINDOWS
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$fn=Input::file('custphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('custphoto')->getClientOriginalName();
					$customer['custphoto']=Input::file('custphoto')->move($destinationPath,$f);
				}
				else
				{
					$customer['custphoto']=$request->input('custphoto');
				}
				
				$fn1=Input::file('custidp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('custidp')->getClientOriginalName();
					$customer['custidp']=Input::file('custidp')->move($destinationPath,$f1);
				}
				else
				{
					$customer['custidp']=$request->input('custidp');
				}
				
				$fn2=Input::file('custadprf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('custadprf')->getClientOriginalName();
					$customer['custadprf']=Input::file('custadprf')->move($destinationPath,$f2);
				}
				else
				{
					$customer['custadprf']=$request->input('custadprf');
				}
				
				$fn3=Input::file('custsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('custsign')->getClientOriginalName();
					$customer['custsign']=Input::file('custsign')->move($destinationPath,$f3);
				}
				else
				{
					$customer['custsign']=$request->input('custsign');
				}
			}
			else
			{
				$destinationPath=$path;
				$fn=Input::file('custeidp');
				
				if($fn!='')
				{
					$f="ID_Proof.jpg";
					$fname=Input::file('custeidp')->getClientOriginalName();
					$customer['custeidp']=Input::file('custeidp')->move($destinationPath,$f);
				}
				else
				{
					$customer['custeidp']= $cust->ID_Proof;
				}
				
				$fn1=Input::file('custeadrpf');
				if($fn1!='')
				{
					$f1="Address_Proof.jpg";
					$fname1=Input::file('custeadrpf')->getClientOriginalName();
					$customer['custeadrpf']=Input::file('custeadrpf')->move($destinationPath,$f1);
				}
				else
				{
					$customer['custeadrpf']= $cust->Address_Proof;
				}
				$fn2=Input::file('custephoto');
				if($fn2!='')
				{
					$f2="Photo.jpg";
					$fname2=Input::file('custephoto')->getClientOriginalName();
					$customer['custephoto']=Input::file('custephoto')->move($destinationPath,$f2);
				}
				else
				{
					$customer['custephoto']= $cust->Photo;
				}
				$fn3=Input::file('custesign');
				if($fn3!='')
				{
					$f3="Signature.jpg";
					$fname3=Input::file('custesign')->getClientOriginalName();
					$customer['custesign']=Input::file('custesign')->move($destinationPath,$f3);
				}
				else
				{
					$customer['custesign']= $cust->Signature;
				}
			}*/
			
			$id=$this->cust_model->updatecustomer($customer);
			return redirect('/home');
			
		}
		public function D_class_custm(Request $request)
		{
			$Url="customer";
			$c['module']=$this->Modules->GetAnyMid($Url);
			$id=$request->input('hai');
			$c['data']=$this->customer->GetSearchData1();
			return view('DclassCustomerSearch',compact('c'));
			
		}
		public function userdetails($id,$type=null){
			
			$ud['user']=$this->customer->userdetails($id);
			if($type!=null)
			{
			$ud['type']='edit';
			}
			else
			{
			$ud['type']='';
			}
			return view('userdetails',compact('ud'));
			
		}
	}
