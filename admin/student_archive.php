<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Student Archive List</title>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="card bg-white mb-2">
                        <div class="card-body">
                            <div class="align-self-center">
                                <h1 class="mt-4">Student Archive List</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#removestudent" data-whatever="Team Leader"><i class='bi bi-file-earmark-zip'></i> Unarchive Student</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Student Archive List DataTable
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">Block</th>
                                        <th class="cell">School Year</th>
                                        <th class="cell">Password</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    include 'db_connect.php';
                                    $sql = "SELECT * FROM student_enroll WHERE status ='1' ORDER BY last_name ASC";
                                    $result = $mysqli->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }

                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                            <td><?php echo $row['block']; ?></td>
                                            <td><?php echo date("Y", strtotime($row['time_date'])); ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td class='text-right'>
                                                <a href='#edit_<?php echo $row['id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#unarchive_<?php echo $row['id']; ?>' class='btn btn-warning btn-sm' data-bs-toggle='modal'><i class='bi bi-file-earmark-zip'></i> Unarchive</a>
                                            </td>
                                        </tr>
                                        <?php include('modal_student_enrolled.php'); ?>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
        <div class="modal fade" id="removestudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Student Enrolled</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="remove_student_enroll.php" method="POST" class="card-body" validate>
                            <input type="hidden" name="status" value="0">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <select type="text" name="semester" class="form-control" required>
                                            <option></option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select type="text" name="year" class="form-control" required>
                                            <option></option>
                                            <?php
                                            $sql = "SELECT DISTINCT YEAR(time_date) AS year FROM student_enroll;";
                                            $result = $mysqli->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option>" . $row['year'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Unarchive </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'script.php' ?>
</body>

</html>