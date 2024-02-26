<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\VisitantesController;
use App\Models\Visitantes;


class ProcesarVisitantesEnLotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:procesar-visitantes-en-lotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procesa los visitantes en lotes';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Procesar los visitantes en lotes de 25
        Visitantes::chunk(25, function ($visitantes) {
            foreach ($visitantes as $visitante) {
                VisitantesController::create($visitante);
                $this->info('Visitante procesado: ' . $visitante->id);
            }
        });

        $this->info('¡Los visitantes han sido procesados en lotes!');
    
    }
}
