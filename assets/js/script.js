const toggler = document.querySelector(".toggler-btn");
toggler.addEventListener("click", function () {
	document.querySelector("#sidebar").classList.toggle("collapsed");
	document.querySelector("#main").classList.toggle("collapsed");
});

const toggler_sidebar = document.querySelector(".sidebar-toggler");
toggler_sidebar.addEventListener("click", function () {
	document.querySelector("#sidebar").classList.toggle("collapsed");
	document.querySelector("#main").classList.toggle("collapsed");
});
