<?php
function get_svg($path)
{
    return file_get_contents(get_template_directory() . '/' . $path);
}

function get_svg_ext($path)
{
    return file_get_contents($path);
}