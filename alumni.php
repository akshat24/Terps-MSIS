<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Terps MSIS</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
    <?php 
        require 'db_con.php';
    ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Terps MSIS</h3>
            </div>

            <ul class="list-unstyled components">
                <p></p>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="active">
                    <a href="alumni.php">Alumni</a>
                </li>
                <li>
                    <a href="company.php">Company</a>
                </li>
                <li>
                    <a href="skills.php">Skills</a>
                </li>
                <li>
                    <a href="metrics.php">Important Hiring Metrics</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-4">Year Of Passing</label>
                            <span style="display: inline-block" class="col">
                                <select class="form-control" name="yearOfPassing">
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                </select>
                            </span>
                            <span style="display: inline-block;" class="col">
                                <input type="submit" name="Submit" value="Submit" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-4">Alumni worked/working at </label>
                            <span style="display: inline-block;" class="col">
                                <select class="form-control" name="company">                   
                                 <?php 
                                        $query = "SELECT companyName from company ORDER BY companyName";
                                        $res = mysqli_query($conn, $query);
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['companyName']."</option>";
                                        }
                                    ?>
                                </select>
                            </span>
                            <span style="display: inline-block;" class="col">
                                <input type="submit" name="submit2" value="Submit" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </nav> 
            <h2></h2>
            
            
            <div class="line"></div>
            <div>
                                    
                        <?php 

                            if(isset($_POST['Submit'])) {
                                $year = $_POST['yearOfPassing'];
                                $query = "SELECT alumniFName, alumniLName, alumniPhoneNo, linkedinURL from alumni WHERE yearOfPassing='".$year."';";
                                $res = mysqli_query($conn, $query);
                                echo "<p> Alumni Details of Year : ".$year."</p>";
                                echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                        echo "<th scope='col'>First Name</th>";
                                        echo "<th scope='col'>Last Name</th>";
                                        echo "<th scope='col'>Phone Number</th>";
                                        echo "<th scope='col'>Linkedin Profile</th>";
                                echo "<tr></thead><tbody>";
                                while($row = mysqli_fetch_assoc($res)) {
                                    echo "<tr>";
                                    echo "<th scope='row'>".$row['alumniFName']."</th><td>".$row['alumniLName']."</td><td>".$row['alumniPhoneNo']."</td><td>".$row['linkedinURL']."</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }
                            
                            if(isset($_POST['submit2'])) {
                                $company = $_POST['company'];
                                $query2 =   "SELECT alumniFName, alumniLName, type, companyName, linkedinURL, workStartDate, workEndDate FROM alumni AS a, hires AS h, company as c WHERE a.alumniID = h.alumniID AND c.companyID = h.companyID 
                                    AND c.companyName='".$company."'";
                                $res = mysqli_query($conn, $query2);
                                if(mysqli_num_rows($res) > 0) {
                                    echo "<p> Alumni Details worked/working at: ".$company." </p>";
                                    echo "<table class='table table-striped'>";
                                    echo "<thead><tr>";
                                            echo "<th scope='col'>First <br>Name</th>";
                                            echo "<th scope='col'>Last <br>Name</th>";
                                            echo "<th scope='col'>Type</th>";
                                            echo "<th scope='col'>Company <br>Name</th>";
                                            echo "<th scope='col'>Linkedin <br>Profile</th>";
                                            echo "<th scope='col'>Start <br>Date</th>";
                                            echo "<th scope='col'>End <br>Date</th>"; 
                                    echo "<tr></thead><tbody>";
                                    $temp = " ";
                                    
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo "<tr>";
                                            if(is_null($row['workEndDate'])) {
                                                $temp = "Currently working here";
                                                echo "<th scope='row'>".$row['alumniFName']."</th><td>".$row['alumniLName']."</td><td>".$row['type']."</td><td>".
                                                    $row['companyName']."</td><td>".$row['linkedinURL']."</td><td>".$row['workStartDate']."</td><td>".$temp."</td>";

                                            } 
                                            if(!is_null($row['workEndDate'])) {
                                                echo "<th scope='row'>".$row['alumniFName']."</th><td>".$row['alumniLName']."</td><td>".$row['type']."</td><td>".
                                                    $row['companyName']."</td><td>".$row['linkedinURL']."</td><td>".$row['workStartDate']."</td><td>".$row['workEndDate']."</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        echo "</tbody></table>";
                                }
                                else {
                                    echo "<h5>Company Selected: ".$company."</h5>";
                                    echo "<div class='alert alert-danger'>The data you requested is not available.</div>";
                                }
                            }

                        ?>



            </div>
                                
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <?php mysqli_close($conn); ?>
</body>

</html>