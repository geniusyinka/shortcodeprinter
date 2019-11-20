
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

function myFunction() {
  alert("Hello! I am an alert box!");
}

var list = document.getElementsByClassName("short_code");
for (var i = 0; i < list.length; i++) {
    list[i].id = "div" + (i + 1);
}