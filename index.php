<?php
	session_start();
	require_once 'dbcon.php';

	if ( isset($_SESSION['user']) != "" ) {
		header("Location: home.php");
		exit;
	}

	if (isset($_POST['btnLog'])) {

		$txtEmail = $_POST['txtEmail'];
		$pass = $_POST['txtPassword'];


							$qry = "SELECT
										userID, userEmail, userPass
									FROM
										tbl_account
									WHERE
										userEmail = ?";
			$stmt1 = $conn->prepare($qry)
			or die (mysqli_error($conn));

			$stmt1->bind_param("s", $txtEmail);

			$stmt1->execute();
			$stmt1->bind_result($userID, $userEmail, $userPass);
			$stmt1->store_result();

			$stmt1->fetch();

			$vPass = password_verify($pass, $userPass);

			$count = $stmt1->num_rows;
		
			if ($count == 1 && $vPass == $userPass) {
				$_SESSION['user'] = $userID;

				// user => 1
				header("Location: home.php");
				exit;
			}
			else {
				echo "<p style='color: red'>Wrong input</p>";
			}

	}
	
	$conn->close();


?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Mysqli Function</title>
		</head>
		<body>
			<form method="POST">
				Email <input type="email" name="txtEmail" placeholder="something@gmail.com" required>
				Password <input type = "password" name="txtPassword" placeholder="*********" required>
				<input type="submit" value="Sign In" name="btnLog"> <br />
				<a href="register.php" style="text-decoration: none">Sign Up here...</a>
			</form>
		</body>
	</html>