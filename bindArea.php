<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GPS-TRACKER</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ==========================================================================
            Demo using Bootstrap 3.3.4 and jQuery 1.11.2
            You don't need any of the following styles for the form to work properly,
            these are just helpers for the demo/test page.
          ========================================================================== */

        #wrapper {
            width:430px;
            margin:0 auto;
        }
        legend {
            margin-top: 20px;
        }
        #attribution {
            font-size:12px;
            color:#999;
            padding:20px;
            margin:20px 0;
            border-top:1px solid #ccc;
        }
        #O_o {
            text-align: center;
            background: #33577b;
            color: #b4c9dd;
            border-bottom: 1px solid #294663;
        }
        #O_o a:link, #O_o a:visited {
            color: #b4c9dd;
            border-bottom: #b4c9dd;
            display: inline;
            padding: 20px;
            text-decoration: none;
        }
        #O_o a:hover, #O_o a:active {
            color: #fff;
            border-bottom: #fff;
            text-decoration: none;
        }
        @media only screen and (max-width: 620px), only screen and (max-device-width: 620px) {
            #wrapper {
                width: 90%;
            }
            legend {
                font-size: 24px;
                font-weight: 500;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">
        // if Google is down, it looks to local file...
        if (typeof jQuery == 'undefined') {
            document.write(unescape("%3Cscript src='asset/js/jquery-1.11.2.min.js' type='text/javascript'%3E%3C/script%3E"));
        }
    </script>
    <script type="text/javascript" src="asset/js/clone-form-td.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> <!-- only added as a smoke test for js conflicts -->
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
<div id="wrapper">
    <legend>Enter Your Area Points</legend>
    <form action="storeArea.php" method="post" id="sign-up_area" role="form">
        <div class="form-group">
            <label class="label_fn control-label" for="first_name">School ID:</label>
            <input id="schoolId" name="school_id" type="text" placeholder="" class="input_fn form-control" required="" style="height: 30px">
            <p class="help-block">This field is required.</p>
        </div>


        <div id="entry1" class="clonedInput row">
<!--            <h4 id="reference" name="reference" class="heading-reference">Entry #1</h4>-->
            <fieldset>

                <!-- Text input-->
                <div class="form-group col-md-6">
                    <label class="label_fn control-label" for="test">Latitude:</label>
                    <input id="test" name="ID1_test" type="text" placeholder="" class="input_fn form-control" required="" style="height: 30px">
                    <p class="help-block">This field is required.</p>
                </div>
                <!-- Text input-->
                <div class="form-group  col-md-6">
                    <label class="label_ln control-label" for="longitude">Longitude:</label>
                    <input id="longitude" name="ID1_longitude" type="text" placeholder="" class="input_ln form-control" required="" style="height: 30px">
                    <p class="help-block">This field is required.</p>
                </div>

        </div><!-- end #entry1 -->
        <!-- Button (Double) -->
        <p class="pull-right">
            <button type="button" id="btnAdd" name="btnAdd" class="btn btn-info">add</button>
            <button type="button" id="btnDel" name="btnDel" class="btn btn-danger">remove</button>
        </p>

        <p>
            <button id="submit_button" name="" class="btn btn-primary">Submit</button>
        </p>

        </fieldset>
    </form>
</div> <!-- end wrapper -->

</body>
</html>
