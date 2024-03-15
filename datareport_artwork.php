<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<script src="datareportscriptemployee.sql"></script>
  </head>
  <body>
	<h2>Artwork Search</h2>
	<form id="form_datareportartwork" method="post">
		<label>Name: </label><input name="DataReportName" id="DataReportName" type="text">
		<label>Type: </label><input name="DataReportType" id="DataReportType" type="text"><label><br></label>
		<label>Artist: </label><input name="DataReportArtist" id="DataReportArtist" type="text">
		<label>ID: </label><input name="DataReportID" id="DataReportID" type="text"><label><br></label>
		<input type="submit" id="button" value="Search" name="datareport_artwork_submitbutton"><br><br>
	</form>
  </body>
  <?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";
		$searchedname = $_POST['DataReportName'];
		$searchedtype = $_POST['DataReportType'];
		$searchedartist = $_POST['DataReportArtist'];
		$searchedid = $_POST['DataReportID'];

		if(isset($_POST['datareport_artwork_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			$sqlDataReport = 'SELECT ArtworkName, Artist, ArtYear, AcquisitionDate, Building, RoomFloor, ArtworkID FROM artwork, room WHERE room.RoomID=artwork.RoomID AND ArtworkName LIKE "%' . $searchedname . '%" AND Artist LIKE "%' . $searchedartist . '%" AND ArtworkType LIKE "%' . $searchedtype . '%";';

			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			//EmployeeID=' . intval($DataReportEmployeeID)

			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				echo "=" . $row['Artwork'] . "=<br>Artist: " . $row['Artist'] . "<br>Year: : " . $row['ArtYear'] . "<br>Acquisition Date: " . $row['AcquisitionDate'] . "<br>Building Number: " . $row['Building'] . "<br>Room Floor: " . $row['RoomFloor'] . "<br>ArtworkID: " . $row['ArtworkID'] . "<br><br>";
			}
		}
	?>
 </html>