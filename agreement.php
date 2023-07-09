<?php
session_start();
$host = "localhost";
$dbname = "ccje_db";
$username = "root";
$password = " ";
$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}
if (isset($_POST["submit"])) {
    $user = $_SESSION["user"];
    $agree = $_POST["agree"];
    if(!empty($agree)){
        $sql = "INSERT INTO message_db ( user_id, send_to_id, message_content, is_read)" .
        "VALUE ('$user','$sent', '$content', 0)";
    $result = $mysqli->query($sql);
    if (!$result) {
        header("location: index.php");
    }
    header("location: /team_leader/form.php");
    exit;
    }else{
        header("location: index.php");
    }
    
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    #list p {
        font: arial;
        font-size: 14px;
        background-color: white;
    }
</style>

<body style="background-color:#7EC8E3;">
    <main>
        <div class="container" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%); padding: auto;">
            <div class="justify-center">
                <div class="card" style="height: auto; width: auto;">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="bs5-form-stacked-element mb-3">
                            <label for="license" class="form-label">Terms &amp; conditions</label>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="/js/chart-pie.js"></script>
    <script src="/js/chart-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script src="/js/datatables-simple-demo.js"></script>
    <script src="/js/lib.vendor.bundle.js"></script>
    <script src="/js/dropify.min.js"></script>
    <script src="/js/core.js"></script>
    <script src="/js/dropify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/js/scripts.js"></script>
    <script src="/js/datatables-simple-demo.js"></script>
    <script src="/js/zoom.js"></script>
</body>

</html>