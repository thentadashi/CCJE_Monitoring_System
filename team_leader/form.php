<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Form</title>
</head>
<style>
        #list p {
            font: arial;
            font-size: 14px;
            background-color: white;
        }

        .small-card {
            max-width: 700px;
            margin: 0 auto;
            margin-top: 2%;
        }
    </style>
<body style="background-color:#7EC8E3">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container pt-5">
                    <div class="row justify-content-center">
                        <div class="card sb-nav-fixed small-card">
                            <div class="card-header">
                            <?php
                                    include '../database/db_connect.php';
                                    $user = $_SESSION["user"];
                                    $sql1 = "SELECT * from student_enroll where id=$user";
                                    $result1 = $mysqli->query($sql1);
                                    while ($row = $result1->fetch_assoc()) {
                                    ?>
                                <h3 class="mt-1">Hello ! <?php echo $row["last_name"].", ".$row["first_name"]." ".$row["middle_name"] ." ".$row["suffix_name"]?></h3>
                            </div>
                            <form action="add_proccess/add_student_information.php" method="post" class="card-body" required>
                                <div class="row clearfix">
                                        <input type="hidden" class="form-control" placeholder="ID number" value="<?php echo $row["id"] ?>" name="student_id">
                                    <?php
                                    }
                                    ?>
                                    <div class="card-header bg-black text-white mb-2">
                                        <i class="text-white"></i>
                                        ADDITIONAL INFORMATION
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-2">
                                        <div class="form-group">
                                            <label>BIRTHDAY</label>
                                            <input placeholder="BIRTHDAY" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" required name="student_birthday" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12  mb-2">
                                        <div class="form-group">
                                            <label>SEX</label>
                                            <select class="form-control" required name="student_sex">
                                                <option value="" selected disabled>SEX</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12  mb-2">
                                        <div class="form-group">
                                            <label>TEL NO.</label>
                                            <input type="text" class="form-control" placeholder="TELEPHONE NO." required name="student_tel_no">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12  mb-2">
                                        <div class="form-group">
                                            <label>MOBILE NO.</label>
                                            <input type="text" class="form-control" placeholder="MOBILE NO." required name="student_mobile_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-2">
                                        <div class="form-group">
                                        <label>PROVINCE</label>
                                            <select class="form-control" name="STI_Region" id="country">
                                                <option value="">PROVINCE</option>
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
                                    <div class="col-md-4 col-sm-12 mb-2">
                                        <div class="form-group">
                                        <label>MUNICIPAL</label>
                                            <select class="form-control" name="STI_Municipal" id="state">
                                                <option value="">MUNICIPAL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-2">
                                        <div class="form-group">
                                        <label>BARANGAY</label>
                                            <select class="form-control" name="STI_Barangay" id="city">
                                                <option value="">BARANGAY</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-header bg-black text-white mb-2">
                                        <i class="text-white"></i>
                                        GUARDIAN INFORMATION
                                    </div>
                                    <div class="col-md-6 col-sm-12  mb-2">
                                        <div class="form-group">
                                            <label>GUARDIAN NAME</label>
                                            <input type="text" class="form-control" placeholder="GUARDIAN NAME" required name="g_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12  mb-2">
                                        <div class="form-group">
                                            <label>RELATION WITH GUARDIAN</label>
                                            <input type="text" class="form-control" placeholder="RELATION WITH GUARDIAN" required name="g_rel">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12  mb-2">
                                        <div class="form-group">
                                            <label>MOBILE NO.</label>
                                            <input type="text" class="form-control" placeholder="MOBILE NO." required name="g_mobile">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-12 mb-2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
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
                        $('#city').html('<option value="">BARANGAY</option>');
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