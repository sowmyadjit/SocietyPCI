$('.sidebarlink').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	addTab($(this));
	
});

$('.side').click(function(e)
{
	e.preventDefault();
	$('.side').removeClass('active');
	$(this).addClass('active');
	
});

//$("#SideLink a").click(function() {});

function addTab(link) {
	
	// If tab already exist in the list, return
	if ($("#" + $(link).attr("rel")).length > 0)
	{
		//alert('test');
		
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
		$("#tabs").append("<li class='side current tabactive' style='padding-left:10px;margin-top:5px;margin-bottom:5px;background-color:white;border-radius:15px;'>&nbsp<a style='color:#000000;text-decoration: none;' class='tab' id='" + $(link).attr("rel") + "' href='#'>" + $(link).html() +"</a>&nbsp&nbsp<a href='#' class='remove glyphicon glyphicon-remove' style='text-decoration: none;'/>&nbsp&nbsp</li>");
		$("#maintest").append("<div id='" + $(link).attr("rel") + "_content'>"+$(link).attr('href')+"</div>");
		$('#'+$(link).attr("rel") + '_content').load($(link).attr('href'));
		// set the newly added tab as curren
		$("#" + $(link).attr("rel") + "_content").show();
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
