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
                <li class="active">
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
                            <label class="col-sm-4">Skill Name</label>
                            <span style="display: inline-block" class="col">
                                <select class="form-control" name="skname">
                                    <?php 
                                        $query = "SELECT skillName from skill ORDER BY skillName";
                                        $res = mysqli_query($conn, $query);
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['skillName']."</option>";
                                        }
                                    ?>
   
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
                            <label class="col-sm-4">Skills required by </label>
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
                        $skname = $_POST['skname'];
                        $query =   "SELECT companyName, skillType FROM company as c, requires as r, skill as s 
                                    WHERE c.companyID = r.companyID AND s.skillID=r.skillID AND s.skillName = '".$skname."'";
                        $res = mysqli_query($conn, $query);
                        if(mysqli_num_rows($res) > 0) {
                            echo "<p>Companies which require the Skill: ".$skname."</p>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                                    echo "<th scope='col'>Company Name</th>";
                                    echo "<th scope='col'>Skill Type</th>";
                            echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['companyName']."</th><td>".$row['skillType']."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                        else {
                            echo "<div class='alert alert-danger'>The data you requested is not available.</div>";
                        }
                        
                    }

                    if(isset($_POST['submit2'])) {
                        $company = $_POST['company'];
                        $query2 =   "SELECT skillName FROM company AS c, skill as s, requires AS r 
                                    WHERE c.companyID = r.companyID AND s.skillID = r.skillID AND c.companyName='".$company."'";
                        $res2 = mysqli_query($conn, $query2);
                        echo "<p>Skills required by ".$company."</p>";
                        if(mysqli_num_rows($res2) > 0) {
                            echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                        echo "<th scope='col'>Skill Name</th>";
                                        
                                echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res2)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['skillName']."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                        else {
                            echo "<div class='alert alert-warning'>No particular skill requirements specified.</div>";
                        }
                    }

                ?>
            </div>
                                
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>