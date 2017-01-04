<?php

namespace webdeveric\GetPostContentShortcode;

function is_yes($arg)
{
    if (is_string($arg)) {
        $arg = strtolower($arg);
    }

    return in_array($arg, [ true, 'true', 'yes', 'y', '1', 1 ], true);
}

function split_comma($csv)
{
    return array_map('trim', explode(',', $csv));
}
