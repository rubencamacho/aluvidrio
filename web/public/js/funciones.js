$(document).ready(function(){
	$.fn.dataTable.moment("dd/MM/D");

    var table = $('.table').DataTable();
	    order: [[2,"desc"]]
});

