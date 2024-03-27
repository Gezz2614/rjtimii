php
 Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

 Try and connect using the info above.
$con = mysqli_connect($DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME, $DATABASE_HOST);

if (mysqli_connect_errno()) {
	 If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL ' . mysqli_connect_error());
}

 Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	 Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}

 Make sure the submitted registration values are not empty.
if (empty($_POST['username'])  empty($_POST['password'])  empty($_POST['email'])) {
	 One or more values are empty.
	exit('Please complete the registration form!');
}

 We need to check if the account already exists or not.
$query = SELECT  FROM accounts WHERE username = ;

 Prepare our SQL
if ($stmt = mysqli_prepare($con, $query)) {
	 Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use s
	mysqli_stmt_bind_param($stmt, s, $_POST['username']);
	 Execute the statement
	mysqli_stmt_execute($stmt);
	 Get the result
	mysqli_stmt_store_result($stmt);
	 Check if the account exists, if it does then we will stop the registration process.
	if (mysqli_stmt_num_rows($stmt)  0) {
		exit('That username already exists, please choose another one!');
	}
}

 Username doesnt exists, insert new account
$query = INSERT INTO accounts (username, password, email) VALUES (, , );

 Prepare our SQL
if ($stmt = mysqli_prepare($con, $query)) {
	 Hash our password for security
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	 Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use s
	mysqli_stmt_bind_param($stmt, sss, $_POST['username'], $password, $_POST['email