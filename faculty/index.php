<?php 
session_start();
if(isset($_SESSION['role']))
{
        switch ($_SESSION['role']) {
                case 'faculty':
                        echo '<script>
                                window.location.href = "profile.php";
                        </script>';
                        break;
                
                default:
                echo '<script>
                        window.location.href = "../login.php";
                </script>';
                        break;
        }
}else{
echo '<script>
        window.location.href = "../login.php";
</script>';
}
