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
		<label>Title: </label><input name="DataReportTitle" id="DataReportTitle" type="text">
		<label>Exhibit Type: </label><input name="DataReportType" id="DataReportType" type="text"><label><br></label>
		<label>Building: </label><input name="DataReportBuilding" id="DataReportBuilding" type="text">
		<label>Floor: </label><input name="DataReportFloor" id="DataReportFloor" type="text"><label><br></label>
		<label>Description: </label><input name="DataReportDescription" id="DataReportDescription" type="text"><label><br></label>
		<input type="submit" id="button" value="Search" name="datareport_exhibit_submitbutton"><br><br>
	</form>
  </body>
  <?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";
		$searchedtitle = $_POST['DataReportTitle'];
		$searchedtype = $_POST['DataReportType'];
		$searchedbuilding = $_POST['DataReportBuilding'];
		$searchedfloor = $_POST['DataReportFloor'];
		$searcheddesc = $_POST['DataReportDescription'];

		if(isset($_POST['datareport_exhibit_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			//$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName FROM employee WHERE EmployeeID=' . $searchedidasint . ' AND Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND Supervisor LIKE "%' . $searchsupervisor . '%" ORDER BY lastName, firstName';
			$sqlDataReport = 'SELECT ExhibitType, ExhibitTitle, ExhibitDescription, Building, RoomFloor FROM exhibit, room WHERE room.RoomID=exhibit.RoomID AND ExhibitType LIKE "%' . $searchedtype . '%" AND ExhibitTitle LIKE "%' . $searchedtitle . '%" AND ExhibitDescription LIKE "%' . $searcheddesc .  '%";';

			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			//EmployeeID=' . intval($DataReportEmployeeID)

			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				//echo $row['FirstName'] . " " . $row['LastName'] . ;
				echo "=" . $row['ExhibitTitle'] . "=<br>Exhibit Description: " . $row['ExhibitDescription'] . "<br>Building Number: " . $row['Building'] . "<br>Floor: " . $row['RoomFloor'] . "<br><br>";
			}
		}
	?>
 </html>