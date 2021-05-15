<html>
<head>
<title>Login</title>
</head>
<style>
body{
	height: 250px;
	display: flex;
	justify-content: center;
	align-items: center;
}
</style>
<body>
	<div>
	<h3 style='font-size:30px; width: 500px; text-align: center; border: 3px solid gold; border-radius: 0.4em;'>Login Page</h3>
	<div style='text-align: center;'>
	<form action='login_check.php' method='POST'>
		<p style='font-size: 18px;'> ID : <input type='text' name='id'/>
		<br><br>
		<p style='font-size: 18px;'> PW : <input type='text' name='passwd'/>
		<br><br>
		<!--<input type='submit' value='Join'/>-->
		<button style='font-size: 18px;'>Join</button>
	</form>
	</div>
	</div>
</body>
</html>
