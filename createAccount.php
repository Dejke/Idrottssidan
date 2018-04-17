<!DOCTYPE html>
<html>
<head>
	<title>Skapa konto</title>

	<script type="text/javascript">
		
		function validate(form){

			var e = form.elements;
			if (e["password"].value == e["password2"].value && e["email"].value == e["email2"].value){

				// oof
				return true;

			} else return false;

		}

	</script>

</head>
<body>

	<!-- Eller ska den skicka till self?!?!? hmmm idk meme -->
	<form action="db_add_user.php" method="post" onsubmit="return validate(this)">
		
		<span>Email</span><br>
		<input type="text" name="email"><br>

		<span>Email igen</span><br>
		<input type="text" name="email2"><br><br>

		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

		<span>Lösenord igen</span><br>
		<input type="password" name="password2">

		<input type="submit" value="Skapa konto">

	</form>

</body>
</html>