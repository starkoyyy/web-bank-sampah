<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use Illuminate\Support\Facades\DB;

DB::statement("ALTER TABLE nasabah ADD jenis_kelamin VARCHAR(20) NULL AFTER alamat");
echo "Column added successfully.\n";
