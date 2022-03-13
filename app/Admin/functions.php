<?php

function admin_path($path = "")
{
    return app_path("Admin" . DIRECTORY_SEPARATOR . $path);
}
