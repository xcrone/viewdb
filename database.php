<?php require 'mysql.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>VIEW DB</title>
	<link rel="icon" type="icon/ico" href="icon.png">
	<link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

<center>
<div id="content">

	<div class="list-inline">
		<div class="desktop">
			DATABASE : 

			<div class="scroll-inline">
				<?php
					$sql = "SHOW DATABASES";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_array($result)) {
					        echo "<a href='?db=".$row["Database"]."' class='sql-select'>".$row["Database"]."</a>";
					    }
					} else {
					    echo "0 results";
					}
				?>
			</div>
		</div>
	</div>

	<?php if (isset($_GET['db'])): ?>
	<div class="list-inline">
		<div class="desktop">
			TABLES : 

			<div class="scroll-inline">
				<?php
					$sql = "USE ".$_GET['db'];
					$result = $conn->query($sql);
					$sql = "SHOW TABLES";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_array($result)) {
					        echo "<a href='?db=".$_GET['db']."&table=".$row["Tables_in_".$_GET['db']]."' class='sql-select'>".$row["Tables_in_".$_GET['db']]."</a>";
					    }
					} else {
					    echo "0 results";
					}
				?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if ((isset($_GET['table'])) && (isset($_GET['db']))): ?>
	<div class="data-table">
		<div class="desktop">
		Table Name : <?php echo $_GET['table']; ?> <br><hr><br>
			<table>
				<?php
					$sql = "USE ".$_GET['db'];
					$result = $conn->query($sql);
					$sql = "SELECT * FROM ".$_GET['table'];
					$result = $conn->query($sql);
					$sql = "DESC ".$_GET['table'];
					$th = $conn->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    echo "<tr>";
					    while($row = mysqli_fetch_array($th)) {
					    	echo "<th>".$row["Field"]."</th>";
					    }
					    echo "</tr>";
					    while($row = mysqli_fetch_array($result)) {
					    	$start = 0;
					    	$field = mysqli_num_fields($result);

					    	echo "<tr>";
					    	while ($start < $field) {
						        echo "<td>".$row[$start]."</td>";
						        $start++;
					    	}
					    	echo "</tr>";
					    }
					} else {
					    echo "0 results";
					}
				?>
			</table>

		</div>
	</div>
	<?php endif ?>

</div>

<?php require 'footer.php'; ?>

</center>

</body>
</html>