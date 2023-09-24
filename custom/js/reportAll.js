$(document).ready(function () {
  // top nav bar
  $("#navInventory").addClass("active");
  // order date picker
  $("#startDate").datepicker();
  // order date picker
  $("#endDate").datepicker();

  $("#getOrderReportForm")
    .unbind("submit")
    .bind("submit", function () {
      var startDate = $("#startDate").val();
      var endDate = $("#endDate").val();

      if (startDate == "" || endDate == "") {
        if (startDate == "") {
          $("#startDate").closest(".form-group").addClass("has-error");
          $("#startDate").after(
            '<p class="text-danger">The Start Date is required</p>'
          );
        } else {
          $(".form-group").removeClass("has-error");
          $(".text-danger").remove();
        }

        if (endDate == "") {
          $("#endDate").closest(".form-group").addClass("has-error");
          $("#endDate").after(
            '<p class="text-danger">The End Date is required</p>'
          );
        } else {
          $(".form-group").removeClass("has-error");
          $(".text-danger").remove();
        }
      } else {
        $(".form-group").removeClass("has-error");
        $(".text-danger").remove();

        var form = $(this);

        // Destroy the existing DataTable (if it exists)
        if ($.fn.DataTable.isDataTable("#manageAllReportTable")) {
          $("#manageAllReportTable").DataTable().destroy();
        }

        // Initialize the new DataTable
		  manageOrderTable = $("#manageAllReportTable").DataTable({
			'ajax': 'php_action/getAllTransactReport.php?startDate='+startDate+'&endDate='+endDate,
			'order': [],
			'dom': "Bfrtip",
			'buttons': ["copy", "csv", "excel", "pdf", "print"],
			'footerCallback': function(row, data, start, end, display) {
				var api = this.api();
		
				// Calculate the sum of the "Grand Total" column (column index 4)
				var sum = api.column(4, { page: 'current' }).data().reduce(function(a, b) {
					return parseFloat(a) + parseFloat(b);
				}, 0);
		
				// Display the sum in the footer
				$(api.column(4).footer()).html(sum);
			}
		  });
      } // /else

      return false;
    });
});
