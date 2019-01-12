<?php
namespace App\Http\Model;

use DB;
use JWTAuth;
//use Illuminate\Database\Eloquent\Model;

abstract class DBTableModel //extends Model
{
    protected $field_list = [];
    protected $row = [];
    
    public function __construct()
    {

    }
    
    public function clear_row()
    {
        $this->row = array();
    }
		
    public function set_row($data)
    {
        // print_r($this->field_list);
        foreach($this->field_list as $field) {
            if(isset($data[$field])) {
                $this->row[$field] = $data[$field];
            }
        }
        return;
    }
		
    public function print_row()
    {
        print_r($this->row);//exit();
    }

    public function get_field_list()
    {
        return $this->field_list;
    }

    public function get_tbl()
    {
        return $this->tbl;
    }

    public function get_pk()
    {
        return $this->pk;
    }
    
    public function insert_row($data)
    {
        $this->clear_row();
        $this->set_row($data);
        $insert_id = DB::table($this->tbl)
            ->insertGetId($this->row);

        return $insert_id;
    }
    
    public function update_row($data)
    {
        $this->clear_row();
        $this->set_row($data);
        $unique_field = $this->get_unique_field();
        if(empty($unique_field)) {
            $unique_fields_str = implode(" | ",$this->unique_fields);
            throw new \Exception("any one of the unique fields is required ({$unique_fields_str})");
        }
        $unique_field_value = $this->row["{$unique_field}"];
        unset($this->row["{$unique_field}"]);
        
        if(count($this->row) == 0) {
            return;
        }
        
        $ret_data = DB::table($this->tbl)
            ->where("{$this->tbl}.{$unique_field}",$unique_field_value)
            ->update($this->row);
    
        return $ret_data;
    }

    private function get_unique_field()
    {
        $row_fields = array_keys($this->row);
        $unique_field = "";
        foreach($row_fields as $key_unq => $value_unq) {
            if(in_array($value_unq,$this->unique_fields)) {
                $unique_field = $value_unq;
                break;
            }
        }
        // print_r($unique_field);exit();
        return $unique_field;
    }



}