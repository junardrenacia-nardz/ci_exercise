function saveToJSON() {
	const form = document.getElementById("registerForm");

	const data = {
		firstName: form.firstName.value,
		lastName: form.lastName.value,
		contact: form.contact.value,
		department: form.department.value,
		role: form.role.value,
		email: form.email.value,
		password: form.email.value,
	};

	localStorage.setItem("registerDraft", JSON.stringify(data));
}

document.addEventListener("DOMContentLoaded", () => {
	const form = document.getElementById("registerForm");

	if (!form) return;

	// Restore Data
	const saved = localStorage.getItem("registerDraft");

	if (saved) {
		const data = JSON.parse(saved);

		if (form.firstName) form.firstName.value = data.firstName || "";
		if (form.lastName) form.lastName.value = data.lastName || "";
		if (form.contact) form.contact.value = data.contact || "";
		if (form.department) form.department.value = data.department || "";
		if (form.role) form.role.value = data.role || "";
		if (form.email) form.email.value = data.email || "";
		if (form.password) form.password.value = data.password || "";
	}

	// SAVE IN INPUT
	form.addEventListener("input", saveToJSON);
});
