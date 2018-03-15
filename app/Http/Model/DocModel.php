<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class DocModel extends Model
{
     protected $table = 'doctype';
	  public function insert($id)
    {
		$id = DB::table('doctype')->insertGetId(['DocTypeName' => $id['docname'],'Description' => $id['desc']]);
	
		return $id;
	}
	
	public function Getdoc()
    {
        $doctype= DB::table('doctype')->select('docname', 'desc')->get();
        return $doctype;
    }
}
