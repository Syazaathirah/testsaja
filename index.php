<!DOCTYPE html>
<html>

<head>
    <title>Baca Data Dari Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        #tambah-data,
        #data-dari-database {
            width: 48%;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="tambah-data">
            <?php
            include("tambahdata.php");
            ?>
        </div>

        <div id="data-dari-database">
            <h2>Data dari Database</h2>
            <?php
            include("dbconnection.php");
            require_once('phpqrcode/qrlib.php');

            $sql = "SELECT * FROM pelajardanstaff ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            $datasaya = "<table><tr><th>ID</th><th>nama</th><th>nomborid</th><th>QRCode</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                $qrvalue = $row["nomborid"];

                $tempDir = "pdfqrcodes/";
                $codeContents = $qrvalue;
                $fileName = $qrvalue . '.png';
                $pngAbsoluteFilePath = $tempDir . $fileName;
                $urlRelativeFilePath = $tempDir . $fileName;
                if (!file_exists($pngAbsoluteFilePath)) {
                    QRcode::png($codeContents, $pngAbsoluteFilePath);
                }

                $datasaya .= "<tr><td>" . $row["id"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["nomborid"] . "</td><td><img src='pdfqrcodes/" . $row["nomborid"] . ".png' width='64px'></td></tr>";
            }

            $datasaya .= "</table>";

            echo $datasaya;
            ?>
        </div>
    </div>
	<script>
        // Check if the URL contains a success parameter
        const urlParams = new URLSearchParams(window.location.search);
        const successParam = urlParams.get('success');

        // Display an alert if the success parameter is present
        if (successParam === 'true') {
            alert('Data berhasil ditambahkan!');
        }
    </script>
</body>

</html>
