<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;

	class ExpenceModel extends Model
	{
		protected $table = 'expense';

		public function __construct()
		{
			$this->rv_no = new ReceiptVoucherController;
		}
		
		public function insert($id)
		{
			$dte=date('d-m-Y');
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
			$respit3=$respit2->payment_voucher_No;
			$r1=$respit3+1;
			DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r1]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','Branch.Bid')
		    ->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->Bid;
			$uid=$udetail->Uid;
			
			$bankID=$id['bank'];
			$amount1=$id['ta'];
			//$bran=$id['branch'];
			$pay=$id['paymode'];
			$particlr=$id['parti'];
			
			$id = DB::table('expense')->insertGetId(['e_date'=> $dte,'cheque_no'=>$id['chqno'],'cheque_date'=>$id['chdate'],'Bid'=>$id['branchid'],'bank'=>$id['bankName'],'bank_id'=>$id['bank'],'pay_mode'=>$id['paymode'],'amount'=>$id['ta'],'Particulars'=>$id['parti'],'ChequeClear_State'=>$id['unclearedval'],'ExpenseBy'=>$uid,'Expence_PamentVoucher'=>$r1]);
			
			$totamt=DB::table('addbank')->select('TotalAmt')
			->where('Bankid','=',$bankID)
			->first();
			$tt=$totamt->TotalAmt;
			$amt=$tt-$amount1;
			DB::table('addbank')->where('Bankid','=',$bankID)
			->update(['TotalAmt'=>$amt]);
			
			if($pay=="CASH")
			{
				$incash=DB::table('cash')->select('InHandCash')
				->where('BID','=',$b)
				->first();
				
				$cash=$incash->InHandCash;
				$totincash=$cash+$amount1;
				
				DB::table('cash')->where('BID',$b)
				->update(['InHandCash'=>$totincash]);
				
				$trandate=date('Y-m-d');
				$bid=$udetail->Bid;
				//$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>$particlr,'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$cash,'Total_InhandCash'=>$totincash]);
			}
			return $id;
		}
		
		public function GetBankDetail($id)
		{
			return DB::table('addbank')
			->select('Branch','AddBank_IFSC','TotalAmt')
			->where('Bankid','=',$id)
			->first();
		}
		
		public function insert_tran($id)
		{
			$dte=date('Y-m-d');
			$bankID=$id['bank'];
			$bankID2=$id['bank2'];
			$amount1=$id['ta'];
			//$bran=$id['branch'];
			$particulars = $id["particulars"];

			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
			$respit3=$respit2->payment_voucher_No;
			$r1=$respit3+1;
			DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r1]);
			// $head_lid = 57;
			// switch($BID) {
			// 	case 1: $subhead_lid = 61;break;
			// 	case 2: $subhead_lid = 64;break;
			// 	case 3: $subhead_lid = 62;break;
			// 	case 4: $subhead_lid = 63;break;
			// 	case 5: $subhead_lid = 65;break;
			// }
			// $id = DB::table('expense')->insertGetId(['Head_lid'=>$head_lid,'SubHead_lid'=>$subhead_lid,'bank'=> $id['bankName'],'Bid'=>$BID,'amount'=>$id['ta'],'e_date'=>$dte,'bank_id'=>$id['bank'],'bank2id'=>$id['bank2'],'bank2'=> $id['bankName2'],'Expence_PamentVoucher'=>$r1,'pay_mode'=>"BankToBank",'ExpenseBy'=>$UID]);
		
			/************************ BANK TO BANK *********************/
				// GET BIDs
					$BID1 = DB::TABLE("addbank")
						->where("Bankid", $bankID)
						->value("Bid");
					$BID2 = DB::TABLE("addbank")
						->where("Bankid", $bankID2)
						->value("Bid");


				// Debit from Bank1 TO BRANCH1
					$addbank = DB::table('addbank')
					->where('Bankid','=',$bankID)
					->first();
					$Deposit_type = "WITHDRAWL";

					$insert_array["Bid"] = $BID1;
					$insert_array["d_date"] = date("d-m-Y",strtotime($dte));
					$insert_array["date"] = date("Y-m-d",strtotime($dte));
					$insert_array["Branch"] = $addbank->Branch;
					$insert_array["depo_bank"] = $addbank->BankName;
					$insert_array["depo_bank_id"] = $addbank->Bankid;
					$insert_array["pay_mode"] = "ADJUSTMENT";
					$insert_array["cheque_no"] = "";
					$insert_array["cheque_date"] = "";
					$insert_array["bank_name"] = "";
					$insert_array["amount"] = $amount1;
					$insert_array["paid"] = "yes";
					$insert_array["reason"] = $particulars;
					// $insert_array["cd"] = "";
					$insert_array["Deposit_type"] = $Deposit_type;
					$insert_id1 = DB::table("deposit")
						->insertGetId($insert_array);
					unset($insert_array);
					//ADJ CREDIT - NO ADJ NO.

				// BRANCH TO BRANCH (B1 to B2)
					$head = 57;
					$subhead = 0;
					switch($BID1) {
						case 1: $subhead = 61;break;
						case 2: $subhead = 64;break;
						case 3: $subhead = 62;break;
						case 4: $subhead = 63;break;
						case 5: $subhead = 65;break;
					}

					$insert_array["Branch_Branch1_Id"] = $BID1;
					$insert_array["Branch_Branch2_Id"] = $BID2;
					$insert_array["Branch_Tran_Date"] = $dte;
					$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
					$insert_array["LedgerHeadId"] = $head;
					$insert_array["SubLedgerId"] = $subhead;
					$insert_array["Branch_Amount"] = $amount1;
					$insert_array["Branch_per"] = $particulars;
					$branch_to_branch_id = DB::table("branch_to_branch")
						->insertGetId($insert_array);
					unset($insert_array);
					//GENERATE ADJ NO. FOR $BID1
						/***********/
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $branch_to_branch_id;
						$fn_data["rv_transaction_type"] = "DEBIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $dte;
						$fn_data["rv_bid"] = $BID1;
						$adj_no = $this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						/***********/

				// CREDIT TO BANK2 FROM BRANCH2
					$addbank = DB::table('addbank')
					->where('Bankid','=',$bankID2)
					->first();
					$Deposit_type = "Deposit";

					$insert_array["Bid"] = $BID2;
					$insert_array["d_date"] = date("d-m-Y",strtotime($dte));
					$insert_array["date"] = date("Y-m-d",strtotime($dte));
					$insert_array["Branch"] = $addbank->Branch;
					$insert_array["depo_bank"] = $addbank->BankName;
					$insert_array["depo_bank_id"] = $addbank->Bankid;
					$insert_array["pay_mode"] = "ADJUSTMENT";
					$insert_array["cheque_no"] = "";
					$insert_array["cheque_date"] = "";
					$insert_array["bank_name"] = "";
					$insert_array["amount"] = $amount1;
					$insert_array["paid"] = "yes";
					$insert_array["reason"] = $particulars;
					// $insert_array["cd"] = "";
					$insert_array["Deposit_type"] = $Deposit_type;
					$insert_id2 = DB::table("deposit")
						->insertGetId($insert_array);
					unset($insert_array);
					//GENERATE ADJ NO. FOR $BID2
						/***********/
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $insert_id2;
						$fn_data["rv_transaction_type"] = "DEBIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $dte;
						$fn_data["rv_bid"] = $BID2;
						$adj_no = $this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						/***********/
			/************************ BANK TO BANK *********************/

			$totamt=DB::table('addbank')->select('TotalAmt')
			->where('Bankid','=',$bankID)
			->first();
			$totamt2=DB::table('addbank')->select('TotalAmt')
			->where('Bankid','=',$bankID2)
			->first();
			$tt=$totamt->TotalAmt;
			$tt2=$totamt2->TotalAmt;
			$amt=$tt-$amount1;
			$amt2=$tt2+$amount1;
			DB::table('addbank')->where('Bankid','=',$bankID)
			->update(['TotalAmt'=>$amt]);
			
			
			DB::table('addbank')->where('Bankid','=',$bankID2)
			->update(['TotalAmt'=>$amt2]);
			
			return $id;
		}
		
		
		public function getExpensedata()//T 29/4
		{
			$id = DB::table('legder')->select('lname','lid')
			->where('subhead','=',0)
			->get();
			return $id;
			
		}
		
		public function GetExpenseDropD($id) //For Branch wise Report T 29/4
		{
			$ExpenseID=$id['BranchID'];
			
			
			$ExpenseListBW = DB::table('legder')->select('subhead')
			//->leftJoin('expense','lid.Bid','=','legder.Bid')
			
			->get();
			//print_r($AgentListBW);
			
			return $ExpenseListBW;
			
			
		}
		
		public function GetSubLedgerHead($id)
		{
			
			$Lid = $id['LedgerId'];
			//print_r($Lid);
			$SubHead = DB::table('legder')->where('subhead','=',$Lid)
			->select('lid','lname')
			->get();
			//print_r($SubHead);
			return $SubHead;
		}
		
		/*	public function GetExpenceData()
			{
			$id['expense']= DB::table('expense')->select('id','e_date','cheque_no','cheque_date','Bid','bank','bank_id','Bank2','bank2id','pay_mode','amount','Particulars','ChequeClear_Date','ChequeClear_State','Chqbounce_charge','ExpenseBy')
			->paginate(10);
			
			$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','expence')
			->first();
			
			return $id;
		}*/
		public function insertinhand($id)
		{
			$dte=date('d-m-Y');
			$trandate=date('Y-m-d');
			$m=date('m');
			$y=date('Y');
			$tm=date('h:i:s');
			$particlr=$id['parti'];
			$particlr1=$id['parti1'];
			$accnum=$id['accnum'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$BID=$uname->Bid;
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
			$respit3=$respit2->payment_voucher_No;
			$r1=$respit3+1;
			DB::table('branch')->where('Bid',$BID)->update(['payment_voucher_No'=>$r1]);
			
			
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','branch.Bid')
		    ->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->Bid;
			$uid=$udetail->Uid;
			$amount1=$id['ta1'];
			$amount1_cheq=$id['ta'];
			$paydone=$id['paydone'];
			
			
			if($paydone=="INHAND")
			{
				//$inh=$id['ta1'];
				//echo "hai".$inh;
				$expense_id = DB::table('expense')->insertGetId(['e_date'=>$trandate,'Bid'=>$id['branchid'],'pay_mode'=>$id['paydone'],'amount'=>$id['ta1'],'Particulars'=>$id['parti1'],'ExpenseBy'=>$uid,'Head_lid'=>$id['exphead'],'SubHead_lid'=>$id['expsubhead'],'Expence_PamentVoucher'=>$r1]);
				
				$incash=DB::table('cash')->select('InHandCash')
				->where('BID','=',$b)
				->first();
				
				$cash=$incash->InHandCash;
				$totincash=$cash-$amount1;
				
				DB::table('cash')->where('BID',$b)
				->update(['InHandCash'=>$totincash]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>$particlr,'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$b,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$cash,'Total_InhandCash'=>$totincash]);
				
				
			}    
			else if($paydone=="CHEQUE")
			{
				
				$bankID=$id['bankid'];
				
				$expense_id = DB::table('expense')->insertGetId(['e_date'=> $trandate,'cheque_date'=>$id['chdate'],'cheque_no'=>$id['chqno'],'Bid'=>$id['branchid'],'bank'=>$id['bankName'],'bank_id'=>$id['bankid'],'pay_mode'=>$id['paydone'],'amount'=>$id['ta'],'Particulars'=>$id['parti'],'ChequeClear_State'=>$id['unclearedval'],'ExpenseBy'=>$uid,'Head_lid'=>$id['exphead'],'SubHead_lid'=>$id['expsubhead'],'Expence_PamentVoucher'=>$r1]);
				
				$totamt=DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bankID)
				->first();
				
				
				$tt=$totamt->TotalAmt;
				$amt=$tt-$amount1_cheq;
				DB::table('addbank')->where('Bankid','=',$bankID)
				->update(['TotalAmt'=>$amt]);
				
				//
				$addbank = DB::table('addbank')
				->where('Bankid','=',$bankID)
				->first();

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = $dte;
				$insert_array["date"] = $trandate;
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "CHEQUE";
				$insert_array["cheque_no"] = $id['chqno'];
				$insert_array["cheque_date"] = $id['chdate'];
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $id['ta'];
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = "EXPENSE THROUGH CHEQUE";
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = "WITHDRAWL";

				DB::table("deposit")
					->insertGetId($insert_array);
				//NO NEED TO GENERATE RECEIPT/VOUCHER NO FOR ADJ CREDIT TRANSACTION
			}
			else if($paydone=="SB")
			{
				$ca1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accnum)->first();
				$ca=$ca1->Total_Amount;
				$tot=$ca+$amount1;
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$accnum,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>$particlr1,'Amount'=>$amount1,'CurrentBalance'=>$ca,'tran_Date'=>$dte,'SBReport_TranDate'=>$trandate,'Time'=>$tm,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$tot,'Bid'=>$BID,'Payment_Mode'=>"SB",'CreatedBy'=>$UID]);
				
				$expense_id = DB::table('expense')->insertGetId(['Head_lid'=>$id['exphead'],'SubHead_lid'=>$id['expsubhead'],'Bid'=>$BID,'e_date'=>$trandate,'pay_mode'=>"SB",'amount'=>$amount1,'Particulars'=>$particlr1,'ExpenseBy'=>$uid]);
				
				DB::table('createaccount')
				->where('Accid',$accnum)
				->update(['Total_Amount'=>$tot]);
			}
			else if($paydone=="ADJUSTMENT")
			{
				$bankID=$id['bankid'];
				
				$expense_id = DB::table('expense')->insertGetId(['e_date'=> $trandate,'cheque_date'=>'0000-00-00','cheque_no'=>'0','Bid'=>$BID,'bank'=>$id['bankName'],'bank_id'=>$id['bankid'],'pay_mode'=>$id['paydone'],'amount'=>$id['ta'],'Particulars'=>$id['parti'],'ChequeClear_State'=>$id['unclearedval'],'ExpenseBy'=>$uid,'Head_lid'=>$id['exphead'],'SubHead_lid'=>$id['expsubhead'],'Expence_PamentVoucher'=>$r1]);
				
				$totamt=DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bankID)
				->first();
				
				
				$tt=$totamt->TotalAmt;
				$amt=$tt-$amount1_cheq;
				DB::table('addbank')->where('Bankid','=',$bankID)
				->update(['TotalAmt'=>$amt]);
			}

				/***********/
				$fn_data["rv_payment_mode"] = $paydone;
				$fn_data["rv_transaction_id"] = $expense_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::EXPENSE;//constant EXPENSE is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $trandate;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			return;
		}
		
		public function GetExpenceData()
		{
			$id= DB::table('expense')->select('id','e_date','cheque_no','cheque_date','Bid','bank','bank_id','Bank2','bank2id','pay_mode','amount','Particulars','ChequeClear_Date','ChequeClear_State','Chqbounce_charge','ExpenseBy')
			->paginate(10);
			
			
			return $id;
		}
		
		
		public function GetPayMode($q)
		{
			return DB::select("SELECT `id` as id,`pay_mode` as name FROM `expense` where `pay_mode` LIKE '%".$q."%' ");
		}
		
		
		
		public function GetExpenseModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','expenseReport')
			->first();
			return $id;
		}
		public function GetAllExpence()
		{
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$ib= DB::table('expense')->select('e_date','amount','Particulars','Expence_PamentVoucher','lname','id')
			->leftjoin('legder','legder.lid','=','SubHead_lid')
			->where('Bid',$BID)
			->get();
			return $ib;
		}
		public function transferbranchamt($id)
		{
			$dte=date('Y-m-d');
			$b1=$id['Br1'];
			$b2=$id['Br2'];
			$amount=$id['amt'];
			$per=$id['per'];
			$tt=$id['tt'];
			$hid=$id['hid'];
			$sid=$id['sid'];
			if($tt=="ADJUSTMENT")
			{
			}
			else
			{
				$incashB1=DB::table('cash')->select('InHandCash')
				->where('BID','=',$b1)
				->first();
				$cashB1=$incashB1->InHandCash;
				$totB1=$cashB1-$amount;
				
				$incashB2=DB::table('cash')->select('InHandCash')
				->where('BID','=',$b2)
				->first();
				$cashB2=$incashB2->InHandCash;
				$totB2=$cashB2+$amount;
				
				
				DB::table('cash')->where('BID',$b1)
				->update(['InHandCash'=>$totB1]);
				
				DB::table('cash')->where('BID',$b2)
				->update(['InHandCash'=>$totB2]);
			}
			
			if($tt=="ADJUSTMENT")
			{
				$b2b_tran_id = DB::table('branch_to_branch')->insertGetId(['Branch_Branch1_Id'=>$id['Br2'],'Branch_Branch2_Id'=>$id['Br1'],'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$id['amt'],'Branch_per'=>$per,'Branch_payment_Mode'=>$tt,'LedgerHeadId'=>$hid,'SubLedgerId'=>$sid]);

				/***********/
				$fn_data["rv_payment_mode"] = $tt;
				$fn_data["rv_transaction_id"] = $b2b_tran_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = $id['Br2'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				/***********/
				$fn_data["rv_payment_mode"] = $tt;
				$fn_data["rv_transaction_id"] = $b2b_tran_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = $id['Br1'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			}
			else	//INHAND
			{
				$b2b_tran_id = DB::table('branch_to_branch')->insertGetId(['Branch_Branch1_Id'=>$id['Br1'],'Branch_Branch2_Id'=>$id['Br2'],'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$id['amt'],'Branch_per'=>$per,'Branch_payment_Mode'=>$tt,'LedgerHeadId'=>$hid,'SubLedgerId'=>$sid]);

				/***********/
				$fn_data["rv_payment_mode"] = $tt;
				$fn_data["rv_transaction_id"] = $b2b_tran_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = $id['Br1'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				/***********/
				$fn_data["rv_payment_mode"] = $tt;
				$fn_data["rv_transaction_id"] = $b2b_tran_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = $id['Br2'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			}

/* 			if($id['Br1'] == 6 && strcasecmp($tt,"ADJUSTMENT") == 0) {
				DB::table('branch_to_branch')->insert(['Branch_Branch1_Id'=>$id['Br2'],'Branch_Branch2_Id'=>$id['Br1'],'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$id['amt'],'Branch_per'=>$per,'Branch_payment_Mode'=>$tt,'LedgerHeadId'=>$hid,'SubLedgerId'=>$sid]);
			} */
			
		}
		public function GetExpenceReceipt($id)
		{
			$ib= DB::table('expense')->select('e_date','amount','Particulars','Expence_PamentVoucher','lname','id')
			->leftjoin('legder','legder.lid','=','SubHead_lid')
			->where('id','=',$id)
			->get();
			return $ib;
		}
		public function GetAllIncome()
		{
			$ib= DB::table('income')->select('Income_date','Income_amount','Income_Particulars','Income_Expence_PamentVoucher','lname','Income_id')
			->leftjoin('legder','legder.lid','=','Income_SubHead_lid')
			
			->get();
			return $ib;
		}
		public function createincomes($id)
		{
			$dte=date('d-m-Y');
			$trandate=date('Y-m-d');
			$m=date('m');
			$y=date('Y');
			$tm=date('h:i:s');
			$particlr=$id['parti1'];
			$accnum=$id['accnum'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$BID=$uname->Bid;
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
			$respit3=$respit2->payment_voucher_No;
			$r1=$respit3+1;
			DB::table('branch')->where('Bid',$BID)->update(['payment_voucher_No'=>$r1]);
			
			
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','branch.Bid')
		    ->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->Bid;
			$uid=$udetail->Uid;
			$amount1=$id['ta1'];
			$paydone=$id['paydone'];
			
			
			if($paydone=="INHAND")
			{
				//$inh=$id['ta1'];
				//echo "hai".$inh;
				$income_id = DB::table('income')->insertGetId(['Income_date'=>$trandate,'Bid'=>$id['branchid'],'Income_pay_mode'=>$id['paydone'],'Income_amount'=>$amount1,'Income_Particulars'=>$particlr,'Income_ExpenseBy'=>$uid,'Income_Head_lid'=>$id['incomehead'],'Income_SubHead_lid'=>$id['incomesubhead'],'Income_Expence_PamentVoucher'=>$r1]);
				
				$incash=DB::table('cash')->select('InHandCash')
				->where('BID','=',$b)
				->first();
				
				$cash=$incash->InHandCash;
				$totincash=$cash+$amount1;
				
				DB::table('cash')->where('BID',$b)
				->update(['InHandCash'=>$totincash]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>$particlr,'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$b,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$cash,'Total_InhandCash'=>$totincash]);
				
				
			}    
			else if($paydone=="CHEQUE")
			{
				
				$bankID=$id['bankid'];
				
				$income_id = DB::table('income')->insertGetId(['Income_date'=> $trandate,'Income_cheque_date'=>$id['chdate'],'Income_cheque_no'=>$id['chqno'],'Bid'=>$id['branchid'],'Income_bank'=>$id['bankName'],'Income_bank_id'=>$id['bankid'],'Income_pay_mode'=>$id['paydone'],'Income_amount'=>$amount1,'Income_Particulars'=>$particlr,'Income_ChequeClear_State'=>$id['unclearedval'],'Income_ExpenseBy'=>$uid,'Income_Head_lid'=>$id['incomehead'],'Income_SubHead_lid'=>$id['incomesubhead'],'Income_Expence_PamentVoucher'=>$r1]);
				
				$totamt=DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bankID)
				->first();
				
				
				$tt=$totamt->TotalAmt;
				$amt=$tt+$amount1;
				DB::table('addbank')->where('Bankid','=',$bankID)
				->update(['TotalAmt'=>$amt]);

				//
				$addbank = DB::table('addbank')
				->where('Bankid','=',$bankID)
				->first();

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = $dte;
				$insert_array["date"] = $trandate;
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "CHEQUE";
				$insert_array["cheque_no"] = $id['chqno'];
				$insert_array["cheque_date"] = $id['chdate'];
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $amount1;
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = "INCOME THROUGH CHEQUE";
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = "Deposit";

				$deposit_id = DB::table("deposit")
					->insertGetId($insert_array);
					
				/***********/
				$fn_data["rv_payment_mode"] = $paydone;
				$fn_data["rv_transaction_id"] = $deposit_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $trandate;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			}
			else if($paydone=="SB")
			{
				$ca1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accnum)->first();
				$ca=$ca1->Total_Amount;
				$tot=$ca-$amount1;
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$accnum,'AccTid'=>"1",'TransactionType'=>"DEBIT",'particulars'=>$particlr,'Amount'=>$amount1,'CurrentBalance'=>$ca,'tran_Date'=>$dte,'SBReport_TranDate'=>$trandate,'Time'=>$tm,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$tot,'Bid'=>$BID,'Payment_Mode'=>"SB",'CreatedBy'=>$UID]);
				
				DB::table('createaccount')
				->where('Accid',$accnum)
				->update(['Total_Amount'=>$tot]);
			}
/*EDIT 22SEP2017*/
			else if($paydone=="ADJUSTMENT")
			{
				$bankID=$id['bankid2'];
				
				$income_id = DB::table('income')->insertGetId(['Income_date'=> $trandate,'Income_cheque_date'=>'adjustment','Income_cheque_no'=>'adjustment','Bid'=>$id['branchid'],'Income_bank'=>$id['bankName2'],'Income_bank_id'=>$id['bankid2'],'Income_pay_mode'=>$id['paydone'],'Income_amount'=>$amount1,'Income_Particulars'=>$particlr,'Income_ChequeClear_State'=>'','Income_ExpenseBy'=>$uid,'Income_Head_lid'=>$id['incomehead'],'Income_SubHead_lid'=>$id['incomesubhead'],'Income_Expence_PamentVoucher'=>$r1]);
				
				$totamt=DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bankID)
				->first();
				
				$tt=$totamt->TotalAmt;
				$amt=$tt+$amount1;
				DB::table('addbank')->where('Bankid','=',$bankID)
				->update(['TotalAmt'=>$amt]);

					//	ADJUSTMENT DEBIT ENTRY FOR BANK
					/*************/
						$bank_id = $id['bankid2'];
						$reason = "Income Adjustment";
						$Deposit_type = "WITHDRAWL";
						$addbank = DB::table('addbank')
						->where('Bankid','=',$bank_id)
						->first();
						
						unset($insert_array_deposit);
						$insert_array_deposit["Bid"] = $BID;
						$insert_array_deposit["d_date"] = date("d-m-Y",strtotime($trandate));
						$insert_array_deposit["date"] = date("Y-m-d",strtotime($trandate));
						$insert_array_deposit["Branch"] = $addbank->Branch;
						$insert_array_deposit["depo_bank"] = $addbank->BankName;
						$insert_array_deposit["depo_bank_id"] = $addbank->Bankid;
						$insert_array_deposit["pay_mode"] = "ADJUSTMENT";
						// $insert_array_deposit["cheque_no"] = $cheque_no;
						// $insert_array_deposit["cheque_date"] = $cheque_date;
						// $insert_array_deposit["bank_name"] = "";
						$insert_array_deposit["amount"] = $amount1;
						$insert_array_deposit["paid"] = "yes";
						$insert_array_deposit["reason"] = $reason;
						// $insert_array_deposit["cd"] = "";
						$insert_array_deposit["Deposit_type"] = $Deposit_type;

						$deposit_insert_id = DB::table("deposit")
							->insertGetId($insert_array_deposit);
							
										//	ADJ NO FOR BANK ENTRY
										/***********/
										unset($fn_data);
										$fn_data["rv_payment_mode"] = "ADJUSTMENT";
										$fn_data["rv_transaction_id"] = $deposit_insert_id;
										$fn_data["rv_transaction_type"] = "DEBIT";
										$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;
										$fn_data["rv_date"] = $trandate;
										$fn_ret_data = $this->rv_no->save_rv_no($fn_data);
										/***********/
					/*************/

				

			}
/*EDIT END 22SEP2017*/

				/***********/
				$fn_data["rv_payment_mode"] = $paydone;
				$fn_data["rv_transaction_id"] = $income_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::INCOME;//constant INCOME is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $trandate;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
		}
		
		public function GetIncomeReceipt($id)
		{
			$ib= DB::table('income')->select('Income_date','Income_amount','Income_Particulars','Income_Expence_PamentVoucher','lname','Income_id')
			->leftjoin('legder','legder.lid','=','Income_SubHead_lid')
			->where('Income_id','=',$id)
			->get();
			return $ib;
		}
		public function getExpensetran()
		{
		
		$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			return DB::table('branch_to_branch')
			->leftJoin('branch','branch.Bid','=','branch_to_branch.Branch_Branch1_Id')
			->where('Branch_Branch2_Id','=',$BID)
			->orderBy("Branch_Id",'desc')
			->get();
			
			
		}
	}

