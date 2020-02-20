<?php 
$patient_name = $_POST["patient_name"];
$question_id = $_POST["question_id"];
$disease_name = $_POST["disease_name"];
$disease_id = $_POST["disease_id"];
$sheetrecord_id = $_POST["sheetrecord_id"];
include "./tcpdf/tcpdf.php"; // include_path配下に設置したtcpdf.phpを読み込む
require_once 'class/Patient.php';
require_once 'class/Disease.php';
require_once 'class/CheckSheet.php';
$tcpdf = new TCPDF();
$patient = new Patient;
$disease = new Disease;
$check_sheet = new CheckSheet;
$tcpdf->AddPage(); // 新しいpdfページを追加
$tcpdf->SetFont("kozgopromedium", "", 10); // デフォルトで用意されている日本語フォント
$html = <<< EOF
<style>
h1 {
    font-size: 24px; // 文字の大きさ
    color: ; // 文字の色
    text-align: center; // テキストを真ん中に寄せる
}
p {
    font-size: 12px; // 文字の大きさ
    color: #000000; // 文字の色
    text-align: left; // テキストを左に寄せる
    border: 1px solid #dee2e6;
    margin: 0;
    padding: 0;
}
table{
  margin: auto;
}
th {
  border-top: 1px solid #dee2e6;

}
td {
  border-top: 1px solid #dee2e6;
}
tr{
  line-height: 2;
}
</style>
<h1>カルテ</h1>
EOF;

$html .= '<h5>患者名 : ' . $patient_name . '</h5>';
$html .= '<h5>病名 : ' . $disease_name . '</h5>';

$answer = $check_sheet->get_answer_freetext($sheetrecord_id);
$html .= '<p class="border">備考:'.$answer['answer'].'</p>';
$html .= '
<table class="table">
  <thead>
    <tr>
      <th scope="col">質問</th>
      <th scope="col">答え</th>
    </tr>
  </thead>
  <tbody>';
  $result = $check_sheet->get_question($disease_id);
    foreach($result as $row){
      $question_id = $row['id'];
      $answer = $check_sheet->get_answer($sheetrecord_id, $question_id);
      $html .= '<tr>';
      if($row['question_id'] == 0){
      $html .= '<th scope="row">'.$row['question'].'</th>';
      }else{
        $html .= '<th scope="row" class="pl-5">'.$row['question'].'</th>';
      }
      $html .= '<td>'.$answer['answer'].'</td></tr>';
    }
  $html .= '
  </tbody>
</table>';

// $tcpdf->writeHTML($html); // 表示htmlを設定
$tcpdf->writeHTML($html);
$tcpdf->Output('patient.pdf', 'I'); // pdf表示設定
?>
