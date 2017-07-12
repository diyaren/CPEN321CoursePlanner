


var openNav = function() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

var closeNav = function() {
	console.log("Close Sidebar!");
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    //document.body.style.backgroundColor = "white";
}

var open = document.getElementById("openSidebar");
open.onclick = openNav;

var close = document.getElementById("closeSidebar");
close.onclick = closeNav;