<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natural Museum of Fine Arts - Employee Search</title>
	<script src="datareportscriptemployee.sql"></script>
  </head>
  <body>
	<h2>Employee Search</h2>
	<form id="form_datareportmenuitem" method="post">
		<label>Menu Item Name: </label><input name="DataReportMenuItemName" type="text">
		<label>Restaurant: </label><input name="DataReportRestaurant" type="text"><label><br></label>
		<label>Contains Ingredient: </label><input name="DataReportIngredient" type="text">
		<label>Maximum price: </label><input name="DataReportMaxPrice" type="text"><label><br></label>
		<label>ID: </label><input name="DataReportMenuItemID" type="text"><label><br></label>
		
		<input type="submit" id="button" value="Search" name="datareport_menuitem_submitbutton"><br><br>
	</form>
  </body>
  <?php
		$servername = "database-1.cfkociaic7f3.us-east-2.rds.amazonaws.com";
		$username = "admin";
		$password = "josephjoestar";
		$dbname = "MfahDB";

		$searchedid = intval($_POST['DataReportMenuItemID']);
		$searchedname = $_POST['DataReportMenuItemName'];
		$searchedrestaurant = $_POST['DataReportRestaurant'];
		$searchedprice = intval($_POST['DataReportMaxPrice']);
		$searchedingredient = $_POST['DataReportIngredient'];
		//if($searchedprice )

		if(isset($_POST['datareport_menuitem_submitbutton'])) {
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			//$sqlDataReport = 'SELECT MenuItemID, RestaurantName, menuitem.MenuItemName, Ingredients, Price FROM menuitem, restaurant WHERE restaurant.RestaurantID=menuitem.RestaurantID AND RestaurantName LIKE "%' . $searchedrestaurant . '%" AND MenuItemName LIKE "%' . $searchedname . '%" AND Ingredients LIKE "%' . $searchedingredient . '%" AND Price<' . $searchedprice . ' ORDER BY MenuItemName, Price DESC;';
			$sqlDataReport = 'SELECT MenuItemID, RestaurantName, MenuItemName, Ingredients, Price FROM menuitem, restaurant WHERE restaurant.RestaurantID=menuitem.RestaurantID AND RestaurantName LIKE "%' . $searchedrestaurant . '%" AND MenuItemName LIKE "%' . $searchedname . '%" AND Ingredients LIKE "%' . $searchedingredient . '%" ORDER BY MenuItemName, Price DESC;';
			//MUST DO: WRITE SQL QUERY

			$dataReportVtable = mysqli_query($conn, $sqlDataReport);

			while ($row = mysqli_fetch_assoc($dataReportVtable)) {
				echo "=" . $row['MenuItemName'] . "=<br>Restaurant: " . $row['RestaurantName'] . "<br>Price: " . $row['Price'] . " American Dollars<br>Ingredients: " . $row['Ingredients'] . "<br>Menu Item ID: " . $row['MenuItemID'] . "<br><br>";
				//MUST DO: ECHO THINGS OUT
			}
		}
	?>
 </html>