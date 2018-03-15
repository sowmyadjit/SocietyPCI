<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\PermissionModel;

class PermissionController extends Controller
{
	
	public function __construct()
    {
    	$this->permissions = new PermissionModel;
	} 
	
	public function show_permissions()
	{
		$p=$this->permissions->getData();
		return view('permissions',compact('p'));
	}

	public function AjaxUpdateCreate(Request $request)
	{
		return $this->permissions->AjaxUpdateCreate($request->Pid,$request->val);
    }

	public function AjaxUpdateRead(Request $request)
	{
		return $this->permissions->AjaxUpdateRead($request->Pid,$request->val);
	}

	public function AjaxUpdateUpdate(Request $request)
	{
		return $this->permissions->AjaxUpdateUpdate($request->Pid,$request->val);
	}

	public function AjaxUpdateDelete(Request $request)
	{
		return $this->permissions->AjaxUpdateDelete($request->Pid,$request->val);
	}
    
}
