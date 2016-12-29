<?php
session_start();
//print_r($_SESSION['post_value']);
//die();
include_once 'LocationTrack.php';

$location = new LocationTrack();

$location->prepare($_SESSION['post_value']);
$allLocations = $location->index();
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        2RA Technology Limited
    </title>

    <link rel="stylesheet" href="../../../../asset/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../../../asset/css/main.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <script type="text/javascript">
        $(document).ready(function () {
            $('dropdown-toggle').dropdown()
        });
    </script>

    <style>
        body {
            background-image: url("../../../../asset/images/bg13.jpg");
            /*background-repeat: repeat-x;*/
        }

        .custom-input {
            height: 29px;
        }
    </style>
</head>

<body>

<div class="row" style="background-color: #006686;height: 40px">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin: 8px">
        <div>
            <a href="reportAccess.php" style="color: white;text-decoration: none;font-size: 15px">Report</a>&nbsp&nbsp&nbsp&nbsp
            <a href="mapAccess.php" style="color: white;text-decoration: none;font-size: 15px">Map </a>&nbsp&nbsp&nbsp&nbsp
            <a href="register.php" style="color: white;text-decoration: none;font-size: 15px">Register</a>&nbsp&nbsp&nbsp&nbsp
            <a href="bindArea.php" style="color: white;text-decoration: none;font-size: 15px">Bind Area</a>&nbsp&nbsp&nbsp&nbsp
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<br><br>

<div class="row">

    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-10" style="background-color: aliceblue;padding: 1px">

<form action="forMap.php" method="post">
        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Device ID</th>
                    <th align="center">Latitude</th>
                    <th align="center">Longitude</th>
                    <th align="center">Date and Time</th>
                    <th align="center"> <input class="check-all" type="checkbox" name="" id="ckbCheckAll"> <label for="ckbCheckAll">Select All</label></th>
                </tr>
                </thead>
                <?php
                if (isset($allLocations) && !empty($allLocations)) {
                $serial = 0;
                foreach ($allLocations as $oneLocations) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneLocations['device_id'] ?></td>
                    <td><?php echo $oneLocations['lat']; ?></td>
                    <td><?php echo $oneLocations['lng'] ?></td>
                    <td><?php echo $oneLocations['created_at']; ?></td>
                    <td style="width: 110px">
                                <input type="checkbox" class="checkBoxClass" name="selectedLocations[]"
                                       value="<?php echo $oneLocations['id']?>" id="<?php echo $oneLocations['id']?>"></td>

                </tr>

                <?php
                }
                ?>
                <tr>
                    <td colspan="5"></td>
                    <td>
                        <input type="submit" value="Go">
                    </td>
                </tr>
                </form>
                <?php
                } else {
                    ?>
                    <tr>
                        <td colspan="5" align="center">
                            <?php echo "No Data Available " ?>

                        </td>
                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>


<br><br><br><br>
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="../../../../asset/js/jquery.min.js"></script>
<script src="jquery.checkAll.js"></script>
<script>
    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            if (this.checked)
                $(".checkBoxClass").prop('checked', "checked");
            else
                $(".checkBoxClass").removeProp('checked');
        });
    });
</script>
</body>
</html>
