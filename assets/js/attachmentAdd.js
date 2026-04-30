const resetBtn = document.getElementById("resetBtn");
const inputAttachmentFiles = document.getElementById("files");
const fileList = document.getElementById("fileList");

let selectedFiles = [];

inputAttachmentFiles.addEventListener("change", (e) => {
	const newFiles = Array.from(e.target.files);

	// Append instead of overwrite
	selectedFiles = [...selectedFiles, ...newFiles];

	updateInputFiles();
	renderList();
});

function renderList() {
	fileList.innerHTML = "";

	selectedFiles.forEach((file, index) => {
		const li = document.createElement("li");
		li.className = "list-group-item d-flex align-items-center";
		li.style.marginBottom = "10px";

		// 🔹 Wrapper div (THIS is what you want)
		const wrapper = document.createElement("div");
		wrapper.className =
			"ms-2 w-100 d-flex justify-content-between align-items-center";

		const fileInfo = document.createElement("div");
		fileInfo.innerHTML = `<span>${file.name}</span>`;

		// Remove button
		const btn = document.createElement("button");
		btn.classList.add("remove-attachment");
		btn.innerHTML =
			"<i class='fa-solid fa-xmark has-tooltip' title = 'remove' ></i>";
		btn.type = "button"; // prevent form submit
		btn.style.marginLeft = "10px";
		btn.onclick = () => removeFile(index);

		const fileIcons = {
			pdf: "assets/images/ticket_attachments/defaults/pdf.png",
			doc: "assets/images/ticket_attachments/defaults/word.png",
			docx: "assets/images/ticket_attachments/defaults/word.png",
			xls: "assets/images/ticket_attachments/defaults/excel.png",
			xlsx: "assets/images/ticket_attachments/defaults/excel.png",
			ppt: "assets/images/ticket_attachments/defaults/ppt.png",
			pptx: "assets/images/ticket_attachments/defaults/ppt.png",
			txt: "assets/images/ticket_attachments/defaults/txt.png",
			zip: "assets/images/ticket_attachments/defaults/zip.png",
			rar: "assets/images/ticket_attachments/defaults/zip.png",
			default: "assets/images/ticket_attachments/defaults/file.png",
		};

		const fileName = file.name.toLowerCase();
		const ext = fileName.split(".").pop();

		const img = document.createElement("img");
		// ✅ Image preview (FIXED: now inside loop)

		let previewElement;

		if (file.type.startsWith("image/")) {
			// Show actual image
			previewElement = document.createElement("img");
			previewElement.src = URL.createObjectURL(file);
		} else {
			// Show icon based on extension
			previewElement = document.createElement("img");

			const iconPath = fileIcons[ext] || fileIcons["default"];
			previewElement.src = BASE_URL + iconPath;
		}

		// Styling
		previewElement.style.display = "block";
		previewElement.style.width = "50px";
		previewElement.style.marginBottom = "5px";
		li.appendChild(previewElement);

		wrapper.appendChild(fileInfo);
		wrapper.appendChild(btn);

		li.appendChild(wrapper);

		fileList.appendChild(li);
	});
}

function removeFile(index) {
	selectedFiles.splice(index, 1);
	updateInputFiles();
	renderList();
}

function updateInputFiles() {
	const dataTransfer = new DataTransfer();

	selectedFiles.forEach((file) => {
		dataTransfer.items.add(file);
	});

	inputAttachmentFiles.files = dataTransfer.files;
}

// resetBtn.addEventListener('click', () => {
//     selectedFiles = [];
//     updateInputFiles();
//     renderList();
// });

resetBtn.addEventListener("click", (e) => {
	e.preventDefault();
	const form = document.getElementById("createNewTicket");

	// Reset native form fields
	form.reset();

	// 🔹 Clear file list (your custom logic)
	selectedFiles = [];
	updateInputFiles();
	renderList();

	// 🔹 Reset dropdown states
	const department = document.getElementById("selectDepartment");
	const subject = document.getElementById("ticketSubject");
	const description = document.getElementById("ticketDescription");
	const requestType = document.getElementById("requestType");

	subject.value = "";
	description.value = "";
	department.value = "";

	requestType.value = "";
	requestType.disabled = true;

	// 🔹 (optional) clear validation messages
	form.querySelectorAll("span").forEach((span) => (span.innerHTML = ""));
});
