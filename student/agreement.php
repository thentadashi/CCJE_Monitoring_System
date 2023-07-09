<?php
session_start();
include '../database/db_connect.php';
if (isset($_POST["submit"])) {
    $user = $_SESSION["user"];
    $agree = $_POST["agree"];
    if (!empty($agree)) {
        $sql = "INSERT INTO agreement ( std_id, status)" .
            "VALUE ('$user','$agree')";
        $result = $mysqli->query($sql);
        if (!$result) {
            header("location: /CCJE_Monitoring_System/index.php");
        }
        header("location: /CCJE_Monitoring_System/student/change_pass.php");
        exit;
    } else {
        header("location: /CCJE_Monitoring_System/index.php");
    }
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Term & Condition</title>
    <?php include 'head.php' ?>
</head>
<style>
    #list p {
        font: arial;
        font-size: 14px;
        background-color: white;
    }
</style>

<body style="background-color:#7EC8E3;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%); padding: auto;">
                    <div class="justify-center">
                        <div class="card" style="height: auto; width: auto;">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="bs5-form-stacked-element mb-3">
                                    <label for="license" class="form-label">DATA PRIVACY ACT OF 2012 (RA 10173)</label>
                                    <textarea id="license" name="license" rows="10" style="font-size:14px" readonly="" class="form-control">
    By providing your personal information and data through this form, you are granting consent to the College of Criminal Justice Education in Urdaneta City University to collect and process the information indicated herein. Your personal information will be handled in accordance with the provisions of the Data Privacy Act of 2012 (RA 10173).
    In using this system for the purpose of managing On the Job Training (OJT), please be informed that the College of Criminal Justice Education in Urdaneta City University will collect and store your personal information and data for the following purposes:
            1. This system is designed to streamline and facilitate the administration of On-the-Job Training(OJT) program, ensuring a smooth and efficient process.
            2. Your personal information will be thoroughly reviewed and considered for OJT placement, allowing us to make informed decisions and provide you with the best opportunities.
            3. During the OJT period, we will monitor and track your progress to ensure a successful training experience.
            4. We will maintain records in accordance with the requirements of the On-the-Job training program in College of Criminal Justice Education and relevant regulatory bodies.
    Rest assured that your personal information will be treated with utmost confidentiality and will only be accessed by authorized personnel involved in the OJT management process. Your data will not be disclosed to third parties without your explicit consent, unless required by law or for legitimate purposes related to the OJT program.
    By submitting your personal information and data, you agree to hold the College of Criminal Justice Education in Urdaneta City University free and harmless from any losses, expenses, liabilities, and claims that may arise from or in connection with their reliance on the information provided in this form.
    By checking the checkbox and clicking the "Agree" button, you acknowledge that you have read and understood the terms and conditions outlined above and consent to the collection and processing of your personal information and data for the purposes stated.
                            </textarea>
                                </div>
                            </div>
                            <form method="post" action="agreement.php" validation>
                                <div class="card-footer text-muted">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="checkbox" class="form-check-input" name="agree" value="1"> I agree to the terms and conditions as set out by the user agreement.
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="submit" name="submit" class="btn btn-primary btn-sm btn-block">Agree</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'script.php' ?>
        </div>
    </div>
</body>

</html>