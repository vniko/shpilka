<?php

return [
    'root'   => storage_path().'/attachments',
    'symlink' => env('CRUD_ATTACH_SYMLINK',''),
    'resized_path' => storage_path('resized'),
    'resized_url' => '/resized'
];