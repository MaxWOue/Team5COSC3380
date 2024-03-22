<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<link rel="stylesheet" href="Style/datareport_styles.css" />
  </head>
  <header>
  	<h1>Employee Search</h1>
  </header>
  <body>
	<br><br>
	<div class="datareportinput" id="datareportemployee_input">
		<form id="form_datareportemployees" method="post">
			<h2>Enter values and click search:</h2>
			<label>First Name: </label><input name="DataReportFirstName" type="text"><br>
			<label>Last Name: </label><input name="DataReportLastName" id="DataReportLastName" type="text"><br>
			<label>ID: </label><input name="DataReportEmployeeID" id="DataReportEmployeeID" type="text"><br>
			<label>Position: </label><input name="DataReportPosition" id="DataReportPosition" type="text"><br>
			<label>UserName: </label><input name="DataReportUserName" id="DataReportUserName" type="text"><br>
			<label>Minimum Hourly Pay: </label><input name="DataReportMinPay" id="DataReportMinPay" type="text"><br>
			<label>Maximum Hourly Pay: </label><input name="DataReportMaxPay" id="DataReportMaxPay" type="text"><br><br>
			<button type="submit" id="datareport_employee_submitbutton" value="Search" name="datareport_employee_submitbutton">Search</button>
		</form>
		<form method="post"><button type="submit" name="datareport_employee_clearselectionbutton">Clear selection</button></form>
	</div>
  </body>
  <div class="datareportphpresults">
  <?php
		$servername = "museum.cpm4eq2ycfx2.us-east-1.rds.amazonaws.com";
		$username = "admin";
		$password = "museumteam5";
		$dbname = "MfahDB";
		$searchedfirstname = $_POST['DataReportFirstName'];
		$searchedlastname = $_POST['DataReportLastName'];
		$searchedid = $_POST['DataReportEmployeeID'];
		$searchedposition = $_POST['DataReportPosition'];
		$searchedminpay = $_POST['DataReportMinPay'];
		$searchedmaxpay = $_POST['DataReportMaxPay'];
		$downloadbutton = '<form method="post"><button class="DownloadButton" id="DownloadEmployeeResults" name="DownloadEmployeeResults">Download these results</button></form>';
		//$downloadfilelocation = 'C:\Users\%USERNAME%\Downloads\DataReportEmployee' . strval(date("Ymd")) . '.csv';
		$downloadfilelocation = 'c:\Users\Max\OneDrive - University Of Houston\Documents\!School\6th semester\testfiles.csv';

		$downloadfile = fopen($downloadfilelocation, "w");
		fwrite($downloadfile,'hello');

		if(isset($_POST['datareport_employee_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if($searchedid == "" && $searchedminpay == "" && $searchedmaxpay == ""){ //None
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" ORDER BY lastName, firstName';
			}
			else if($searchedminpay == "" && $searchedmaxpay == ""){ //Only have ID
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND EmployeeID=' . intval($searchedid) . ' ORDER BY lastName, firstName;';
			}
			else if($searchedid == "" && $searchedmaxpay == ""){ //Only have min pay
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND payrate>=' . floatval($searchedminpay) . ' ORDER BY lastName, firstName;';
			}
			else if($searchedid == "" && $searchedminpay == ""){ //Only have max pay
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND payrate<=' . floatval($searchedmaxpay) . ' ORDER BY lastName, firstName;';
			}
			else if($searchedmaxpay == ""){ //Have ID and min pay
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND EmployeeID=' . intval($searchedid) . ' AND payrate>=' . floatval($searchedminpay) . ' ORDER BY lastName, firstName;';
			}
			else if($searchedminpay == ""){ //Have ID and max pay
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND EmployeeID=' . intval($searchedid) . ' AND payrate<=' . floatval($searchedmaxpay) . ' ORDER BY lastName, firstName;';
			}
			else if($searchedid == ""){ //min pay and max pay
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName, payrate FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND payrate>=' . intval($searchedminpay) . ' AND payrate<=' . floatval($searchedmaxpay) . ' ORDER BY lastName, firstName;';
			}
			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			echo "<br>";// . $downloadbutton;
			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				$roundedpayrate = sprintf("%.2f", $row['payrate']);
				echo "=" . $row['FirstName'] . " " . $row['LastName'] . "=<br>Employee ID: " . $row['EmployeeID'] . "<br>Supervisor ID: " . $row['Supervisor'] . "<br>Position: " . $row['Postion'] . "<br>Employee User Name: " . $row['UserName'] . "<br>Pay rate: \$" . $roundedpayrate . "<br><br>";
			}
		}

		/*if(isset($_POST['DownloadEmployeeResults'])){
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			$downloadfile = fopen($downloadfilelocation, "w");
			if($searchedid == ""){
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" ORDER BY lastName, firstName';
			}
			else{
				$sqlDataReport = 'SELECT FirstName, LastName, EmployeeID, Supervisor, Postion, UserName FROM employee WHERE Postion LIKE "%' . $searchedposition . '%" AND FirstName LIKE "%' . $searchedfirstname . '%" AND LastName LIKE "%' . $searchedlastname . '%" AND UserName LIKE "%' . $searchusername . '%" AND EmployeeID=' . intval($searchedid) . ' ORDER BY lastName, firstName;';
			}
			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				$textToWrite = $row['FirstName'] . "," . $row['LastName'] . "," . $row['EmployeeID'] . "," . $row['Supervisor'] . "," . $row['Postion'] . "," . $row['UserName'] . ",\n";
				//fwrite($downloadfile,$textToWrite);
			}
		}*/

		if(isset($_POST['datareport_employee_clearselectionbutton'])){
			$searchedfirstname = "";
			$searchedlastname = "";
			$searchedid = "";
			$searchedposition = "";
			$searchusername = "";
		}

	?></div>
 </html>