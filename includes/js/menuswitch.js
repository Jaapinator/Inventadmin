$(function () {

	$('#table1').wrap('<div id="hidetable1"  class="hide" style="display:none"/>');
	$('#table2').wrap('<div id="hidetable2"  class="hide" style="display:none"/>');
	$('#table3').wrap('<div id="hidetable3"  class="hide" style="display:none"/>');
	$('#table4').wrap('<div id="hidetable4"  class="hide" style="display:none"/>');
	$('#table5').wrap('<div id="hidetable5"  class="hide" style="display:none"/>');
	$('#table6').wrap('<div id="hidetable6"  class="hide" style="display:none"/>');
	
	$('#table1').DataTable( {
	  "searching": true,
	  "lengthMenu": [[12, -1], [12, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "font-family": 'Arial',
	  "stateSave": true
	} );
	$('#table2').DataTable( {
	  "searching": true,
	  "lengthMenu": [[12, -1], [12, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table3').DataTable( {
	  "searching": true,
	  "lengthMenu": [[12, -1], [12, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table4').DataTable( {
	  "searching": true,
	  "lengthMenu": [[12, -1], [12, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table5').DataTable( {
	  "searching": true,
	  "lengthMenu": [[12, -1], [12, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table6').DataTable( {
	  "searching": true,
	  "lengthMenu": [[12, -1], [12, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	
var selec = localStorage.getItem('drop') || $("#drop").val();
$("#hide" + selec).show();
$('#drop').val(selec).change(function() {
  var val = $(this).val();
  $('.hide').hide();
  $("#hide" + val).show();
  localStorage.setItem('drop', val);
});
});	