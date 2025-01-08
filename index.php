<?php 
session_start();
if(isset($_SESSION['role']))
{
        switch ($_SESSION['role']) {
                case 'college_secretary':
                        echo '<script>
                                window.location.href = "college_secretary/";
                        </script>';
                        break;
                case 'college_dean':
                        echo '<script>
                                window.location.href = "college_dean/";
                        </script>';
                        break;
                case 'department_secretary':
                                echo '<script>
                                        window.location.href = "department_secretary/";
                                </script>';
                                break;
                case 'department_chairperson':
                        echo '<script>
                                window.location.href = "department_chairperson/";
                        </script>';
                        break;
                case 'faculty':
                        echo '<script>
                                window.location.href = "faculty/";
                        </script>';
                        break;
                default:
                echo '<script>
                        window.location.href = "login.php";
                </script>';
                        break;
        }
}else{
echo '<script>
        window.location.href = "login.php";
</script>';
}
?>
