<?php

function checkType($type) {
    $types = [
        'A'     => 'Attachment',
        'I'     => 'Image',
        'D'     => 'Document',
    ];

    return array_key_exists($type, $types) ? $types[$type] : false;
}

function getStatus($status) {
    $statuses = [
        'APP'   =>  'Approved',
        'PENDING'   =>  'Pending',
        'CAN'   =>  'Cancelled',
        'DEC'   =>  'Declined',
    ];

    return array_key_exists($status, $statuses) ? $statuses[$status] : false;
}

function getSchedule($schedule) {
    switch($schedule) {
        case '1-10-m-f':
            $schedule = 'Monday to Friday, 1:00pm - 10:00pm';
            break;
        case '2-11-m-f':
            $schedule = 'Monday to Friday, 2:00pm - 10:00pm';
            break;
        case '330-1230-m-f':
            $schedule = 'Monday to Friday, 3:30pm - 12:30pm';
            break;
        default:
            $schedule = '';
    }

    return $schedule;
}

function getTypeFromMime($type) {
    $type = explode('/', $type);

    return $type[0];
}

function getUserTypes()
{
    $types = [
        'Admin', 'Employee', 'Client'
    ];

    return $types;
}
