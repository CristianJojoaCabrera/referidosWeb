// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add views
var view1 = myApp.addView('#view-1', {
	dynamicNavbar: true
});
var view2 = myApp.addView('#view-2', {
    dynamicNavbar: true
});
var view3 = myApp.addView('#view-3', {
	dynamicNavbar: true
});
var view4 = myApp.addView('#view-4', {
	dynamicNavbar: true
});
var view5 = myApp.addView('#view-5', {
	dynamicNavbar: true
});

// Functions
function setCookie(cname, value) {
	document.cookie = cname + "=" + value;
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function deleteCookie(cname) {
	if (getCookie(cname)) {
		document.cookie = cname + "=" + ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
	}
}