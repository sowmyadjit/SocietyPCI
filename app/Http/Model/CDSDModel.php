<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\CommonModel;
use App\Http\Model\SettingsModel;
use DB;
use Auth;

class CDSDModel extends Model
{
	public $tbl = 'cdsd_account';
	public $pk = 'cdsd_id';
	public $cdsd_type_field = 'cdsd_type';
	public $sd_ho_id_field = 'sd_ho_id';
	public $cdsd_acc_no_field = 'cdsd_acc_no';
	public $cdsd_oldacc_no_field = 'cdsd_oldacc_no';
	public $user_type_field = 'user_type';
	public $uid_field = 'uid';
	public $bid_field = 'bid';
	public $cdsd_start_date_field = 'cdsd_start_date';
	public $cdsd_close_date_field = 'cdsd_close_date';
	public $cdsd_closed_field = 'cdsd_closed';
	public $subhead_id_field = 'subhead_id';
	public $deleted_field = 'deleted';
	
	private $field_list = array(
		"cdsd_id",
		"cdsd_type",
		"sd_ho_id",
		"cdsd_acc_no",
		"cdsd_oldacc_no",
		"user_type",
		"uid",
		"bid",
		"cdsd_start_date",
		"cdsd_close_date",
		"cdsd_closed",
		"subhead_id",
		"deleted"
	);

    const CD = 1;
    const SD = 2;
	const SD_HO_AMOUNT_LIMIT = 100000;

	private $row_data = array();

	public function __construct()
	{
		$this->common = new CommonModel;
		$this->settings = new SettingsModel;
	}

	public function clear_row_data()
	{
		$this->row_data = array();
	}

	public function print_row_data()
	{
		print_r($this->row_data);
	}

	public function set_row_data($data)
	{
		foreach($this->field_list as $value) {
			if(isset($data[$value])) {
				$this->row_data[$value] = $data[$value];
			}
		}
	}

	public function insert_row()
	{
		return DB::table($this->tbl)
			->insertGetId($this->row_data);
	}

	public function update_row()
	{
		$this->common->required($this->row_data,$this->pk);
		$update_row_pk = $this->row_data[$this->pk];
		unset($this->row_data[$this->pk]);

		if(count($this->row_data) == 0) {
			return;
		}

		return DB::table($this->tbl)
			->where("{$this->tbl}.{$this->pk}", $update_row_pk)
			->update($this->row_data);
	}

	/* --------------------------------------------------------------------------------------------- */

	/* public function get_sd_ho_id($sd_id)
	{
		if(!empty($sd_id)) {
			$ret_data = DB::table($this->tbl)
			->where("{$this->tbl}.{$this->pk}", $temp_sd_id)
			->value($this->sd_hd_id_field);
		} else {
			$ret_data = 0;
		}

		return $ret_data;
	} */

	public function get_row($data)
	{
		$row = DB::table($this->tbl);
		if(isset($data[$this->pk])) {
			$row = $row->where("{$this->tbl}.{$this->pk}", $data[$this->pk]);
		} elseif(isset($data[$this->cdsd_acc_no_field])) {
			$row = $row->where("{$this->tbl}.{$this->cdsd_acc_no_field}", $data[$this->cdsd_acc_no_field]);
		} elseif(isset($data[$this->uid_field])) {
			$row = $row->where("{$this->tbl}.{$this->uid_field}", $data[$this->uid_field]);
		}
		$row = $row->first();
		
		return $row;
	}
	
	public function get_next_acc_no($data)
	{
		$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

		if(!empty($data["bid"])) {
			$BID = $data["bid"];
        }
        
        if(!empty($data["cdsd_type"])) {
            $cdsd_type = $data["cdsd_type"];
        } else {
            echo "data['cdsd_type'] is empty...";
            return "error";
        }

		$acc_no_list = DB::table($this->tbl)
			->select("{$this->cdsd_acc_no_field}")
			->where($this->cdsd_type_field, $cdsd_type)
			->where($this->bid_field, $BID)
			->get();
		$number_list = [];
		$i = -1;
		foreach($acc_no_list as $key => $row) {
			$cdsd_no = $row->{$this->cdsd_acc_no_field};
			$number = (int)preg_replace('/[^0-9]/', '', $cdsd_no);
			$number_list[++$i] = $number;
		}

		if(!empty($number_list)) {
			$max_number = max($number_list);
		} else {
			$max_number = 0;
		}
		$new_number = $max_number + 1;

		switch($BID) {
			case 1:
					$branch_code = "KUL";
					break;
			case 2:
					$branch_code = "TOK";
					break;
			case 3:
					$branch_code = "KRI";
					break;
			case 4:
					$branch_code = "JOK";
					break;
			case 5:
					$branch_code = "TAL";
					break;
			case 6:
					$branch_code = "HO";
					break;
			default:
					$branch_code = "";
        }
        switch($cdsd_type) {
            case 1:
                    $account_code = "CD";
                    break;
            case 2:
                    $account_code = "SD";
                    break;
            default:
                    $account_code = "";
        }
		$new_acc_no = "PCIS{$account_code}{$branch_code}{$new_number}";
		return $new_acc_no;
	}

