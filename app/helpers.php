<?php

function gravatar_url($email)
{
    $email = md5($email);

    return "http://gravatar.com/avatar/{$email}?s=60";
}