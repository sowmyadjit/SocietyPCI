$(document).ready(function(){
    var _scroll = true, _timer = false, _floatbox = $("#contact_form"), _floatbox_opener = $(".contact-opener") ;
    _floatbox.css("right", "-302px"); //initial contact form position
   
    //Contact form Opener button
    _floatbox_opener.click(function(){
        if (_floatbox.hasClass('visiable')){
            _floatbox.animate({"right":"-302px"}, {duration: 300}).removeClass('visiable');
        }else{
           _floatbox.animate({"right":"30px"},  {duration: 300}).addClass('visiable');
        }
    });

    //Effect on Scroll Translate
    $(window).scroll(function(){
        if(_scroll){
            _floatbox.animate({"top": "20px"},{duration: 300});
            _scroll = false;
        }
        if(_timer !== false){ clearTimeout(_timer); }          
            _timer = setTimeout(function(){_scroll = true;
            _floatbox.animate({"top": "80px"},{easing: "linear"}, {duration: 500});}, 400);
    });
	var _scroll2 = true, _timer2 = false, _floatbox2 = $("#contact_form2"), _floatbox_opener2 = $(".below1") ;
    _floatbox2.css("right", "-235px"); //initial contact form position
   
    //Contact form Opener button
    _floatbox_opener2.click(function(){
		//alert('fhi');
        if (_floatbox2.hasClass('visiable')){
            _floatbox2.animate({"right":"-235px"}, {duration: 300}).removeClass('visiable');
        }else{
           _floatbox2.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
        }
    });

    //Effect on Scroll CALCI
    $(window).scroll(function(){
        if(_scroll2){
            _floatbox2.animate({"top": "100px"},{duration: 300});
            _scroll2 = false;
        }
        if(_timer2 !== false){ clearTimeout(_timer2); }          
            _timer2 = setTimeout(function(){_scroll2 = true;
            _floatbox2.animate({"top": "160px"},{easing: "linear"}, {duration: 500});}, 400);
    });

});