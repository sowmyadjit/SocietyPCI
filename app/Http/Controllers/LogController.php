<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\LogModel;

class LogController extends Controller
{
     public function __construct()
    {
		$this->log_mdl= new LogModel;
    }
	
	public function insert_log($data)
	{
		$value_array = array(
							//	"log_user_id"	=>	"",//no need to enter
								"table_name"	=>	$data["table_name"],
								"pk_name"		=>	$data["pk_name"],
								"pk_value"		=>	$data["pk_value"],
								"field_name"	=>	$data["field_name"],
							//	"updated_from"	=>	//unknown
								"updated_to"	=>	$data["updated_to"]
							);
		$this->log_mdl->set_values($value_array);
		$updated_from = $this->log_mdl->get_updated_from();
		$this->log_mdl->set_values(["updated_from"=>$updated_from]);
		$this->log_mdl->print_values();
		$this->log_mdl->insert_log();
	}
}

