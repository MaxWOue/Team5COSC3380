<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<script src="datareportscriptemployee.sql"></script>
  </head>
  <body>
	<h2>Employee Search</h2>
	<form id="form_datareportemployees" method="post">
		<label>First Name: </label><input name="DataReportFirstName" type="text">
		<label>Last Name: </label><input name="DataReportLastName" id="DataReportLastName" type="text"><label><br></label>
		<label>ID: </label><input name="DataReportEmployeeID" id="DataReportEmployeeID" type="text">
		<label>Position: </label><input name="DataReportPosition" id="DataReportPosition" type="text"><label><br></label>
		<label>UserName: </label><input name="DataReportUserName" id="DataReportUserName" type="text"><br>
		<input type="submit" id="button" value="Search" name="datareport_employee_submitbutton"><br><br>
		<form method="post"><button type="submit" name="datareport_employee_clearselectionbutton">Clear selection</button></form>
	</form>
  </body>
  <?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";
		$searchedfirstname = $_POST['DataReportFirstName'];
		$searchedlastname = $_POST['DataReportLastName'];
		$searchedid = $_POST['DataReportEmployeeID'];
		$searchedposition = $_POST['DataReportPosition'];
		$searchusername = $_POST['DataReportUserName'];

		if(isset($_POST['datareport_employee_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if($searchedid == ""){
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" ORDER BY lastName, firstName';
			}
			else{
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND EmployeeID=' . intval($searchedid) . ' ORDER BY lastName, firstName;';
			}
			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				echo "=" . $row['FirstName'] . " " . $row['LastName'] . "=<br>Employee ID: " . $row['EmployeeID'] . "<br>Supervisor ID: " . $row['Supervisor'] . "<br>Position: " . $row['Postion'] . "<br>Employee User Name: " . $row['UserName'] . "<br><br>";
			}
		}

		if(isset($_POST['datareport_employee_clearselectionbutton'])){
			$searchedfirstname = "";
			$searchedlastname = "";
			$searchedid = "";
			$searchedposition = "";
			$searchusername = "";
		}
	?>
 </html>