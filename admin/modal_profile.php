
<?php
                    include 'db_connect.php';
                    $student = $row['id'];
                    $sql5 = "SELECT * FROM student_infomation JOIN student_family_bg on student_infomation.id=student_family_bg.id JOIN student_address_bg on student_infomation.id=student_address_bg.id JOIN student_education_bg on student_infomation.id=student_education_bg.id WHERE student_infomation.id=$student;";
                    $result5 = $mysqli->query($sql5);
                    if (!$result4) {
                        die("Invalid query: " . $mysqli->error);
                    }
                    while ($row5 = $result5->fetch_assoc()) {
                    ?>

<!-- edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-header bg-black text-white">
                    <i class="text-white"></i>
                    Personal Information
                </div>
                <form action="edit_student_information.php" method="post" class="card-body" required>
                    <div class="row clearfix">
                        <input type="hidden" class="form-control" placeholder="ID number" value="<?php echo $_SESSION["user"] ?>" name="student_id">
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SURNAME" required name="student_surname" value="<?php echo $row5["surname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="FIRST NAME" required name="student_firstname" value="<?php echo $row5["firstname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MIDDLE NAME" required name="student_middlename" value="<?php echo $row5["middlename"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <select class="form-control" required name="student_extensionname">
                                    <option value="<?php echo $row5["suffixname"]?>" selected><?php echo $row5["suffixname"]?></option>
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input placeholder="BIRTHDAY" value="<?php echo $row5["birthday"]?>" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" required name="student_birthday" />
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12  mb-2">
                            <div class="form-group">
                                <select class="form-control" required name="student_sex">
                                    <option value="<?php echo $row5["sex"]?>" selected><?php echo $row5["sex"]?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12  mb-2">
                            <div class="form-group">
                                <select class="form-control" required name="student_civil_status">
                                    <option value="<?php echo $row5["civil_status"]?>"selected><?php echo $row5["civil_status"]?></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="CITIZENSHIP" required name="student_citizenship" value="<?php echo $row5["citizenship"]?>">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12  mb-2">
                            <div class="form-group">
                                <select class="form-control" required name="student_blood_type">
                                    <option value="<?php echo $row5["blood_type"]?>" selected><?php echo $row5["blood_type"]?></option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="HEIGHT(m)" required name="student_height" value="<?php echo $row5["height"]?>">
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="WEIGHT(kg)" required name="student_weight" value="<?php echo $row5["weight"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="TELEPHONE NO." required name="student_tel_no" value="<?php echo $row5["tel_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOBILE NO." required name="student_mobile_no" value="<?php echo $row5["mobile_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="EMAIL ADDRESS" required name="student_email" value="<?php echo $row5["email"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="GSIS ID NO." required name="student_gsis_no" value="<?php echo $row5["gsis_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PAG-IBIG ID NO." required name="student_pagibig_no" value="<?php echo $row5["pagibig_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PHILHEALTH NO." required name="student_philhealth_no" value="<?php echo $row5["philhealth_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SSS NO." required name="student_sss_no" value="<?php echo $row5["sss_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="AGENCY EMPLOYEE NO." required name="student_employee_no" value="<?php echo $row5["employee_no"]?>">
                            </div>
                        </div>
                        <div class="card-header bg-secondary text-white mb-2">
                            <i class="text"></i>
                            BIRTH OF PLACE
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PROVINCE" required name="student_bop_province" value="<?php echo $row5["bop_province"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="CITY/MUNICIPALITY" required name="student_bop_municipal" value="<?php echo $row5["bop_municipal"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="BARANGAY" required name="student_bop_barangay" value="<?php echo $row5["bop_barangay"]?>">
                            </div>
                        </div>
                        <div class="card-header bg-secondary text-white mb-2">
                            <i class="text"></i>
                            RECIDENTIAL ADDRESS
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PROVINCE" required name="student_ra_province" value="<?php echo $row5["ra_province"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="CITY/MUNICIPALITY" required name="student_ra_municipal" value="<?php echo $row5["ra_municipal"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="BARANGAY" required name="student_ra_barangay" value="<?php echo $row5["ra_barangay"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SUBDIVISION/VILLAGE" required name="student_ra_village" value="<?php echo $row5["ra_village"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="STREET" required name="student_ra_street" value="<?php echo $row5["ra_street"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="HOUSE/BLOCK/LOT NO." required name="student_ra_house_no" value="<?php echo $row5["ra_house_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="ZIP CODE" required name="student_ra_zipcode" value="<?php echo $row5["ra_zipcode"]?>">
                            </div>
                        </div>
                        <div class="card-header bg-secondary text-white mb-2">
                            <i class="text"></i>
                            PERNAMENT ADDRESS
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PROVINCE" required name="student_pa_province" value="<?php echo $row5["pa_province"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="CITY/MUNICIPALITY" required name="student_pa_municipal" value="<?php echo $row5["pa_municipal"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="BARANGAY" required name="student_pa_barangay" value="<?php echo $row5["pa_barangay"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SUBDIVISION/VILLAGE" required name="student_pa_village" value="<?php echo $row5["pa_village"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="STREET" required name="student_pa_street" value="<?php echo $row5["pa_street"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="HOUSE/BLOCK/LOT NO." required name="student_pa_house_no" value="<?php echo $row5["pa_house_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="ZIP CODE" required name="student_pa_zipcode" value="<?php echo $row5["pa_zipcode"]?>">
                            </div>
                        </div>

                        <div class="card-header bg-black text-white mb-2">
                            <i class="text-white"></i>
                            FAMILY BACKGROUND
                        </div>
                        <div class="card-header bg-secondary text-white mb-2">
                            <i class="text"></i>
                            SPOUSE INFORMATION (If you have, N/A if NONE)
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SURNAME" required name="fb_si_surname" value="<?php echo $row5["spouse_surname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="FIRST NAME" required name="fb_si_firstname" value="<?php echo $row5["spouse_firstname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MIDDLE NAME" required name="fb_si_middlename" value="<?php echo $row5["spouse_middlename"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <select class="form-control" required name="fb_si_rxtensionname">
                                    <option value="<?php echo $row5["spouse_suffixname"]?>"selected><?php echo $row5["spouse_suffixname"]?></option>
                                    <option value=" ">N/A</option>
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="OCCUPATION" required name="fb_si_occupation" value="<?php echo $row5["spouse_occupation"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="EMPLOYER/BUSINESS NAME" required name="fb_si_employer_name" value="<?php echo $row5["spouse_employer_name"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="BUSINESS ADDRESS" required name="fb_si_business_add" value="<?php echo $row5["spouse_business_address"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="TELEPHONE NO." required name="fb_si_tel_no" value="<?php echo $row5["spouse_tel_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOBILE NO." required name="fb_si_mobile_no" value="<?php echo $row5["spouse_mobile_no"]?>">
                            </div>
                        </div>
                        <div class="card-header bg-secondary text-white mb-2">
                            <i class="text"></i>
                            PARENTS INFORMATION
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="FATHER SURNAME" required name="fb_pi_f_surname" value="<?php echo $row5["father_surname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="FATHER FIRST NAME" required name="fb_pi_f_firstname" value="<?php echo $row5["father_firstname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="FATHER MIDDLE NAME" required name="fb_pi_f_middlename" value="<?php echo $row5["father_middlename"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <select class="form-control" required name="fb_pi_f_extensionname">
                                    <option value="<?php echo $row5["father_suffixname"]?>" selected><?php echo $row5["father_suffixname"]?></option>
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="OCCUPATION" required name="fb_pi_f_occupation" value="<?php echo $row5["father_occupation"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOBILE NO." required name="fb_pi_f_mobile_no" value="<?php echo $row5["father_mobile_no"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  mb-2">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOTHER SURNAME" required name="fb_pi_m_surname" value="<?php echo $row5["mother_surname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOTHER FIRST NAME" required name="fb_pi_m_firstname" value="<?php echo $row5["mother_firstname"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOTHER MIDDLE NAME" required name="fb_pi_m_middlename" value="<?php echo $row5["mother_middlename"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOTHER MAIDEN NAME" required name="fb_pi_m_maidenname" value="<?php echo $row5["mother_maidenname"]?>">
                            </div>

                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="OCCUPATION" required name="fb_pi_m_occupation" value="<?php echo $row5["mother_occupation"]?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="MOBILE NO." required name="fb_pi_m_mobile_no" value="<?php echo $row5["mother_mobile_no"]?>">
                            </div>
                        </div>
                        <div class="card-header bg-black text-white mb-2">
                            <i class="text-white"></i>
                            EDUCATIONAL BACKGROUND
                        </div>
                        <div class="col-md-5 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="ELEMENTARY SCHOOL NAME" required name="eb_elem_school" value="<?php echo $row5["elemtary_school"]?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PERIOD OF ATTENDANCE(ex.2018-2020)" required name="eb_elem_school_poa" value="<?php echo $row5["elemtary_school_poa"]?>">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SECONDARY SCHOOL NAME" required name="eb_sec_school" value="<?php echo $row5["secondary_school"]?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PERIOD OF ATTENDANCE(ex.2018-2020)" required name="eb_sec_school_poa" value="<?php echo $row5["secondary_school_poa"]?>">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="EDUCATIONAL/GRADE COURCE SCHOOL NAME" required name="eb_cource_school" value="<?php echo $row5["course_school"]?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PERIOD OF ATTENDANCE(ex.2018-2020)" required name="eb_cource_school_poa" value="<?php echo $row5["course_school_poa"]?>">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="COLLEGE NAME" required name="eb_college" value="<?php echo $row5["college"]?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="PERIOD OF ATTENDANCE(ex.2018-2020)" required name="eb_college_poa" value="<?php echo $row5["college_poa"]?>">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="profile.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
                    }
                    ?>