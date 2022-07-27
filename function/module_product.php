<?php //------------------------QUERY---------------------------//

function get_moto_model_name($id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT * FROM `motor_model` WHERE `model_id` = $id");
	$rs=mysqli_fetch_array($sql);
	return $rs['model_name'];	
}
//------------------------SELECT---------------------------//


//------------------------INSERT---------------------------//

if($add_brand==1){
	mysqli_query($GLOBALS['CON'],"INSERT INTO `motor_brand` (`brand_id`, `brand_name`) VALUES (NULL, '$f_name');");
	gotoURL("?p=".get_page_slug(19)."",0);
}

if($add_model==1){
	mysqli_query($GLOBALS['CON'],"INSERT INTO `motor_model` (`model_id`, `model_name`, `brand_id`) VALUES (NULL, '$f_name', '$f_brand');");
	gotoURL("?p=".get_page_slug(19)."",0);
}

//------------------------UPDATE---------------------------//

function update_product_view($id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT
			motor.`view`
		FROM
			motor
		WHERE
			motor.motor_id = $id");
	$rs=mysqli_fetch_array($sql);
	$c=$rs['view']+=1;	
	mysqli_query($GLOBALS['CON'],"
	UPDATE `motor` SET `view` = '$c' WHERE `motor`.`motor_id` = $id;");
}

if($edit_motor_detail==1){
	$motor_brand_id=get_moto_brand_id_by_model_id($f_model);
	mysqli_query($GLOBALS['CON'],"UPDATE `motor` SET `motor_name` = '$f_name', `motor_brand` = '$motor_brand_id', `motor_model` = '$f_model', `motor_detail` = '$f_detail', `motor_cc` = '$f_cc', `motor_gear` = '$f_gear', `motor_color` = '$f_color', `motor_price` = '$f_price', `motor_interest` = '0', `feature` = '$f_tag', `status` = '$f_status' WHERE `motor`.`motor_id` = $product_id;");
	gotoURL("?p=".get_page_slug(20)."&op=edit&product_id=$product_id",0);
}

if($edit_motor_brand==1){
	mysqli_query($GLOBALS['CON'],"UPDATE `motor_brand` SET `brand_name` = '$f_name' WHERE `motor_brand`.`brand_id` = $brand_id");
	gotoURL("?p=".get_page_slug(19)."",0);
}

if($edit_motor_model==1){
	mysqli_query($GLOBALS['CON'],"UPDATE `motor_model` SET `model_name` = '$f_name' WHERE `motor_model`.`model_id` = $model_id");
	gotoURL("?p=".get_page_slug(19)."",0);
}

//------------------------DELETE---------------------------//

if($del_motor==1){
	mysqli_query($GLOBALS['CON'],"DELETE FROM `motor` WHERE `motor`.`motor_id` = $motor_id");
	gotoURL("?p=".get_page_slug(17)."",0);
}

if($del_motor_brand==1){
	mysqli_query($GLOBALS['CON'],"DELETE FROM `motor_brand` WHERE `motor_brand`.`brand_id` = $brand_id");
	gotoURL("?p=".get_page_slug(19)."",0);
}

if($del_motor_model==1){
	mysqli_query($GLOBALS['CON'],"DELETE FROM `motor_model` WHERE `motor_model`.`model_id` = $model_id");
	gotoURL("?p=".get_page_slug(19)."",0);
}

if($del_product_image==1){
	mysqli_query($GLOBALS['CON'],"DELETE FROM `motor_image` WHERE `motor_image`.`id` = $img_id");
	@unlink("img/product/server/php/files/$file");
	@unlink("img/product/server/php/files/thumbnail/$file");
	@unlink("img/product/server/php/files/medium/$file");
}

?>