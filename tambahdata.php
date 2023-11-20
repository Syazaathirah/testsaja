<!DOCTYPE html>
<html>
	<head>
		<title>Tambah Data</title>
	</head>
	<body>
    <?php
		
		include ("dbconnection.php");

        if (isset($_POST["databaru"])) 
        {

            $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
            $nomborid = mysqli_real_escape_string ($conn, $_POST["nomborid"]);
        
            mysqli_query($conn,"INSERT INTO pelajardanstaff (nama, nomborid) VALUE ('$nama','$nomborid')");

            if ($result) {
                // Data insertion successful
                header("Location: index.php?success=true");
                exit();
            }
        }else{
            ?>
            <h2>Tambah Data</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input name="nama" placeholder="nama pelajar/staff" required >
                <br><br>
                <input name="nomborid" placeholder="nombor ID pelajar/staff" required>
                <br><br>
                <input name="databaru" type="submit" value="Tambahkan">
                <br>
            </form>
            <?php
        }

    ?>
    </body>
</html>


