$(function() {

	$('#table1').wrap('<div id="hidetable1" class="hide" style="display:none"/>');
	$('#table2').wrap('<div id="hidetable2" class="hide"  style="display:none"/>');
	$('#table3').wrap('<div id="hidetable3"  class="hide" style="display:none"/>');
	$('#table4').wrap('<div id="hidetable4"  class="hide" style="display:none"/>');
	$('#table5').wrap('<div id="hidetable5"  class="hide" style="display:none"/>');

	$('#table1').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }]
	
	} );
	$('#table2').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }]
	} );
	$('#table3').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }]
	} );
	$('#table4').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }]
	} );
	$('#table5').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }]
	  
	} );
	
	console.log($("#drop"))
	$("#hide"+ $("#drop")[0].value).show(); 
	   $("#drop").change(function () {
			var end = this.value;
			$('.hide').hide();
		   $("#hide"+end).show(); 
		});
	  
	 
	});