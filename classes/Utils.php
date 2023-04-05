<?php
class Utils
{

    /**
     * Redirect function : when called with an url , redirects to this url 
     *
     * @param string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header("Location:$url");
        die();
    }
}
