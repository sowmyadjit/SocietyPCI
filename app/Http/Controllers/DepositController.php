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
	use App\Http\Model\CDSDModel;
	use App\Http\Model\CDSDTranModel;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
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
			$this->cdsd= new CDSDModel;
			$this->cdsd_tran= new CDSDTranModel;
			$this->rv_no = new ReceiptVoucherController;
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
				/* case "CD":	$ret_data = $this->creadepositmodel->deposit_account_list_cd($in_data);
							return view("deposit_account_list_data_cd",compact("ret_data"));
							break; */
				/* case "SD":	$ret_data = $this->creadepositmodel->deposit_account_list_sd($in_data);
							return view("deposit_account_list_data_sd",compact("ret_data"));
							break; */
				case "SD":	
							$in_data["cdsd_type"] = $request->input("cdsd_type");
							$data = $this->creadepositmodel->deposit_account_list_cdsd($in_data);
							return view("deposit_account_list_data_cdsd",compact("data"));
							break;
				case "CD":	
							$in_data["cdsd_type"] = $request->input("cdsd_type");
							$data = $this->creadepositmodel->deposit_account_list_cdsd($in_data);
							return view("deposit_account_list_data_cdsd",compact("data"));
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

	/* 	public function create_sd_transaction(Request $request)
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
		} */

