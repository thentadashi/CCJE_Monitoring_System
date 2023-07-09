<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Station Info</title>
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
                                <h1 class="mt-4">Station Information Tables</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader"> Add Station Information</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Station DataTable
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="cell">Station</th>
                                        <th class="cell">Supervisor Name</th>
                                        <th class="cell">Assignment Date</th>
                                        <th class="cell">Contact</th>
                                        <th class="cell">Email</th>
                                        <th class="cell">Station Address</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    include 'db_connect.php';
                                    $sql = "SELECT * from station_info where s_status !='1'";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['sti_station']; ?></td>
                                            <td><?php echo $row['sti_lname'] . ", " . $row['sti_fname'] . " " . $row['sti_mname'] . " " . $row['sti_sname']; ?></td>
                                            <td><?php echo date( "M, d, Y" ,strtotime($row['sti_assign_date'])); ?></td>
                                            <td><?php echo $row['sti_contact']; ?></td>
                                            <td><?php echo $row['sti_email']; ?></td>
                                            <td><?php echo $row['sti_barangay'] . ", " . $row['sti_municipal'] . ", " . $row['sti_region']; ?></td>
                                            <td class='text-right'>
                                                <a href='#edit_<?php echo $row['sti_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#archive_<?php echo $row['sti_id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Archive</a>
                                            </td>
                                        </tr>
                                        <?php include('modal_station_info.php'); ?>
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
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Station Information</h5>
                    <button type="button" class="btn-close btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_station_info.php" method="post" class="card-body" novalidate>
                        <input type="hidden" name="status" value="0">
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12 mb-2">
                                <input type="text" id="val" name="STI_Station" class="form-control mb-2" placeholder="STATION TYPE (ex, PNP, BFP, BJMP at etc.)">
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <input type="text" name="STI_Lname" class="form-control" placeholder="LAST NAME">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <input type="text" name="STI_Fname" class="form-control" placeholder="FIRST NAME">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <input type="text" name="STI_Mname" class="form-control" placeholder="MIDDLE NAME">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <select name="STI_Sname" class="form-control">
                                        <option value="" disabled selected>SUFFIX NAME</option>
                                        <option value=" ">N/A</option>
                                        <option value="Jr">Jr</option>
                                        <option value="Sr">Sr</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <input type="text" name="STI_Assign" class="form-control" placeholder="ASSIGN DATE" onfocus="(this.type='date')" onblur="(this.type='text')">
                                </div>
                            </div>
                           
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <select class="form-control" name="STI_Region" id="country">
                                        <option value="">Select Province</option>
                                        <?php
                                        $query = "SELECT * FROM refprovince";
                                        $result = $mysqli->query($query);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row['provCode'] . '" id="' . $row['provCode'] . '">' . $row['provDesc'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Country not available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <select class="form-control" name="STI_Municipal" id="state">
                                        <option value="">Select Municipal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <select class="form-control" name="STI_Barangay" id="city">
                                        <option value="">Select Barangay</option>
                                        </select>
                                </div>
                            </div>
                             <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <input type="text" name="STI_Contact" class="form-control" placeholder="CONTACT">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <input type="text" name="STI_Email" class="form-control" placeholder="EMAIL">
                                </div>
                            </div>
                            <div class="col-sm-12 pt-2">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a href="station_info.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export data</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="export_station.php" method="POST" class="card-body" validate>
                            <div class="row clearfix">
                                <p>Are you sure you want to Export the data ?</p>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" name="export" class="btn btn-danger btn-sm">Export</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php include 'script.php' ?>
    <script type="text/javascript">
        $(document).ready(function() {
            // Country dependent ajax
            $("#country").on("change", function() {
                var countryId = $(this).val();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        countryId: countryId
                    },
                    success: function(data) {
                        $("#state").html(data);
                        $('#city').html('<option value="">Select Barangay</option>');
                    }
                });
            });

            // state dependent ajax
            $("#state").on("change", function() {
                var stateId = $(this).val();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        stateId: stateId
                    },
                    success: function(data) {
                        $("#city").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>