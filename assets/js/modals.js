document.querySelectorAll(".btn-close-reload").forEach((btn) => {
	btn.addEventListener("click", function () {
		setTimeout(() => {
			location.reload();
		}, 250); // 1000ms = 1 second
	});
});

if (showModal) {
	document.addEventListener("DOMContentLoaded", function () {
		var modalId = showModal;
		var myModal = new bootstrap.Modal(document.getElementById(modalId), {
			backdrop: "static",
			keyboard: false,
		});
		myModal.show();
	});
}
