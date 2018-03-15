<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\ShareReceiptModel;

class ShareReceiptController extends Controller
{
	public function __construct()
    {
       
		$this->Share_Receipt= new ShareReceiptModel;
    }
    
    public function ShareReceipt_Home()
    {
       return view('ShareReceipt');
    }
	
	 public function ShowCreateShareReceipt()
    {
       return view('CreateShareReceipt');
    }

}
