<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\PurchaseshareModel;
	use App\Http\Model\ShareModel;
	use App\Http\Model\ExpenceModel;
	use App\Http\Model\ReportModel;
	use App\Http\Model\ModulesModel;
	
	class PurchaseshareController extends Controller
	{
		public function __construct()
		{
			$this->Modules= new ModulesModel;
			$this->purshare_model = new PurchaseshareModel;
			$this->purshare = new PurchaseshareModel;
			$this->share_model=new ShareModel;
			$this->creadexpencemodel = new ExpenceModel;
			$this->Report_model = new ReportModel;
		}
		
		/*public function show_purshare()
			{
			$ps=PurchaseshareModel::all();
			return view('purchaseshare',compact('ps'));
		}*/
		public function show_purshare()
		{
			$Url="purchaseshare";
			$ps['module']=$this->Modules->GetAnyMid($Url);
			$ps['PurchaseShares']=$this->purshare_model->GetData();
			return view('purchaseshare',compact('ps'));
		}
		
		public function PurchaseShareSearchView(Request $request)
		{
			$id=$request->input('SearchAccId');
			$ps=$this->purshare_model->GetSearchData($id);
			return view('PurchaseShareSearch',compact('ps'));
		}
		
		
		public function view_purshare()
		{
			$shares=$this->share_model->getpurshare();
			return view('createpurchaseshare',['shares'=>$shares]);
		}
		
		public function ShowPshareDetails($id)
		{
			$psd['purshare']=$this->purshare->GetPurshareDetail($id);
			return view('purchasesharedetails',compact('psd'));
			
		}
		
		public function PshareReceipt($id,$mid)
		{
			$psreceipt['purshare']=$this->purshare->GetPurshareReceDetail($id);
			$psreceipt['minPid']=$this->purshare->GetMinPurId($mid);
			$psreceipt['maxReceiptId']=$this->purshare->GetMaxRecNum();
			//var_dump($psreceipt);
			
			return view('PurchaseShareReceipt',compact('psreceipt'));
			
		}
		
		public function UpdateReceiptNo(Request $request)
		{
			$recid['recenum']=$request->input('recenum');
			$recid['purchid']=$request->input('purchid');
			$get=$this->purshare->UpdateReceiptNo($recid);
			
		}
		
		public function retrieve_val(Request $request)
		{
			$share['shclass']=$request->input('shclass');
			$get=$this->share_model->getvalue($share);
			$id['face']=$get->Facevalue;
			$id['sharep']=$get->Share_Price;
			return $id;
		}
		
		public function retreive_maxcount()
		{
			$getcount=$this->purshare_model->getmaxcount();
			return $getcount;
		}
		
		public function create_PurShares(Request $request)
		{
			$pshares['mid']=$request->input('mid');
			$pshares['shclass']=$request->input('shclass');
			$pshares['shamt']=$request->input('shamt');
			$pshares['shprice']=$request->input('shprice');
			$pshares['totshare']=$request->input('totshare');
			$pshares['totamt']=$request->input('totamt');
			$pshares['memshr']=$request->input('memshr');
			$pshares['spdate']=$request->input('spdate');
			$pshares['count']=$request->input('count');
			$pshares['totshrval']=$request->input('totshrval');
			
			$id=$this->purshare_model->insert($pshares);
			return redirect('/');
		}
		
		public function sharehandover()
		{
			
			return view('ShareHandOverHome');   
		}
		public function getshares(Request $request)
		{
			
			$pshares['mid']=$request->input('mid');
			
			$shares['data1']=$this->purshare_model->getshares($pshares);
			$shares['data2']=$this->purshare_model->getsharesindiv($pshares);
			return view('ShareHandOver',compact('shares'));
		}
		public function shareclose($id)
		{
			$shares['branch_data']=$this->Report_model->GetBranchDropD();
			$shares['led']=$this->creadexpencemodel->getExpensedata();
			$shares['data']=$this->purshare_model->shareclose($id);
			
			return view('ShareHandOverIndex',compact('shares'));
			
		}
		public function indshareclose(Request $request)
		{
			$pshares['shareid']=$request->input('shareid');
			$pshares['s_id']=$request->input('s_id');
			$pshares['loopid']=$request->input('loopid');
			$shares['branch_data']=$this->Report_model->GetBranchDropD();
			$shares['led']=$this->creadexpencemodel->getExpensedata();
			$shares['data1']=$this->purshare_model->indshareclose($pshares);
			return view('SingleShareHandOverIndex',compact('shares'));
			
		}
		public function ShareCloseTran(Request $request)
		{
			$pshares['pid']=$request->input('pid');
			$pshares['cerificateid']=$request->input('cerificateid');
			$pshares['payamt']=$request->input('payamt');
			$pshares['tt']=$request->input('tt');
			$pshares['per']=$request->input('per');
			$pshares['expsubhead']=$request->input('expsubhead');
			$pshares['HeadiD']=$request->input('HeadiD');
			$pshares['BranchList2']=$request->input('BranchList2');
			
			$this->purshare_model->ShareCloseTran($pshares);
		}
		public function SingleShareCloseTran(Request $request)
		{
			$pshares['pid']=$request->input('pid');
			//$pshares['cerificateid']=$request->input('cerificateid');
			$pshares['payamt']=$request->input('payamt');
			$pshares['sid']=$request->input('sid');
			$pshares['tt']=$request->input('tt');
			$pshares['per']=$request->input('per');
			$pshares['expsubhead']=$request->input('expsubhead');
			$pshares['HeadiD']=$request->input('HeadiD');
			$pshares['BranchList2']=$request->input('BranchList2');
			$pshares['shareid']=$request->input('all_share_id');
			$pshares['loopid']=$request->input('loopid');
			//$pshares['shareid']=$request->input('shareid');
			$this->purshare_model->SingleShareCloseTran($pshares);
		}
	}
