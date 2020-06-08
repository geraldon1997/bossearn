<?php

function logout()
{
    session_destroy();
    // header('location: http://bossearnphp.test');
}

logout();
