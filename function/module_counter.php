<?php
	//*** By Weerachai Nukitram ThaiCreate.Com ***//

	//*** Select วันที่ในตาราง Counter ว่าปัจจุบันเก็บของวันที่เท่าไหร่  ***//
	//*** ถ้าเป็นของเมื่อวานให้ทำการ Update Counter ไปยังตาราง daily และลบข้อมูล เพื่อเก็บของวันปัจจุบัน ***//
	global $table_prefix;
	
	$strSQL = " SELECT DATE FROM ".$table_prefix."counter LIMIT 0,1";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if($objResult["DATE"] != date("Y-m-d"))
	{
		//*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
		$strSQL = " INSERT INTO ".$table_prefix."daily (DATE,NUM) SELECT '".date('Y-m-d',strtotime("-1 day"))."',COUNT(*) AS intYesterday FROM  ".$table_prefix."counter WHERE 1 AND DATE = '".date('Y-m-d',strtotime("-1 day"))."'";
		mysqli_query($GLOBALS['CON'],$strSQL);

		//*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
		$strSQL = " DELETE FROM ".$table_prefix."counter WHERE DATE != '".date("Y-m-d")."' ";
		mysqli_query($GLOBALS['CON'],$strSQL);
	}

	//*** Insert Counter ปัจจุบัน ***//
	$strSQL = " INSERT INTO ".$table_prefix."counter (DATE,IP) VALUES ('".date("Y-m-d")."','".$_SERVER["REMOTE_ADDR"]."') ";
	mysqli_query($GLOBALS['CON'],$strSQL);

	//******************** Get Counter ************************//

	// Today //
	$strSQL = " SELECT COUNT(DATE) AS CounterToday FROM ".$table_prefix."counter WHERE DATE = '".date("Y-m-d")."' ";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strToday = $objResult["CounterToday"];

	// Yesterday //
	$strSQL = " SELECT NUM FROM ".$table_prefix."daily WHERE DATE = '".date('Y-m-d',strtotime("-1 day"))."' ";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strYesterday = $objResult["NUM"];

	// This Month //
	$strSQL = " SELECT SUM(NUM) AS CountMonth FROM ".$table_prefix."daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '".date('Y-m')."' ";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strThisMonth = $objResult["CountMonth"];

	// Last Month //
	$strSQL = " SELECT SUM(NUM) AS CountMonth FROM ".$table_prefix."daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '".date('Y-m',strtotime("-1 month"))."' ";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strLastMonth = $objResult["CountMonth"];

	// This Year //
	$strSQL = " SELECT SUM(NUM) AS CountYear FROM ".$table_prefix."daily WHERE DATE_FORMAT(DATE,'%Y')  = '".date('Y')."' ";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strThisYear = $objResult["CountYear"];

	// Last Year //
	$strSQL = " SELECT SUM(NUM) AS CountYear FROM ".$table_prefix."daily WHERE DATE_FORMAT(DATE,'%Y')  = '".date('Y',strtotime("-1 year"))."' ";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strLastYear = $objResult["CountYear"];
	
	// Sum All //
	$strSQL = " SELECT SUM(NUM) AS CountAll FROM ".$table_prefix."daily";
	$objQuery = mysqli_query($GLOBALS['CON'],$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$CountAll = $objResult["CountAll"];

?>