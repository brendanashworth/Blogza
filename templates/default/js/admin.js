

$(document).ready(function() {

	$('#create-post').submit(function(event) {
		event.preventDefault();

		$("#create-post .loader").addClass("show");

		// Delay for a second.
		//$.delay(1);

		// Run the ajax.
		$.ajax({
		 	url: "create-post",
			complete: function(result) {
				$("#create-post .loader").removeClass("show");
			}
		});

	});

});