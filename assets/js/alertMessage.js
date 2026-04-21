const alertBox = document.getElementById("alertMessage");

if (alertBox) {
	setTimeout(() => {
		alertBox.style.transition = "opacity 0.5s ease";
		alertBox.style.opacity = "0";
		setTimeout(() => {
			alertBox.remove();
		}, 500);
	}, 3000); // 3 seconds
}
