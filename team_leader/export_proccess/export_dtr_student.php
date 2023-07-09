<?php
session_start();
require_once('../../tcpdf/tcpdf.php');
include '../../database/db_connect.php';
if (isset($_POST['export'])) {
    $id=$_POST["id"];
    $sdate=$_POST["sdate"];
    $edate=$_POST["edate"];
?>
    <?php
     $station= $_SESSION["userstation"];
     $sql = "SELECT * FROM attendance_qrcode JOIN student_enroll on student_enroll.id=attendance_qrcode.std_id WHERE attendance_qrcode.sti_id= '$station' and attendance_qrcode.std_id='$id' and attendance_qrcode.date_time BETWEEN '$sdate 00:00:00' AND '$edate 23:59:59';";
    $result = $mysqli->query($sql);

    $namesql = "SELECT DISTINCT sti_lname,sti_fname,sti_mname,sti_sname,last_name,first_name,middle_name,suffix_name FROM student_station JOIN student_enroll on student_station.s_id=student_enroll.id JOIN station_info ON student_station.sti_id=station_info.sti_id where student_enroll.status !='1' and student_enroll.id ='$id' and student_station.sti_id='$station' ORDER BY s_assign_date DESC;";
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
$currentDate = date("Y/m/d");
// Set header content
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 16, 'URDANETA CITY UNIVERSITY', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 10, 'Collage of Criminal Justice Education', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 10, 'Daily Time Record', 0, 1, 'C');

// Set logo in header
$pdf->Image('../../uculogo.png', 37, 11, 25, 27  , 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Image('../../logoccje.png', 150, 16, 18, 18, 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
$pdf->SetLineWidth(0.5); // Set line width to 0.5mm
$pdf->SetDrawColor(0, 0, 0); // Set line color (black)
$pdf->Ln(40);
// Draw a straight line
$pdf->Line(10, 50, 200, 50);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 10, "DATE : ".date( "M, d, Y" ,strtotime($date)), 0, 1, 'R');
$pdf->Ln(-10);
$pdf->SetFont('helvetica', 'B', 10);
while ($name = $resultname->fetch_assoc()) {
    $pdf->Cell(0, 10, 'Student Name : '.$name['last_name'] . ", " . $name['first_name'] . " " . $name['middle_name'] . " " . $name['suffix_name'], 0, 1, 'L');
    $pdf->Ln(-5);
    $pdf->Cell(0, 10, 'Supervisor Name : '.$name['sti_lname'] . ", " . $name['sti_fname'] . " " . $name['sti_mname'] . " " . $name['sti_sname'], 0, 1, 'L');
    
}

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(0, 0, 255); // Blue color
$pdf->SetTextColor(255, 255, 255); // White color
$pdf->Cell(20, 10, '#', 1, 0, 'C',true);
$pdf->Cell(50, 10, 'Time In', 1, 0, 'C',true);
$pdf->Cell(50, 10, 'Time Out', 1, 0, 'C',true);
$pdf->Cell(50, 10, 'Spend', 1, 1, 'C',true);

// Set table rows
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0, 0, 0); // Black color
$x='1';
$totalSeconds = 0;
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 7, $x++, 1, 0, 'C');
    $pdf->Cell(50, 7, date("d M Y H:i a", strtotime($row['time_in'])), 1, 0, 'C');
    $pdf->Cell(50, 7, date("d M Y H:i a", strtotime($row['time_out'])), 1, 0, 'C');

    $timeIn = strtotime($row['time_in']);
    $timeOut = strtotime($row['time_out']);
    $timeDiffSeconds = abs($timeOut - $timeIn);
    $hours = floor($timeDiffSeconds / 3600); // Calculate the hours
    $minutes = floor(($timeDiffSeconds % 3600) / 60); // Calculate the minutes
    $pdf->Cell(50, 7, sprintf("%02d:%02d", $hours, $minutes), 1, 1, 'C');
    $totalSeconds += $timeDiffSeconds;
}

$totalMinutes = floor($totalSeconds / 60);  // Convert total seconds to minutes
$totalHours = floor($totalMinutes / 60);    // Convert total minutes to hours
$remainingMinutes = $totalMinutes % 60;

$pdf->Cell(120, 7, 'Total', 1, 0, 'C');
$pdf->Cell(50, 7, $totalHours.' hours '. $remainingMinutes.' minutes', 1, 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 6, 'I HEREBY CERTIFY on my honor that the above is a true and correct report of hours of work performed', 0, 1, 'L');
$pdf->Cell(0, 6, ' record of which was made daily at the time of arrival and departure from the station.', 0, 1, 'L');
$pdf->Ln(25);

$pdf->SetFont('helvetica', 'BU', 10);
$pdf->SetX(27);
$pdf->Cell(0, 6, '                                                                     ', 'U', 1, 'L');

$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetX(42); // Set left padding
$pdf->Cell(10, 6, 'Signature over Print Name', 0, 1, 'L');

$pdf->Ln(15);

$pdf->SetFont('helvetica', 'BU', 10);
$pdf->SetX(30);
$pdf->Cell(0, 6, '                                                                     ', 'U', 1, 'L');

$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetX(37); // Set left padding
$pdf->Cell(10, 6, 'Supervisor Signature over Print Name', 0, 1, 'L');

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