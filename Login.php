<?php
    require_once('SQL.php');
    $sql = new SQL;

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $users = $_POST['emailid'];
        $pass = $_POST['pwd'];
        $sql->Execute("Login",array($users,$pass));
        $result = $sql->IsUserNamePasswordValid();
        if($result == true)
        {
            header("location: UploadPage.php");
        }
        else
        {
            echo "<script> alert('Incorrect Login! Please try again');window.location='index.php'</script>";
            exit;
        }
    }
   $sql->CloseConnection();
?>
