$(function () {

	$('#table1').wrap('<div id="hidetable1" class="hide" style="display:none"/>');
	$('#table2').wrap('<div id="hidetable2" class="hide"  style="display:none"/>');
	$('#table3').wrap('<div id="hidetable3"  class="hide" style="display:none"/>');
	$('#table4').wrap('<div id="hidetable4"  class="hide" style="display:none"/>');
	$('#table5').wrap('<div id="hidetable5"  class="hide" style="display:none"/>');
	$('#table6').wrap('<div id="hidetable6"  class="hide" style="display:none"/>');
	
	
	$('#table1').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }, { type: 'date-uk', targets: 0 }],
	  "stateSave": true,
	 /* "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "http://webserver03/inventadmin/index.php",
			  "data": {state: JSON.stringify(data)},
			  "dataType": "json",
			  "type": "POST",
			  "success": function(){}
			} );
		}*/
	} );
	$('#table2').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table3').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table4').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table5').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	$('#table6').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true
	} );
	console.log($("#drop"))
	$("#hide"+ $("#drop")[0].value).show(); 
	   $("#drop").change(function () {
			var end = this.value;
			$('.hide').hide();
		   $("#hide"+end).show(); 
		}); 
	});