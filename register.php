<!DOCTYPE html>
<html>
    <head>
    <title>
        GPS-TRACKER
    </title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"><br><br>
        <p style="font-family: Arial;font-size:15px;background-color: #006686;color: white;padding: 1%;height: 32px">Register with 2RA GPS Tracking Service.</p>

        <div  style="background-color: aliceblue">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="margin-top: 4%;margin-bottom: 4%">
        <form role="form" action="store.php" method="post">
            <div class="form-group">
                <label for="deviceId">Device ID</label>
                <input type="text" class="form-control" name="deviceId" id="deviceId" placeholder="Enter Your Device ID" required>
            </div>
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="schoolId">School ID</label>
                <input type="text" class="form-control" name="schoolId" id="schoolId" placeholder="Enter School ID" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber1">Phone Number 1</label>
                <input type="text" class="form-control" name="phoneNumber1" id="phoneNumber1" placeholder="Phone Number 1" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber2">Phone Number 2</label>
                <input type="text" class="form-control" name="phoneNumber2" id="phoneNumber2" placeholder="Phone Number 2">
            </div>
            <br>
            <div class="form-group">
<!--                <button type="submit" class="form-group btn btn-primary">Create Task</button>-->
                <input type="submit" class="form-control" value="Register" style="background-color: #006686;color: #ffffff">
            </div>
        </form>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<br><br><br><br><br><br>
</body>
</html>