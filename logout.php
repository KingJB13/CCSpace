<?php
session_start();
session_destroy();
echo "<script>alert('Account Logged Out Successfully!');window.location='index.php'</script>";
?>