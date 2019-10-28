<?php
    function hashmake($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function hashcheck($newpassword, $oldpassword)
    {
        return password_verify($newpassword, $oldpassword);
    }
