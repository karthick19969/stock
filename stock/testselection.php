<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>jQuery Get Selected Option Value</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("select.country").change(function(){
    	 alert("Ycalling try - ");
        var selectedCountry = $(".country option:selected").val();
        alert("You have selected the country - " + selectedCountry);
    });

    $("#country").change(function(){
        var selectedCountry = $("#country option:selected").val();
        alert("You have id option selected the country - " + selectedCountry);
    });
});
</script>
</head> 
<body>
    <form>
        <label>Select Country:</label>
        <select id="country" class="country1">
            <option value="usa">United States</option>
            <option value="india">India</option>
            <option value="uk">United Kingdom</option>
        </select>
    </form>
</body>
</html>