//CDSD DEPOSIT
		/* public function cd_index()
		{
			$data["cdsd_type"] = CDSDModel::CD;
			return view("cdsd_index",compact('data'));
		} */

		///////////////////////////////////////////////////////////
		public function sd_index()
		{
			$data["cdsd_type"] = CDSDModel::SD;
			return view("cdsd_index",compact('data'));
		}

		public function create_cdsd_index(Request $request)
		{
			$data["cdsd_type"] = $request->input("cdsd_type");
			return view("create_cdsd_index",compact("data"));
		}

		public function cdsd_transaction_index(Request $request)
		{
			$data = [];
			$data["cdsd_type"] = $request->input("cdsd_type");
			return view("cdsd_transaction_index",compact("data"));
		}

		public function cdsd_interest_index(Request $request)
		{
			$data = [];
			$data["cdsd_type"] = $request->input("cdsd_type");
			// $data["calculated_int"] = $this->creadepositmodel->calculated_interest(["cdsd_type"=>$data["cdsd_type"]]);
			return view("cdsd_interest_index",compact("data"));
		}

		public function cdsd_int_prev_data(Request $request)
		{
			$data = [];
			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);
			$data["cdsd_type"] = $in_data["cdsd_type"];
			$data["user_type"] = $in_data["user_type"];

			$data["cdsd_type"] = $data["cdsd_type"];
			$data["calculated_int"] = $this->creadepositmodel->calculated_interest(["cdsd_type"=>$data["cdsd_type"], "user_type"=>$data["user_type"]]);
			return view("cdsd_int_prev_data",compact("data"));
		}

		public function cdsd_close_index(Request $request)
		{
			$data = [];
			$data["cdsd_type"] = $request->input("cdsd_type");
			return view("cdsd_close_index",compact("data"));
		}

		public function create_cdsd(Request $request)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);
			$cdsd_type = $in_data["cdsd_type"];
			$user_type = $in_data["cr_user_type"];
			$user_id = $in_data["cr_user_id"];
			$old_acc_no = $in_data["cr_old_acc_no"];
			$start_date = $in_data["cr_start_date"];

			//CREATE ACCOUNT IN BRANCH
			unset($fn_data);
			$fn_data["bid"] = $BID;
			$fn_data["cdsd_type"] = $cdsd_type;
			$account_no = $this->cdsd->get_next_acc_no($fn_data);

			if($cdsd_type == 2) {
				$user_ho_acc_id = $this->creadepositmodel->get_ho_acc_id(["uid"=>$user_id]);
				if(empty($user_ho_acc_id)) {
					$user_ho_acc_id = 0;
				}
			} else {
				$user_ho_acc_id = 0;
			}

			unset($fn_data);
			$fn_data["cdsd_type"] = $cdsd_type;
			$fn_data["sd_ho_id"] = $user_ho_acc_id;
			$fn_data["cdsd_acc_no"] = $account_no;
			$fn_data["cdsd_oldacc_no"] = $old_acc_no;
			$fn_data["user_type"] = $user_type;
			$fn_data["uid"] = $user_id;
			$fn_data["bid"] = $BID;
			$fn_data["cdsd_start_date"] = $start_date;
			// $fn_data["cdsd_close_date"] = ;
			$fn_data["cdsd_closed"] = NOT_CLOSED;
			// $fn_data["subhead_id"] = ;
			$fn_data["deleted"] = NOT_DELETED;

			$this->cdsd->clear_row_data();
			$this->cdsd->set_row_data($fn_data);
			$cdsd_branch_id = $this->cdsd->insert_row();

			/* if($cdsd_type == CDSDModel::SD && $BID != 6) {
				//CREATE AN ACCOUNT IN HO
				unset($fn_data);
				$fn_data["bid"] = 6; // HEAD OFFICE
				$fn_data["cdsd_type"] = $cdsd_type;
				$sd_account_no = $this->cdsd->get_next_acc_no($fn_data);

				unset($fn_data);
				$fn_data["cdsd_type"] = $cdsd_type;
				$fn_data["sd_ho_id"] = 0;
				$fn_data["cdsd_acc_no"] = $sd_account_no;
				$fn_data["cdsd_oldacc_no"] = 0;
				$fn_data["user_type"] = $user_type;
				$fn_data["uid"] = $user_id;
				$fn_data["bid"] = 6;	//HEAD OFFICE
				$fn_data["cdsd_start_date"] = $start_date;
				// $fn_data["sd_close_date"] = ;
				$fn_data["cdsd_closed"] = NOT_CLOSED;
				// $fn_data["subhead_id"] = ;
				$fn_data["deleted"] = NOT_DELETED;

				$this->cdsd->clear_row_data();
				$this->cdsd->set_row_data($fn_data);
				$sd_ho_id = $this->cdsd->insert_row();

				//UPDATE BRANCH ACCOUNT'S "sd_ho_id" FIELD
				unset($fn_data);
				$fn_data[$this->cdsd->pk] = $cdsd_branch_id;
				$fn_data[$this->cdsd->sd_ho_id_field] = $sd_ho_id;
				$this->cdsd->clear_row_data();
				$this->cdsd->set_row_data($fn_data);
				// $this->sd->print_row_data($fn_data);
				$this->cdsd->update_row();

			} */
			return "done";
		}

		public function create_cdsd_transaction(Request $request)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);
			// print_r($in_data);return;

			$account_info = $this->cdsd->get_row(["{$this->cdsd->pk}"=>$in_data["cdsd_id"]]);
			$user_type = $account_info->{$this->cdsd->user_type_field};

			switch($user_type) {
				case 1:
						$temp_subhead_id = 156;
						break;
				case 2:
						$temp_subhead_id = 283;
						break;
				case 3:
						$temp_subhead_id = "";
						break;
				default:
						$temp_subhead_id = "";
			}

			$cdsd_acc_info = $this->cdsd->get_row(["cdsd_id"=>$in_data["cdsd_id"]]);

			unset($fn_data);
			$fn_data[$this->cdsd_tran->cdsd_id_field] = $in_data["cdsd_id"];
			$fn_data[$this->cdsd_tran->cdsd_type_field] = $in_data["cdsd_type"];
			$fn_data[$this->cdsd_tran->date_field] = $in_data["cdsd_tran_date"];
			$fn_data[$this->cdsd_tran->time_field] = date("H:i:s");
			$fn_data[$this->cdsd_tran->bid_field] = $cdsd_acc_info->bid;
			$fn_data[$this->cdsd_tran->transaction_type_field] = $in_data["cdsd_transaction_type"];
			$fn_data[$this->cdsd_tran->amount_field] = $in_data["cdsd_amount"];
			$fn_data[$this->cdsd_tran->paid_field] = PAID;
			$fn_data[$this->cdsd_tran->payment_mode_field] = $in_data["cdsd_payment_mode"];
			$fn_data[$this->cdsd_tran->particulars_field] = $in_data["cdsd_perticulars"];
			$fn_data[$this->cdsd_tran->interest_tran_field] = $in_data["is_interest_tran"];
			// $fn_data[$this->cdsd_tran->cheque_no_field] = "";
			// $fn_data[$this->cdsd_tran->cheque_date_field] = "";
			// $fn_data[$this->cdsd_tran->bank_id_field] = "";
			$fn_data[$this->cdsd_tran->subhead_id_field] = $temp_subhead_id;
			$fn_data[$this->cdsd_tran->deleted_field] = "";
		
			$this->cdsd_tran->clear_row_data();
			$this->cdsd_tran->set_row_data($fn_data);
			$sd_tran_id = $this->cdsd_tran->insert_row();
			/****** RV SD TRAN *****/
			if($in_data["cdsd_transaction_type"] == 1) {
				$rv_transaction_type = "CREDIT";
			} else {
				$rv_transaction_type = "DEBIT";
			}
			if($in_data["cdsd_payment_mode"] == 1) {
				$rv_payment_mode = "CASH";
			} else {
				$rv_payment_mode = "ADJUSTMENT";
			}
			unset($fn_data);
			$fn_data["rv_payment_mode"] = $rv_payment_mode;
			$fn_data["rv_transaction_id"] = $sd_tran_id;
			$fn_data["rv_transaction_type"] = $rv_transaction_type;
			$fn_data["rv_transaction_category"] = ReceiptVoucherModel::CDSD_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
			$fn_data["rv_date"] = $in_data["cdsd_tran_date"];
			$fn_data["rv_bid"] = $cdsd_acc_info->bid;
			$this->rv_no->save_rv_no($fn_data);
			unset($fn_data);
			/***********/
			return "done";
		}

		public function view_cdsd_tran(Request $request)
		{
			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);
			$cdsd_type = $in_data["cdsd_type"];
			$data["cdsd_type"] = $cdsd_type;

			$fn_data["cdsd_type"] = $cdsd_type;
			$fn_data["{$this->cdsd_tran->cdsd_id_field}"] = $in_data["cdsd_id"];
			$data["cdsd_tran"] = $this->cdsd_tran->get_cdsd_tran($fn_data);
			$cdsd_acc_info = $this->cdsd->get_row(["{$this->cdsd->pk}"=>$in_data["cdsd_id"]]);
			$data["cdsd_acc_info"]["name"] = "";
			$data["cdsd_acc_info"]["cdsd_acc_no"] = $cdsd_acc_info->cdsd_acc_no;
			$data["cdsd_acc_info"]["cdsd_oldacc_no"] = $cdsd_acc_info->cdsd_oldacc_no;
			return view("view_cdsd_tran", compact("data"));
		}

		public function cdsd_int_calc_all_acc(Request $request)
		{
			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);

			$cdsd_type = $in_data["cdsd_type"];
			$user_type = $in_data["user_type"];

			$fn_data["cdsd_type"] = $cdsd_type;
			$fn_data["user_type"] = $user_type;
			$fn_data["cdsd_int_calc_date"] = $in_data["cdsd_int_calc_date"];
			$fn_data["cdsd_int_rate"] = $in_data["cdsd_int_rate"];
			$this->creadepositmodel->cdsd_int_calc_all_acc($fn_data);
			return "done";
		}

		public function cdsd_close(Request $request)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$date = date("Y-m-d");
			$post_data = $request->input("post_data");
			$in_data = (array)json_decode($post_data);

			$cdsd_type = $in_data["cdsd_type"];
			$user_type =  $in_data["user_type"];

			$fn_data["cdsd_type"] = $cdsd_type;
			$fn_data["user_type"] = $user_type;
			$fn_data["preview"] = $in_data["preview"];
			$fn_data["cdsd_int_calc_date"] = $in_data["cdsd_int_calc_date"];
			$fn_data["cdsd_int_rate"] = $in_data["cdsd_int_rate"];
			$fn_data[$this->cdsd_tran->cdsd_id_field] = $in_data["cdsd_acc_id"];
			if($cdsd_type == 2) {
				$cdsd_interest = $this->creadepositmodel->cdsd_int_calc($fn_data);	//sd
			} else {
				$cdsd_interest = $this->creadepositmodel->cd_int_calc($fn_data);	//cd
			}

			if(strcasecmp($in_data["preview"],"NO") == 0) {
				$this->creadepositmodel->cdsd_close($fn_data);
				// $this->creadepositmodel->cdsd_close_interest(["cdsd_type"=>$cdsd_type, "user_type"=>$user_type, "cdsd_id"=>$in_data["cdsd_acc_id"], "date"=>$date]);
			} else {
				// $this->creadepositmodel->cdsd_create_int_tran(["cdsd_type"=>$cdsd_type, "cdsd_id"=>$in_data["cdsd_acc_id"]]);
			}
			return $cdsd_interest;
		}

		public function cdsd_int_create(Request $request)
		{
			$date = date("Y-m-d");
			$pd = $request->input("post_data");
			$id = (array)json_decode($pd);
			$cdsd_type = $id["cdsd_type"];
			$user_type = $id["user_type"];
			$id_list = (array)$id["id_list"];
			foreach($id_list as $val) {
				$this->creadepositmodel->cdsd_create_int_tran(["cdsd_type"=>$cdsd_type, "user_type"=>$user_type, "cdsd_id"=>$val, "date"=>$date]);
			}
			return "done";
		}

		public function cdsd_int_remove(Request $request)
		{
			$pd = $request->input("post_data");
			$id = (array)json_decode($pd);
			$cdsd_type = $id["cdsd_type"];
			$id_list = (array)$id["id_list"];
			foreach($id_list as $val) {
				$this->creadepositmodel->cdsd_int_remove(["cdsd_type"=>$cdsd_type, "cdsd_id"=>$val]);
			}
			return "done";
		}

		public function int_emp_agt(Request $request)
		{
			$pd = $request->input("post_data");
			$id = (array)json_decode($pd);
			$data["cdsd_type"] = $id["cdsd_type"];
			$data["user_type"] = $id["user_type"];
			// if($id["user_type"] == 1) {
				return view("cdsd_interest_index_user", compact("data"));
			// } else {
			// 	return view("cdsd_interest_index_agent", compact("data"));
			// }
		}

		public function close_emp_agt(Request $request)
		{
			$pd = $request->input("post_data");
			$id = (array)json_decode($pd);
			$data["cdsd_type"] = $id["cdsd_type"];
			$data["user_type"] = $id["user_type"];
			// if($id["close_emp_agt_type"] == 1) {
				return view("cdsd_close_index_user", compact("data"));
			// } else {
			// 	return view("cdsd_close_index_agent", compact("data"));
			// }
		}

		public function cdsd_pay_index(Request $request)
		{
			$data = [];
			$data["cdsd_type"] = $request->input("cdsd_type");
			return view("cdsd_pay_index",compact("data"));
		}

		public function cdsd_pay(Request $request)
		{
			$pd = $request->input("post_data");
			$id = (array)json_decode($pd);

			if(strcasecmp($id["pay_mode"], "CASH") == 0) {
				$temp_pay_mode = 1;
			} else {
				$temp_pay_mode = 2;
			}

			unset($fd);
			$fd["cdsd_type"] = $id["cdsd_type"];
			$fd["user_type"] = 0;
			$fd["payment_mode"] = $temp_pay_mode;
			$fd["closing_interest"] = "YES";
			$fd["cdsd_id"] = $id["cdsd_id"];
			$fd["date"] = date("Y-m-d");;
			// $this->creadepositmodel->cdsd_create_int_tran($fd);
			$this->creadepositmodel->cdsd_pay_closing_int($fd);

			unset($fd);
			$fd["cdsd_type"] = $id["cdsd_type"];
			$fd["cdsd_id"] = $id["cdsd_id"];
			$fd["pay_date"] = $id["pay_date"];
			$fd["pay_mode"] = $id["pay_mode"];
			$fd["sb_acc_id"] = $id["sb_acc_id"];
			$fd["bank"] = $id["bank"];
			$fd["cheque_no"] = $id["cheque_no"];
			$fd["cheque_date"] = $id["cheque_date"];
			$fd["pay_amt"] = $id["pay_amt"];
			$this->creadepositmodel->cdsd_pay($fd);

			switch($id["pay_mode"]) {
				case "CHEQUE":
					unset($fd);
					$fd["cdsd_type"] = $id["cdsd_type"];
					$fd["cdsd_id"] = $id["cdsd_id"];
					$fd["pay_mode"] = $id["pay_mode"];
					$fd["bank"] = $id["bank"];
					$fd["cheque_no"] = $id["cheque_no"];
					$fd["cheque_date"] = $id["cheque_date"];
					$fd["pay_amt"] = $id["pay_amt"];
					$this->creadepositmodel->cdsd_pay_cheque_entry($fd);
					break;
				case "SB":
					unset($fd);
					$fd["pay_amt"] = $id["pay_amt"];
					$fd["sb_acc_id"] = $id["sb_acc_id"];
					$this->creadepositmodel->cdsd_pay_sb_entry($fd);
					break;
			}
			return "done";
		}

		public function cdsd_acc_details(Request $request)
		{
			$pd = $request->input("pd");
			$id = (array)json_decode($pd);
			$fd["cdsd_type"] = $id["cdsd_type"];
			$fd["cdsd_id"] = $id["cdsd_id"];

			$ret_data["bal_amt"] = $this->cdsd_tran->get_cdsd_amount($fd);
			$ret_data["acc_info"] = $this->creadepositmodel->get_cdsd_acc_info($fd);
			
			return $ret_data;
		}

//CD
		
		public function cd_index()
		{
			$data["cdsd_type"] = CDSDModel::CD;
			return view("cdsd_index",compact('data'));
		}

	}
