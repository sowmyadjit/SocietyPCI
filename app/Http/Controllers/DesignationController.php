<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\DesignationModel;
	use App\Http\Model\ModulesModel;
	class DesignationController extends Controller
	{
		
		var $dsgn;
		public function __construct()
		{
			$this->dsgn = new DesignationModel;
			$this->Modules= new ModulesModel;
			
		} 
		
		public function showdesig(){
			$d['desig']=$this->dsgn->GetDesignations();
			$Url="designation";
			$d['module']=$this->Modules->GetAnyMid($Url);
			
			return view('designation',compact('d'));
		}
		
		public function show_desg()
		{
			$Url="designation";
			$d['module']=$this->Modules->GetAnyMid($Url);
			return view('createdesignation',compact('d'));
		}
		
		public function create_desg(Request $request)
		{
			$designation['dinitial']=$request->input('dinitial');
			$designation['dname']=$request->input('dname');
			$designation['DesigLevel']=$request->input('DesigLevel');
			$id=$this->dsgn->insert($designation);
			//echo $id;
			//user::create($user);
			return redirect('/');
			
		}
	}
