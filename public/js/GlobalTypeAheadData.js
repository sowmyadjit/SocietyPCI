//LOCAL TYPEAHEAD DATA STARTS

	//For AgentPigmiReportHome
	var agent_cust_list;
	$.get( "PigmiAccountForAgent", function( data ) {
		agent_cust_list=data;
		//alert( "Load was performed." );
	});
	
	//To get Branches For createcustomer,transation
	var GetBranches;
	$.get( "GetBranches", function( data ) {
		GetBranches=data;
		//alert( "Load was performed." );
	});
	//To GET SB AND RD ACCOUNT IN CREATEACCOUNT
	var GetSearchAcc;
	$.get( "GetSearchAcc", function( data ) {
		GetSearchAcc=data;
		//alert( "Load was performed." );
	});
	
	//To GET SB AND RD ACCOUNT IN CREATEACCOUNT
	var Getacctyp;
	$.get( "Getacctyp", function( data ) {
		Getacctyp=data;
		//alert( "Load was performed." );
	});
	
	//To get Branches For createcustomer,
	var GetBranchForAddBank;
	$.get( "GetBranchForAddBank", function( data ) {
		GetBranchForAddBank=data;
		//alert( "Load was performed." );
	});
	
	//To get AccNum For transation,
	var Getaccnum;
	$.get( "Getaccnum", function( data ) {
		Getaccnum=data;
		//alert( "Load was performed." );
	});
	
	//To get AgentList For transation,
	var getAllocateagentlist;
	$.get( "getAllocateagentlist", function( data ) {
		getAllocateagentlist=data;
		//alert( "Load was performed." );
	});
	
	//To get rdaccnum For transation,
	var Getrdaccnum;
	$.get( "Getrdaccnum", function( data ) {
		Getrdaccnum=data;
		//alert( "Load was performed." );
	});
	
	//To get rdaccnum For transation,
	var GetlnAccNum;
	$.get( "GetlnAccNum", function( data ) {
		GetlnAccNum=data;
		//alert( "Load was performed." );
	});
	

	//To get branchname For transation,
	var Getbranchname;
	$.get( "Getbranchname", function( data ) {
		Getbranchname=data;
		//alert( "Load was performed." );
	});

	
	//To get branchname For transation,
	var Getrdbranchname;
	$.get( "Getrdbranchname", function( data ) {
		Getrdbranchname=data;
		//alert( "Load was performed." );
	});
	//to det user For SMS subscription
		var Getuser;
		$.get( "Getuser", function( data ) {
		Getuser=data;
		});
		
		var GetFDAgent;
		$.get( "GetFDAgent", function( data ) {
		GetFDAgent=data;
		});
		
		var SearchCustomer;
		$.get( "SearchCustomer", function( data ) {
		SearchCustomer=data;
		});
		
		var GetMinorUser;
		$.get( "GetMinorUser", function( data ) {
		GetMinorUser=data;
		});
		
		var GetBank;
		$.get( "GetBank", function( data ) {
		GetBank=data;
		});
		
		var Getpgmbranchname;
		$.get( "Getpgmbranchname", function( data ) {
		Getpgmbranchname=data;
		});
		var Getlnbranchname;
		$.get( "Getlnbranchname", function( data ) {
		Getlnbranchname=data;
		});
		
		var Getcertificatnum;
		$.get( "Getcertificatnum", function( data ) {
		Getcertificatnum=data;
		});
		
		var GetFdtype;
		$.get( "GetFdtype", function( data ) {
		GetFdtype=data;
		});
		var GetFDBranches;
		$.get( "GetFDBranches", function( data ) {
		GetFDBranches=data;
		});
		var SearchFdAllocation;
		$.get( "SearchFdAllocation", function( data ) {
		SearchFdAllocation=data;
		});
		var GetKCCtype;
		$.get( "GetKCCtype", function( data ) {
		GetKCCtype=data;
		});
		var SearchPigmy;
		$.get( "SearchPigmy", function( data ) {
		SearchPigmy=data;
		});
		
		var GetAccountType;
		$.get( "GetAccountType", function( data ) {
		GetAccountType=data;
		});
		var GetAgentName;
		$.get( "GetAgentName", function( data ) {
		GetAgentName=data;
		});
		var GetCustomer;
		$.get( "GetCustomer", function( data ) {
		GetCustomer=data;
		});
		var Getpigmyacct;
		$.get( "Getpigmyacct", function( data ) {
		Getpigmyacct=data;
		});
		var Getrdprewithdrawaccnum;
		$.get( "Getrdprewithdrawaccnum", function( data ) {
		Getrdprewithdrawaccnum=data;
		});
		var GetFDNum;
		$.get( "GetFDNum", function( data ) {
		GetFDNum=data;
		});
		var SearchPigmyPay;
		$.get( "SearchPigmyPay", function( data ) {
		SearchPigmyPay=data;
		});
		var GetPigmyAccForPayAmt;
		$.get( "GetPigmyAccForPayAmt", function( data ) {
		GetPigmyAccForPayAmt=data;
		});
		var GetPigmyIntAccForPayAmt;
		$.get( "GetPigmyIntAccForPayAmt", function( data ) {
		GetPigmyIntAccForPayAmt=data;
		});
		var SearchRdPay;
		$.get( "SearchRdPay", function( data ) {
		SearchRdPay=data;
		});
		var SearchFdPay;
		$.get( "SearchFdPay", function( data ) {
		SearchFdPay=data;
		});
		var GetDesignation;
		$.get( "GetDesignation", function( data ) {
		GetDesignation=data;
		});
		var GetSearchpigmyAcc;
		$.get( "GetSearchpigmyAcc", function( data ) {
		GetSearchpigmyAcc=data;
		});
//LOCAL TYPEAHEAD DATA ENDS