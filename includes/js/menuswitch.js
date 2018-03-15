$(function() {

	$('#table1').wrap('<div id="hidetable1" class="hide" style="display:none"/>');
	$('#table2').wrap('<div id="hidetable2" class="hide"  style="display:none"/>');
	$('#table3').wrap('<div id="hidetable3"  class="hide" style="display:none"/>');
	$('#table4').wrap('<div id="hidetable4"  class="hide" style="display:none"/>');
	$('#table5').wrap('<div id="hidetable5"  class="hide" style="display:none"/>');
	$('#table6').wrap('<div id="hidetable6"  class="hide" style="display:none"/>');

	$('#table1').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true,
	  "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "/state_save",
			  "data": data,
			  "dataType": "json",
			  "type": "POST",
			  "success": function () {}
			} );
		}
	
	} );
	$('#table2').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true,
	  "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "/state_save",
			  "data": data,
			  "dataType": "json",
			  "type": "POST",
			  "success": function () {}
			} );
		}
	} );
	$('#table3').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true,
	  "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "/state_save",
			  "data": data,
			  "dataType": "json",
			  "type": "POST",
			  "success": function () {}
			} );
		}
	} );
	$('#table4').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true,
	  "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "/state_save",
			  "data": data,
			  "dataType": "json",
			  "type": "POST",
			  "success": function () {}
			} );
		}
	} );
	$('#table5').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true,
	  "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "/state_save",
			  "data": data,
			  "dataType": "json",
			  "type": "POST",
			  "success": function () {}
			} );
		}
	} );
	$('#table6').DataTable( {
	  "searching": true,
	  "lengthMenu": [[18, -1], [18, "All"]],
	  "columnDefs": [{  "bSortable": false, "aTargets": [-1] }, { "bSearchable":false, "aTargets": [-1] }],
	  "stateSave": true,
	  "stateSaveCallback": function (settings, data) {
			$.ajax( {
			  "url": "/state_save",
			  "data": data,
			  "dataType": "json",
			  "type": "POST",
			  "success": function () {}
			} );
		}
	} );
	console.log($("#drop"))
	$("#hide"+ $("#drop")[0].value).show(); 
	   $("#drop").change(function () {
			var end = this.value;
			$('.hide').hide();
		   $("#hide"+end).show(); 
		});
	  
	 
	});