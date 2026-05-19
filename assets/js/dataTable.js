var ticketTable;
var userTable;
var pendingUserTable;

// Ticket Table
$(document).ready(function () {
	ticketTable = $("#ticketTable").DataTable({
		order: [[0, "asc"]],
		// stateSave: true,
		dom: 'f i rt<"bottom"l p>',
		pageLength: 10,
		pagingType: "simple_numbers",
		layout: {
			topStart: null,
			topEnd: "search",
			top: {
				start: null,
				end: null,
			},
		},

		buttons: [
			{
				extend: "excelHtml5",
				text: '<i class="fa fa-file-excel"></i> Excel',
				title: "Ticket Report",
				exportOptions: {
					columns: ":visible",
					modifier: {
						search: "applied", // ✅ respects filters
						order: "applied",
					},
				},
			},
			{
				extend: "csvHtml5",
				text: '<i class="fa fa-file-csv"></i> CSV',
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
				},
			},
			{
				extend: "pdfHtml5",
				text: '<i class="fa fa-file-pdf"></i> PDF',
				orientation: "landscape",
				pageSize: "A4",
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
				},
			},
			{
				extend: "print",
				text: '<i class="fa fa-print"></i> Print',
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
				},
			},
		],

		initComplete: function () {
			$(".dt-search input").attr("placeholder", "Keyword");

			// ✅ PUT THEM HERE
			$(".dt-search").append($(".dataTables_filter"));
			$(".dt-search").prepend($(".filter_specific"));
			$(".dt-search").append($(".filter_options"));

			$(".btn-export-excel").on("click", function () {
				ticketTable.button(".buttons-excel").trigger();
			});

			$(".btn-export-pdf").on("click", function () {
				ticketTable.button(".buttons-pdf").trigger();
			});
			$("#filterStatus").on("change", function () {
				ticketTable.column(4).search(this.value).draw();
			});
			$("#filterPriority").on("change", function () {
				ticketTable.column(2).search(this.value).draw();
			});

			$("#filterDepartment").on("change", function () {
				ticketTable.column(5).search(this.value).draw();
			});

			// Reset Button
			$("#filterForm").on("reset", function () {
				// wait for form to actually reset values
				setTimeout(function () {
					$("#filterStatus").val("");
					$("#filterPriority").val("");

					ticketTable.columns().search("").draw();
				}, 0);
			});
		},
	});
});

// User Table
$(document).ready(function () {
	userTable = $("#userTable").DataTable({
		order: [[0, "asc"]],
		// stateSave: true,
		dom: 'f i rt<"bottom"l p >',
		pageLength: 10,
		stateSave: true,
		pagingType: "simple_numbers",
		layout: {
			topStart: null,
			topEnd: "search",
			top: {
				start: null,
				end: null,
			},
		},

		buttons: [
			{
				extend: "excelHtml5",
				text: '<i class="fa fa-file-excel"></i> Excel',
				title: "Users Report",
				exportOptions: {
					columns: ":visible",
					modifier: {
						search: "applied", // ✅ respects filters
						order: "applied",
					},
				},
			},
			{
				extend: "csvHtml5",
				text: '<i class="fa fa-file-csv"></i> CSV',
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7],
				},
			},
			{
				extend: "pdfHtml5",
				text: '<i class="fa fa-file-pdf"></i> PDF',
				orientation: "landscape",
				pageSize: "A4",
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7],
				},
			},
			{
				extend: "print",
				text: '<i class="fa fa-print"></i> Print',
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7],
				},
			},
		],

		initComplete: function () {
			$(".dt-search input").attr("placeholder", "Keyword");

			// ✅ PUT THEM HERE
			$(".dt-search").append($(".user-util"));
			$(".dt-search").prepend($(".user-filter"));

			$(".btn-export-excel").on("click", function () {
				userTable.button(".buttons-excel").trigger();
			});

			$(".btn-export-pdf").on("click", function () {
				userTable.button(".buttons-pdf").trigger();
			});

			$("#filterStatus").on("change", function () {
				userTable.column(3).search(this.value).draw();
			});

			$("#filterDepartment").on("change", function () {
				userTable.column(4).search(this.value).draw();
			});

			$("#filterRole").on("change", function () {
				userTable.column(5).search(this.value).draw();
			});

			// Reset Button
			$("#filterForm").on("reset", function () {
				// wait for form to actually reset values
				setTimeout(function () {
					userTable.columns().search("").draw();
				}, 0);
			});
		},
	});
});

// // Pending User Table
// $(document).ready(function () {
// 	pendingUserTable = $("#pendingUserTable").DataTable({
// 		order: [[0, "asc"]],
// 		// stateSave: true,
// 		dom: 'f i rt<"bottom"l p >',
// 		pageLength: 10,
// 		pagingType: "simple_numbers",
// 		layout: {
// 			topStart: null,
// 			topEnd: "search",
// 			top: {
// 				start: null,
// 				end: null,
// 			},
// 		},

// 	});
// });

$("#approve_user").on("shown.bs.modal", function () {
	if (!$.fn.DataTable.isDataTable("#pendingUserTable")) {
		pendingUserTable = $("#pendingUserTable").DataTable({
			order: [[0, "asc"]],
			dom: 'f i rt<"bottom"l p>',
			pageLength: 10,

			initComplete: function () {
				$(".dt-search input").attr("placeholder", "Search...");
			},
		});
	}
});

$("#audit_trail").on("shown.bs.modal", function () {
	if (!$.fn.DataTable.isDataTable("#auditTable")) {
		auditTable = $("#auditTable").DataTable({
			order: [[0, "asc"]],
			dom: 'f i rt<"bottom"l p>',
			pageLength: 10,
			autoWidth: true,

			initComplete: function () {
				$(".dt-search input").attr("placeholder", "Search...");
			},
		});
	}
});

$.fn.dataTable.version;
