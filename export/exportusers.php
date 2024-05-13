<?php

namespace exportusers;
include 'db/db.php';
require 'vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Set character encoding
$mysqli->set_charset("utf8");

// READ (Read records)
$result = $mysqli->query("SELECT * FROM users Order by id");

if ($result->num_rows > 0) {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Column headers
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Age');
    $sheet->setCellValue('E1', 'City');

    $row = 2; // Start data from the second row

    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['id']);
        $sheet->setCellValue('B' . $row, $data['name']);
        $sheet->setCellValue('C' . $row, $data['email']);
        $sheet->setCellValue('D' . $row, $data['age']);
        $sheet->setCellValue('E' . $row, $data['city']);
        $row++;
    }

    // Create Xlsx Writer object
    $writer = new Xlsx($spreadsheet);

    // Set headers for downloading
    $date = date("Y-m-d_H-i-s");
    $filename = "users_" . $date . ".xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Save the file to output
    $writer->save('php://output');

} else {
    echo "0 results";
}

$mysqli->close();
?>
