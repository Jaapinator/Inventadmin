function showMov(val) {
  localStorage.setItem("SelectedItem", val);

  switch (val) {
    case 'table2':
      {
        $('#table1_form').hide();
        $('#table3_form').hide();
        $('#table4_form').hide();
        $('#table5_form').hide();
        $('#table6_form').hide();
        $('#table7_form').hide();
        $('#table8_form').hide();
        $('#table2_form').show();
        break;
      }
	  case 'table3':
      {
        $('#table1_form').hide();
        $('#table2_form').hide();
        $('#table4_form').hide();
        $('#table5_form').hide();
        $('#table6_form').hide();
        $('#table7_form').hide();
        $('#table8_form').hide();
        $('#table3_form').show();
        break;
      }
	  case 'table4':
      {
        $('#table1_form').hide();
        $('#table2_form').hide();
        $('#table3_form').hide();
        $('#table5_form').hide();
        $('#table6_form').hide();
        $('#table7_form').hide();
        $('#table8_form').hide();
        $('#table4_form').show();
        break;
      }
	  case 'table5':
      {
        $('#table1_form').hide();
        $('#table2_form').hide();
        $('#table3_form').hide();
        $('#table4_form').hide();
        $('#table6_form').hide();
        $('#table7_form').hide();
        $('#table8_form').hide();
        $('#table5_form').show();
        break;
      }
	  case 'table6':
      {
        $('#table1_form').hide();
        $('#table2_form').hide();
        $('#table3_form').hide();
        $('#table4_form').hide();
        $('#table5_form').hide();
        $('#table7_form').hide();
        $('#table8_form').hide();
        $('#table6_form').show();
        break;
      }
	  case 'table7':
      {
        $('#table1_form').hide();
        $('#table2_form').hide();
        $('#table3_form').hide();
        $('#table4_form').hide();
        $('#table5_form').hide();
        $('#table6_form').hide();
        $('#table8_form').hide();
        $('#table7_form').show();
        break;
      }
	  case 'table8':
      {
        $('#table1_form').hide();
        $('#table2_form').hide();
        $('#table3_form').hide();
        $('#table4_form').hide();
        $('#table5_form').hide();
        $('#table6_form').hide();
        $('#table7_form').hide();
        $('#table8_form').show();
        break;
      }
    default:
      {
		$('#table1_form').show();
        $('#table2_form').hide();
        $('#table3_form').hide();
        $('#table4_form').hide();
        $('#table5_form').hide();
        $('#table6_form').hide();
        $('#table7_form').hide();
        $('#table8_form').hide();
      }
  }
}

$(function() {
  var selMovType = document.getElementById('drop');
  var selectedItem = localStorage.getItem("SelectedItem");

	if (selectedItem) {
  	selMovType.value = selectedItem;
  }
});