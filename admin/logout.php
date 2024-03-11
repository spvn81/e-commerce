<?php
session_start();
if(empty($_SESSION['user_login'])){
    echo "
    <script>
    window.location='login.php'
    </script>
  ";
}else{
    if(!empty($_SESSION['user_login'] && $_SESSION['user_login']==1)){
        session_destroy();
        echo "
        <script>
        window.location='login.php'
        </script>
      ";
     }
}



?>