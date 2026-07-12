<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
Illuminate\Support\Facades\DB::statement("ALTER TABLE nasabah ADD jenis_kelamin ENUM('Laki-laki', 'Perempuan') NULL AFTER alamat");
echo "Column added successfully.\n";
