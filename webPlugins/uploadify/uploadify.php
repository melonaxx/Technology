<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

// Define a destination
$targetFolder = '/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}


	/**
     * laravel图片上传
     * @param  Request $request
     * @return mixed
     */
    // public function uploadImg(Request $request)
    // {
    //     //上传图片
    //     $Filedata = $request->all()['Filedata'];
    //     $imgFile = $Filedata ? $Filedata : ''; //文件资源

    //     if (!Storage::exists('sat')) {
    //         Storage::makeDirectory('sat');//创建文件
    //     }
    //     $picFile    = 'sat/' . date('Ymd');
    //     $fileExists = Storage::exists($picFile);//是否存在
    //     if (!$fileExists) {
    //         Storage::makeDirectory($picFile);//创建文件
    //     }
    //     //获取路径
    //     $pathData = $imgFile->store($picFile);
    //     $path = env('ENV_DATA_CDN_URL') . '/' . $pathData;
    //     $HTMLIMG = '&ltimg style="width: 100%;text-align:center;" src="'.$path.'"/&gt';

    //     echo $HTMLIMG;
    // }