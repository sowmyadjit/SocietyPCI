<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\DepositModel;
	use App\Http\Model\OpenCloseModel;
	use App\Http\Model\SDModel;
	use App\Http\Model\SDTranModel;
	use Auth;
	
	class depositController extends Controller
	{
		
		
		
		public function __construct()
		{
			$this->creadepositmodel = new DepositModel;
			$this->Modules= new ModulesModel;
			$this->op= new OpenCloseModel;
			$this->sd= new SDModel;
			$this->sd_tran= new SDTranModel;
		}
		
		public function show_deposit()
		{
			$Url="deposit";
			$depo['module']=$this->Modules->GetAnyMid($Url);
			$depo['deposits']=$this->creadepositmodel->GetDepositData();
			$depo['is_day_open']=$this->op->is_day_open(date("Y-m-d"));
			return view('deposit2',compact('depo'));
		}
		
		public function deposit_data()
		{
			$Url="deposit";
			$depo['module']=$this->Modules->GetAnyMid($Url);
			$depo['deposits']=$this->creadepositmodel->GetDepositData();
			return view('deposit_data',compact('depo'));
		}
		
		public function create_deposit(Request $request)
		{
			$depo['bankName']=$request->input('bankName');
			$depo['bank']=$request->input('bank');
			$depo['ta']=$request->input('ta');
			$depo['branch']=$request->input('branch');
			$depo['perti']=$request->input('perti');
			$depo['bbbranch']=$request->input('bbbranch');
			$depo['chdate']=$request->input('chdate');
			$depo['chqno']=$request->input('chqno');
			$depo['paymode']=$request->input('paymode');
			$id=$this->creadepositmodel->insert($depo);
			return redirect('/');
			
		}
		
		public function display_deposit()
		{
			$Url="deposit";
			$branch['module']=$this->Modules->GetAnyMid($Url);
			//$branch=$this->creadepositmodel->GetBranchDropD();
			//return view('createdeposit',['branch'=>$branch]);
			$branch['Blist']=$this->creadepositmodel->GetBranchDropD();
			return view('createdeposit',compact('branch'));
		}
		
		public function GetBankDetailForDeposite(Request $request)
		{
			
			$deposit['bankid']=$request->input('bankid');
			$get=$this->creadepositmodel->GetBankDetailForDeposite($deposit);
			$id['bnkbranch']=$get->Branch;
			$id['ifsc']=$get->AddBank_IFSC;
			$id['totamt']=$get->TotalAmt;
			
			return $id;
		}
		
		public function depodetailbranch()
		{
			$branch=$this->creadepositmodel->GetBranchDropD();
			return view('deposittobranch',['branch'=>$branch]);
			
			
		}
		public function crateaddeposittobranch(Request $request)
	{
		$depo['bankName']=$request->input('bankName');
		$depo['bank']=$request->input('bank');
		$depo['ta']=$request->input('ta');
		$depo['branch']=$request->input('branch');
		$depo['perti']=$request->input('perti');
		$depo['paymode']=$request->input('paymode');
		$depo['bank']=$request->input('bank');
		$id=$this->creadepositmodel->crateaddeposittobranch($depo);
		return redirect('/');
	
	}
	
	//	PIGMY FD KCC MATURITY-DEPOSIT
		public function deposit_account_list(Request $request)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$force_reload_flag = false;
			$dont_save_to_cache_flag = false;
			$force_reload = $request->input("force_reload");
			$in_data['category'] = $request->input("category");
			$in_data['closed'] = $request->input("closed");
			$in_data['agent_id'] = $request->input("agent_id");//USED IN PG
			$in_data['user_type'] = $request->input("user_type");// USED IN CD
			$in_data['allocation_id'] = $request->input("allocation_id");
			if(!empty($in_data['allocation_id'])) {
				$dont_save_to_cache_flag = true;
			}
			if(strcasecmp($force_reload,"YES") == 0) {
				$force_reload_flag = true;
			} elseif(!empty($in_data['allocation_id'])) {
				$force_reload_flag = true;
			}
			switch($in_data['category']) {
				case "PG":	
							// CACHE

							$cache_ele_name = "cache_{$BID}_{$in_data['category']}_{$in_data['closed']}_{$in_data['agent_id']}"; //cache element name - cache_BID_PG_CLOSED_AGENTID
							if(\Cache::has($cache_ele_name) && $force_reload_flag == false) {
								return \Cache::get($cache_ele_name);
							} else {
								// return 'cachekey was forgotten, so this is just random data';
								$ret_data = $this->creadepositmodel->deposit_account_list_pg($in_data);
								if(!$dont_save_to_cache_flag) { //FOR SEARCH RESULTS
									$vw = (string)view("deposit_account_list_data",compact("ret_data"));
									\Cache::forever($cache_ele_name, $vw);
								}
								return view("deposit_account_list_data",compact("ret_data"));
							}
							
							break;
				case "FD":	$ret_data = $this->creadepositmodel->deposit_account_list_fd($in_data);
							return view("deposit_account_list_data_fd",compact("ret_data"));
							break;
				case "KCC":	$ret_data = $this->creadepositmodel->deposit_account_list_fd($in_data);
							return view("deposit_account_list_data_kcc",compact("ret_data"));
							break;
				case "MD":	$ret_data = $this->creadepositmodel->deposit_account_list_md($in_data);
							return view("deposit_account_list_data_md",compact("ret_data"));
							break;
				case "CD":	$ret_data = $this->creadepositmodel->deposit_account_list_cd($in_data);
							return view("deposit_account_list_data_cd",compact("ret_data"));
							break;
				case "SD":	$ret_data = $this->creadepositmodel->deposit_account_list_sd($in_data);
							return view("deposit_account_list_data_sd",compact("ret_data"));
							break;
			}
		}
	
		public function deposit_account_edit(Request $request)
		{
			$in_data['category'] = $request->input("category");
			$in_data['closed'] = $request->input("closed");
			$in_data['allocation_id'] = $request->input("allocation_id");
			switch($in_data['category']) {
				case "PG":	$ret_data = $this->creadepositmodel->deposit_account_edit_pg($in_data);
							break;
				case "FD":	
				case "KCC":	
							$ret_data = $this->creadepositmodel->deposit_account_edit_fd($in_data);//SAME FN FOR FD AND KCC
							break;
			}
			return "deposit_account_edit: done";
		}
		
		public function maturity_deposit_index()
		{
			$data = [];
			return view("maturity_deposit_index",compact('data'));
		}
		
		public function maturity_amount_pay_form(Request $request)
		{
			$data = [];
			$in_data["allocation_id"] = $request->input("allocation_id");
			$data = $this->creadepositmodel->maturity_amount_pay_form($in_data);
			return view("maturity_amount_pay_form",compact('data'));
		}
		
		public function maturity_amt_create(Request $request)
		{
			$in_data["md_id"] = $request->input("md_id");
			$in_data["tran_date"] = $request->input("tran_date");
			$in_data["payable_amt"] = $request->input("payable_amt");
			$in_data["particulars"] = $request->input("particulars");
			$in_data["account_no"] = $request->input("account_no");
			$in_data["pay_mode"] = $request->input("pay_mode");
			$in_data["cheque_no"] = $request->input("cheque_no");
			$in_data["cheque_date"] = $request->input("cheque_date");
			$in_data["bank_id"] = $request->input("bank_id");
			$in_data["bank_branch"] = $request->input("bank_branch");
			$in_data["ifsc_code"] = $request->input("ifsc_code");
			$in_data["bank_acc_no"] = $request->input("bank_acc_no");
			$in_data["actid"] = $request->input("actid");
			$in_data["type_ahead_sb_acc_no"] = $request->input("type_ahead_sb_acc_no");
			$in_data["sb_acc_no"] = $request->input("sb_acc_no");
			$in_data["sb_available_amount"] = $request->input("sb_available_amount");
			$in_data["sb_remaining_amount"] = $request->input("sb_remaining_amount");
			$data = $this->creadepositmodel->maturity_amt_create($in_data);
			return "done";
		}
		
