<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */

$this->title = 'Print Forms';
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/* [START PHPWORD] */
//require "vendor/autoload.php";
$pw = new \PhpOffice\PhpWord\PhpWord();
/* [THE HTML] */
//var_dump(base64_decode($request));
$section = $pw->addSection();
$html = base64_decode($request);

//$html = "HELLO WORLD!";

\PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

/* [SAVE FILE ON THE SERVER] */
// $pw->save("html-to-doc.docx", "Word2007");

/* [OR FORCE DOWNLOAD] */
header('Content-Type: application/docx');
header('Content-Disposition: attachment;filename="convert.docx"');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($pw, 'Word2007');
//var_dump($pw);
ob_clean();
$objWriter->save('php://output');
exit;
?>