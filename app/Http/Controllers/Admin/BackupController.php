<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BackupController extends Controller
{
    public function index()
    {
        $backupDir = storage_path('app/backups');
        $files = file_exists($backupDir) ? glob($backupDir . '/*.zip') : [];
        
        $backups = [];
        if ($files) {
            foreach ($files as $file) {
                $backups[] = [
                    'name' => basename($file),
                    'size' => $this->formatSizeUnits(filesize($file)),
                    'date' => filemtime($file),
                    'path' => $file
                ];
            }
        }

        // Urutkan dari yang terbaru
        usort($backups, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });

        $perPage = 10;
        $currentPage = Paginator::resolveCurrentPage('page');
        
        $paginatedBackups = new LengthAwarePaginator(
            array_slice($backups, ($currentPage - 1) * $perPage, $perPage),
            count($backups),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
        );

        return view('admin.backups.index', ['backups' => $paginatedBackups]);
    }

    public function store()
    {
        try {
            $backupDir = storage_path('app/backups');
            if (!file_exists($backupDir)) {
                mkdir($backupDir, 0755, true);
            }

            $timePrefix = 'backup-' . date('Y-m-d-His');
            $sqlFilename = $timePrefix . '.sql';
            $sqlPath = $backupDir . DIRECTORY_SEPARATOR . $sqlFilename;
            $zipFilename = $timePrefix . '.zip';
            $zipPath = $backupDir . DIRECTORY_SEPARATOR . $zipFilename;
            
            $dbName = config('database.connections.mysql.database');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbHost = config('database.connections.mysql.host');
            $dbPort = config('database.connections.mysql.port');

            // Format DSN PDO untuk library mysqldump-php
            $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName}";

            // Gunakan library PHP murni untuk dump database tanpa butuh mysqldump.exe di server
            $dump = new \Ifsnop\Mysqldump\Mysqldump($dsn, $dbUser, $dbPass);
            $dump->start($sqlPath);

            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                $zip->addFile($sqlPath, $sqlFilename);
                $password = config('app.key');
                if (str_starts_with($password, 'base64:')) {
                    $password = substr($password, 7);
                }
                $zip->setEncryptionName($sqlFilename, \ZipArchive::EM_AES_256, $password);
                $zip->close();

                unlink($sqlPath);
            } else {
                throw new \Exception('Gagal membuat file ZIP terenkripsi.');
            }

            return redirect()->route('admin.backups.index')->with('success', 'Backup database berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->route('admin.backups.index')->with('error', 'Gagal membuat backup. Detail: ' . $e->getMessage());
        }
    }

    public function download($file)
    {
        $path = storage_path('app/backups/' . $file);
        if (file_exists($path)) {
            return response()->download($path);
        }
        return redirect()->route('admin.backups.index')->with('error', 'File backup tidak ditemukan.');
    }

    public function destroy($file)
    {
        $path = storage_path('app/backups/' . $file);
        if (file_exists($path)) {
            unlink($path);
            return redirect()->route('admin.backups.index')->with('success', 'File backup berhasil dihapus.');
        }
        return redirect()->route('admin.backups.index')->with('error', 'File backup tidak ditemukan.');
    }

    private function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