//COMPULSORY DEPOSIT
		public function compulsory_deposit_index()
		{
			$data = [];
			return view("compulsory_deposit_index",compact('data'));
		}
		
		public function cd_interest_calculation_index(Request $request)
		{
			return view("cd_interest_calculation_index");
		}
		
		public function cd_interest_calculatoin(Request $request)
		{
			$in_data["date"] = $request->input("date");
			$this->creadepositmodel->cd_interest_calculatoin($in_data);
			return "11";
		}
		
//SECURITY DEPOSIT
		public function security_deposit_index()
		{
			$data = [];
			return view("security_deposit_index",compact('data'));
		}

		public function create_sd_index()
		{
			$data = [];
			return view("create_sd_index",compact("data"));
		}

		public function create_sd(Request $request)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$user_id = $request->input("user_id");
			$user_type = $request->input("user_type");
			$old_acc_no = $request->input("old_acc_no");
			$start_date = $request->input("start_date");

			//CREATE ACCOUNT IN BRANCH
			unset($fn_data);
			$fn_data["bid"] = $BID;
			$sd_account_no = $this->sd->get_next_sd_account_no($fn_data);

			unset($fn_data);
			$fn_data["sd_ho_id"] = 0;
			$fn_data["sd_acc_no"] = $sd_account_no;
			$fn_data["sd_old_acc_no"] = $old_acc_no;
			$fn_data["user_type"] = $user_type;
			$fn_data["uid"] = $user_id;
			$fn_data["bid"] = $BID;
			$fn_data["sd_start_date"] = $start_date;
			// $fn_data["sd_close_date"] = ;
			$fn_data["sd_closed"] = NOT_CLOSED;
			// $fn_data["subhead_id"] = ;
			$fn_data["deleted"] = NOT_DELETED;

			$this->sd->clear_row_data();
			$this->sd->set_row_data($fn_data);
			$sd_branch_id = $this->sd->insert_row();

			if($BID != 6) {
				//CREATE AN ACCOUNT IN HO
				unset($fn_data);
				$fn_data["bid"] = 6; // HEAD OFFICE
				$sd_account_no = $this->sd->get_next_sd_account_no($fn_data);

				unset($fn_data);
				$fn_data["sd_ho_id"] = 0;
				$fn_data["sd_acc_no"] = $sd_account_no;
				$fn_data["sd_old_acc_no"] = $old_acc_no;
				$fn_data["user_type"] = $user_type;
				$fn_data["uid"] = $user_id;
				$fn_data["bid"] = 6;	//HEAD OFFICE
				$fn_data["sd_start_date"] = $start_date;
				// $fn_data["sd_close_date"] = ;
				$fn_data["sd_closed"] = NOT_CLOSED;
				// $fn_data["subhead_id"] = ;
				$fn_data["deleted"] = NOT_DELETED;

				$this->sd->clear_row_data();
				$this->sd->set_row_data($fn_data);
				$sd_ho_id = $this->sd->insert_row();

				//UPDATE BRANCH ACCOUNT'S "sd_ho_id" FIELD
				unset($fn_data);
				$fn_data[$this->sd->pk] = $sd_branch_id;
				$fn_data[$this->sd->sd_ho_id_field] = $sd_ho_id;
				$this->sd->clear_row_data();
				$this->sd->set_row_data($fn_data);
				// $this->sd->print_row_data($fn_data);
				$this->sd->update_row();

			}
			return "done";
		}

		public function sd_transaction_index()
		{
			$data = [];
			return view("sd_transaction_index",compact("data"));
		}

		public function create_sd_transaction(Request $request)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);
			// print_r($in_data);return;
			unset($fn_data);
			$fn_data[$this->sd_tran->sd_id_field] = $in_data["sd_id"];
			$fn_data[$this->sd_tran->date_field] = $in_data["sd_tran_date"];
			$fn_data[$this->sd_tran->time_field] = date("H:i:s");
			$fn_data[$this->sd_tran->bid_field] = $BID;
			$fn_data[$this->sd_tran->transaction_type_field] = $in_data["sd_transaction_type"];
			$fn_data[$this->sd_tran->sd_amount_field] = $in_data["sd_amount"];
			$fn_data[$this->sd_tran->paid_field] = PAID;
			$fn_data[$this->sd_tran->payment_mode_field] = $in_data["sd_payment_mode"];
			$fn_data[$this->sd_tran->particulars_field] = $in_data["sd_perticulars"];
			// $fn_data[$this->sd_tran->cheque_no_field] = "";
			// $fn_data[$this->sd_tran->cheque_date_field] = "";
			// $fn_data[$this->sd_tran->bank_id_field] = "";
			// $fn_data[$this->sd_tran->subhead_id_field] = "";
			$fn_data[$this->sd_tran->deleted_field] = "";
		
			$this->sd_tran->clear_row_data();
			$this->sd_tran->set_row_data($fn_data);
			$sd_tran_id = $this->sd_tran->insert_row();
			return "done";
		}



	}