	public function search_cdsd_acc_no($data)
	{
		$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

        
        if(!empty($data["cdsd_type"])) {
            $cdsd_type = $data["cdsd_type"];
        } else {
            echo "data['cdsd_type'] is empty...(in CDSDModel::search_cdsd_acc_no)";
            return "error";
        }

        $query_string = $data["query_string"];

        unset($select_array_cdsd);
		$select_array_cdsd = array(
			"{$this->pk} as id",
			"{$this->cdsd_acc_no_field} as name"
		);

		$ret_data = DB::table($this->tbl)
			->select($select_array_cdsd)
			->where("{$this->tbl}.{$this->deleted_field}", NOT_DELETED);
		if($this->settings->get_value("allow_inter_branch") == 0) {
			$ret_data = $ret_data->where($this->bid_field, $BID);
		}
		$ret_data = $ret_data->where(function($query) use ($query_string) {
			$query->where($this->cdsd_acc_no_field, "like", "%{$query_string}%");
				// ->orWhere();
		})
			->get();

		return $ret_data;
    }
    
    public function search_employee_for_cdsd($data)
    {
        $uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

        $query_string = $data["query_string"];
        $did_array = array(1,2,3,6);
        
        $ret_data = DB::table("user")
            ->select(
                "user.Uid as id",
                DB::raw(" CONCAT(`user`.`Uid`, ' ', ' - ', `user`.`FirstName`, ' ', `user`.`MiddleName`, ' ', `user`.`LastName`, ' - ', `address`.`Address` ) as name  ")
            )
            ->join("employee","employee.Uid","=","user.Uid")
            ->join("address","address.Aid","=","user.Aid");
        if($this->settings->get_value("allow_inter_branch") == 0) {
            $ret_data = $ret_data->where('employee.Bid','=',$BID);
        }
		$ret_data = $ret_data->where(function($query) use ($query_string) {
			$query->where("user.FirstName", "like", "%{$query_string}%")
				->orWhere("user.MiddleName", "like", "%{$query_string}%")
				->orWhere("user.LastName", "like", "%{$query_string}%");
		});
        $ret_data = $ret_data->whereIn("employee.Did",$did_array)
            ->get();
            
        return $ret_data;
    }
    
    public function search_agent_for_cdsd($data)
    {
        $uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

        $query_string = $data["query_string"];
        $did_array = array(4,8);
        
        $ret_data = DB::table("user")
            ->select(
                "user.Uid as id",
                DB::raw(" CONCAT(`user`.`Uid`, ' ', ' - ', `user`.`FirstName`, ' ', `user`.`MiddleName`, ' ', `user`.`LastName`, ' - ', `address`.`Address` ) as name  ")
            )
            ->join("employee","employee.Uid","=","user.Uid")
            ->join("address","address.Aid","=","user.Aid");
        if($this->settings->get_value("allow_inter_branch") == 0) {
            $ret_data = $ret_data->where('employee.Bid','=',$BID);
        }
		$ret_data = $ret_data->where(function($query) use ($query_string) {
			$query->where("user.FirstName", "like", "%{$query_string}%")
				->orWhere("user.MiddleName", "like", "%{$query_string}%")
				->orWhere("user.LastName", "like", "%{$query_string}%");
		});
        $ret_data = $ret_data->whereIn("employee.Did",$did_array)
            ->get();
            
        return $ret_data;
    }
    
    public function search_customer_for_cdsd($data)
    {
        $uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

        $query_string = $data["query_string"];
        $did_array = array(6);
        
        $ret_data = DB::table("user")
            ->select(
                "user.Uid as id",
                DB::raw(" CONCAT(`user`.`Uid`, ' ', ' - ', `user`.`FirstName`, ' ', `user`.`MiddleName`, ' ', `user`.`LastName`, ' - ', `address`.`Address` ) as name  ")
            )
            ->join("address","address.Aid","=","user.Aid");
        if($this->settings->get_value("allow_inter_branch") == 0) {
            $ret_data = $ret_data->where('user.Bid','=',$BID);
        }
		$ret_data = $ret_data->where(function($query) use ($query_string) {
			$query->where("user.FirstName", "like", "%{$query_string}%")
				->orWhere("user.MiddleName", "like", "%{$query_string}%")
				->orWhere("user.LastName", "like", "%{$query_string}%");
		});
        $ret_data = $ret_data//->whereIn("user.Did",$did_array)
            ->get();
            
        return $ret_data;
    }
}
