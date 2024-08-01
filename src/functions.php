<?php
function renderTemplate($template, $param = null) {
    ob_start();
    if ($param) {
        extract($param);
    }
    include($template);
    return ob_get_clean();
}