<?php

/* use yii\helpers\Html;
 */use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */

/* $this->title = 'Print Forms';
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 */
/* [START PHPWORD] */
//require "vendor/autoload.php";
$pw = new \PhpOffice\PhpWord\PhpWord();

$data = json_decode(base64_decode($request));
//var_dump($data->namaKorban);

/* [THE HTML] */
//$section = $pw->addSection();
$filename = "fileku.docx";
 $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/template.docx');

$templateProcessor->setValue('name', $data->namaKorban);
$templateProcessor->setValue('location', $data->lokasi);
$templateProcessor->setValue('date', $data->tanggal);
$templateProcessor->setValue('description', $data->penjelasan);

header("Content-Disposition: attachment; filename=report.docx");
ob_clean();
$templateProcessor->saveAs('php://output');
?>