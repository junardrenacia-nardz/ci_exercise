$(document).on("click", ".edit_user_btn", function () {
	let id = $(this).data("id");

	$.ajax({
		url: editUserUrl,
		type: "POST",
		data: { id: id },

		success: function (response) {
			// remove old modal (important)
			$("#editModal").remove();

			// insert modal from other PHP file
			$("body").append(response);

			// NOW show it (because it exists in DOM)
			let modal = new bootstrap.Modal(document.getElementById("editModal"));

			modal.show();
		},
	});
});
