<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Team Leader List</title>
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
                                <h1 class="mt-1 ">Team Leader List</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader">Add Team Leader</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Team Leader List DataTable
                        </div>
                        <div class="card-body">
                             <div class="table-responsive">
                                 <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">Station</th>
                                        <th class="cell">Area</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'db_connect.php';
                                    $sql = "SELECT * FROM team_leader_student JOIN student_enroll on team_leader_student.tl_id=student_enroll.id JOIN station_info ON team_leader_student.sti_id=station_info.sti_id where student_enroll.status !='1' ORDER BY team_leader_student.date_time DESC;";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                            <td><?php echo $row['sti_station']; ?></td>
                                            <td><?php echo $row['sti_region'] . ", " . $row['sti_municipal'] . ", " . $row['sti_barangay']; ?></td>
                                            <td class='text-right'>
                                                <a href='#edit_<?php echo $row['id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#delete_<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Delete</a>
                                            </td>
                                        </tr>
                                        <?php include('modal_team_leader.php'); ?>
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

        <!-- Add New -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Team Leader</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="add_team_leader.php" method="post" class="card-body" novalidate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="mb-3">ID - Student name</label>
                                        <input name="user_id" autocomplete="off" list="student_list" class="form-control">
                                        <datalist id="student_list">
                                            <option class="align-center" disabled selected> ID - Student name</option>
                                            <?php
                                            include 'db_connect.php';
                                            $sql = "SELECT * from student_enroll where status !='1' ";
                                            $result = $mysqli->query($sql);
                                            if (!$result) {
                                                die("Invalid query: " . $mysqli->error);
                                            }
                                            while ($row = $result->fetch_assoc()) {
                                                echo "
                                                            <option value='$row[id]'>$row[last_name] $row[first_name] $row[middle_name] $row[suffix_name]</option>
                                                            ";
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="mb-3">Station Designated</label>
                                        <input name="station_id" autocomplete="off" list="station_list" class="form-control">
                                        <datalist id="station_list" class="form">
                                            <option class="align-center" disabled selected> Station</option>
                                            <?php
                                            include 'db_connect.php';
                                            $sql2 = "SELECT * from station_info where s_status !='1'";
                                            $result2 = $mysqli->query($sql2);
                                            if (!$result2) {
                                                die("Invalid query: " . $mysqli->error);
                                            }
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo "
                                                            <option value='$row2[sti_id]'>$row2[sti_station]" . " - " . "$row2[sti_lname] $row2[sti_fname] $row2[sti_mname] $row2[sti_sname]
                                                            " . " - " . "$row2[sti_region] $row2[sti_municipal] $row2[sti_barangay]</option>";
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="team_leader_table.php.php" class="btn btn-outline-secondary" title="">Cancel</a>
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