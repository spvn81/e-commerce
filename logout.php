<?php 
session_start();
if(!empty($_SESSION['main_user'])){
    unset($_SESSION['main_user']);
    unset($_SESSION['main_user_email']);
    echo "
<script>
  window.location='index.php'
</script>
";  

}else{
    echo "
    <script>
      window.location='index.php'
    </script>
    ";       
}





?>