<?php
include ('config.php');
if (isset($_POST['submit'])) {
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $mobile = $_POST['tel'];
    $email = $_POST['email'];
    $sql = "INSERT INTO data(fname,lname,mobile,email) values ('$fname','$lname','$mobile','$email')";
    mysqli_query($conn, $sql);

} ?>
<?php
include ('config.php');
if (isset($_POST['submit'])) {
	$file_name = $_FILES['image']['name'];
	$tempname = $_FILES['image']['tmp_name'];
	$folder = "Images/" . $file_name;
	$query = mysqli_query($conn, "insert into images (file)  values ('$file_name')");
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h2><center>File Uploaded Successfully</center> </h2>";
		
	} else {
		echo "<h2>File Not  Uploaded </h2>";
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telephone Input Field With Country Code & Flag </title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body>
    <div class="select-box" >
        <form method="POST">
            <h1>Country code </h1>
        <div class="form-fields">
            <input type="text" name="first-name" placeholder="First Name">
            <input type="text" name="last-name" placeholder="Last Name">
            <div class="selected-option">
                <div>
                    <span class="iconify" data-icon="flag:gb-4x3"></span>
                    <strong>+44</strong>
                </div>
            </div>
            <input type="tel" name="tel" placeholder="Phone Number">
            <div class="options">
                <input type="text" class="search-box" placeholder="Search Country Name">
                <ol>

                </ol>
            </div>
            <input type="email" name="email" placeholder="Email">
        </div>
        <div class="options">
            <input type="text" class="search-box" placeholder="Search Country Name">
            <ol>

            </ol>
        </div>
        <input type="submit" name="submit" value="Send Data">
        </form>
        <?php

        $sql = "SELECT * FROM `data`";

        $result = mysqli_query($conn, $sql);
        // print_r($result);
        

        ?>
    </div>

    <script src="script.js"></script>

    <form method="post">
		<input type="search" id="search" name="search" placeholder="Search...">
		<button type="submit" name="submit1">Search</button>
	</form>

	<table border="1">
		<?php

		if (isset($_POST['submit1'])) {
			$search = $_POST['search'];
			$sql = "SELECT * FROM `data` where `fname`='$search' OR `lname`='$search' OR `email`='$search' OR `mobile`='$search'";
			$result = mysqli_query($conn, $sql);
			if($result)
			{
				$num=mysqli_num_rows($result);
				
				
			}


		} ?>

		<tr>
			<th>S.N.</th>
			<th>First-Name</th>
            <th>Last-Name</th>
			<th>Email</th>
			<th>Mobile</th>
           
		</tr>
		<?php if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while ($row = mysqli_fetch_assoc($result)) { ?>
				<tr>
					<td><?= htmlspecialchars($row['sno']) ?></td>
					<td><?= htmlspecialchars($row['fname']) ?></td>
                    <td><?= htmlspecialchars($row['lname']) ?></td>
					<td><?= htmlspecialchars($row['mobile']) ?></td>
					<td><?= htmlspecialchars($row['email']) ?></td>
                    
					
				</tr>
			<?php }
		} else {
			
			echo "<h2 style='background-color: #f7cac9; border: 1px solid #e67e73; padding: 10px; border-radius: 5px; width: 250px; margin: 20px auto; text-align: center; color: #e67e73; font-weight: bold;'>Data not found</h2>";
		} ?>


	</table>
</body>

</html>