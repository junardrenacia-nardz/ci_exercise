const filterToggle = document.querySelector(".btn-filter");
const filterOptions = document.querySelector(".filter-option");

function toggleFilterOptions() {
	filterOptions.classList.toggle("collapsed");
}

const department = document.getElementById("department");
const position = document.getElementById("position");

const editDepartment = document.getElementById("editdepartment");
const editPosition = document.getElementById("editposition");

if (editDepartment && editPosition) {
	setupDepartmentPosition(editDepartment, editPosition);
}

if (department && position) {
	setupDepartmentPosition(department, position);
}

function setupDepartmentPosition(deptSelect, posSelect) {
	const allOptions = Array.from(posSelect.options);

	function filterPositions(selectedDept, selectedPosition = null) {
		posSelect.innerHTML = '<option value="">- Select a Position -</option>';

		if (!selectedDept) {
			posSelect.disabled = true;
			return;
		}

		posSelect.disabled = false;

		allOptions.forEach((option) => {
			// skip placeholder
			if (option.value === "") return;

			if (option.dataset.department == selectedDept) {
				const newOption = option.cloneNode(true);

				// restore selected position
				if (selectedPosition && newOption.value == selectedPosition) {
					newOption.selected = true;
				}

				posSelect.appendChild(newOption);
			}
		});
	}

	deptSelect.addEventListener("change", function () {
		filterPositions(this.value);
	});

	// initial load
	if (deptSelect.value) {
		filterPositions(deptSelect.value, posSelect.value);
	}
}

$(document).on("click", "#changePassBtn", function () {
	let user_id = $(this).data("pass_user_id");
	let fullname = $(this).data("user_fullname");
	$("#pass_user_id").val(user_id);
	$("#fullname_user").val(fullname);
	$("#user_pass_id").html("UID-" + String(user_id).padStart(5, "0"));
	$("#user_fullname").html(fullname);
});

$(document).on("click", "#deactivate_btn", function () {
	let user_id = $(this).data("user_id");
	let employee_id = $(this).data("employee_id");

	$("#deactivate_user_id").val(user_id);
	$("#deactivate_employee_id").val(employee_id);
	$("#user_id_text").html(user_id);
});

$(document).on("click", "#activate_btn", function () {
	let user_id = $(this).data("user_id");
	let employee_id = $(this).data("employee_id");

	$("#activate_user_id").val(user_id);
	$("#activate_employee_id").val(employee_id);
	$("#user_id_activate").html(user_id);
});

// Password
let password = document.getElementById("newPassword");
const regexPassword = /[^A-Za-z\d@$!%*?&-]/;

let passwordRequirement = document.getElementById("requirement");
let passwordLength = document.getElementById("length");
let passwordLowCase = document.getElementById("lowCase");
let passwordUpCase = document.getElementById("upCase");
let passwordSpecialChars = document.getElementById("specialChars");
let passwordNumbers = document.getElementById("nums");
let passwordInvalid = document.getElementById("invalid");

function validatePassword() {
	let passwordVal = password.value;
	passwordRequirement.textContent = "Password Requirement:";

	if (regexPassword.test(passwordVal)) {
		passwordInvalid.style.display = "block";
		passwordInvalid.innerHTML =
			"<li class = 'text-danger'>Password input is invalid</li>";
		passwordLength.style.display = "none";
		passwordLowCase.style.display = "none";
		passwordUpCase.style.display = "none";
		passwordNumbers.style.display = "none";
		passwordSpecialChars.style.display = "none";
	} else {
		passwordInvalid.style.display = "none";
		passwordLength.style.display = "block";
		passwordLowCase.style.display = "block";
		passwordUpCase.style.display = "block";
		passwordNumbers.style.display = "block";
		passwordSpecialChars.style.display = "block";
	}

	if (passwordVal.length < 8) {
		passwordLength.innerHTML =
			"<li class = 'text-danger'>Password must have at least 8 character</li>";
	} else {
		passwordLength.innerHTML =
			"<li>Password must have at least 8 character</li>";
		passwordLength.style.color = "green";
	}

	if (!/^(?=.*[a-z])[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
		passwordLowCase.innerHTML =
			"<li class = 'text-danger'>Password must contain a lower cased letter</li>";
	} else {
		passwordLowCase.innerHTML =
			"<li>Password must contain a lower cased letter</li>";
		passwordLowCase.style.color = "green";
	}

	if (!/^(?=.*[A-Z])[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
		passwordUpCase.innerHTML =
			"<li class = 'text-danger'>Password must contain a upper cased letter</li>";
	} else {
		passwordUpCase.innerHTML =
			"<li>Password must contain a upper cased letter</li>";
		passwordUpCase.style.color = "green";
	}

	if (!/^(?=.*\d)[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
		passwordNumbers.innerHTML =
			"<li class = 'text-danger'>Password must contain a number</li>";
	} else {
		passwordNumbers.innerHTML = "<li>Password must contain a number</li>";
		passwordNumbers.style.color = "green";
	}

	if (!/^(?=.*[@$!%*?&-])[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
		passwordSpecialChars.innerHTML =
			"<li class = 'text-danger'>Password must contain a special character</li>";
	} else {
		passwordSpecialChars.innerHTML =
			"<li>Password must contain a special character</li>";
		passwordSpecialChars.style.color = "green";
	}
}

password.addEventListener("input", validatePassword);
