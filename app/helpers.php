<?php

if (!function_exists('notify')) {
    function notify($type, $text)
    {
        session()->put('notificationType', $type);
        session()->put('notificationText', $text);
    }
}

if (!function_exists('notifySuccess')) {
    function notifySuccess($text)
    {
        notify('success', $text);
    }
}

if (!function_exists('notifyError')) {
    function notifyError($text)
    {
        notify('danger', $text);
    }
}


if (!function_exists('notified')) {
    function notified()
    {
        session()->forget('notificationType');
        session()->forget('notificationText');
    }
}
