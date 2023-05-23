<?php
require_once __dir__ . '/composer/vendor/autoload.php';

if(isset($_POST['submit'])) {
    $doc_name =  $_FILES['doc']['name'];
    $doc_type = $_FILES['doc']['type'];
    $ext = pathinfo($doc_name, PATHINFO_EXTENSION);

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

    if($ext == 'xlsx' || $ext == 'doc' || $ext == 'docx') {
        $spreadsheet = $reader->load("$doc_name");
        $d = $spreadsheet->getSheet(0)->toArray();
        // echo count($d);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // echo "<pre>";
        // print_r($sheetData[1]);

    }
    else {
        echo"<h2>Please choose the document file.</h2>";
        die;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Excel Sheet</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="icon" href="favicon.png">
</head>
<body>
    <div class="align-items-center">
        <div class="d-flex w-75 m-auto mt-5">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                    <?php
                    for($i=0;$i<count($sheetData[0]);$i++) {
                        echo "<th>" . $sheetData[0][$i] . "</th>";
                    }
                    ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    for($i=1; $i<count($sheetData); $i++) {
                        echo "<tr>";
                        for($j=0; $j<count($sheetData[0]); $j++) {
                            echo "<td>" . $sheetData[$i][$j] . "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
