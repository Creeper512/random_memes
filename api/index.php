<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// 获取上级目录路径
$parentDirectory = dirname(__DIR__);

// 图片链接文件路径
$imageUrlFile = $parentDirectory . '/image_url.txt';

// 检查请求参数
if (isset($_GET['type']) && $_GET['type'] === 'count') {
    // 检查图片链接文件是否存在
    if (file_exists($imageUrlFile)) {
        // 读取图片链接行数
        $lineCount = count(file($imageUrlFile, FILE_IGNORE_NEW_LINES));

        // 返回 JSON 文本
        $response = array('count' => $lineCount);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // 文件不存在，返回错误信息
        echo '错误：找不到图片链接文件';
        exit;
    }
}

// 检查请求参数 image
if (isset($_GET['image']) && is_numeric($_GET['image'])) {
    $lineNumber = intval($_GET['image']);

    // 检查图片链接文件是否存在
    if (file_exists($imageUrlFile)) {
        // 读取图片链接
        $urls = file($imageUrlFile, FILE_IGNORE_NEW_LINES);

        // 检查行数是否有效
        if ($lineNumber >= 1 && $lineNumber <= count($urls)) {
            // 获取对应行数的链接
            $url = $urls[$lineNumber - 1];

            // 返回 JSON 文本
            $response = array('url' => $url);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            // 行数无效，返回错误信息
            $response = array('error' => '无效的行数');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        // 文件不存在，返回错误信息
        $response = array('error' => '找不到图片链接文件');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

// 检查图片链接文件是否存在
if (file_exists($imageUrlFile)) {
    // 读取图片链接
    $urls = file($imageUrlFile, FILE_IGNORE_NEW_LINES);

    // 检查是否存在链接
    if (count($urls) > 0) {
        // 随机选择一个索引
        $randomIndex = array_rand($urls);

        // 获取随机索引对应的链接
        $randomUrl = $urls[$randomIndex];

        // 返回 JSON 文本
        $response = array('url' => $randomUrl);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // 链接为空，返回错误信息
        $response = array('error' => '图片链接文件中没有链接');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
    // 文件不存在，返回错误信息
    $response = array('error' => '找不到图片链接文件');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// 列出上级目录下的所有文件和目录
$files = scandir($parentDirectory);

echo '<br><br>上级目录下的所有文件和目录：<br>';
foreach ($files as $file) {
    echo $file . '<br>';
}
?>
