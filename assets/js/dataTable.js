var ticketTable;

$(document).ready(function () {
	ticketTable = $("#ticketTable").DataTable({
		order: [[0, "asc"]],
		// stateSave: true,
		dom: 'f rt<"bottom"l p i>',
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
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
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
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
				},
			},
			{
				extend: "print",
				text: '<i class="fa fa-print"></i> Print',
				exportOptions: {
					modifier: {
						search: "applied",
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
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
$.fn.dataTable.version;
