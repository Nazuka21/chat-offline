
<?php
$target_dir = "voices/";
$max_age = 7 * 24 * 60 * 60; // 7 hari

if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

// Hapus file lama
foreach (glob($target_dir . "*.ogg") as $file) {
  if (filemtime($file) < time() - $max_age) unlink($file);
}

if ($_FILES["audio"]["error"] === UPLOAD_ERR_OK) {
  $tmp = $_FILES["audio"]["tmp_name"];
  $name = basename($_FILES["audio"]["name"]);
  $target = $target_dir . $name;
  if (move_uploaded_file($tmp, $target)) {
    echo $target;
  } else {
    http_response_code(500);
    echo "Gagal simpan file.";
  }
} else {
  http_response_code(400);
  echo "Gagal upload.";
}
?>
