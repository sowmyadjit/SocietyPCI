<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class User_model extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
	
	public function insert($id)
    {
      //  $id = DB::table('users')->insertGetId(['Uname' => $id['uname'],'Password'=>$id['password'],'Email'=>$id['email'],'Bid'=>$id['bid']]);
		//return $id;
        $Aid = DB::table('address')->insertGetId(['address' => $id['address'],'phone'=>$id['phone']]); 
        $id = DB::table('users')->insertGetId(['Uname' => $id['uname'],'Password'=>$id['password'],'Email'=>$id['email'],'Bid'=>$id['bid'],'aid'=>$Aid]);
        return $id;
    }


    
	
}