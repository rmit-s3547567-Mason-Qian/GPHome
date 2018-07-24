<?php
	include_once 'header.php'
;?>

<section class="main-container">
	<div class="main-wrapper">	
		<h2>Test v0.0</h2>
		<?php
			if (isset($_SESSION['id'])) {
				echo "Displaying info for, ";
				echo $_SESSION['id'];
			}
			if (isset($_POST['upload'])){
				$name = $_FILES['myfile']['name'];
				$type = $_FILES['myfile']['type'];
				$data = file_get_contents($_FILES['myfile']['tmp_name']);
				$stmt = $dbh->prepare("insert into myblob values('',?,?,?)");
				$stmt->bindParam(1,$name);
				$stmt->bindParam(2,$type);
				$stmt->bindParam(3,$data);
				$stmt->execute();
			}
		?>
		<form method="POST" enctype="multipart/form-data">
			<input type="file" name="myfile"/>
			<button name="upload">Upload</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php';
?>
