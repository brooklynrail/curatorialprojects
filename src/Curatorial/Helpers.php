<?php

namespace Curatorial;

class Helpers
{
    // http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
    static public function slugify($text)
    { 
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return '';
        }

        return $text;
    }


}