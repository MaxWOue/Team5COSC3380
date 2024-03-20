<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<script src="datareportscriptemployee.sql"></script>
  </head>
  <body>
	<h2>Exhibit Search</h2>
	<form id="form_datareportemployees" method="post">
		<label>Title: </label><input name="DataReportTitle" id="DataReportTitle" type="text">
		<label>Exhibit Type: </label><input name="DataReportType" id="DataReportType" type="text"><label><br></label>
		<label>Building: </label><input name="DataReportBuilding" id="DataReportBuilding" type="text">
		<label>Floor: </label><input name="DataReportFloor" id="DataReportFloor" type="text"><label><br></label>
		<label>Description: </label><input name="DataReportDescription" id="DataReportDescription" type="text"><label><br></label>
		<input type="submit" id="button" value="Search" name="datareport_exhibit_submitbutton"><br><br>
		<form method="post"><button type="submit" name="datareport_exhibit_clearselectionbutton">Clear selection</button></form>
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
			$sqlDataReport = '';
			if($searchedbuilding == "" && $searchedfloor == ""){
				$sqlDataReport = 'SELECT ExhibitType, ExhibitTitle, ExhibitDescription, Building, RoomFloor FROM exhibit, room WHERE room.RoomID=exhibit.RoomID AND ExhibitType LIKE "%' . $searchedtype . '%" AND ExhibitTitle LIKE "%' . $searchedtitle . '%" AND ExhibitDescription LIKE "%' . $searcheddesc .  '%" ORDER BY Building, RoomFloor, ExhibitTitle;';
			}else if($searchedbuilding == "" && $searchedfloor != ""){
				$sqlDataReport = 'SELECT ExhibitType, ExhibitTitle, ExhibitDescription, Building, RoomFloor FROM exhibit, room WHERE room.RoomID=exhibit.RoomID AND ExhibitType LIKE "%' . $searchedtype . '%" AND ExhibitTitle LIKE "%' . $searchedtitle . '%" AND ExhibitDescription LIKE "%' . $searcheddesc .  '%" AND RoomFloor=' . intval($searchedfloor) . ' ORDER BY Building, RoomFloor, ExhibitTitle;';
			}else if($searchedbuilding != "" && $searchedfloor == ""){
				$sqlDataReport = 'SELECT ExhibitType, ExhibitTitle, ExhibitDescription, Building, RoomFloor FROM exhibit, room WHERE room.RoomID=exhibit.RoomID AND ExhibitType LIKE "%' . $searchedtype . '%" AND ExhibitTitle LIKE "%' . $searchedtitle . '%" AND ExhibitDescription LIKE "%' . $searcheddesc .  '%" AND Building=' . intval($searchedbuilding) . ' ORDER BY Building, RoomFloor, ExhibitTitle;';
			}else{
				$sqlDataReport = 'SELECT ExhibitType, ExhibitTitle, ExhibitDescription, Building, RoomFloor FROM exhibit, room WHERE room.RoomID=exhibit.RoomID AND ExhibitType LIKE "%' . $searchedtype . '%" AND ExhibitTitle LIKE "%' . $searchedtitle . '%" AND ExhibitDescription LIKE "%' . $searcheddesc .  '%" AND Building=' . intval($searchedbuilding) . ' AND RoomFloor=' . intval($searchedfloor) . ' ORDER BY Building, RoomFloor, ExhibitTitle;';
			}
			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			//EmployeeID=' . intval($DataReportEmployeeID)

			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				//echo $row['FirstName'] . " " . $row['LastName'] . ;
				echo "=" . $row['ExhibitTitle'] . "=<br>Exhibit Type: " . $searchedtype . "<br>Exhibit Description: " . $row['ExhibitDescription'] . "<br>Building Number: " . $row['Building'] . "<br>Floor: " . $row['RoomFloor'] . "<br><br>";					
			}
		}
		
		if(isset($_POST['datareport_exhibit_clearselectionbutton'])){
			$searchedtitle = "";
			$searchedtype = "";
			$searchedbuilding = "";
			$searchedfloor = "";
			$searcheddesc = "";
		}
	?>
 </html>