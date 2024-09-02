<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorInfo;
use App\Models\VisitorV;
use App\Models\visitorP;

class SyncVisitorInfo extends Command
{
    protected $signature = 'sync:visitor-info';
    protected $description = 'Sync Visitor Info from VisitorV and visitorP tables';

    public function handle()
    {
        // Sincronizar desde VisitorV
        $visitorVRecords = VisitorV::all();
        foreach ($visitorVRecords as $visitorV) {
            // Verifica si hay un match en VisitorP
            $visitorP = visitorP::where('email', $visitorV->email)
                                ->orWhere('docNumber', $visitorV->documentNumber)
                                ->first();
                                
            if ($visitorP) {
                // Si hay un match, actualiza o crea un registro en VisitorInfo con tipo 'B' (ambos)

                //crear cadena para concatenar id de visitorV y visitorP 
                $id_visitorVP = $visitorV->id_visitorV . '_' . $visitorP->id_visitorP;


                VisitorInfo::updateOrCreate(
                    [
                        'fk_id_visitor' => $id_visitorVP, // concatenado cuando es de tipo 'B'
                        'visitor_type' => 'B',
                        'typeOfVisitor' => 'Both',
                    ]
                );
            } else {
                // Si no hay match, actualiza o crea un registro con tipo 'V' (virtual)
                VisitorInfo::updateOrCreate(
                    [
                        'fk_id_visitor' => $visitorV->id_visitorV, // ID de VisitorV para tipo 'V'        
                        'visitor_type' => 'V',
                        'typeOfVisitor' => 'Virtual',
                    ]
                );
            }
        }

        // Sincronizar desde VisitorP para registros que no hayan sido cubiertos por la lógica anterior
        $visitorPRecords = visitorP::all();
        foreach ($visitorPRecords as $visitorP) {
            $visitorV = VisitorV::where('email', $visitorP->email)->first();
                                
            if (!$visitorV) {
                // Si no hay un match en VisitorV, actualiza o crea un registro con tipo 'P' (físico)
                VisitorInfo::updateOrCreate(
                    [
                        'fk_id_visitor' => $visitorP->id_visitorP, // ID de VisitorP para tipo 'P'                    
                        'visitor_type' => 'P',
                        'typeOfVisitor' => 'Physical',
                    ]
                );
            }
        }

        $this->info('Visitor Info synchronized successfully!');
    }
}