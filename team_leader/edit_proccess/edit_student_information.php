<?php
session_start();

include '../../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $studentid = $_SESSION["user"];
    $studentsurname = $_POST["student_surname"];
    $studentfirstname = $_POST["student_firstname"];
    $studentmiddlename = $_POST["student_middlename"];
    $studentsuffix = $_POST["student_extensionname"];
    $studentbirthday = $_POST["student_birthday"];
    $studentsex = $_POST["student_sex"];
    $studentcivilstatus = $_POST["student_civil_status"];
    $studentcitizenship = $_POST["student_citizenship"];
    $studentbloodtype = $_POST["student_blood_type"];
    $studentheight = $_POST["student_height"];
    $studentweight = $_POST["student_weight"];
    $studenttelno = $_POST["student_tel_no"];
    $studentmobileno = $_POST["student_mobile_no"];
    $studentemail = $_POST["student_email"];
    $studentgsisno = $_POST["student_gsis_no"];
    $studentpagibigno = $_POST["student_pagibig_no"];
    $studentphilhealthno = $_POST["student_philhealth_no"];
    $studentisssno = $_POST["student_sss_no"];
    $studentemployeeno = $_POST["student_employee_no"];

    $studentbopprovince = $_POST["student_bop_province"];
    $studentbopmunicipal = $_POST["student_bop_municipal"];
    $studentbopbarangay = $_POST["student_bop_barangay"];
    $studentraprovince = $_POST["student_ra_province"];
    $studentramunicipal = $_POST["student_ra_municipal"];
    $studentrabarangay = $_POST["student_ra_barangay"];
    $studentravillage = $_POST["student_ra_village"];
    $studentrastreet = $_POST["student_ra_street"];
    $studentrahouseno = $_POST["student_ra_house_no"];
    $studentrazipcode = $_POST["student_ra_zipcode"];
    $studentpaprovince = $_POST["student_pa_province"];
    $studentpamunicipal = $_POST["student_pa_municipal"];
    $studentpabarangay = $_POST["student_pa_barangay"];
    $studentpavillage = $_POST["student_pa_village"];
    $studentpastreet = $_POST["student_pa_street"];
    $studentpahouseno = $_POST["student_pa_house_no"];
    $studentpazipcode = $_POST["student_pa_zipcode"];

    $spousesurname = $_POST["fb_si_surname"];
    $spousefirstname = $_POST["fb_si_firstname"];
    $spousemiddlename = $_POST["fb_si_middlename"];
    $spouserxtensionname = $_POST["fb_si_rxtensionname"];
    $spouseoccupation = $_POST["fb_si_occupation"];
    $spouseemployername = $_POST["fb_si_employer_name"];
    $spousebusinessadd = $_POST["fb_si_business_add"];
    $spousetelno = $_POST["fb_si_tel_no"];
    $spousemobileno = $_POST["fb_si_mobile_no"];
    $fathersurname = $_POST["fb_pi_f_surname"];
    $fatherfirstname = $_POST["fb_pi_f_firstname"];
    $fathermiddlename = $_POST["fb_pi_f_middlename"];
    $fatherextensionname = $_POST["fb_pi_f_extensionname"];
    $fatheroccupation = $_POST["fb_pi_f_occupation"];
    $fathermobileno = $_POST["fb_pi_f_mobile_no"];
    $mothersurname = $_POST["fb_pi_m_surname"];
    $motherfirstname = $_POST["fb_pi_m_firstname"];
    $mothermiddlename = $_POST["fb_pi_m_middlename"];
    $mothermaidenname = $_POST["fb_pi_m_maidenname"];
    $motheroccupation = $_POST["fb_pi_m_occupation"];
    $mothermobileno = $_POST["fb_pi_m_mobile_no"];

    $elem = $_POST["eb_elem_school"];
    $elempoa = $_POST["eb_elem_school_poa"];
    $second = $_POST["eb_sec_school"];
    $secondpoa = $_POST["eb_sec_school_poa"];
    $course = $_POST["eb_cource_school"];
    $coursepoa = $_POST["eb_cource_school_poa"];
    $college = $_POST["eb_college"];
    $collegepoa = $_POST["eb_college_poa"];

    do {

        $sql = "UPDATE student_infomation  SET  surname = '$studentsurname', middlename = '$studentmiddlename',suffixname = '$studentsuffix', birthday = '$studentbirthday',sex = '$studentsex',civil_status='$studentcivilstatus',citizenship='$studentcitizenship',blood_type='$studentbloodtype', height='$studentheight', weight='$studentweight', tel_no='$studenttelno', mobile_no='$studentmobileno', email='$studentemail', gsis_no='$studentgsisno', pagibig_no='$studentpagibigno', philhealth_no='$studentphilhealthno', sss_no='$studentisssno', employee_no='$studentemployeeno' WHERE student_infomation.id = $studentid;";
        $sql2 = "UPDATE student_address_bg SET  bop_province = '$studentbopprovince', bop_municipal = '$studentbopmunicipal', bop_barangay = '$studentbopbarangay', ra_province = '$studentraprovince', ra_municipal='$studentramunicipal', ra_barangay='$studentrabarangay', ra_village='$studentravillage', ra_street='$studentrastreet', ra_house_no='$studentrahouseno', ra_zipcode='$studentrazipcode', pa_province='$studentpaprovince', pa_municipal='$studentpamunicipal', pa_barangay='$studentpabarangay', pa_village='$studentpavillage', pa_street='$studentpastreet', pa_house_no='$studentpahouseno', pa_zipcode='$studentpazipcode' WHERE student_address_bg.id = $studentid;";
        $sql3 = "UPDATE student_family_bg   SET  spouse_surname = '$spousesurname', spouse_firstname = '$spousefirstname', spouse_middlename = '$spousemiddlename', spouse_suffixname = '$spouserxtensionname', spouse_occupation='$spouseoccupation', spouse_employer_name='$spouseemployername', spouse_business_address='$spousebusinessadd', spouse_tel_no='$spousetelno', spouse_mobile_no='$spousemobileno', father_surname='$fathersurname', father_firstname='$fatherfirstname', father_middlename='$fathermiddlename', father_suffixname='$fatherextensionname', father_occupation='$fatheroccupation', father_mobile_no='$fathermobileno', mother_surname='$mothersurname', mother_firstname='$motherfirstname', mother_middlename='$mothermiddlename', mother_maidenname='$mothermaidenname', mother_occupation='$motheroccupation', mother_mobile_no='$mothermobileno' WHERE student_family_bg.id = $studentid;";
        $sql4 = "UPDATE student_education_bg SET   elemtary_school = '$elem', elemtary_school_poa = '$elempoa', secondary_school = '$second', secondary_school_poa='$secondpoa', course_school='$course', course_school_poa='$coursepoa', college='$college', college_poa='$collegepoa' WHERE student_education_bg.id = $studentid;";
        $result = $mysqli->query($sql);
        $result2 = $mysqli->query($sql2);
        $result3 = $mysqli->query($sql3);
        $result4 = $mysqli->query($sql4);
        if (!$result || !$result2 || !$result3 || !$result4) {
            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
            header("location: /CCJE_Monitoring_System/team_leader/profile.php");
            break;
        }
        $_SESSION['successmessage'] = "Success";
    } while (false);
    header("location: /CCJE_Monitoring_System/team_leader/profile.php");
    exit;
}
