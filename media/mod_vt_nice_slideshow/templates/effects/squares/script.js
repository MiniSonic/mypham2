// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Generated by $AppName$ $AppVersion$
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
function ws_squares(c,a,b){var g=jQuery;var e=b.find("ul").get(0);e.id="wowslider_tmp"+Math.round(Math.random()*99999);var h=0;g(e).coinslider({hoverPause:false,startSlide:c.startSlide,navigation:0,delay:-1,width:c.width,height:c.height});var f=g("#coin-slider-"+e.id).css({position:"absolute",left:0,top:0,"z-index":8});var d=c.startSlide;g(e).bind("cs:animFinished",function(){g(e).css({left:-d+"00%"});if(h<2){h=0;f.hide()}});this.go=function(i){h++;f.show();d=i;g.transition(e,i);return i}};