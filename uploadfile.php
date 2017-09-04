<?php
$typeArr = array("jpg", "png", "gif","ico");
//允许上传文件格式
//上传路径
$path = "uploads/";

if(isset($_POST)){
	$name = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];
	$name_tmp = $_FILES['file']['tmp_name'];
	if (empty($name)) {
		echo json_encode(array("error" => "您还未选择图片"));
		exit ;
	}
	//获取文件类型
	$type = strtolower(substr(strrchr($name, '.'), 1));
	
	if (!in_array($type, $typeArr)) {
		echo json_encode(array("error" => "清上传jpg,png或gif类型的图片！"));
		exit ;
	}
	//图片名称
	$pic_name = time() . rand(10000, 99999) . "." . $type;
	//上传后图片路径+名称
	$pic_url = $path . $pic_name;
	
	if (move_uploaded_file($name_tmp, $pic_url)) {//临时文件转移到目标文件夹
		echo json_encode(array("error" => "0", "pic" => $pic_url, "name" => $pic_name));
	} else {
		echo json_encode(array("error" => "上传有误，清检查服务器配置！"));
	}
	
	
}
