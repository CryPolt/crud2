<?php
include 'db/database.php';
require 'vendor/autoload.php'; // Подключение PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// READ (Чтение записей)
$result = $conn->query("SELECT * FROM users union select * from user2 union select * from users_auth Order by id");


if ($result->num_rows > 0) {
    // Создание нового объекта Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Заголовки столбцов
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Full Name');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Age');

    $row = 2; // Начало данных со второй строки

    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['id']);
        $sheet->setCellValue('B' . $row, $data['full_name']);
        $sheet->setCellValue('C' . $row, $data['email']);
        $sheet->setCellValue('D' . $row, $data['age']);
        $row++;
    }

    // Создание объекта Xlsx Writer
    $writer = new Xlsx($spreadsheet);

    // Установка заголовков для скачивания
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="usersALL.xlsx"');
    header('Cache-Control: max-age=0');

    // Сохранение файла в вывод
    $writer->save('php://output');

} else {
    echo "0 results";
}

$conn->close();
?>