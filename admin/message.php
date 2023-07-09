<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Sent</title>
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
                                <h1 class="mt-4">Sent</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader"><i class="bi bi-chat-dots-fill"></i> Add Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-message me-1"></i>
                            Message sent
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th class="cell">Message Content</th>
                                        <th class="cell">Send to</th>
                                        <th class="cell">Send Date/Time</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'db_connect.php';
                                    if ($mysqli->connect_errno) {
                                        die("Connection error: " . $mysqli->connect_error);
                                    }
                                    $user = $_SESSION["user"];
                                    $sql1 = "SELECT * from message_db JOIN admin_db on message_db.send_to_id=admin_db.admin_id  where message_db.user_id=$user ORDER BY message_time_date DESC";
                                    $result1 = $mysqli->query($sql1);
                                    if (!$result1) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row1 = $result1->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row1['message_content']; ?></td>
                                            <td><?php echo $row1['admin_lname'] . ", " . $row1['admin_fname'] . " " . $row1['admin_mname'] . " " . $row1['admin_sname']; ?></td>
                                            <td><?php echo date("M, d, Y g:i a", strtotime($row1['message_time_date'])); ?></td>
                                            <td>
                                                <a href='#edit_<?php echo $row1['message_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#delete_<?php echo $row1['message_id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Delete</a>
                                            </td>
                                        </tr>
                                        <?php include('edit_delete_message.php'); ?>
                                    <?php
                                    }

                                    $sql = "SELECT * from message_db JOIN student_enroll on message_db.send_to_id=student_enroll.id where message_db.user_id='$user'  \n"
                                        . "ORDER BY message_time_date desc;";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['message_content']; ?></td>
                                            <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                            <td><?php echo date("M, d, Y g:i a", strtotime($row['message_time_date'])); ?></td>
                                            <td>
                                                <a href='#edit_<?php echo $row['message_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#delete_<?php echo $row['message_id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Delete</a>
                                            </td>
                                        </tr>
                                        <?php include('edit_delete_message.php'); ?>
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
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Message</h5>
                    <button type="button" class="btn-close btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_message.php" method="post" class="card-body" novalidate>
                        <div class="row clearfix">
                            <input type="hidden" class="form-control" name="message_user" value="<?php echo $_SESSION["user"] ?>">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" class="form-control" name="content">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Send to</label>
                                    <input name="sent_to" autocomplete="off" list="list" class="form-control" placeholder="<---------- Send to ---------->">
                                    <datalist id="list">
                                        <?php
                                        include 'db_connect.php';
                                        $sql3 = "SELECT * from admin_db ";
                                        $result3 = $mysqli->query($sql3);
                                        if (!$result3) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        echo "<option class='align-center' >< ADMIN ></option>";
                                        while ($row3 = $result3->fetch_assoc()) {
                                            echo "
                                                            <option value='$row3[admin_id]'>$row3[admin_fname] $row3[admin_mname] $row3[admin_lname] $row3[admin_sname]</option>
                                                            ";
                                        }
                                        $sql = "SELECT * from student_enroll ";
                                        $result = $mysqli->query($sql);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        echo "<option class='align-center text-bold'>< STUDENT ></option>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                            <option value='$row[id]'>$row[first_name] $row[middle_name] $row[last_name] $row[suffix_name]</option>
                                                            ";
                                        }

                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a href="message.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
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