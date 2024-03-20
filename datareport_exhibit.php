<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<link rel="stylesheet" href="datareport_styles.css" />
  </head>
  <header>
  	<h1>Employee Search</h1>
  </header>
  <body>
	<br><br>
	<div class="datareportinput" id="datareportemployee_input">
		<form id="form_datareportexhibit" method="post">
			<h2>Enter values and click search:</h2>
			<label>Title: </label><input name="DataReportTitle" id="DataReportTitle" type="text">
			<label>Exhibit Type: </label><input name="DataReportType" id="DataReportType" type="text"><label><br></label>
			<label>Building: </label><input name="DataReportBuilding" id="DataReportBuilding" type="text">
			<label>Floor: </label><input name="DataReportFloor" id="DataReportFloor" type="text"><label><br></label>
			<label>Description: </label><input name="DataReportDescription" id="DataReportDescription" type="text"><br><br>
			<button type="submit" id="button" value="Search" name="datareport_exhibit_submitbutton">Search</button><br><br>
			<form method="post"><button type="submit" name="datareport_exhibit_clearselectionbutton">Clear selection</button></form>
		</form>
	</div>
  </body>
  <div class="datareportphpresults"><?php
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
	?></div>
 </html>