<?php
header('Content-Type: application/json; charset=utf-8');

if (!isset($_FILES['file1'])) {
  echo json_encode(array(
    'success' => 'false',
    'msg' => '',
    'error' => '沒有收到上傳檔案。',
    'fileName' => ''
  ), JSON_UNESCAPED_UNICODE);
  exit();
}

$fileName = $_FILES['file1']['name'];
$fileTmpLoc = $_FILES['file1']['tmp_name'];
$fileSize = (int)$_FILES['file1']['size'];
$fileErrorMsg = (int)$_FILES['file1']['error'];

if ($fileErrorMsg !== UPLOAD_ERR_OK || !$fileTmpLoc) {
  echo json_encode(array(
    'success' => 'false',
    'msg' => '',
    'error' => '圖片上傳失敗。',
    'fileName' => ''
  ), JSON_UNESCAPED_UNICODE);
  exit();
}

$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0777, true);
}

$extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
if (!in_array($extension, $allowedExtensions, true)) {
  echo json_encode(array(
    'success' => 'false',
    'msg' => '',
    'error' => '只允許 jpg、jpeg、png、gif 圖片格式。',
    'fileName' => ''
  ), JSON_UNESCAPED_UNICODE);
  exit();
}

if ($fileSize <= 0) {
  echo json_encode(array(
    'success' => 'false',
    'msg' => '',
    'error' => '上傳檔案大小不正確。',
    'fileName' => ''
  ), JSON_UNESCAPED_UNICODE);
  exit();
}

$safeBaseName = preg_replace('/[^A-Za-z0-9_-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
$safeFileName = $safeBaseName . '_' . date('YmdHis') . '_' . mt_rand(1000, 9999) . '.' . $extension;
$targetPath = $uploadDir . DIRECTORY_SEPARATOR . $safeFileName;

if (move_uploaded_file($fileTmpLoc, $targetPath)) {
  echo json_encode(array(
    'success' => 'true',
    'msg' => '圖片上傳成功。',
    'error' => '',
    'fileName' => $safeFileName
  ), JSON_UNESCAPED_UNICODE);
  exit();
}

echo json_encode(array(
  'success' => 'false',
  'msg' => '',
  'error' => '圖片搬移失敗。',
  'fileName' => ''
), JSON_UNESCAPED_UNICODE);
exit();
