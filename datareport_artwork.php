<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<link rel="stylesheet" href="datareport_styles.css" />
  </head>
  <header>
  	<h1>Artwork Search</h1>
  </header>
  <body>
	<br><br>
	<div class="datareportinput" id="datareportartwork_input">
		<form id="form_datareportartwork" method="post">
			<h2>Enter values and click search:</h2>
			<label>Name: </label><input name="DataReportArtworkName" id="DataReportArtworkName" type="text"><br>
			<label>Type: </label><input name="DataReportType" id="DataReportType" type="text" style="margin-left:0.65em"><br>
			<label>Artist: </label><input name="DataReportArtist" id="DataReportArtist" type="text" style="margin-left:0.4em"><br>
			<label>ID: </label><input name="DataReportID" id="DataReportID" type="text"  style="margin-left:2.05em"><br><br>
			<!-- <input type="submit" id="datareport_artwork_submitbutton" value="Search" name="datareport_artwork_submitbutton"> -->
			<button type="submit" id="datareport_artwork_submitbutton" value="Search" name="datareport_artwork_submitbutton">Search</button>
		</form>
		<form method="post"><button type="submit" name="datareport_artwork_clearselectionbutton">Clear selection</button></form>
	</div>
  </body>
  <div class="datareportphpresults">
  <?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";
		$searchedname = $_POST['DataReportArtworkName'];
		$searchedtype = $_POST['DataReportType'];
		$searchedartist = $_POST['DataReportArtist'];
		$searchedid = $_POST['DataReportID'];

		if(isset($_POST['datareport_artwork_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if($searchedid == ""){
				$sqlDataReport = 'SELECT ArtworkName, Artist, ArtYear, AcquisitionDate, Building, RoomFloor, ArtworkID FROM artwork, room WHERE room.RoomID=artwork.RoomID AND ArtworkName LIKE "%' . $searchedname . '%" AND Artist LIKE "%' . $searchedartist . '%" AND ArtworkType LIKE "%' . $searchedtype . '%" ORDER BY ArtworkName;';
			}
			else{
				$sqlDataReport = 'SELECT ArtworkName, Artist, ArtYear, AcquisitionDate, Building, RoomFloor, ArtworkID FROM artwork, room WHERE room.RoomID=artwork.RoomID AND ArtworkName LIKE "%' . $searchedname . '%" AND Artist LIKE "%' . $searchedartist . '%" AND ArtworkType LIKE "%' . $searchedtype . '%" AND ArtworkID=' . intval($searchedid) . ' ORDER BY ArtworkName;';
			}
			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			echo "<br>";
			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				echo "<u><strong>" . $row['ArtworkName'] . "</strong></u><br>Artist: " . $row['Artist'] . "<br>Year: " . $row['ArtYear'] . "<br>Acquisition Date: " . $row['AcquisitionDate'] . "<br>Building Number: " . $row['Building'] . "<br>Room Floor: " . $row['RoomFloor'] . "<br>ArtworkID: " . $row['ArtworkID'] . "<br><br>";
			}
		}
		if(isset($_POST['datareport_artwork_clearselectionbutton'])){
			$searchedname = "";
			$searchedtype = "";
			$searchedartist = "";
			$searchedid = "";
		}
	?></div>
 </html>