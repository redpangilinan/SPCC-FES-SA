<?php
// Only allows access to owner accounts
function authorize($user_type)
{
    if ($_SESSION['user_type'] != $user_type) {
        header('Location: login.php');
    }
}
