// function saveToJSON() {
// 	const form = document.getElementById("registerForm");
// 	if (!form) return;

// 	const data = {
// 		firstName: form.elements["firstName"]?.value || "",
// 		lastName: form.elements["lastName"]?.value || "",
// 		contact: form.elements["contact"]?.value || "",
// 		email: form.elements["email"]?.value || "",
// 	};

// 	localStorage.setItem("registerDraft", JSON.stringify(data));
// }

// document.addEventListener("DOMContentLoaded", () => {
// 	const form = document.getElementById("registerForm");

// 	if (!form) return;

// 	// Restore Data
// 	const saved = localStorage.getItem("registerDraft");

// 	if (saved) {
// 		const data = JSON.parse(saved);

// 		if (form.firstName) form.firstName.value = data.firstName || "";
// 		if (form.lastName) form.lastName.value = data.lastName || "";
// 		if (form.contact) form.contact.value = data.contact || "";
// 		if (form.email) form.email.value = data.email || "";
// 	}

// 	// SAVE IN INPUT
// 	form.addEventListener("input", saveToJSON);
// });

function getForm() {
	return document.getElementById("registerForm");
}

function saveToJSON() {
	const form = getForm();
	if (!form) return;

	const data = {
		firstName: form.elements["firstName"]?.value || "",
		lastName: form.elements["lastName"]?.value || "",
		contact: form.elements["contact"]?.value || "",
		email: form.elements["email"]?.value || "",
		department: form.elements["department"]?.value || "",
		role: form.elements["role"]?.value || "",
	};

	localStorage.setItem("registerDraft", JSON.stringify(data));

	// optional debug
	console.log("Saved draft:", data);
}

function restoreFromJSON() {
	const form = getForm();
	if (!form) return;

	const saved = localStorage.getItem("registerDraft");
	if (!saved) return;

	let data = {};

	try {
		data = JSON.parse(saved);
	} catch (e) {
		console.error("Invalid JSON:", e);
		return;
	}

	const setValue = (name, value) => {
		const el = form.elements[name];
		if (el) el.value = value || "";
	};

	setValue("firstName", data.firstName);
	setValue("lastName", data.lastName);
	setValue("contact", data.contact);
	setValue("email", data.email);
	setValue("department", data.department);
	setValue("role", data.role);
}

document.addEventListener("DOMContentLoaded", () => {
	restoreFromJSON();

	const form = getForm();
	if (!form) return;

	form.addEventListener("input", saveToJSON);
});

document.addEventListener("DOMContentLoaded", () => {
	const params = new URLSearchParams(window.location.search);

	if (params.get("clearDraft") === "1") {
		localStorage.removeItem("registerDraft");

		console.log("Draft cleared");

		// clean URL so it doesn't repeat
		window.history.replaceState({}, document.title, window.location.pathname);
	}
});
