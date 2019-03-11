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
        require('db_con.php');
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
                <li>
                    <a href="alumni.php">Alumni</a>
                </li>
                <li>
                    <a href="company.php">Company</a>
                </li>
                <li>
                    <a href="skills.php">Skills</a>
                </li>
                <li class="active">
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
                            <label class="col-sm-4">Big Four Metrics </label>
                            <span style="display: inline-block" class="col">
                                <select class="form-control col" name="mtype">
                                    <option value="skills">Skills</option>
                                    <option value="alumni">Alumni</option>
                                </select>
                            </span>
                            <span style="display: inline-block;" class="col">
                                <input type="submit" name="Submit" value="Submit" class="btn btn-success col">
                            </span>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-3">Most<br> in-demand Skill in  </label>
                            <div style="display: inline-block" class="col-sm-6">
                                <select class="form-control" name="industry">
                                    <option value="all">All Industries</option>
                                    <?php 
                                        $query = "SELECT DISTINCT industry FROM company ORDER BY industry";
                                        $res = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['industry']."</option>";
                                            
                                        }
                                    ?>
                                </select>
                            </div>
                            <div style="display: inline-block;" class="col-sm-2">
                                <input type="submit" name="submit2" value="Submit" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-3">Average Salary by </label>
                            <div style="display: inline-block" class="col-sm-6">
                                <select class="form-control" name="industry">
                                    <option value="all">All Industries</option>
                                    <?php 
                                        $query = "SELECT DISTINCT industry FROM company ORDER BY industry";
                                        $res = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['industry']."</option>";
                                            
                                        }
                                    ?>
                                </select>
                                
                            </div>
                            <div style="display: inline-block;" class="col-sm-2">
                                <input type="submit" name="submit3" value="Submit" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </nav>

            <h2></h2>
            
            
            <div class="line"></div>
            <div>
                <?php 
                    if(isset($_POST['Submit'])) {
                        $mtype = $_POST['mtype'];
                        if($mtype == "skills") {
                            $query = "SELECT skillName, companyName
                                FROM skill AS s, company AS c, requires AS r
                                WHERE s.skillID = r.skillID
                                AND r.companyID = c.companyID
                                AND c.companyName IN ('PWC', 'EY', 'KPMG', 'Deloitte')
                                ORDER BY c.companyName";

                            $res = mysqli_query($conn, $query);
                            if(mysqli_num_rows($res) > 0) {
                                echo "<p>Skill Details for Big Four</p>";
                                echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                    echo "<th scope='col'>Skill Name</th>";
                                    echo "<th scope='col'>Company Name</th>";
                            echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['skillName']."</th><td>".$row['companyName']."</td>";
                                echo "</tr>";        
                                }
                            }
                        }


                        if($mtype == "alumni") {
                            $query = "SELECT alumniFName, alumniLName, companyName, alumniPhoneNo,linkedInURL, type, title, department
                                    FROM alumni AS a,company AS c,hires AS h
                                    WHERE a.alumniID = h.alumniID
                                    AND h.companyID = c.companyID
                                    AND c.companyName IN ('PWC','EY','KPMG','Deloitte')
                                    ORDER BY alumniFName, alumniLName";
                            $res = mysqli_query($conn, $query);

                            if(mysqli_num_rows($res) > 0) {
                            echo "<p>Alumni Details for Big Four</p>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                                    echo "<th scope='col'>First Name</th>";
                                    echo "<th scope='col'>Last Name</th>";
                                    echo "<th scope='col'>Company Name</th>";
                                    echo "<th scope='col'>Phone Number</th>";
                                    echo "<th scope='col'>Linkedin Profile</th>";
                                    echo "<th scope='col'>Type of Job</th>";
                                    echo "<th scope='col'>Title</th>";
                                    echo "<th scope='col'>Department</th>";
                            echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['alumniFName']."</th><td>".$row['alumniLName']."</td><td>".$row['companyName']."</td><td>".$row['alumniPhoneNo']."</td><td>".$row['linkedInURL']."</td><td>".$row['type']."</td><td>".
                                    $row['title']."</td><td>".$row['department']."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            }
                            else {
                            echo "<h4>No data exists!</h4>";
                            }    
                        }
                    }

                    if(isset($_POST['submit2'])) {
                        $industry = $_POST['industry'];

                        if($industry == "all") {
                            $query2 = "SELECT c.industry, MAX(s.skillName) AS 'Skill Name'
                                FROM company AS c
                                INNER JOIN requires AS r ON r.companyID = c.companyID
                                INNER JOIN skill AS s ON s.skillID = r.skillID
                                GROUP BY c.industry";

                            $res2 = mysqli_query($conn, $query2);
                            echo "<p> Most in-demand Skill in All Industries </p>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                                    echo "<th scope='col'>Industry</th>";
                                    echo "<th scope='col'>Skill Name</th>";
                            echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res2)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['industry']."</td><td>".$row['Skill Name']."</td>";
                                echo "</tr>";
                            }
                        echo "</tbody></table>";
                        }
                        else {
                            $query2 = "SELECT c.industry, MAX(s.skillName) AS 'Skill Name'
                            FROM company AS c
                            INNER JOIN requires AS r ON r.companyID = c.companyID
                            INNER JOIN skill AS s ON s.skillID = r.skillID
                            WHERE c.industry='".$industry."' 
                            GROUP BY c.industry";

                            $res2 = mysqli_query($conn, $query2);
                            echo "<p> Most in-demand Skill in Industry : ".$industry."</p>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                                    echo "<th scope='col'>Industry</th>";
                                    echo "<th scope='col'>Skill Name</th>";
                            echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res2)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['industry']."</td><td>".$row['Skill Name']."</td>";
                                echo "</tr>";
                            }
                        echo "</tbody></table>";

                        }
                    }

                        

                    if(isset($_POST['submit3'])) {
                        $industry = $_POST['industry'];
                        if($industry == 'all') {
                            $query2 =   "SELECT c.industry, ROUND(AVG(h.salary),2) AS 'Average Salary' FROM hires AS h
                                    INNER JOIN company AS c ON c.companyID = h.companyID
                                    GROUP BY c.industry
                                    ORDER BY c.industry";

                            $res2 = mysqli_query($conn, $query2);
                            if(mysqli_num_rows($res2) > 0) {
                                echo "<p> Average Salary by Industry : ".$industry."</p>";
                                echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                echo "<th scope='col'>Industry</th>";
                                echo "<th scope='col'>Average Salary (in USD)</th>";
                                echo "<tr></thead><tbody>";
                                while ($row = mysqli_fetch_assoc($res2)) {
                                    echo "<tr>";
                                    echo "<th scope='row'>".$row['industry']."</td><td>".$row['Average Salary']."</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }
                            else {
                                echo "<div class='alert alert-danger'>The data you requested is not available.</div>";
                            }    
                        }
                        else {
                            $query2 =   "SELECT c.industry, ROUND(AVG(h.salary),2) AS 'Average Salary' FROM hires AS h
                                    INNER JOIN company AS c ON c.companyID = h.companyID
                                    WHERE c.industry='".$industry."' 
                                    GROUP BY c.industry
                                    ORDER BY c.industry";

                            $res2 = mysqli_query($conn, $query2);
                            if(mysqli_num_rows($res2) > 0) {
                                echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                echo "<th scope='col'>Industry</th>";
                                echo "<th scope='col'>Average Salary (in USD)</th>";
                                echo "<tr></thead><tbody>";
                                while ($row = mysqli_fetch_assoc($res2)) {
                                    echo "<tr>";
                                    echo "<th scope='row'>".$row['industry']."</td><td>".$row['Average Salary']."</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }
                            else {
                                echo "<div class='alert alert-danger'>The data you requested is not available.</div>";
                            }    
                        }
                        
                    }
                ?>
            </div>
                                
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>