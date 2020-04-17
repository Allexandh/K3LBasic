$( document ).ready(function() {
	var data = (btoa($(".table-contents").html()));
	$("#tableencoded").val(data);
	$('button[type="submit"]').on("click", function(){
		console.log("test");
	});
});