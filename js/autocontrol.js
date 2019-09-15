 var scrolly = 0;
 var distance = 40;
 var speed = 24;
 function autoscroll(el){
 	var currentY = window.pageYOffset;
 	var targetY = document.getElementById(el).offdsetTop;
 	var bodyHeight = document.body.offsetHeight;
 	var ypos = currentY + window.innerHeight;
 	var animator = setTimeout('autoscroll(\''+el+'\')',24);
if (ypos > bodyHeight) {
	clearTimeout(animator);
}else{
	if (currentY < targetY - distance) {
		scrolly = currentY + distance;
		window.scroll(0, scrollY);
	}else{
		clearTimeout(animator);
	}
 }
}
