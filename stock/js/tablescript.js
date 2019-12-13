/**
 * Projet Name : Dynamic Form Processing with PHP
 * URL: http://techstream.org/Web-Development/PHP/Dynamic-Form-Processing-with-PHP
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Tech Stream
 * http://techstream.org
 */

//<![CDATA[
      $(function(){

            $('.required').each(function(){
                $(this).html('<span>*</span>' + $(this).text());
            });

        });
      //]]>;

function addRow(tableID,tableRowId) {
	var table = document.getElementById(tableID);
	var tablerow = document.getElementById(tableRowId);
	var rowCount = table.rows.length;
	if(rowCount < 50){							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[1].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Item per ticket is 50.");
			   
	}
}

function deleteRow(tableID) {
	alert("deleteRow  tableID "+tableID);
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	alert("rowCount "+rowCount);
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 2) { 						// limit the user from removing all the fields
				alert("Cannot Remove all the Item.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}