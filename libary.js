function getParameterByName(e, a = window.location.href) {
	e = e.replace(/[\[\]]/g, "\\$&");
	var t = new RegExp("[?&]" + e + "(=([^&#]*)|&|#|$)").exec(a);
	return t ? t[2] ? decodeURIComponent(t[2].replace(/\+/g, " ")) : "" : null
}
const el = document.currentScript;
$.ajax({
	url: "https://boclink.phongdq.vn/assets/ajaxs/boclink.php",
	method: "GET",
	dataType: "JSON",
	data: {
		v: getParameterByName("v", el.src)
	},
	success: function (e) {
		1 == e.code && (location.href = e.url)
	}
});