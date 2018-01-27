<?php
	session_start();
	require_once 'dbcon.php';

	if ( isset($_SESSION['user']) == "" ) {
		header("Location: index.php");
		exit;
	}

	$sql = "SELECT userID, uName, userEmail FROM tbl_account ORDER BY rand() LIMIT 0,6";
	$stmt = $conn->prepare($sql)
	or die (mysqli_error($conn));
	$stmt->execute();
	$stmt->bind_result($userID, $uName, $userEmail);

	echo "<table border=1>";
		echo "<thead>";
		echo "
			<tr>
				<td>User ID</td>
				<td>Username</td>
				<td>Email Address</td>
			</tr>
		";
		echo "</thead>";

	while ($stmt->fetch()) {
		echo "<tbody>";
		echo "
			<tr>
				<td>$userID</td>
				<td>$uName</td>
				<td>$userEmail</td>
			</tr>
		";		
		echo "</tbody>";
	}
		echo "</table>";

?>
<html>
	<head>
		<title></title>
		<style type="text/css">
			body {
				font-family: Lucida Console;
			}

			table {
				border-collapse: collapse;
			}
			table thead {
				background-color: skyblue;
			}

			table thead tr td {
				padding: 10px;
				text-align: center
			}
			table tbody tr td {
				padding: 5px;
			}

			table tbody tr:nth-child(even) {
				background-color: #3e2fee;
			}
		</style>
	</head>
<body>
HOME PAGE
<a href="about.php">About</a>
<a href="logout.php?logout">Logout</a>

</body>
</html>