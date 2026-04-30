const toggler = document.querySelector(".toggler-btn");
const toggler_sidebar = document.querySelector(".sidebar-toggler");
const sidebar = document.querySelector("#sidebar");
const main_container = document.querySelector("#main");

toggler.addEventListener("click", function () {
	// sidebar.classList.toggle("collapsed");
	// main_container.classList.toggle("collapsed");
	const isCollapsed = sidebar.classList.contains("collapsed");
	setSidebarState(!isCollapsed);
});
toggler_sidebar.addEventListener("click", function () {
	// sidebar.classList.toggle("collapsed");
	// main_container.classList.toggle("collapsed");
	const isCollapsed = sidebar.classList.contains("collapsed");
	setSidebarState(!isCollapsed);
});

document.addEventListener("DOMContentLoaded", function () {
	const savedState = localStorage.getItem("sidebarCollapsed");

	if (savedState === "true") {
		setSidebarState(true);
	} else {
		setSidebarState(false);
	}

	requestAnimationFrame(() => {
		document.body.classList.remove("no-transition");
	});
});

// helper
function setSidebarState(collapsed) {
	sidebar.classList.toggle("collapsed", collapsed);
	main_container.classList.toggle("collapsed", !collapsed);

	localStorage.setItem("sidebarCollapsed", collapsed);
}

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

document.querySelectorAll(".btn-close-reload").forEach((btn) => {
	btn.addEventListener("click", function () {
		setTimeout(() => {
			location.reload();
		}, 250); // 1000ms = 1 second
	});
});
