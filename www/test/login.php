<?php

require_once './layout.inc';

require_once './db.php';




$base = new Layout;




$base->link = './style.css';




$db = new DBC;

$db->DBI();




$id = $_POST['logid'];

$pass = $_POST['logpass'];




$db->query = "select id, pass, permit from member where id='".$id."' and pass=password('".$pass."')";

$db->DBQ();




$num = $db->result->num_rows;

$data = $db->result->fetch_row();




$db->DBO();




if($num==1)

{

	$_SESSION['id'] = $id;

	$_SESSION['permit'] = $data[2];

	echo "<script>location.replace('/');</script>";

} else if(($id!="" || $pass!="") && $data[0]!=1)

{

	echo "<script>alert('ID and Password are not correct');</script>";

}




$base->content = "

<form action='".$_SERVER['PHP_SELF']."' method='post'>

	<table style='margin:0 auto; margin-top:5%;'>

		<tr>

			<th colspan='2'>login</th>

		</tr>

		<tr>

			<td><input type='text' name='logid'size='16' placeholder='ID'/></td>

			<td rowspan='2'><input type='submit' value='login' style='height:50px;'/></td>

		</tr>

		<tr>

			<td><input type='password' name='logpass' size='16' placeholder='Password'/></td>

		</tr>

		<tr>

			<td><a href='./registi.php'>Registration</a></td>

			<td style='text-align:right;'><a href='./find.php'>search</a></td>

		</tr>

	</table>

</form>

";




$base->LayoutMain();




?>
