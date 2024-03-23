<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Museum Database - Employee Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* Basic styling for the page */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f2f2f2;
      background-image: url('picture.jpg');
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #d9ead3;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    h1 {
      margin-top: 0;
    }

    /* Profile section styles */
    .profile-section {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      align-items: center;
    }

    .profile-picture {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      overflow: hidden;
      margin-right: 10px;
      cursor: pointer;
      /* Add cursor pointer */
    }

    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-dropdown {
      position: relative;
    }

    .profile-dropdown-content {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 120px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1;
      right: 0;
    }

    .profile-dropdown-content a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #333;
      transition: background-color 0.3s ease;
    }

    .profile-dropdown-content a:hover {
      background-color: #f2f2f2;
    }

    .profile-dropdown.active .profile-dropdown-content {
      display: block;
    }

    .button {
      display: inline-block;
      padding: 12px 24px;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Profile section -->
    <div class="profile-section">
      <div class="profile-picture" onclick="toggleDropdown()">
        <img src='no-profile-picture-icon.webp' alt="Profile Picture">
      </div>
      <div class="profile-dropdown" id="profileDropdown">
        <div class="profile-dropdown-content">
          <a href="#">View Profile</a>
          <a href="#">Settings</a>
          <a href="#">Logout</a>
        </div>
      </div>
    </div>
    <!-- End of Profile section -->

    <h1>Employee Portal</h1>
    <p>Welcome to the employee portal of the museum database.</p>
    <p>Here, employees can access and manage various museum-related tasks.</p>
    <p>Below are the data reports you can access:</p>

    <!-- Additional buttons -->
    <button class="button" onclick="location.href='artwork_report.html'">Artwork Data Report</button>
    <button class="button" onclick="location.href='exhibit_report.html'">Exhibit Data Report</button>
    <button class="button" onclick="location.href='gift_shop_report.html'">Gift Shop Item Data Report</button>
    <button class="button" onclick="location.href='employee_report.html'">Employee Data Report (Admin Only)</button>
    <!-- End of Additional buttons -->
  </div>

  <script>
    function toggleDropdown() {
      var dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('active');
    }
  </script>
</body>

</html>