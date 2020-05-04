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
$width = 300;
$height = 300;
$data = json_decode(base64_decode($request));
//var_dump($data->namaKorban);
if($data->lampiranprop->width > 2000){
	$width = 200;
	$height = 200;
}
if($data->lampiranprop->height > 2000){
	$width = 200;
	$height = 200;
}
/* [THE HTML] */
//$section = $pw->addSection();
$filename = "fileku.docx";
 $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/template.docx');

$templateProcessor->setValue('name', $data->namaKorban);
$templateProcessor->setValue('location', $data->lokasi);
$templateProcessor->setValue('date', $data->tanggal);
$templateProcessor->setValue('description', $data->penjelasan);
//$templateProcessor->setImageValue('lampiran', $data->lampiran);
$templateProcessor->setImageValue('lampiran', array('path' => $data->lampiran, 'width' => $width, 'height' => $height, 'ratio' => false));

header("Content-Disposition: attachment; filename=report.docx");
ob_clean();
$templateProcessor->saveAs('php://output');
?>