$(document).ready(function () {
  // top nav bar
  $("#navOrder").addClass("active");
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
        if ($.fn.DataTable.isDataTable("#manageReportTable")) {
          $("#manageReportTable").DataTable().destroy();
        }

        // Initialize the new DataTable
        manageOrderTable = $("#manageReportTable").DataTable({
          ajax:
            "php_action/getSetReport.php?startDate=" +
            startDate +
            "&endDate=" +
            endDate,
          order: [],
          dom: "Bfrtip",
          buttons: ["copy", "csv", "excel", "pdf", "print"],
          footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Calculate the sum of the "Grand Total" column (column index 4)
            var sum1 = api
              .column(1, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
              }, 0);
            var sum2 = api
              .column(2, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
              }, 0);
            var sum3 = api
              .column(3, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
              }, 0);
            var sum4 = api
              .column(4, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
              }, 0);

            // Display the sum in the footer
            $(api.column(1).footer()).html('₱' + sum1.toLocaleString());
            $(api.column(2).footer()).html('₱' + sum2.toLocaleString());
            $(api.column(3).footer()).html('₱' + sum3.toLocaleString());
            $(api.column(4).footer()).html('₱' + sum4.toLocaleString());
            $(api.column(6).footer()).html('₱' + (sum1+sum2+sum3+sum4).toLocaleString());
          },
        });
      } // /else

      return false;
    });
});
