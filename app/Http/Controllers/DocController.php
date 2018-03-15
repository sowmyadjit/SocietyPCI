<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\DocModel;

class DocController extends Controller
{
 var $doc;
 public function __construct()
    {
        $this->doc = new DocModel;
	 
    }
	public function show_doctype()
	{
		$d=DocModel::all();
        return view('doctype',compact('d'));
	}
	public function create_doc()
	{
		
	return view('createdoctype');
	
	}
	public function insert_doc(Request $request)
	{
	$doctype['docname']=$request->input('docname');
		$doctype['desc']=$request->input('desc');
		return $this->doc->insert($doctype);
	
	}
	
	public function create_doctype(Request $request)
	{
		$doctype['DocTypeName']=$request->input('DocTypeName');
		$doctype['Description']=$request->input('Description');
		return redirect('/');
	
	}
	public function display_doctype()
	{
		return view('doctype');
	}

	
}
