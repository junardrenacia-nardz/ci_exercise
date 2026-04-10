const toggler = document.querySelector(".toggler-btn");
const toggler_sidebar = document.querySelector(".sidebar-toggler");
const sidebar = document.querySelector("#sidebar");
const overlay_bg = document.querySelector("#overlayBg");
const main_container = document.querySelector("#main");

function toggleSidebar() {
	sidebar.classList.toggle("collapsed");
	overlay_bg.classList.toggle(
		"active",
		!sidebar.classList.contains("collapsed"),
	);
}

toggler.addEventListener("click", toggleSidebar);
toggler_sidebar.addEventListener("click", toggleSidebar);

// click outside (overlay closes sidebar)
overlay_bg.addEventListener("click", () => {
	sidebar.classList.add("collapsed");
	overlay_bg.classList.toggle(
		"active",
		!sidebar.classList.contains("collapsed"),
	);
});
