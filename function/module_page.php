<?php //------------------------QUERY---------------------------//



//------------------------SELECT---------------------------//

function get_page_slug($page_id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT
	page.page_id,
	page.page_slug 
FROM
	page 
WHERE
	page.page_id = $page_id");
	$rs=mysqli_fetch_array($sql);
	return $rs['page_slug'];	
}

function get_page_content($page_id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT
page.page_content
FROM
page
WHERE
page.page_id = $page_id");
	$rs=mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql)>0){
		return $rs['page_content'];	
	}else{
		return NULL;
	}
}

function get_page_title($page_id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT
	page.page_title 
FROM
	page 
WHERE
	page.page_id = $page_id");
	$rs=mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql)>0){
		return $rs['page_title'];	
	}else{
		return NULL;
	}
}

function get_page_menu($page_id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT
	page.page_menu
FROM
	page 
WHERE
	page.page_id = $page_id");
	$rs=mysqli_fetch_array($sql);
	return $rs['page_menu'];	
}

function get_page_file_name($slug){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT * FROM `page` WHERE `page_slug` LIKE '$slug' ");
	$rs=mysqli_fetch_array($sql);
	$c=mysqli_num_rows($sql);
	if($c==0){
		return "main";
	}else{
		return $rs['page_file_name'];	
	}
}

function get_page_id($slug){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT * FROM `page` WHERE `page_slug` LIKE '$slug' ");
	$rs=mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql)>0){
		return $rs['page_id'];	
	}else{
		return "0";
	}
	
}

//------------------------INSERT---------------------------//


	
//------------------------UPDATE---------------------------//

if($edit_page==1){
	mysqli_query($GLOBALS['CON'],"UPDATE `page` SET `page_slug` = '$f_slug', `page_title` = '$f_name', `page_content` = '$f_content' WHERE `page`.`page_id` = $page_id");
	gotoURL("?p=edit_page&id=$page_id",0);
}

//------------------------DELETE---------------------------//


?>