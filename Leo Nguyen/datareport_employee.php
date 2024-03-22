<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Search</title>
</head>
<body>
    <h1>Employee Search</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="searchFirstName">Search by First Name:</label><input type="text" id="searchFirstName" name="searchFirstName"><br>
		<label for="searchLastName">Search by Last Name:</label><input type="text" id="searchLastName" name="searchLastName"><br>
        <label for="searchPosition">Search by Position:</label><input type="text" id="searchPosition" name="searchPosition"><br>
		<label for="searchUsername">Search by Username:</label><input type="text" id="searchUsername" name="searchUsername"><br>
		<label for="searchWorkDay">Work on this day:</label><input type="text" id="searchWorkDay" name="searchWorkDay"><br>
		<label for="searchMinPayRate">Minimum pay rate:</label><input type="text" id="searchMinPay" name="searchMinPay"><br>
        <button type="submit">Search</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchFirstName = isset($_POST['searchFirstName']) ? $_POST['searchFirstName'] : "";
		$searchLastName = isset($_POST['searchLastName']) ? $_POST['searchLastName'] : "";
        $searchPosition = isset($_POST['searchPosition']) ? $_POST['searchPosition'] : "";
		$searchUsername = isset($_POST['searchUsername']) ? $_POST['searchUsername'] : "";
		$searchWorkDay = isset($_POST['searchWorkDay']) ? $_POST['searchWorkDay'] : ""; //TO DO: Make it to where it changes if you do "Monday" or something like that
		$searchMinPay = isset($_POST['searchMinPay']) ? $_POST['searchMinPay'] : "0";
		//MAYBE: Add address? Ask Leo or professor first

        // Database configuration
		$servername = "museum.cpm4eq2ycfx2.us-east-1.rds.amazonaws.com";
		$username = "admin";
		$password = "museumteam5";
		$dbname = "MfahDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to search employees
        $sql = "SELECT EmployeeID, firstName, lastName, position, UserName, WorkDays, payrate FROM employee WHERE firstName LIKE ? AND lastName LIKE ? AND position LIKE ? AND UserName LIKE ? AND WorkDays LIKE ? AND payrate>=? ORDER BY lastName, firstName;";
        $stmt = $conn->prepare($sql);
        $searchTermFirstName = "%" . $searchFirstName . "%";
		$searchTermLastName = "%" . $searchLastName . "%";
        $searchTermPosition = "%" . $searchPosition . "%";
		$searchTermUsername = "%" . $searchUsername . "%";
		$searchTermWorkDay = "%" . $searchWorkDay . "%";
		$searchTermMinPay = $searchMinPay;
        $stmt->bind_param("sssssd", $searchTermFirstName, $searchTermLastName, $searchTermPosition, $searchTermUsername, $searchTermWorkDay, $searchTermMinPay);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Position</th><th>User Name</th><th>Hourly Pay</th><th>Work Days</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["EmployeeID"]."</td><td>".$row["firstName"]."</td><td>".$row["lastName"]."</td><td>".$row["position"]."</td><td>".$row["UserName"]."</td><td>\$".$row["payrate"]."</td><td>".$row["WorkDays"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
