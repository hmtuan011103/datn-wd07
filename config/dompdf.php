<?php

return [
    'font_dir' => public_path('fonts/'),
    'font_cache' => storage_path('fonts/'),
    'default_font' => 'DejaVuSans',
    'font_height_ratio' => 0.85,
    'enable_remote' => true,
    'pdf_backend' => 'CPDF',
    'default_paper_size' => 'a4',
    'orientation' => 'portrait',
    'chroot' => public_path(),
    'temp_dir' => storage_path('temp'),
    'unicode_enabled' => true,
    'font_subsetting' => true,
];