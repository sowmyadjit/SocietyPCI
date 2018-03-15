<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\ModulesModel;


class ModulesController extends Controller
{
    public function __construct()
    {
        $this->modules = new ModulesModel;
	} 
	
	public function show_modules()
	{
		//$m=ModulesModel::all();
		$m=$this->modules->GetModules();
        return view('modules',compact('m'));
	}
	
	public function ModuleEditView($id)
	{
		//$m=ModulesModel::all();
		$Url="modules";
		$ModData['module']=$this->modules->GetAnyMid($Url);
		$ModData['data']=$this->modules->GetModuleData($id);
        return view('EditModule',compact('ModData'));
	}
	
	public function ShowModuleCreate()
	{
		
        $Url="modules";
		$M['module']=$this->modules->GetAnyMid($Url);
		return view('CreateModule',compact('M'));
	}
	
	public function CreateModule(Request $request)
	{
		$modules['modulename']=$request->input('modulename');
		$modules['moduleorderid']=$request->input('moduleorderid');
        $modules['moduleurl']=$request->input('moduleurl');
        $modules['modulecid']=$request->input('modulecid');
        $modules['modulett']=$request->input('modulett');
        $modules['moduleico']=$request->input('moduleico');
        
        $id=$this->modules->CreateModule($modules);
		
        return redirect('/');
        
	}
	
	
	public function EditModule(Request $request)
	{
		$modules['moduleid']=$request->input('moduleid');
		$modules['modulename']=$request->input('modulename');
		$modules['moduleorderid']=$request->input('moduleorderid');
        $modules['moduleurl']=$request->input('moduleurl');
        $modules['modulecid']=$request->input('modulecid');
        $modules['modulett']=$request->input('modulett');
        $modules['moduleico']=$request->input('moduleico');
        
        $id=$this->modules->UpdateModule($modules);
		
        return redirect('/');
        
	}
	
	public function UpdateModuleStatus(Request $request)
	{
		$modules['ModuleStatus']=$request->input('ModuleStatus');
		$modules['ModuleId']=$request->input('ModuleId');
		$id=$this->modules->UpdateModuleStatus($modules);
		return $id;
	}
}
