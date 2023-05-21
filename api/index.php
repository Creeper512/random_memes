<?php
// 读取图片链接
$urls = file('./image_url.txt', FILE_IGNORE_NEW_LINES);

// 随机选择一个链接
$randomUrl = $urls[array_rand($urls)];

// 执行重定向
header('Location: ' . $randomUrl);
exit;
?>
