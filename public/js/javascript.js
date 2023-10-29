$('.datatable-basic').DataTable({
  autoWidth: false,
  dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
  language: {
    search: '<span>Filter:</span> _INPUT_',
    lengthMenu: '<span>Show:</span> _MENU_',
    paginate: { 'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←' }
  }
});

var table = $('.datatable-Filtered').DataTable();
$(".datatable-Filtered.dataTables_filter").append($("#categoryFilter"));
var categoryIndex = 0;

$(".datatable-Filtered th").each(function (i) {
  if ($($(this)).html() == "Active") {
    categoryIndex = i; return false;
  }
});
$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var selectedItem = $('#categoryFilter').val()
    var category = data[categoryIndex];
    if (selectedItem === "" || category.includes(selectedItem)) {
      return true;
    }
    return false;
  }
);

//Set the change event for the Category Filter dropdown to redraw the datatable each time
//a user selects a new filter.
$("#categoryFilter").change(function (e) {
  table.draw();
});

table.draw();


function validateForm(form) {
  let startDate = form.elements["startDate"].value;
  let endDate = form.elements["endDate"].value;
  startDate = new Date(startDate).getTime();
  endDate = new Date(endDate).getTime();
  if (endDate < startDate) {
    alert('The Start Date cannot be less than the End Date');
    return false;
  }
}