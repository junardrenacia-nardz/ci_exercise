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

const searchBtnToggler = document.querySelector(".search-btn-all");
const inputSearchAll = document.querySelector("#input-search-all");
const searchIcon = searchBtnToggler.querySelector("i");

searchBtnToggler.addEventListener("click", function () {
	if (
		inputSearchAll.style.display === "none" ||
		inputSearchAll.style.display === ""
	) {
		searchBtnToggler.classList.add("btn-secondary");
		searchIcon.classList.remove("fa-magnifying-glass");
		searchIcon.classList.add("fa-chevron-right");
		inputSearchAll.style.display = "block";
	} else {
		searchBtnToggler.classList.remove("btn-secondary");
		searchIcon.classList.add("fa-magnifying-glass");
		searchIcon.classList.remove("fa-chevron-right");
		inputSearchAll.style.display = "none";
	}
});

$(function () {
	$(".has-tooltip").tooltip();
});
