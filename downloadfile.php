<?php


if (!empty($_GET['attachmentlink'])) {
    $fileName  = basename($_GET['attachmentlink']);
    $filePath  = "uploaded_files/ecert/" . $fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: image/png");
        header("Content-Transfer-Encoding: binary");

        //read file 
        readfile($filePath);
        exit;
    } else {
        echo "file does not exist";
    }
}


if (!empty($_GET['attachmentlink'])) {
    $fileName  = basename($_GET['attachmentlink']);
    $filePath  = "uploaded_files/ecert/" . $fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: image/png");
        header("Content-Transfer-Encoding: binary");

        //read file 
        readfile($filePath);
        exit;
    } else {
        echo "File does not exist";
    }
}
