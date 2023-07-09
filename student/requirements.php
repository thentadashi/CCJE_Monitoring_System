<?php
session_start();
include '../database/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Requirements</title>
</head>
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
    }

    /* Styles for the pop-up image */
    .overlay img {
        max-width: 80%;
        max-height: 80%;
    }
</style>
<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <?php
                        include('alert_message.php');
                        ?>
                        <div class="d-flex justify-content-center container-fluid">
                            <div class="container py-5 px-5">
                                <div class="table-responsive rounded-3">
                                    <table border="1" class="table table-sm border border-2">
                                        <tr>
                                            <td colspan="3" class="bg-warning text-dark py-4">
                                                <h2 class="card-title text-center"><b>Requirements</b></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="blockquote mb-0 px-3">Personal Data Sheet</p>
                                                <p class="text-sm px-3">Click the button below to download a file:  Fill out the information sent by PDF file.<br><a href="download/download2.php"><i class="bi bi-download mx-2"></i> Download File</a></p>
                                            </td>
                                            <?php
                                            include '../database/db_connect.php';
                                            if ($mysqli->connect_errno) {
                                                die("Connection error: " . $mysqli->connect_error);
                                            }
                                            $user = $_SESSION["user"];
                                            $sql = "SELECT * from personal_sheet_db where std_id=$user";
                                            $result = $mysqli->query($sql);
                                            $row = $result->fetch_assoc();
                                            if (empty($row)) {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#getsheet"><i class='bi bi-cloud-download-fill mx-2'></i>Send</button></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><a href="<?php echo $row['file_path']; ?>" class='btn btn-success btn-sm' target="_blank"><i class="bi bi-view-list"></i> View</a></td>
                                            <?php
                                            }
                                            ?>

                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="blockquote mb-0 px-3">Parent Consent</p>
                                                <p class="text-sm px-3">Click the button below to download a file:  Fill out the information sent by PDF file. <br><a href="download/download.php"><i class="bi bi-download mx-2"></i> Download File</a></p>
                                            </td>
                                            <?php
                                            include '../database/db_connect.php';
                                            if ($mysqli->connect_errno) {
                                                die("Connection error: " . $mysqli->connect_error);
                                            }
                                            $user = $_SESSION["user"];
                                            $sql = "SELECT * from parent_con_db where std_id=$user";
                                            $result = $mysqli->query($sql);
                                            $row = $result->fetch_assoc();
                                            if (empty($row)) {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#getParent"><i class='bi bi-cloud-download-fill mx-2'></i>Send</button></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><a href="<?php echo $row['file_path']; ?>" class='btn btn-success btn-sm' target="_blank"><i class="bi bi-view-list"></i> View</a></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="blockquote mb-0 px-3">PhilHealth ID</p>
                                            </td>
                                            <?php
                                            include '../database/db_connect.php';
                                            if ($mysqli->connect_errno) {
                                                die("Connection error: " . $mysqli->connect_error);
                                            }
                                            $user = $_SESSION["user"];
                                            $sql = "SELECT * from philhealth_id_db where std_id=$user";
                                            $result = $mysqli->query($sql);
                                            $row = $result->fetch_assoc();
                                            if (empty($row)) {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#getPhilId"><i class="bi bi-cloud-download-fill mx-2"></i>Send</button></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><a href="<?php echo $row['file_path']; ?>" class='btn btn-success btn-sm' target="_blank"><i class="bi bi-view-list"></i> View</a></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="blockquote mb-0 px-3">Certification of Vaccination</p>
                                            </td>
                                            <?php
                                            include '../database/db_connect.php';
                                            if ($mysqli->connect_errno) {
                                                die("Connection error: " . $mysqli->connect_error);
                                            }
                                            $user = $_SESSION["user"];
                                            $sql = "SELECT * from cer_vac_db where std_id=$user";
                                            $result = $mysqli->query($sql);
                                            $row = $result->fetch_assoc();
                                            if (empty($row)) {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#getCerVac"><i class='bi bi-cloud-download-fill mx-2'></i>Send</button></td>

                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><a href="<?php echo $row['file_path']; ?>" class='btn btn-success btn-sm' target="_blank"><i class="bi bi-view-list"></i> View</a></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="blockquote mb-0 px-3">Medical Certificate</p>
                                            </td>
                                            <?php
                                            $sql2 = "SELECT * from pregnancy_db where std_id=$user";
                                            $result2 = $mysqli->query($sql2);
                                            $row2 = $result2->fetch_assoc();
                                            if (empty($row2)) {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#getPregtest"><i class='bi bi-cloud-download-fill mx-2'></i>Send</button></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Not Submitted
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Submitted
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><a href="<?php echo $row2['file_path']; ?>" class='btn btn-success btn-sm' target="_blank"><i class="bi bi-view-list"></i> View</a></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="overlay" onclick="hideImage()">
                            <img id="zoomedImage">
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="getsheet">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Personal Data Sheet</h4>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="upload_proccess/upload_sheet.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3 pb-2">
                            <div class="custom-file">
                                <p class="lead">Insert a PDF file of your Personal Data Sheet.</p>
                                <input type="file" class="form-control form-control-sm" name="pdfFile" accept=".pdf" required>
                            </div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal" id="getParent">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Parent Consent</h4>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="upload_proccess/upload_consent.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3 pb-2">
                            <div class="custom-file">
                                <p class="lead">Insert a PDF file of your Parent Consent.</p>
                                <input type="file" class="form-control form-control-sm" name="pdfFile" accept=".pdf" required>
                            </div>
                        </div>
                        
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal" id="getPhilId">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">PhilHealth ID</h4>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="upload_proccess/upload_phil.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3 pb-2">
                            <div class="custom-file">
                                <p class="lead">Insert a PDF file of your PhilHealth ID. <br>(Front & Back of the ID)</p>
                                <input type="file" class="form-control form-control-sm" name="pdfFile" accept=".pdf" required>
                            </div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal" id="getCerVac">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Certification of Vaccination</h4>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="upload_proccess/upload_cervac.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3 pb-2">
                            <div class="custom-file">
                                <p class="lead">Insert a PDF file of your Certification of Vaccination.</p>
                                <input type="file" class="form-control form-control-sm" name="pdfFile" accept=".pdf" required>
                            </div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal" id="getPregtest">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Medical Certificate</h4>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="upload_proccess/upload_pregnancy.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3 pb-2">
                            <div class="custom-file">
                                <p class="lead">Insert a PDF file of your Pregnancy Test.
                                <input type="file" class="form-control form-control-sm" name="pdfFile" accept=".pdf" required>
                            </div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>