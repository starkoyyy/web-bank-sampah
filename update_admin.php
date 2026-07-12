<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('username', 'admin')->first();
$user->password = Hash::make('admin123');
$user->save();
echo "Admin password updated successfully!\n";
