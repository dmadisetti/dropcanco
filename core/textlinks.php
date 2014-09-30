<?php
$s = "this site is awesome http://www.plumicity.com lol.";

function put_url_in_a($arr)
    {
    if(strpos($arr[0], 'http://') !== 0)
        {
            $arr[0] = 'http://' . $arr[0];
        }
        $url = parse_url($arr[0]);

        //links
        return sprintf('<a href="%1$s">%1$s</a>', $arr[0]);
    }

$s = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(?:\S+\.\S+)#', 'put_url_in_a', $s);

echo $s;