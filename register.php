<?php
	session_start();
	require_once 'dbcon.php';

	if ( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
		exit;
	}

	if (isset($_POST['btnSubmit'])) {

		$txtUser = $_POST['txtUser'];
		$txtEmail = $_POST['txtEmail'];
		$txtPassword = $_POST['txtPassword'];

		$hashPass = password_hash($txtPassword, PASSWORD_BCRYPT);

		if (empty($txtUser) || empty($txtEmail) || empty($txtPassword)) {

			echo "Fields are required";

		}

		else {

			$qry1 = "SELECT
						userID, userEmail
					FROM
						tbl_account
					WHERE
						userEmail = ? ";
			$stmt1 = $conn->prepare($qry1)
			or die (mysqli_error($conn));

			$stmt1->bind_param("s", $txtEmail);

			$stmt1->execute();
			$stmt1->store_result();

			$count = $stmt1->num_rows;

			if ($count == 1) {
				echo "<span style='color: red'>Email already exists</span>";
				$stmt1->close();
			}

			else {

				$qry2 = "INSERT INTO
						tbl_account
						(uName, userEmail, userPass)
					VALUES
						(?, ?, ?)";

				$stmt2 = $conn->prepare($qry2)
				or die (mysqli_error($conn));

				$stmt2->bind_param("sss", $txtUser, $txtEmail, $hashPass);

				if ($stmt2->execute()) {
					echo "<span style='color: green'>Successfully Registered</span>";
				}
				else {
					echo "<span style='color: red'>Please try again</span>";
				}
				$stmt2->close();
			}
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
				Username <input type="text" name="txtUser" placeholder="username101" required> <br />
				Email <input type="email" name="txtEmail" placeholder="sample@gmail.com" required> <br />
				Password <input type = "password" name="txtPassword" placeholder="*********" required> <br />
				<input type="submit" value="Sign Up" name="btnSubmit"> <br />
				<a href="index.php" style="text-decoration: none">Sign In here...</a>
			</form>
		</body>
	</html>