<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\MemberModel;
	use App\Http\Model\ShareModel;
	use App\Http\Model\PurchaseshareModel;
	use App\Http\Model\ModulesModel;
	use File;
	use Input;
	use App\Http\Model\CustomerModel;
	
	class MemberController extends Controller
	{
		/**
			* Display a listing of the resource.
			*
			* @return \Illuminate\Http\Response
		*/
		public function __construct()
		{
			$this->Modules= new ModulesModel;
			$this->member_model= new MemberModel;
			$this->share_model=new ShareModel;
			$this->purshare_model=new PurchaseshareModel;
			$this->customer=new CustomerModel;
		}
		
		public function Show_Mem()
		{
			$Url="member";
			$m['module']=$this->Modules->GetAnyMid($Url);
			$m['members']=$this->member_model->getData();
			return view('member',compact('m'));
		}
		
		public function MemSearchView(Request $request)//M 19-4-16
		{
			$id=$request->input('SearchAccId');
			$m=$this->member_model->GetSearchData($id);
			return view('MemberSearch',compact('m'));
		}
		
		public function Show_MemberDetails($id,$type=null)
		{
			$md['member']=$this->member_model->GetMemberDetail($id);
			if($type!=null)
			$md['type']='edit';
			else
			$md['type']='';
			return view('memberDetails',compact('md'));
			
		}
		
		public function view_Mem()
		{
			$shares=$this->share_model->getpurshare();
			return view('createmember',['shares'=>$shares]);
		}
		
		
		
		public function retrieve_info(Request $request)
		{
			$share['shclass']=$request->input('shclass');
			$get=$this->share_model->getvalue($share);
			$id['face']=$get->Facevalue;
			$id['sharep']=$get->Share_Price;
			return $id;
		}
		
		public function retreive_max()
		{
			$getcount=$this->purshare_model->getmaxcount();
			return $getcount;
		}
		
		public function GetUid()
		{
			$id=$this->customer->maxid();
			return $id;
		}
		
		public function Member_Create(Request $request)
		{
			$mem['mfname']=$request->input('mfname');
			$mem['mmname']=$request->input('mmname');
			$mem['mlname']=$request->input('mlname');
			$mem['branchid']=$request->input('branchid');
			$mem['mdte']=$request->input('mdte');
			$mem['mage']=$request->input('mage');
			$mem['mgender']=$request->input('mgender');
			$mem['mbdate']=$request->input('mbdate');
			$mem['memail']=$request->input('memail');
			$mem['mmrstate']=$request->input('mmrstate');
			$mem['madd']=$request->input('madd');
			$mem['mcity']=$request->input('mcity');
			$mem['mpno']=$request->input('mpno');
			$mem['mmno']=$request->input('mmno');
			$mem['moccup']=$request->input('moccup');
			$mem['mpin']=$request->input('mpin');
			$mem['mdist']=$request->input('mdist');
			$mem['mstate']=$request->input('mstate');
			$mem['adcrdno']=$request->input('adcrdno');
			$mem['voterid']=$request->input('voterid');
			$mem['passportnum']=$request->input('passportnum');
			$mem['nfname']=$request->input('nfname');
			$mem['nmname']=$request->input('nmname');
			$mem['nlname']=$request->input('nlname');
			$mem['ngender']=$request->input('ngender');
			$mem['nage']=$request->input('nage');
			$mem['nbdate']=$request->input('nbdate');
			$mem['nemail']=$request->input('nemail');
			$mem['nmstate']=$request->input('nmstate');
			$mem['nadd']=$request->input('nadd');
			$mem['ncity']=$request->input('ncity');
			$mem['npno']=$request->input('npno');
			$mem['nmno']=$request->input('nmno');
			$mem['noccup']=$request->input('noccup');
			$mem['npin']=$request->input('npin');
			$mem['ndist']=$request->input('ndist');
			$mem['nstate']=$request->input('nstate');
			$mem['remark']=$request->input('remark');
			$mem['shclass']=$request->input('shclass');
			$mem['shamt']=$request->input('shamt');
			$mem['shprice']=$request->input('shprice');
			$mem['totshare']=$request->input('totshare');
			$mem['totamt']=$request->input('totamt');
			$mem['memshr']=$request->input('memshr');
			$mem['count']=$request->input('count');
			$mem['lgname']=$request->input('lgname');
			$mem['pwd']=$request->input('pwd');
			$mem['pscd']=$request->input('pscd');
			$mem['pncrdno']=$request->input('pncrdno');
			$mem['mfee']=$request->input('mfee');
			$mem['totshrval']=$request->input('totshrval');
			$mem['fthrname']=$request->input('fthrname');
			$mem['reltn']=$request->input('reltn');
			$mem['spousename']=$request->input('spousename');
			
			
			
			$fname=$request->input('mfname');
			$mname=$request->input('mmname');
			$lname=$request->input('mlname');
			
			$memuid=$request->input('usrid');
			//$uid=$request->input('user_ss');
			
			$path = 'Upload/'.$memuid."_".$fname."_".$mname."_".$lname;
			
			
			if(!File::exists($path)) 
			{
				//$result = File::makeDirectory($path); for WINDOWS
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$fn=Input::file('photo');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('photo')->getClientOriginalName();
					$mem['photo']=Input::file('photo')->move($destinationPath,$f);
				}
				else
				{
					$mem['photo']=$request->input('photo');
				}
				
				$fn1=Input::file('idp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('idp')->getClientOriginalName();
					$mem['idp']=Input::file('idp')->move($destinationPath,$f1);
				}
				else
				{
					$mem['idp']=$request->input('idp');
				}
				
				$fn2=Input::file('adprf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('adprf')->getClientOriginalName();
					$mem['adprf']=Input::file('adprf')->move($destinationPath,$f2);
				}
				else
				{
					$mem['adprf']=$request->input('adprf');
				}
				
				$fn3=Input::file('adprf');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('sign')->getClientOriginalName();
					$mem['sign']=Input::file('sign')->move($destinationPath,$f3);
				}
				else
				{
					$mem['sign']=$request->input('sign');
				}
			}
			else
			{
				$destinationPath=$path;
				$fn=Input::file('photo');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('photo')->getClientOriginalName();
					$mem['photo']=Input::file('photo')->move($destinationPath,$f);
				}
				else
				{
					$mem['photo']=$request->input('photo');
				}
				
				$fn1=Input::file('idp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('idp')->getClientOriginalName();
					$mem['idp']=Input::file('idp')->move($destinationPath,$f1);
				}
				else
				{
					$mem['idp']=$request->input('idp');
				}
				
				$fn2=Input::file('adprf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('adprf')->getClientOriginalName();
					$mem['adprf']=Input::file('adprf')->move($destinationPath,$f2);
				}
				else
				{
					$mem['adprf']=$request->input('adprf');
				}
				
				$fn3=Input::file('adprf');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('sign')->getClientOriginalName();
					$mem['sign']=Input::file('sign')->move($destinationPath,$f3);
				}
				else
				{
					$mem['sign']=$request->input('sign');
				}
			}
			
			
			$id=$this->member_model->insert($mem);
			
			return redirect('/home');
		}
		
		
		
		
		
		
		public function UpdateMember(Request $request)
		{
			$mem['uid']=$request->input('uid');
			$mem['aid']=$request->input('aid');
			$mem['nid']=$request->input('nid');
			$mem['memid']=$request->input('memid');
			$mem['branchid']=$request->input('branchid');
			$mem['dcid']=$request->input('dcid');
			$mem['mfname']=$request->input('mfname');
			$mem['mmname']=$request->input('mmname');
			$mem['mlname']=$request->input('mlname');
			$mem['mdte']=$request->input('mdte');
			$mem['mage']=$request->input('mage');
			$mem['mgender']=$request->input('mgender');
			$mem['mbdate']=$request->input('mbdate');
			$mem['memail']=$request->input('memail');
			$mem['mmrstate']=$request->input('mmrstate');
			$mem['madd']=$request->input('madd');
			$mem['mcity']=$request->input('mcity');
			$mem['mpno']=$request->input('mpno');
			$mem['mmno']=$request->input('mmno');
			$mem['moccup']=$request->input('moccup');
			$mem['mpin']=$request->input('mpin');
			$mem['mdist']=$request->input('mdist');
			$mem['mstate']=$request->input('mstate');
			$mem['adcrdno']=$request->input('adcrdno');
			$mem['voterid']=$request->input('voterid');
			$mem['passportnum']=$request->input('passportnum');
			$mem['nfname']=$request->input('nfname');
			$mem['nmname']=$request->input('nmname');
			$mem['nlname']=$request->input('nlname');
			$mem['ngender']=$request->input('ngender');
			$mem['nage']=$request->input('nage');
			$mem['nbdate']=$request->input('nbdate');
			$mem['nemail']=$request->input('nemail');
			$mem['nmstate']=$request->input('nmstate');
			$mem['nadd']=$request->input('nadd');
			$mem['ncity']=$request->input('ncity');
			$mem['npno']=$request->input('npno');
			$mem['nmno']=$request->input('nmno');
			$mem['noccup']=$request->input('noccup');
			$mem['npin']=$request->input('npin');
			$mem['ndist']=$request->input('ndist');
			$mem['nstate']=$request->input('nstate');
			$mem['remark']=$request->input('remark');
			/*$mem['shclass']=$request->input('shclass');
				$mem['shamt']=$request->input('shamt');
				$mem['shprice']=$request->input('shprice');
				$mem['totshare']=$request->input('totshare');
				$mem['totamt']=$request->input('totamt');
				$mem['memshr']=$request->input('memshr');
			$mem['count']=$request->input('count');*/
			$mem['lgname']=$request->input('lgname');
			//$mem['pwd']=$request->input('pwd');
			//$mem['pscd']=$request->input('pscd');
			$mem['pncrdno']=$request->input('pncrdno');
			$mem['mfee']=$request->input('mfee');
			$mem['rltn']=$request->input('rltn');
			$mem['fthrname']=$request->input('fthrname');
			$mem['spousename']=$request->input('spousename');
			
			$mem['KaMFather']=$request->input('KaMFather');
			$mem['KaRelation']=$request->input('KaRelation');
			$mem['KaMSpouse']=$request->input('KaMSpouse');
			$mem['KaMFname']=$request->input('KaMFname');
			$mem['KaMMname']=$request->input('KaMMname');
			$mem['KaMLname']=$request->input('KaMLname');
			$mem['KaMAdd']=$request->input('KaMAdd');
			$mem['KaMCity']=$request->input('KaMCity');
			$mem['KaMDistrict']=$request->input('KaMDistrict');
			$mem['KaMState']=$request->input('KaMState');
			$mem['KaNFname']=$request->input('KaNFname');
			$mem['KaNMname']=$request->input('KaNMname');
			$mem['KaNLname']=$request->input('KaNLname');
			
			$membruid=$request->input('uid');
			
			
			$fnme=$request->input('mfname');
			$mnme=$request->input('mmname');
			$lnme=$request->input('mlname');
			$mem1 = $this->member_model->GetMemberDetail1($mem['memid']);
			//print_r($cust);
			$path = 'Upload/'.$membruid."_".$fnme."_".$mnme."_".$lnme;
			
			
			if(!File::exists($path)) {
				//$result = File::makeDirectory($path); for WINDOWS
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$fn=Input::file('memidp');
				if($fn!="")
				{
					$f="ID_Proof.jpg";
					$fname=Input::file('memidp')->getClientOriginalName();
					$mem['memidp']=Input::file('memidp')->move($destinationPath,$f);
				}
				else
				{
					$mem['memidp']=$request->input('memidp');
				}
				
				$fn1=Input::file('memadrp');
				if($fn1!="")
				{
					$f1="Address_Proof.jpg";
					$fname1=Input::file('memadrp')->getClientOriginalName();
					$mem['memadrp']=Input::file('memadrp')->move($destinationPath,$f1);
				}
				else
				{
					$mem['memadrp']=$request->input('memadrp');
				}
				
				$fn2=Input::file('memphoto');
				if($fn2!="")
				{
					$f2="Photo.jpg";
					$fname2=Input::file('memphoto')->getClientOriginalName();
					$mem['memphoto']=Input::file('memphoto')->move($destinationPath,$f2);
				}
				else
				{
					$mem['memphoto']=$request->input('memphoto');
				}
				
				$fn3=Input::file('memsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname3=Input::file('memsign')->getClientOriginalName();
					$mem['memsign']=Input::file('memsign')->move($destinationPath,$f3);
				}
				else
				{
					$mem['memsign']=$request->input('memsign');
				}
			}
			else
			{
				$destinationPath=$path;
				//$fn=$request->input('memidp');
				$fn=Input::file('memidp');
				//echo 'hi'.$fn;
				if($fn!='')
				{
					$f="ID_Proof.jpg";
					$fname=Input::file('memidp')->getClientOriginalName();
					$mem['memidp']=Input::file('memidp')->move($destinationPath,$f);
				}
				else
				{
					$mem['memidp']= $mem1->ID_Proof;
				}
				
				//$fn1=$request->input('memadrp');
				$fn1=Input::file('memadrp');
				if($fn1!='')
				{
					$f1="Address_Proof.jpg";
					$fname1=Input::file('memadrp')->getClientOriginalName();
					$mem['memadrp']=Input::file('memadrp')->move($destinationPath,$f1);
				}
				else
				{
					$mem['memadrp']= $mem1->Address_Proof;
				}
				//$fn2=$request->input('memphoto');
				$fn2=Input::file('memphoto');
				if($fn2!='')
				{
					$f2="Photo.jpg";
					$fname2=Input::file('memphoto')->getClientOriginalName();
					//$mem['memphoto']=Input::file('memphoto')->move($destinationPath,mt_rand()."_".$fname2);
					$mem['memphoto']=Input::file('memphoto')->move($destinationPath,$f2);
				}
				else
				{
					$mem['memphoto']= $mem1->Photo;
				}
				//$fn3=$request->input('memsign');
				$fn3=Input::file('memsign');
				if($fn3!='')
				{
					$f3="Signature.jpg";
					$fname3=Input::file('memsign')->getClientOriginalName();
					//$mem['memsign']=Input::file('memsign')->move($destinationPath,mt_rand()."_".$fname3);
					$mem['memsign']=Input::file('memsign')->move($destinationPath,$f3);
				}
				else
				{
					$mem['memsign']= $mem1->Signature;
				}
			}
			
			$id=$this->member_model->UpdateMember($mem);
			return redirect('/home');
			
		}
		public function transfercusttomem()
		{
				$shares=$this->share_model->getpurshare();
				return view('trancefercust',['shares'=>$shares]);
				
		}
		
		public function tranmember(Request $request)
		{
			$mem['userid']=$request->input('userid');
			$mem['shclass']=$request->input('shclass');
			$mem['shamt']=$request->input('shamt');
			$mem['shprice']=$request->input('shprice');
			$mem['totshare']=$request->input('totshare');
			$mem['totshrval']=$request->input('totshrval');
			$mem['totamt']=$request->input('totamt');
			$mem['memshr']=$request->input('memshr');
			$mem['memfee']=$request->input('memfee');
			$mem['count']=$request->input('count');
			$id=$this->member_model->tranmember($mem);
		
		}
		
		public function share_details(Request $request)
		{
			$data["branch"] = $this->member_model->get_branches();
			$data["share_class"] = $this->member_model->get_share_classes();
			return view('share_details',compact("data"));
		}
		
		public function share_details_data(Request $request)
		{
			$in_data["bid"] = $request->input("bid");
			$in_data["share_class_id"] = $request->input("share_class_id");
			$data["share"] = $this->member_model->share_details_data($in_data);
			return view('share_details_data',compact("data"));
		}
		
		public function member_details(Request $request)
		{
			$in_data = array();
		//	$in_data["bid"] = $request->input("bid");
			$data["member_details"] = $this->member_model->get_member_details($in_data);
			return view('member_details',compact("data"));
		}
		
	
	}
