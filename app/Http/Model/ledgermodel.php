<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	class ledgermodel extends Model
	{
		protected $table='legder';
		
		public function getleddata()
		{
			$id = DB::table('legder')->select('lname','lid')
			->where('subhead','=',0)
			->get();
			return $id;
			
		}
		
		public function GetSubHeads()
		{
			$id = DB::table('legder')->select('lname','lid')
			->where('subhead','<>',0)
			->get();
			return $id;
			
		}
		
		public function GetAllHeads()
		{
			$id = DB::table('legder')->select('lname','lid')
			->get();
			return $id;
			
		}
		
		
		
		public function insert($id)
		{
			$id = DB::table('legder')->insertGetId(['lname'=> $id['lhname'],'kadate'=>$id['date']]);
		}
		
		public function insertion($id)
		{
			DB::table('legder')->insertGetId(['lname'=> $id['subhead'],'subhead'=>$id['ledgerhead']]);
		}
		
		/*public function insertingj($id)
			{
			$id = DB::table('legder')->insertGetId(['date'=>$id['date'],'amountdebit'=>$id['adebit'],'amountcredit'=>$id['acredit'],'narration'=>$id['narration'],'toparticulars'=>$id['topar']]);
		}*/
		
		
		public function Getledger($id)
		{
			return DB::table('legder')->select('lid','lname','subhead')
			
			->where('lid',$id)
			->get();
		}
		
		public function getkadata()
		{
			$id = DB::table('legder')->select('kalname','lid')->get();
			return $id;
			
		}
		
		
		
		public function	getledka()
		{
			
			$id['kparent'][]= DB::table('legder')->select('lid','kalname','subhead','kadate')
			->where('subhead','=','0')
			->get();
			
			foreach($id['kparent']  as $kparent)
			{
				foreach($kparent as $kp)
				{
					$id['kchild1'][$kp->lid][]= DB::table('legder')->select('lid','kalname','subhead','kadate')
					->where('subhead','=',$kp->lid)
					->get();
					/*foreach($id['kchild1'][$kp->lid]  as $kchild1)
						{
						foreach($kchild1 as $kc1){
						$id['kchild2'][$kc1->lid][]= DB::table('legder')->select('lid','kalname','subhead','kaparticulars')
						->where('subhead','=',$kc1->lid)
						->get();
						foreach($id['kchild2'][$kc1->lid]  as $kchild2)
						{
						foreach($kchild2 as $kc2){
						
						$id['kchild3'][$kc2->lid][]= DB::table('legder')->select('lid','kalname','subhead','kaparticulars')
						->where('subhead','=',$kc2->lid)
						->get();
						
						}
					}*/
				}
			}
			return $id;
			
		}
		
		
		
		public function getled()
		{
			$id['parent'][]= DB::table('legder')->select('lid','lname','subhead','kadate')
			->where('subhead','=','0')
			->get();
			
			foreach($id['parent']  as $parent)
			{
				foreach($parent as $p)
				{
					$id['child1'][$p->lid][]= DB::table('legder')->select('lid','lname','subhead','kadate')
					->where('subhead','=',$p->lid)
					->get();
					foreach($id['child1'][$p->lid]  as $child1)
					{
						foreach($child1 as $c1){
							$id['child2'][$c1->lid][]= DB::table('legder')->select('lid','lname','subhead','kadate')
							->where('subhead','=',$c1->lid)
							->get();
							foreach($id['child2'][$c1->lid]  as $child2)
							{
								foreach($child2 as $c2)
								$id['child3'][$c2->lid][]= DB::table('legder')->select('lid','lname','subhead','kadate')
								->where('subhead','=',$c2->lid)
								->get();
							}
						}
					}
				}
			}
			return $id;
		}
		
		public function ledgerhead($data)
		{
			$from_date=$data['from_date'];
			$to_date = $data['to_date'];
			
			$from_date="2014-04-01";
			$to_date="2018-03-31";
			
			$ledgerhead= DB::table('legder')
			->select('lid','lname','subhead','Kalname')
			->orderBy('balance_sheet_order',"asc")
			->get();
			
			$temp=array();
			$temp1=array();
			
			$temp_debit=array();
			$temp1_debit=array();
			foreach($ledgerhead as $led)
			{
				if($led->subhead==0)
				{
					$temp[]=$led;
					$temp_debit[]=$led;
					$head=$led->lid;
					$tableinfo=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount','query','TableAndFiled_Id')
					->where('TableAndFiled_Lid',$head)
					->where('Type',"CREDIT")
					->get();
					
					$tableinfo_debit=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount','query','TableAndFiled_Id')
					->where('TableAndFiled_Lid',$head)
					->where('Type',"DEBIT")
					->get();
					
					
					$sum=0;
					$sum_debit=0;
					
					foreach($tableinfo as $tab)
					{
						
							$TabName=$tab->TableAndFiled_TableName;
							$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
							
							$TableAndFiled_date=$tab->TableAndFiled_Date;
							$TableAndFiled_Id=$tab->TableAndFiled_Id;
							
						
						$sqlw = "";
					
						$kjdfvs = DB::table("whereclaus_tabel")
							->select("whereclaus","whereclaus_value")
							->where("whereclaus_tab_id","=",$TableAndFiled_Id)
							->get();
						//$n = $kjdfvs.count();
						
						foreach($kjdfvs as $key=>$row) {
					
							if(empty($sqlw)) {
								$sqlw .= "WHERE `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
								
							} else {
								$sqlw .= "AND `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
							}
						
						}
						
					
						$TableAndFiled_date=$tab->TableAndFiled_Date;
						
						$q2 = "SELECT SUM(`{$TableAndFiled_Amount}`) as amt FROM `{$TabName}` ";
						
						$q1 = $q2 .$sqlw."AND`{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
						//print_r("-1-".$q1);
						$amt= DB::select($q1);
						
						$amt_val=$amt[0]->amt;
						$sum=Floatval($sum)+Floatval($amt_val);
						$sum=round($sum);
					}
					
					foreach($tableinfo_debit as $tab)
					{
					$TabName=$tab->TableAndFiled_TableName;
							$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
							$TableAndFiled_date=$tab->TableAndFiled_Date;
							$TableAndFiled_Id=$tab->TableAndFiled_Id;
						
						$sqlw = "";
					
						$kjdfvs = DB::table("whereclaus_tabel")
							->select("whereclaus","whereclaus_value")
							->where("whereclaus_tab_id","=",$TableAndFiled_Id)
							->get();
						//$n = $kjdfvs.count();
						
						foreach($kjdfvs as $key=>$row) {
					
							if(empty($sqlw)) {
								$sqlw .= "WHERE `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
								
							} else {
								$sqlw .= "AND `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
							}
						
						}
						
						
					
						$TableAndFiled_date=$tab->TableAndFiled_Date;
						
						$q2 = "SELECT SUM(`{$TableAndFiled_Amount}`) as amt FROM `{$TabName}` ";
						
						$q1 = $q2 .$sqlw."AND`{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
						//print_r("-2-".$q1);
						$amt= DB::select($q1);
						//$q1=$tab->query;
						//$TableAndFiled_date=$tab->TableAndFiled_Date;
						//$q1 = $q1 ."AND `{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
						//$amt= DB::select($q1);
						$amt_val=$amt[0]->amt;
						$sum_debit=Floatval($sum_debit)+Floatval($amt_val);
						$sum_debit=round($sum_debit);
					}
					
					$temp1[$head]=$sum;
					$temp1_debit[$head]=$sum_debit;
					
					
					
					
					
					
					
					$suhead=$led->lid;
					$ledgersubhead= DB::table('legder')->select('lid','lname','subhead','Kalname')
					->where('subhead',$suhead)
					->get();
					foreach($ledgersubhead as $ledsubhead)
					{
						$temp[]=$ledsubhead;
						$temp_debit[]=$ledsubhead;
						$suhead1=$ledsubhead->lid;
						$sum1_debit=0;
						$sum1=0;
						
						$tableinfo1=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount','query','TableAndFiled_Id')
						->where('TableAndFiled_Lid',$suhead1)
						->where('Type',"CREDIT")
						->get();
						
						$tableinfo1_debit=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount','query','TableAndFiled_Id')
						->where('TableAndFiled_Lid',$suhead1)
						->where('Type',"DEBIT")
						->get();
						foreach($tableinfo1 as $tab)
						{
							$TabName=$tab->TableAndFiled_TableName;
							$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
							$TableAndFiled_Date=$tab->TableAndFiled_Date;
							$TableAndFiled_Id=$tab->TableAndFiled_Id;
							
							/*$q1=$tab->query;
							$TableAndFiled_date=$tab->TableAndFiled_Date;
							$q1 = $q1 . " AND `{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
							$amt= DB::select($q1);*/
							
							$sqlw = "";
					
							$whereclaus_tabel = DB::table("whereclaus_tabel")
								->select("whereclaus","whereclaus_value")
								->where("whereclaus_tab_id","=",$TableAndFiled_Id)
								->get();
						
						
							foreach($whereclaus_tabel as $key=>$row) {
								if(empty($sqlw)) {
									$sqlw .= "WHERE `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
								} else {
									$sqlw .= "AND `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
								}
							
							}
						
						
						
							$TableAndFiled_date=$tab->TableAndFiled_Date;
							
							$q2 = "SELECT SUM(`{$TableAndFiled_Amount}`) as amt FROM `{$TabName}` ";
							
							$q1 = $q2 .$sqlw."AND`{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
							//print_r("-3-".$q1);
							$amt= DB::select($q1);
							$q1=$tab->query;
							//$TableAndFiled_date=$tab->TableAndFiled_Date;
						//	$q1 = $q1 ."AND `{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
						//	$amt= DB::select($q1);
							$amt_val=$amt[0]->amt;
							//$sum1=$sum1+$amt;
							$sum1=Floatval($sum1)+Floatval($amt_val);
							$sum1=round($sum1);
						}
						
						foreach($tableinfo1_debit as $tab)
						{
							$TabName=$tab->TableAndFiled_TableName;
								$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
								$TableAndFiled_Date=$tab->TableAndFiled_Date;
								$TableAndFiled_Id=$tab->TableAndFiled_Id;
								
								$sqlw = "";
					
						$whereclaus_tabel = DB::table("whereclaus_tabel")
							->select("whereclaus","whereclaus_value")
							->where("whereclaus_tab_id","=",$TableAndFiled_Id)
							->get();
						
						
						foreach($whereclaus_tabel as $key=>$row) {
					
							if(empty($sqlw)) {
								$sqlw .= "WHERE `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
								
							} else {
								$sqlw .= "AND `{$row->whereclaus}` = '{$row->whereclaus_value}' ";
							}
						
						}
						
						
						//$q1=$tab->query;
						$TableAndFiled_date=$tab->TableAndFiled_Date;
						
						$q2 = "SELECT SUM(`{$TableAndFiled_Amount}`) as amt FROM `{$TabName}` ";
						
						$q1 = $q2 .$sqlw. "AND `{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
						//print_r("-4-".$q1);
						$amt= DB::select($q1);
						//$q1=$tab->query;
						//$TableAndFiled_date=$tab->TableAndFiled_Date;
						//$q1 = $q1 ."AND`{$TableAndFiled_date}` BETWEEN '{$from_date}' and '{$to_date}' ";
						//$amt= DB::select($q1);
							$amt_val=$amt[0]->amt;
							//$sum1=$sum1+$amt;
							$sum1_debit=Floatval($sum1_debit)+Floatval($amt_val);
							$sum1_debit=round($sum1_debit);
						}
						
						$temp1[$suhead1]=$sum1;
						$temp1_debit[$suhead1]=$sum1_debit;
					}
				}
			}
			
			$temp2['xyz']=$temp;
			$temp2['xyz1']=$temp1;
			
			$temp2['xyz_debit']=$temp_debit;
			$temp2['xyz1_debit']=$temp1_debit;
			return $temp2;
			
		}
		
		
/*		public function ledgerhead()
		{
			$start="2016-04-01";
			$end="2017-03-31";
			$ledgerhead= DB::table('legder')->select('lid','lname','subhead','Kalname')
			->get();
			$temp=array();
			$temp1=array();
			
			$temp_debit=array();
			$temp1_debit=array();
			foreach($ledgerhead as $led)
			{
				if($led->subhead==0)
				{
					$temp[]=$led;
					$temp_debit[]=$led;
					$head=$led->lid;
					$tableinfo=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount')
					->where('TableAndFiled_Lid',$head)
					->where('Type',"CREDIT")
					->get();
					
					$tableinfo_debit=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount')
					->where('TableAndFiled_Lid',$head)
					->where('Type',"DEBIT")
					->get();
					
					
					$sum=0;
					$sum_debit=0;
					foreach($tableinfo as $tab)
					{
						$TabName=$tab->TableAndFiled_TableName;
						$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
						
						$TableAndFiled_date=$tab->TableAndFiled_Date;
						
						$TableAndFiled_whereclaus1=$tab->TableAndFiled_whereclaus1;
						$TableAndFiled_whereclaus2=$tab->TableAndFiled_whereclaus2;
						$TableAndFiled_whereclaus3=$tab->TableAndFiled_whereclaus3;
						$TableAndFiled_whereclaus4=$tab->TableAndFiled_whereclaus4;
						$TableAndFiled_whereclaus5=$tab->TableAndFiled_whereclaus5;
						$TableAndFiled_whereclaus6=$tab->TableAndFiled_whereclaus6;
						
						$TableAndFiled_whereclaus1Data=$tab->TableAndFiled_whereclaus1Data;
						$TableAndFiled_whereclaus2Data=$tab->TableAndFiled_whereclaus2Data;
						$TableAndFiled_whereclaus3Data=$tab->TableAndFiled_whereclaus3Data;
						$TableAndFiled_whereclaus4Data=$tab->TableAndFiled_whereclaus4Data;
						$TableAndFiled_whereclaus5Data=$tab->TableAndFiled_whereclaus5Data;
						$TableAndFiled_whereclaus6Data=$tab->TableAndFiled_whereclaus6Data;
						
						
						$amt=DB::table($TabName)
						->where($TableAndFiled_whereclaus1,'=',$TableAndFiled_whereclaus1Data)
						->where($TableAndFiled_whereclaus2,'=',$TableAndFiled_whereclaus2Data)
						->where($TableAndFiled_whereclaus3,'=',$TableAndFiled_whereclaus3Data)
						->where($TableAndFiled_whereclaus4,'=',$TableAndFiled_whereclaus4Data)
						->where($TableAndFiled_whereclaus5,'=',$TableAndFiled_whereclaus5Data)
						->where($TableAndFiled_whereclaus6,'=',$TableAndFiled_whereclaus6Data)
						->whereRaw("DATE($TableAndFiled_date) BETWEEN '".$start."' AND '".$end."'")
						->sum($TableAndFiled_Amount);
						
						$sum=Floatval($sum)+Floatval($amt);
						$sum=round($sum);
					}
					
					foreach($tableinfo_debit as $tab)
					{
						$TabName=$tab->TableAndFiled_TableName;
						$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
						$TableAndFiled_date=$tab->TableAndFiled_Date;
						$TableAndFiled_whereclaus1=$tab->TableAndFiled_whereclaus1;
						$TableAndFiled_whereclaus2=$tab->TableAndFiled_whereclaus2;
						$TableAndFiled_whereclaus3=$tab->TableAndFiled_whereclaus3;
						$TableAndFiled_whereclaus4=$tab->TableAndFiled_whereclaus4;
						$TableAndFiled_whereclaus5=$tab->TableAndFiled_whereclaus5;
						$TableAndFiled_whereclaus6=$tab->TableAndFiled_whereclaus6;
						
						$TableAndFiled_whereclaus1Data=$tab->TableAndFiled_whereclaus1Data;
						$TableAndFiled_whereclaus2Data=$tab->TableAndFiled_whereclaus2Data;
						$TableAndFiled_whereclaus3Data=$tab->TableAndFiled_whereclaus3Data;
						$TableAndFiled_whereclaus4Data=$tab->TableAndFiled_whereclaus4Data;
						$TableAndFiled_whereclaus5Data=$tab->TableAndFiled_whereclaus5Data;
						$TableAndFiled_whereclaus6Data=$tab->TableAndFiled_whereclaus6Data;
						
						
						$amt=DB::table($TabName)
						->where($TableAndFiled_whereclaus1,'=',$TableAndFiled_whereclaus1Data)
						->where($TableAndFiled_whereclaus2,'=',$TableAndFiled_whereclaus2Data)
						->where($TableAndFiled_whereclaus3,'=',$TableAndFiled_whereclaus3Data)
						->where($TableAndFiled_whereclaus4,'=',$TableAndFiled_whereclaus4Data)
						->where($TableAndFiled_whereclaus5,'=',$TableAndFiled_whereclaus5Data)
						->where($TableAndFiled_whereclaus6,'=',$TableAndFiled_whereclaus6Data)
						->whereRaw("DATE($TableAndFiled_date) BETWEEN '".$start."' AND '".$end."'")
						->sum($TableAndFiled_Amount);
						
						$sum_debit=Floatval($sum_debit)+Floatval($amt);
						$sum_debit=round($sum_debit);
					}
					
					$temp1[$head]=$sum;
					$temp1_debit[$head]=$sum_debit;
					
					$suhead=$led->lid;
					$ledgersubhead= DB::table('legder')->select('lid','lname','subhead','Kalname')
					->where('subhead',$suhead)
					->get();
					foreach($ledgersubhead as $ledsubhead)
					{
						$temp[]=$ledsubhead;
						$temp_debit[]=$ledsubhead;
						$suhead1=$ledsubhead->lid;
						$sum1_debit=0;
						$sum1=0;
						
						$tableinfo1=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount')
						->where('TableAndFiled_Lid',$suhead1)
						->where('Type',"CREDIT")
						->get();
						
						$tableinfo1_debit=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount')
						->where('TableAndFiled_Lid',$suhead1)
						->where('Type',"DEBIT")
						->get();
						foreach($tableinfo1 as $tab)
						{
							$TabName=$tab->TableAndFiled_TableName;
							$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
							$TableAndFiled_Date=$tab->TableAndFiled_Date;
							$TableAndFiled_whereclaus1=$tab->TableAndFiled_whereclaus1;
							$TableAndFiled_whereclaus2=$tab->TableAndFiled_whereclaus2;
							$TableAndFiled_whereclaus3=$tab->TableAndFiled_whereclaus3;
							$TableAndFiled_whereclaus4=$tab->TableAndFiled_whereclaus4;
							$TableAndFiled_whereclaus5=$tab->TableAndFiled_whereclaus5;
							$TableAndFiled_whereclaus6=$tab->TableAndFiled_whereclaus6;
							
							$TableAndFiled_whereclaus1Data=$tab->TableAndFiled_whereclaus1Data;
							$TableAndFiled_whereclaus2Data=$tab->TableAndFiled_whereclaus2Data;
							$TableAndFiled_whereclaus3Data=$tab->TableAndFiled_whereclaus3Data;
							$TableAndFiled_whereclaus4Data=$tab->TableAndFiled_whereclaus4Data;
							$TableAndFiled_whereclaus5Data=$tab->TableAndFiled_whereclaus5Data;
							$TableAndFiled_whereclaus6Data=$tab->TableAndFiled_whereclaus6Data;
							
							
							$amt=DB::table($TabName)
							->where($TableAndFiled_whereclaus1,'=',$TableAndFiled_whereclaus1Data)
							->where($TableAndFiled_whereclaus2,'=',$TableAndFiled_whereclaus2Data)
							->where($TableAndFiled_whereclaus3,'=',$TableAndFiled_whereclaus3Data)
							->where($TableAndFiled_whereclaus4,'=',$TableAndFiled_whereclaus4Data)
							->where($TableAndFiled_whereclaus5,'=',$TableAndFiled_whereclaus5Data)
							->where($TableAndFiled_whereclaus6,'=',$TableAndFiled_whereclaus6Data)
							->whereRaw("DATE($TableAndFiled_Date) BETWEEN '".$start."' AND '".$end."'")
							->sum($TableAndFiled_Amount);
							
							//$sum1=$sum1+$amt;
							$sum1=Floatval($sum1)+Floatval($amt);
						$sum1=round($sum1);
						}
						
						foreach($tableinfo1_debit as $tab)
						{
							$TabName=$tab->TableAndFiled_TableName;
							$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
							$TableAndFiled_whereclaus1=$tab->TableAndFiled_whereclaus1;
							$TableAndFiled_whereclaus2=$tab->TableAndFiled_whereclaus2;
							$TableAndFiled_whereclaus3=$tab->TableAndFiled_whereclaus3;
							$TableAndFiled_whereclaus4=$tab->TableAndFiled_whereclaus4;
							$TableAndFiled_whereclaus5=$tab->TableAndFiled_whereclaus5;
							$TableAndFiled_whereclaus6=$tab->TableAndFiled_whereclaus6;
							$TableAndFiled_Date=$tab->TableAndFiled_Date;
							
							
							$TableAndFiled_whereclaus1Data=$tab->TableAndFiled_whereclaus1Data;
							$TableAndFiled_whereclaus2Data=$tab->TableAndFiled_whereclaus2Data;
							$TableAndFiled_whereclaus3Data=$tab->TableAndFiled_whereclaus3Data;
							$TableAndFiled_whereclaus4Data=$tab->TableAndFiled_whereclaus4Data;
							$TableAndFiled_whereclaus5Data=$tab->TableAndFiled_whereclaus5Data;
							$TableAndFiled_whereclaus6Data=$tab->TableAndFiled_whereclaus6Data;
							
							
							$amt=DB::table($TabName)
							->where($TableAndFiled_whereclaus1,'=',$TableAndFiled_whereclaus1Data)
							->where($TableAndFiled_whereclaus2,'=',$TableAndFiled_whereclaus2Data)
							->where($TableAndFiled_whereclaus3,'=',$TableAndFiled_whereclaus3Data)
							->where($TableAndFiled_whereclaus4,'=',$TableAndFiled_whereclaus4Data)
							->where($TableAndFiled_whereclaus5,'=',$TableAndFiled_whereclaus5Data)
							->where($TableAndFiled_whereclaus6,'=',$TableAndFiled_whereclaus6Data)
							->whereRaw("DATE($TableAndFiled_Date) BETWEEN '".$start."' AND '".$end."'")
							->sum($TableAndFiled_Amount);
							
							//$sum1=$sum1+$amt;
							$sum1_debit=Floatval($sum1_debit)+Floatval($amt);
						$sum1_debit=round($sum1_debit);
						}
						
						$temp1[$suhead1]=$sum1;
						$temp1_debit[$suhead1]=$sum1_debit;
					}
				}
			}
			
			$temp2['xyz']=$temp;
			$temp2['xyz1']=$temp1;
			
			$temp2['xyz_debit']=$temp_debit;
			$temp2['xyz1_debit']=$temp1_debit;
			return $temp2;
			
		}//*/
		public function LedSingleDetails($id)
		{
		
		/*	$temp=array();
			$start="2016-04-01";
			$end="2017-03-31";
			
			$tableinfo=DB::table('ledgertableandfieldsname')->select('TableAndFiled_Lid','TableAndFiled_TableName','TableAndFiled_Date','TableAndFiled_whereclaus1','TableAndFiled_whereclaus2','TableAndFiled_whereclaus3','TableAndFiled_whereclaus4','TableAndFiled_whereclaus5','TableAndFiled_whereclaus6','TableAndFiled_whereclaus1Data','TableAndFiled_whereclaus2Data','TableAndFiled_whereclaus3Data','TableAndFiled_whereclaus4Data','TableAndFiled_whereclaus5Data','TableAndFiled_whereclaus6Data','TableAndFiled_Amount','TableAndFiled_select1','TableAndFiled_select2','TableAndFiled_select3')
			->where('TableAndFiled_Lid',$id)
			->where('Type',"CREDIT")
			->get();
			foreach($tableinfo as $tab)
					{
						$TabName=$tab->TableAndFiled_TableName;
						$TableAndFiled_Amount=$tab->TableAndFiled_Amount;
						
						$TableAndFiled_date=$tab->TableAndFiled_Date;
						
						$TableAndFiled_whereclaus1=$tab->TableAndFiled_whereclaus1;
						$TableAndFiled_whereclaus2=$tab->TableAndFiled_whereclaus2;
						$TableAndFiled_whereclaus3=$tab->TableAndFiled_whereclaus3;
						$TableAndFiled_whereclaus4=$tab->TableAndFiled_whereclaus4;
						$TableAndFiled_whereclaus5=$tab->TableAndFiled_whereclaus5;
						$TableAndFiled_whereclaus6=$tab->TableAndFiled_whereclaus6;
						$TableAndFiled_select1=$tab->TableAndFiled_select1;
						$TableAndFiled_select2=$tab->TableAndFiled_select2;
						$TableAndFiled_select3=$tab->TableAndFiled_select3;
						
						$TableAndFiled_whereclaus1Data=$tab->TableAndFiled_whereclaus1Data;
						$TableAndFiled_whereclaus2Data=$tab->TableAndFiled_whereclaus2Data;
						$TableAndFiled_whereclaus3Data=$tab->TableAndFiled_whereclaus3Data;
						$TableAndFiled_whereclaus4Data=$tab->TableAndFiled_whereclaus4Data;
						$TableAndFiled_whereclaus5Data=$tab->TableAndFiled_whereclaus5Data;
						$TableAndFiled_whereclaus6Data=$tab->TableAndFiled_whereclaus6Data;
						
						$amt=DB::table($TabName)
							->select($TableAndFiled_select1 as 'Accno',$TableAndFiled_select2 as 'Amount',$TableAndFiled_select3 as 'Date_')
							->where($TableAndFiled_whereclaus1,'=',$TableAndFiled_whereclaus1Data)
							->where($TableAndFiled_whereclaus2,'=',$TableAndFiled_whereclaus2Data)
							->where($TableAndFiled_whereclaus3,'=',$TableAndFiled_whereclaus3Data)
							->where($TableAndFiled_whereclaus4,'=',$TableAndFiled_whereclaus4Data)
							->where($TableAndFiled_whereclaus5,'=',$TableAndFiled_whereclaus5Data)
							->where($TableAndFiled_whereclaus6,'=',$TableAndFiled_whereclaus6Data)
							->whereRaw("DATE($TableAndFiled_date) BETWEEN '".$start."' AND '".$end."'")
							->get();
							 $temp[]=$amt;
					}
					
					return $temp;
			
			*/
		}
		
		
		
		
		public function create_all_head_subhead($data)
		{
			$z=0;
			$where_claus=$data['where_clause'];
			$where_value=$data['where_clause_value'];
			$num=$data['where_clause_num'];	
			$id=DB::table('ledgertableandfieldsname')->insertGetId(['TableAndFiled_Lid'=>$data['Headid'],'TableAndFiled_TableName'=>$data['table_name'],'TableAndFiled_Amount'=>$data['Amount_field'],'TableAndFiled_Date'=>$data['Date_field'],'TableAndFiled_Bid'=>$data['bid_field'],'Type'=>$data['type']]);
			
			$id1=DB::table('ledgertableandfieldsname')->insertGetId(['TableAndFiled_Lid'=>$data['Headid'],'TableAndFiled_TableName'=>"expense",'TableAndFiled_Amount'=>"amount",'TableAndFiled_Date'=>"e_date",'TableAndFiled_Bid'=>"Bid",'Type'=>$data['type']]);
			
			
			DB::table('whereclaus_tabel')->insertGetId(['whereclaus'=>"SubHead_lid",'whereclaus_value'=>$data['Headid'],'whereclaus_tab_id'=>$id1]);
			
			
			
			$id2=DB::table('ledgertableandfieldsname')->insertGetId(['TableAndFiled_Lid'=>$data['Headid'],'TableAndFiled_TableName'=>"income",'TableAndFiled_Amount'=>"Income_amount",'TableAndFiled_Date'=>"Income_date",'TableAndFiled_Bid'=>"Bid",'Type'=>$data['type']]);
			
			
			DB::table('whereclaus_tabel')->insertGetId(['whereclaus'=>"Income_SubHead_lid",'whereclaus_value'=>$data['Headid'],'whereclaus_tab_id'=>$id2]);
			
			
			for($i=0;$i<$num;$i++)
			{
				$where_claus1=explode(",",$where_claus);
				$where_value1=explode(",",$where_value);
				$x=$where_claus1[$z];
				$y=$where_value1[$z];
				DB::table('whereclaus_tabel')->insertGetId(['whereclaus'=>$x,'whereclaus_value'=>$y,'whereclaus_tab_id'=>$id]);
				$z++;
				
			}
		}
		
		public function gernalentry($data)
		{
			DB::table('journal_entries')->insert(['Headid'=>$data['Headid'],'Subid'=>$data['Subid'],'Date'=>$data['Date'],'particulars'=>$data['particulars'],'bid'=>$data['bid'],'amount'=>$data['amt'],'type'=>$data['type']]);
			
		}
		
		public function update_head_subhead_selectdata($head_id)
		{
			$legder = DB::table("legder")
				->select("lid")
				->where("subhead","=",$head_id)
				->get();
				
			$subhead_ids = array();
			
			foreach($legder as $key=>$row) {
				$subhead_ids[$key] = $row->lid;
			}
			return DB::table("ledgertableandfieldsname")
				->select()
				->leftJoin("legder","legder.lid","=","ledgertableandfieldsname.TableAndFiled_Lid")
				->whereIn("TableAndFiled_Lid",$subhead_ids)
				->get();
		}
		
		public function get_subhead_entry_data($entry_id)
		{
			$data["ledger_field_info"] = DB::table("ledgertableandfieldsname")
				->select()
				->where("TableAndFiled_Id","=",$entry_id)
				->first();
			
			$data["whereclaus"] = DB::table("whereclaus_tabel")
				->select()
				->where("whereclaus_tab_id","=",$entry_id)
				->get();
			$data["count"] = count($data["whereclaus"]);
			return $data;
		}
		
		public function update_head_subhead($data)
		{
			$entry_id = $data["entry_id"];
			$where_id = $data['where_id'];
			$where_claus = $data['where_clause'];
			$where_value = $data['where_clause_value'];
			$num = $data['where_clause_num'];
			
			DB::table('ledgertableandfieldsname')
				->where("TableAndFiled_Id","=",$entry_id)
				->update(['TableAndFiled_Lid'=>$data['Headid'],'TableAndFiled_TableName'=>$data['table_name'],'TableAndFiled_Amount'=>$data['Amount_field'],'TableAndFiled_Date'=>$data['Date_field'],'TableAndFiled_Bid'=>$data['bid_field'],'Type'=>$data['type']]);
			
			
				$where_id1=explode(",",$where_id);
				$where_claus1=explode(",",$where_claus);
				$where_value1=explode(",",$where_value);
				
			for($i=0;$i<$num;$i++)
			{
				$z=$where_id1[$i];
				$x=$where_claus1[$i];
				$y=$where_value1[$i];
				if($z == -1) {
					DB::table('whereclaus_tabel')->insertGetId(['whereclaus'=>$x,'whereclaus_value'=>$y,'whereclaus_tab_id'=>$entry_id]);
				} else {
					if($x == "-delete-") {
						DB::table("whereclaus_tabel")
							->where("whereclaus_id","=",$z)
							->delete();
					} else {
						DB::table("whereclaus_tabel")
							->where("whereclaus_id","=",$z)
							->update(['whereclaus'=>$x,'whereclaus_value'=>$y,'whereclaus_tab_id'=>$entry_id]);
					}
				}
				
			}
		}
	}
