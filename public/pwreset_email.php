<?
    //Generates a password reset email.
    //Takes PASSWORD_RESETS key as $_GET["key"] 
    $link = $_SERVER["HTTP_HOST"]."/password_change.php?str=".$_GET["key"];

?>

En lösenordsändring har begärts på ditt konto till idrottssidan. <br>
Klicka <a href = "<?echo $link?>">här</a> eller på länken nedan för att fylla i ditt nya lösenord.
<br>
<br>
<?echo $link?>
<br><br>
Om du inte har begärt en lösenordsändring så kan du ignorera det här mailet.