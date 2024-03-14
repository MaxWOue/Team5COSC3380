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
		<label>UserName: </label><input name="DataReportUserName" id="DataReportUserName" type="text">
		<label>Supervisor: </label><input name="DataReportSupervisor" id="DataReportSupervisor" type="text"><label><br></label>
		<label>Work Days:<br></label>
		<input type="checkbox" id="WorksOnMonday"><label>Monday</label>
		<input type="checkbox" id="WorksOnTuesday"><label>Tuesday</label>
		<input type="checkbox" id="WorksOnWednesday"><label>Wednesday</label>
		<input type="checkbox" id="WorksOnThursday"><label>Thursday</label>
		<input type="checkbox" id="WorksOnFriday"><label>Friday</label>
		<input type="checkbox" id="WorksOnSaturday"><label>Saturday</label>
		<input type="checkbox" id="WorksOnSunday"><label>Sunday</label><br>
		<input type="submit" id="button" value="Search" name="datareport_employee_submitbutton"><br><br>
	</form>
  </body>
  <?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";
		$searchedfirstname = $_POST['DataReportFirstName'];
		$searchedlastname = $_POST['DataReportLastName'];
		$searchedidasstr = $_POST['DataReportEmployeeID'];
		$searchedidasint = intval($searchedidasstr);
		$searchedposition = $_POST['DataReportPosition'];
		$searchusername = $_POST['DataReportUserName'];
		$searchsupervisor = $_POST['DataReportSupervisor'];
		echo $searchedfirstname;

		if(isset($_POST['datareport_employee_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName FROM employee WHERE EmployeeID=' . $searchedidasint . ' AND Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND Supervisor LIKE "%' . $searchsupervisor . '%" ORDER BY lastName, firstName';

			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			//EmployeeID=' . intval($DataReportEmployeeID)

			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				//echo $row['FirstName'] . " " . $row['LastName'] . ;
				echo "=" . $row['FirstName'] . " " . $row['LastName'] . "=<br>Employee ID: " . $row['EmployeeID'] . "<br>Supervisor ID: " . $row['Supervisor'] . "<br>Position: " . $row['Postion'] . "<br>Employee User Name: " . $row['UserName'] . "<br><br>";
			}
		}
	?>
 </html>
