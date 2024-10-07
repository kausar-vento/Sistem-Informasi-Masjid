// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#dataTable').DataTable();
});

$(document).ready(function () {
  $('#dataTableCheck').DataTable({
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50, 100]
  });
});
