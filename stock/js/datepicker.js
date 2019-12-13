$(document).ready(function() {
    $("#fromdate").datepicker();
    $("#todate").datepicker();
    $("button").click(function() {
    	var selected = $("#dropdown option:selected").text();
        var departing = $("#fromdate").val();
        var returning = $("#todate").val();
        if (departing === "" || returning === "") {
			alert("Please select from and to dates.");
        } else {
			confirm("Would you like to go to " + selected + " on " + departing + " and return on " + returning + "?");
        }
    });
});