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
$lampiran = count($data->lampiran);
$lampirans = count($data->lampiransuper);
//var_dump($replacementlamps);

//var_dump(count($data->lampiransuper));

/* [THE HTML] */
//$section = $pw->addSection();
$filename = "fileku.docx";
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/template.docx');

$templateProcessor->setValue('name', $data->namaKorban);
$templateProcessor->setValue('location', $data->lokasi);
$templateProcessor->setValue('date', $data->tanggal);
$templateProcessor->setValue('description', $data->penjelasan);
$templateProcessor->cloneBlock('lampiran',$lampiran , true, true);
$i = 1;
foreach($data->lampiran as $lamp){
	$templateProcessor->setImageValue('lampiranimg#'.$i, array('path' => $lamp, 'width' => 500, 'height' => 500, 'ratio' => true));
	$i++;
}
$i = 1;
$templateProcessor->cloneBlock('lampirans',$lampirans , true, true);
foreach($data->lampiransuper as $lamp){
	$templateProcessor->setImageValue('lampiransimg#'. $i, array('path' => $lamp, 'width' => 500, 'height' => 500, 'ratio' => true));
	$i++;
}
header("Content-Disposition: attachment; filename=report.docx");
ob_clean();
$templateProcessor->saveAs('php://output');
?>