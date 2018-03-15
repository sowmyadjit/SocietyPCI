<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ledgermodel;
	use DB;
	use App\Http\Model\ExpenceModel;
	class ledgercontroller extends Controller
	{
		var $ledger;
		public function __construct()
		{
			$this->ledger = new ledgermodel;
			$this->creadexpencemodel = new ExpenceModel;
		}
		
		
		public function show_led()
		{
			$data['led']=$this->ledger->getled();
			$data['ledk']=$this->ledger->getledka();
			$data['ledger']=$this->ledger->getleddata();
			$data['kledger']=$this->ledger->getkadata();
			
			return view('ledgerhead',compact('data'));
		}
		
		
		
		
		
		
		
		public function Show_ledgerDetails($id,$type=null){
			
			$ede['ledger']=$this->ledger->Getledger($id);
			$ede['ledgers']=$this->ledger->getleddata();//added by manju
			if($type!=null)
			$ede['type']='edit';
			else
			$ede['type']='';
			return view('ledgerdetails',compact('ede'));
			
		}
		
		public function create_led(Request $request)
		{
			$ledger['lhname']=$request->input('lhname');
			$ledger['date']=$request->input('date');
			$ledger['kanlhname']=$request->input('kanlhname');
			$ledger['kdate']=$request->input('kdate');
			
			
			$id=$this->ledger->insert($ledger);
			//echo $id;
			//user::create($user);
			//return redirect()->route('/ledger');
			return redirect('/ledger');
		}
		
		public function create_ledger(Request $request)
		{
			$led['ledgerhead']=$request->input('ledgerhead');
			$led['subhead']=$request->input('subhead');
			$led['sdate']=$request->input('sdate');
			$led['kledgerhead']=$request->input('kledgerhead');
			$led['kansubhead']=$request->input('kansubhead');
			// $led['ksdate']=$request->input('ksdate');
			
			$id=$this->ledger->insertion($led);
			//echo $id;
			//user::create($user);
			return redirect('/ledger');
			
		}
		
		public function Updateledger(Request $request)
		{
			$ledger['Lid']=$request->input('Lid');
			$ledger['lhname']=$request->input('lhname');
			$ledger['date']=$request->input('date');
			$ledger['subhead']=$request->input('subhead');
			$ledger['kahead']=$request->input('kahead');
			$ledger['kasubhead']=$request->input('kasubhead');
			$ledger['kdate']=$request->input('kdate');
			
			$id=$this->ledger->updateledger($ledger);
			return redirect('/');
		}
		
		public function ledgerReport(Request $request)
		{
			//$ledger=$this->ledger->test();
			//return;
			$from_date = $request->input('from_date');
			$to_date = $request->input('to_date');
			$data = array('from_date'=>$from_date, 'to_date'=>$to_date);
			if(!empty($from_date) && !empty($to_date) ){
				
				$ledger=$this->ledger->ledgerhead($data);
				return view('ledgerview',compact('ledger'));
			}
			
			return view('ledgerview_getdate',compact('ledger'));
		}
		
		public function balanceSheet(Request $request)
		{
			/*$from_date = $request->input('from_date');
				$to_date = $request->input('to_date');
				$data = array('from_date'=>$from_date, 'to_date'=>$to_date);
				if(!empty($from_date) && !empty($to_date) ){
				
				$ledger=$this->ledger->balanceSheet($data);
				return view('balanceSheet',compact('ledger'));
				}
			*/
			$tables = DB::select('SHOW TABLES');
			
			foreach($tables as $table)
			{
				echo $table->Tables_in_society;
			}
			//return view('balanceSheet_getdate',compact('ledger'));
		}
		public function create_head_subhead(Request $request)
		{
			$tables = DB::select('SHOW TABLES');
			
			foreach($tables as $table)
			{
				$tablename[]=$table->Tables_in_society;
			}
			$data['head']=$this->creadexpencemodel->getExpensedata();
			$data['tablename']=$tablename;
			
			return view('create_head_subhead',compact('data'));
		}
		public function GetFieldNames(Request $request)
		{
		
		$table=$request->input('table');
		return DB::getSchemaBuilder()->getColumnListing($table);
		
			}
		public function LedSingleDetails($id)
		{
			//$ledger=$this->ledger->LedSingleDetails($id);
			
			//return view('ledgersingleview',compact('ledger'));
			
		}
		
		public function create_all_head_subhead(Request $request)
		{
			$data['table_name']=$request->input('table_name');
			$data['Headid']=$request->input('Headid');
			$data['Amount_field']=$request->input('Amount_field');
			$data['Date_field']=$request->input('Date_field');
			$data['where_clause']=$request->input('where_clause');
			$data['where_clause_value']=$request->input('where_clause_value');
			$data['where_clause_num']=$request->input('where_clause_num');
			$data['bid_field']=$request->input('bid_field');
			$data['type']=$request->input('type');
			
			$this->ledger->create_all_head_subhead($data);
		}
		
		public function gernalentry(Request $request)
		{
			
			$dte=date('Y-m-d');
		
			$data['Headid']=$request->input('exphead');
			$data['Subid']=$request->input('expsubhead');
			$data['Date']=$dte;
			$data['particulars']=$request->input('parti1');
			$data['amt']=$request->input('ta1');
			$data['bid']=$request->input('bid');
			$data['type']=$request->input('type');
			$this->ledger->gernalentry($data);
		}
		public function Journal_entry()
		{
			$Url="expence";
			$led['module']=$this->Modules->GetAnyMid($Url);
			$led['expense']=$this->creadexpencemodel->getExpensedata();
			return view('Journal_entry',compact('led'));
		}
		
		public function update_head_subhead(Request $request)
		{
			$update = $request->input("update");
			if(empty($update)) {
				$data['head']=DB::table('legder')->where("subhead","=",0)->get();
				//ledgertableandfieldsname
				return view('update_head_subhead_getdata',compact('data'));
			} else if($update == 1) {
				$head_id = $request->input("head_id");
				$data['det'] = $this->ledger->update_head_subhead_selectdata($head_id);
				return view('update_head_subhead_selectdata',compact('data'));
			} else if($update == 2){
				$entry_id = $request->input("entry_id");
				$entry_data = $this->ledger->get_subhead_entry_data($entry_id);
			
					$tables = DB::select('SHOW TABLES');
					foreach($tables as $table)
					{
						$tablename[]=$table->Tables_in_society;
					}
					$data['head']=DB::table('legder')->get();
					$data['tablename']=$tablename;
			
				return view('update_head_subhead',compact('data','entry_data'));
			} else if($update == 3) {
				$data['entry_id']=$request->input('entry_id');
				$data['table_name']=$request->input('table_name');
				$data['Headid']=$request->input('Headid');
				$data['Amount_field']=$request->input('Amount_field');
				$data['Date_field']=$request->input('Date_field');
				$data['where_id']=$request->input('where_id');
				$data['where_clause']=$request->input('where_clause');
				$data['where_clause_value']=$request->input('where_clause_value');
				$data['where_clause_num']=$request->input('where_clause_num');
				$data['bid_field']=$request->input('bid_field');
				$data['type']=$request->input('type');
				
				$this->ledger->update_head_subhead($data);
			
			}
		}
		
	}
