$(document).ready(function() {
    $("li").first().addClass("active");
    
    $("#next").click(function() {
	    var aktiivne = $("li.active");
	    if (aktiivne.next().is("li")) {
		    aktiivne.next().addClass("active");
		    aktiivne.first().removeClass("active");
		} else {
			$("li").first().addClass("active");
			$("li").last().removeClass("active");
		}
	});
	
	$("#prev").click(function() {
		var aktiivne = $("li.active");
	    if (aktiivne.prev().is("li")) {
		    aktiivne.prev().addClass("active");
		    aktiivne.last().removeClass("active");
		} else {
			$("li").last().addClass("active");
			$("li").first().removeClass("active");
		}
	});
});