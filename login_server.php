<?php
	include"include.php";
	login();
	
	function login(){
		$name=$_POST['userid'];
		$pwd=$_POST['pwd']; 
		$yzm=$_POST['yzm'];
//		$quanxian=$_POST['quanxian'];
		$yzm1=$_SESSION['yzm'];
		$autoFlag=1;
		$pwd=md5($pwd); 
		global $user,$admin;
		$result = '{"success":false,"msg":"验证码错误"}';	
		if($yzm==$yzm1){	
		$user = mysql_query("select * from user where username='".$name."' and password='".$pwd."' limit 1");
			$row=mysql_fetch_assoc($user);
			if($row['admin']=='1')
			{
			if($autoFlag){
			setcookie("adminId",$row['id'],time()+7*24*3600);
			setcookie("adminName",$row['username'],time()+7*24*3600);
			}else{
			setcookie("adminId",$row['id']);
			setcookie("adminName",$row['username']);
			}
			$_SESSION['adminName']=$row['username'];
			$_SESSION['adminId']=$row['id'];
			$result = '{"success":true,"aaa":1,"msg":"登录成功！"}';
				
				
			echo $result;	
			}
			else if($row['admin']=='0')
				{
			if($autoFlag){
			setcookie("userId",$row['id'],time()+7*24*3600);
			setcookie("userName",$row['username'],time()+7*24*3600);
			}else{
			setcookie("userId",$row['id']);
			setcookie("userName",$row['username']);
			}
			$_SESSION['userName']=$row['username'];
			$_SESSION['userId']=$row['id'];
			
			
			$result = '{"success":true,"aaa":0,"msg":"登录成功！"}';
				
				
			echo $result;	
			}
			
			
			
		
			else{
 					
 					$result = '{"success":false,"msg":"账号或者密码错误！"}';	
 					echo $result;
 					
 				}}
 					else 
 					echo $result;
 					
 					}
	mysql_close();


	

?>

  
