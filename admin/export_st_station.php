<?php
session_start();
require_once('../tcpdf/tcpdf.php');
include 'db_connect.php';
if (isset($_POST['export'])) {
    $station=$_POST["station_id"];
?>
    <?php
    $sql = "SELECT * FROM student_station JOIN student_enroll on student_station.s_id=student_enroll.id JOIN station_info ON student_station.sti_id=station_info.sti_id where student_enroll.status !='1' and student_station.sti_id='$station' ORDER BY s_assign_date DESC;";
    $result = $mysqli->query($sql);

    $namesql = "SELECT DISTINCT sti_lname,sti_fname,sti_mname,sti_sname,sti_email,sti_contact,sti_barangay,sti_municipal,sti_region,sti_station FROM student_station JOIN student_enroll on student_station.s_id=student_enroll.id JOIN station_info ON student_station.sti_id=station_info.sti_id where student_enroll.status !='1' and student_station.sti_id='$station' ORDER BY s_assign_date DESC;";
    $resultname = $mysqli->query($namesql);


// Create the PDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information and metadata
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Database Export');
$pdf->SetSubject('Data from Database');
$pdf->SetKeywords('database, export, pdf');

// Set page format and margins
$pdf->SetMargins(10, 10, 10);

// Add a page
$pdf->AddPage();
$date=date("Y/m/d");
// Set header content
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 16, 'URDANETA CITY UNIVERSITY', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 10, 'Collage of Criminal Justice Education', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 10, 'Student Station', 0, 1, 'C');

// Set logo in header
$pdf->Image('../uculogo.png', 37, 11, 25, 27  , 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Image('../logoccje.png', 150, 16, 18, 18, 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
$pdf->SetLineWidth(0.5); // Set line width to 0.5mm
$pdf->SetDrawColor(0, 0, 0); // Set line color (black)
$pdf->Ln(35);
// Draw a straight line
$pdf->Line(10, 50, 200, 50);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 10, "DATE : ".date( "M, d, Y" ,strtotime($date)), 0, 1, 'R');
$pdf->Ln(-10);
$pdf->SetFont('helvetica', 'B', 10);
while ($name = $resultname->fetch_assoc()) {
    $pdf->Cell(0, 10, 'Supervisor Name : '.$name['sti_lname'] . ", " . $name['sti_fname'] . " " . $name['sti_mname'] . " " . $name['sti_sname'], 0, 1, 'L');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Station : '.$name['sti_station'] . " " . $name['sti_municipal'], 0, 1, 'L');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Address : '.$name['sti_barangay'] . ", " . $name['sti_municipal'] . ", " . $name['sti_region'], 0, 1, 'L');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Contact : '.$name['sti_contact'], 0, 1, 'L');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Email : '.$name['sti_email'], 0, 1, 'L');
}

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(0, 0, 255); // Blue color
$pdf->SetTextColor(255, 255, 255); // White color
$pdf->SetX(30);
$pdf->Cell(10, 10, '#', 1, 0, 'C',true);
$pdf->Cell(30, 10, 'ID', 1, 0, 'C',true);
$pdf->Cell(80, 10, 'Name', 1, 0, 'C',true);
$pdf->Cell(40, 10, 'Assign Date', 1, 1, 'C',true);

// Set table rows
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0, 0, 0); // White color

$x='1';
while ($row = $result->fetch_assoc()) {
$year = date("Y", strtotime($row['time_date']));
         $yearnew = $year - 1;
         $pdf->SetX(30);
         $pdf->Cell(10, 7, $x++, 1, 0, 'C');
$pdf->Cell(30, 7, $row['id'], 1, 0, 'C');
$pdf->Cell(80, 7, $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name'], 1, 0, 'L');
$pdf->Cell(40, 7, date("M, d, Y", strtotime($row['s_assign_date'])), 1, 1, 'C');
}

$pdf->Ln(25);
$pdf->SetFont('helvetica', 'B', 6);
$pdf->Cell(0, 6, 'PREPARED BY :', 0, 1, 'L');

$pdf->SetFont('helvetica', 'BU', 10);
$pdf->SetX(27);
$pdf->Cell(0, 6, 'DALE JUSTIN B. BAUZON, R.CRIM', 'U', 1, 'L');

$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetX(42); // Set left padding
$pdf->Cell(10, 6, 'OJT COORDINATOR', 0, 1, 'L');

$pdf->Ln(15);
$pdf->SetFont('helvetica', 'B', 6);
$pdf->Cell(0, 6, 'APPROVED BY :', 0, 1, 'L');

$pdf->SetFont('helvetica', 'BU', 10);
$pdf->SetX(30);
$pdf->Cell(0, 6, 'JOSEPH D. MIRANDA, MS CRIM', 'U', 1, 'L');

$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetX(52); // Set left padding
$pdf->Cell(10, 6, 'DEAN', 0, 1, 'L');
// Set footer content
$pdf->SetY(-15);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages(), 0, 0, 'R');

// Set header and footer fonts
$pdf->setHeaderFont(array('helvetica', '', 10));
$pdf->setFooterFont(array('helvetica', '', 8));

// Set default header and footer content
$pdf->setHeaderMargin(10);
$pdf->setFooterMargin(10);

// Set table header

// Output the PDF as a file or inline in the browser
$pdf->Output('student_station.pdf', 'I');

// Close the database connection
$mysqli->close();
}
?>