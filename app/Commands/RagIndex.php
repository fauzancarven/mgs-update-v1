<?php

namespace App\Commands;

use App\Libraries\RagService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

/**
 * php spark rag:index           -> indeks dokumen baru/yang berubah saja
 * php spark rag:index --force   -> indeks ulang semuanya (wajib setelah ganti model embedding)
 */
class RagIndex extends BaseCommand
{
    protected $group       = 'AI';
    protected $name        = 'rag:index';
    protected $description = 'Indeks dokumen panduan (app/Knowledge/*.md) untuk Asisten AI.';
    protected $usage       = 'rag:index [--force]';
    protected $options     = ['--force' => 'Indeks ulang semua dokumen walaupun tidak berubah.'];

    public function run(array $params)
    {
        $force = CLI::getOption('force') !== null;

        CLI::write('Mengindeks ' . APPPATH . 'Knowledge ...', 'yellow');

        try {
            $report = (new RagService())->indexDirectory(APPPATH . 'Knowledge', $force);
        } catch (\Throwable $e) {
            CLI::error('Gagal: ' . $e->getMessage());

            return EXIT_ERROR;
        }

        foreach ($report['indexed'] as $s) {
            CLI::write('  + ' . $s, 'green');
        }
        foreach ($report['skipped'] as $s) {
            CLI::write('  = ' . $s . ' (tidak berubah)');
        }
        foreach ($report['removed'] as $s) {
            CLI::write('  - ' . $s . ' (dihapus dari indeks)', 'red');
        }

        CLI::write('Selesai.', 'green');

        return EXIT_SUCCESS;
    }
}
