<?php
// 获取上级目录路径
$parentDirectory = dirname(__DIR__);

// 图片链接文件路径
$imageUrlFile = $parentDirectory . '/image_url.txt';

// 检查图片链接文件是否存在
if (file_exists($imageUrlFile)) {
    // 读取图片链接
    $urls = file($imageUrlFile, FILE_IGNORE_NEW_LINES);

    // 检查是否存在链接
    if (count($urls) > 0) {
        // 随机选择一个链接
        $randomUrl = $urls[array_rand($urls)];

        // 执行重定向
        header('Location: ' . $randomUrl);
        exit;
    } else {
        // 链接为空，返回错误信息
        echo '错误：图片链接文件中没有链接';
    }
} else {
    // 文件不存在，返回错误信息
    echo '错误：找不到图片链接文件';
}

// 列出上级目录下的所有文件和目录
$files = scandir($parentDirectory);

echo '<br><br>上级目录下的所有文件和目录：<br>';

// 遍历文件和目录数组
foreach ($files as $file) {
    // 排除当前目录和上级目录
    if ($file != '.' && $file != '..') {
        // 输出文件或目录名称
        echo $file . '<br>';
    }
}
?>
