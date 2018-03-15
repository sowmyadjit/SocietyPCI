var temparray=[];
$('.sidebarlink').click(function(e)
{
	e.preventDefault();
	var id=$(this).attr("rel");
	temparray[id]=this;
	//console.log(temparray);
	addTab($(this),0);
	
});

$('.side').click(function(e)
{
	e.preventDefault();
	$('.side').removeClass('active');
	$(this).addClass('active');
	
	
});
function alldata(data_temp)
{
	console.log(alldata);
}

function refreshtab(tad_id,name,herfdata)
{
	refershtab(tad_id,name,herfdata);
}

//$("#SideLink a").click(function() {});
function refershtab(tad_id,name,herfdata)
{
	
	
	var contentname = tad_id + "_content";
	$("#" + contentname).remove();
	$("#"+tad_id).remove();
	addTab(temparray[tad_id],1,tad_id,name,herfdata);
	
	//$("#tabs li").removeClass("tabactive");
	//addTab($(this));
	//$("#tabs").append("<li id="23" class='side  current tabactive' style='padding-left:10px;margin-top:5px;margin-bottom:5px;background-color:white;border-radius:15px;'>&nbsp<a style='color:#000000;text-decoration: none;' class='tab' id="23" href='#'></a>&nbsp&nbsp<a href='#' class='remove glyphicon glyphicon-remove' style='text-decoration: none;'/>&nbsp&nbsp</li>");
	//	$("#maintest").append("<div id='23_content'>"+$(link).attr('href')+"</div>");
		//$('#'+$(link).attr("rel") + '_content').load($(link).attr('href'));
		// set the newly added tab as curren
		//$("#" + $(link).attr("rel") + "_content").show();
	
}
function addTab(link,status,tad_id,name,herfdata) {
	
	
	if(status==1)
	{
		
		// hide other tabs
		$("#tabs li").removeClass("current");
		$("#tabs li").removeClass("tabactive");
		$("#maintest > div").hide();
		
		// add new tab and related content
		$("#tabs").append("<li id='"+tad_id+"' class='side  current tabactive' style='padding-left:10px;margin-top:5px;margin-bottom:5px;background-color:white;border-radius:15px;'>&nbsp<a style='color:#000000;text-decoration: none;' class='tab' id='"+tad_id+"' href='#'>"+name+"</a>&nbsp&nbsp<a href='#' class='remove glyphicon glyphicon-remove' style='text-decoration: none;'/>&nbsp&nbsp</li>");
		$("#maintest").append("<div id='"+tad_id+"_content'>"+herfdata+"</div>");
		$('#'+tad_id+'_content').load(herfdata);
		// set the newly added tab as curren
		$("#"+tad_id+"_content").show();
	}
	
	else
	{
	if ($("#" + $(link).attr("rel")).length > 0)
	{
		
		
		var contentname = $(link).attr("rel") + "_content";
		
		// hide all other tabs
		$("#maintest > div").hide();
		$("#tabs li").removeClass("current");
		$("#tabs li").removeClass("tabactive");
		// show current tab
		$("#" + contentname).show();
		$(link).parent().addClass("current");
		$("#" + $(link).attr("rel")).parent().addClass("tabactive");
		return;
	}
	else{
		// hide other tabs
		$("#tabs li").removeClass("current");
		$("#tabs li").removeClass("tabactive");
		$("#maintest > div").hide();
		
		
		// add new tab and related content
		$("#tabs").append("<li id='" + $(link).attr("rel") + "' class='side  current tabactive' style='padding-left:10px;margin-top:5px;margin-bottom:5px;background-color:white;border-radius:15px;'>&nbsp<a style='color:#000000;text-decoration: none;' class='tab' id='" + $(link).attr("rel") + "' href='#'>" + $(link).html() +"</a>&nbsp&nbsp<a href='#' class='remove glyphicon glyphicon-remove' style='text-decoration: none;'/>&nbsp&nbsp</li>");
		$("#maintest").append("<div id='" + $(link).attr("rel") + "_content'>"+$(link).attr('href')+"</div>");
		$('#'+$(link).attr("rel") + '_content').load($(link).attr('href'));
		// set the newly added tab as curren
		$("#" + $(link).attr("rel") + "_content").show();
	}
	}
}

$('#tabs ').on('click','a.tab' ,function() {
	
	// Get the tab name
	var contentname = $(this).attr("id") + "_content";
	
	// hide all other tabs
	$("#maintest > div").hide();
	$("#tabs li").removeClass("current");
	$("#tabs li").removeClass("tabactive");
	
	// show current tab
	$("#" + contentname).show();
	$(this).parent().addClass("current");
	$(this).parent().addClass("tabactive");
});

$('#tabs ').on('click','a.remove', function() {
	
	// Get the tab name
	var tabid = $(this).parent().find(".tab").attr("id");
	
	// remove tab and related content
	var contentname = tabid + "_content";
	$("#" + contentname).remove();
	$(this).parent().remove();
	
	// if there is no current tab and if there are still tabs left, show the first one
	if ($("#tabs li.current").length == 0 && $("#tabs li").length > 0) {
		// find the first tab
		var firsttab = $("#tabs li:first-child");
		firsttab.addClass("current");
		firsttab.addClass("tabactive");
		var firstsidetab = $("#SideLink li:first-child");
		$('.side').removeClass('active');
		firstsidetab.addClass('active');
		// get its link name and show related content
		var firsttabid = $(firsttab).find("a.tab").attr("id");
		$("#" + firsttabid + "_content").show();
	} 
});
