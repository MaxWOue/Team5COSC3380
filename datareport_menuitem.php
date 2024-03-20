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
		<form id="form_datareportmenuitem" method="post">
			<h2>Enter values and click search:</h2>
			<label>Menu Item Name: </label><input name="DataReportMenuItemName" type="text"><br>
			<label>Restaurant: </label><input name="DataReportRestaurant" type="text"><br>
			<label>Contains Ingredient: </label><input name="DataReportIngredient" type="text"><br>
			<label>Maximum price: </label><input name="DataReportMaxPrice" type="text"><br><br>
			<button type="submit" id="button" value="Search" name="datareport_menuitem_submitbutton">Search</button><br>
		</form>
		<form method="post"><button type="submit" name="datareport_menuitem_clearselectionbutton">Clear selection</button></form>
	</div>
  </body>
  <div class="datareportphpresults"><?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";

		$searchedname = $_POST['DataReportMenuItemName'];
		$searchedrestaurant = $_POST['DataReportRestaurant'];
		$searchedprice = $_POST['DataReportMaxPrice'];
		$searchedingredient = $_POST['DataReportIngredient'];
		if(isset($_POST['datareport_menuitem_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if($searchedprice == ""){
				$sqlDataReport = 'SELECT MenuItemID, RestaurantName, MenuItemName, Ingredients, Price FROM menuitem, restaurant WHERE restaurant.RestaurantID=menuitem.RestaurantID AND RestaurantName LIKE "%' . $searchedrestaurant . '%" AND MenuItemName LIKE "%' . $searchedname . '%" AND Ingredients LIKE "%' . $searchedingredient . '%" ORDER BY MenuItemName, Price DESC;';
			}
			else{
				$sqlDataReport = 'SELECT MenuItemID, RestaurantName, MenuItemName, Ingredients, Price FROM menuitem, restaurant WHERE restaurant.RestaurantID=menuitem.RestaurantID AND RestaurantName LIKE "%' . $searchedrestaurant . '%" AND MenuItemName LIKE "%' . $searchedname . '%" AND Ingredients LIKE "%' . $searchedingredient . '%" AND Price<=' . intval($searchedprice) . ' ORDER BY MenuItemName, Price DESC;';
			}
			$dataReportVtable = mysqli_query($conn, $sqlDataReport);
			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				echo "=" . $row['MenuItemName'] . "=<br>Restaurant: " . $row['RestaurantName'] . "<br>Price: \$" . $row['Price'] . " <br>Ingredients: " . $row['Ingredients'] . "<br>Menu Item ID: " . $row['MenuItemID'] . "<br><br>";
			}
		}
		if(isset($_POST['datareport_menuitem_clearselectionbutton'])) {
			$searchedname = "";
			$searchedrestaurant = "";
			$searchedprice = "";
			$searchedingredient = "";
		}
	?></div>
 </html>