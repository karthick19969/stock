


<?php
if($_POST["action"]=="PrintHi"){
    echo $_POST["PrintMessage"];
}


$vote = $_POST['vote']; // either 'good', or 'bad'
echo "vote is".$vote;
?>
