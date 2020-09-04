<?php




require_once './layout.inc';




$base = new Layout;




$base->link = './style.css';

$base->content = "

<form action='./registio.php' method='post'>

	<table style='margin:0 auto; margin-top:5%;'>

		<tr>

			<th colspan='2'>Sign Up</th>

		</tr>

		<tr>

			<td>ID</td>

			<td><input type='text' size='16' name='id' placeholder='ID'/></td>

		</tr>

		<tr>

			<td>password</td>

			<td><input type='password' size='16' name='pass1' placeholder='password'/></td>

		</tr>

		<tr>

			<td>confirm password</td>

			<td><input type='password' size='16' name='pass2' placeholder='confirm password'/></td>

		</tr>

		<tr>

			<td>email</td>

			<td><input type='text' size='16' name='mail' placeholder='email'/></td>

		</tr>

		<tr>

			<td colspan='2' style='text-align:center;'><input type='submit' value='registration'/></td>

		</tr>

	</table>

</form>

";

$base->LayoutMain();

?>
