<?php 
session_start();
if(isset($_SESSION['role']))
{
        switch ($_SESSION['role']) {
                case 'college_secretary':
                        echo '<script>
                                window.location.href = "departments.php";
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
        