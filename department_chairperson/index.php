<?php 
session_start();
// var_dump($_SESSION);
if(isset($_SESSION['role']))
{
        switch ($_SESSION['role']) {
                case 'department_chairperson':
                        echo '<script>
                                window.location.href = "dashboard.php";
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
