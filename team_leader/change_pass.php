<?php
session_start();
include '../database/db_connect.php';
if (isset($_POST['submit'])) {
    $oldpass=$_POST["oldpass"];
    $newpass=$_POST["newpass"];
    $repass=$_POST["retypepass"];
    $user = $_SESSION["user"];
    $sql = "SELECT * from student_enroll where id=$user";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {

        if($oldpass == $row["password"] ){

            if($newpass==$repass){
                $insert = $mysqli->query("UPDATE student_enroll SET password='$newpass' where id=$user");
                if ($insert) {
                    $_SESSION['successmessage'] = 'Success';
                    header("location: /CCJE_Monitoring_System/team_leader/form.php");
                    exit;
                  } else {
                    $_SESSION['errormessage'] = "Failed to update.";
                  }
            }else{
                $_SESSION['errormessage'] = "The Password not match";
            }
        }else{
            $_SESSION['errormessage'] = "Wrong Password";
            
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Term & Condition</title>
    <?php include 'head.php' ?>
    <style>
        #list p {
            font: arial;
            font-size: 14px;
            background-color: white;
        }

        .small-card {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 10%;
        }
    </style>
</head>

<body style="background-color:#7EC8E3;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="card small-card">
                        <div class="card-header">
                           <h3 class="text-center">Change Password</h3>
                        </div>
                        <div class="card-body">
                        <?php include('alert_message.php'); ?>
                        <form action="change_pass.php" method="post" class="card-body" novalidate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control mb-3" placeholder="OLD PASSWORD" required name="oldpass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control mb-3" placeholder="NEW PASSWORD" required name="newpass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Re-Type New Password</label>
                                    <input type="password" class="form-control mb-3" placeholder="RE_TYPE NEW PASSWORD" required name="retypepass">
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 mb-3 ">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                        </div>
                        <div class="card-footer text-muted">
                           
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'script.php' ?>
        </div>
    </div>
</body>

</html>