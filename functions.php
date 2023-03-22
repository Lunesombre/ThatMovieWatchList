<?php
/**
 * Redirect function : when called with an url , redirects to this url 
 *
 * @param string $url
 * @return void
 */
function redirect(string $url): void
{
    header("Location:$url");
    die();
}



