<?php

namespace exportall;

use DB\db;
include '../db/db.php';
require '../vendor/autoload.php'; // Подключение PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// READ (Чтение записей)
$result = $db->query("SELECT * FROM users_history union all select * from users order by id");


if ($result->num_rows > 0) {
    // Создание нового объекта Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Заголовки столбцов
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Age');

    $row = 2; // Начало данных со второй строки

    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['id']);
        $sheet->setCellValue('B' . $row, $data['name']);
        $sheet->setCellValue('C' . $row, $data['email']);
        $sheet->setCellValue('D' . $row, $data['age']);
        $row++;
    }

    // Создание объекта Xlsx Writer
    $writer = new Xlsx($spreadsheet);

    // Установка заголовков для скачивания
    $date = date("Y-m-d_H-i-s");
    $filename = "users_all_" . $date . ".xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Сохранение файла в вывод
    $writer->save('php://output');

} else {
    echo "0 results";
}

$db->close();
?>