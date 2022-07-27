<?php //------------------------QUERY---------------------------//

function get_admin_name($id){
	$sql=mysqli_query($GLOBALS['CON'],"SELECT * FROM `admin` WHERE `id` = $id");
	$rs=mysqli_fetch_array($sql);
	return $rs['admin_name'];	
}

//------------------------SELECT---------------------------//



//------------------------INSERT---------------------------//


//------------------------UPDATE---------------------------//


//------------------------DELETE---------------------------//



?>