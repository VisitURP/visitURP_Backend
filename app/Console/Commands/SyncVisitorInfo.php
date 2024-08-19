<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorInfo;
use App\Models\VisitorV;
use App\Models\VisitorP;

class SyncVisitorInfo extends Command
{
    protected $signature = 'sync:visitor-info';
    protected $description = 'Sync Visitor Info from VisitorV and VisitorP tables';

    public function handle()
    {
        // Sincronizar desde VisitorV
        $visitorVRecords = VisitorV::all();
        foreach ($visitorVRecords as $visitorV) {
            // Verifica si hay un match en VisitorP
            $visitorP = VisitorP::where('email', $visitorV->email)
                                ->orWhere('docNumber', $visitorV->documentNumber)
                                ->first();
                                
            if ($visitorP) {
                // Si hay un match, actualiza o crea un registro en VisitorInfo con tipo 'B' (ambos)
                VisitorInfo::updateOrCreate(
                    [
                        'email' => $visitorV->email,
                    ],
                    [
                        'name' => $visitorV->name ?: $visitorP->name,
                        'lastName' => $visitorV->lastName ?: $visitorP->lastName,
                        'fk_docType_id' => $visitorV->fk_docType_id ?: $visitorP->fk_docType_id,
                        'documentNumber' => $visitorV->documentNumber ?: $visitorP->docNumber,
                        'phone' => $visitorV->phone ?: $visitorP->phone,
                        'visitor_type' => 'B',
                        'typeOfVisitor' => 'Both',
                        'fk_id_visitor' => $visitorV->id_visitorV, // ID de VisitorV para tipo 'B'

                    ]
                );
            } else {
                // Si no hay match, actualiza o crea un registro con tipo 'V' (virtual)
                VisitorInfo::updateOrCreate(
                    [
                        'email' => $visitorV->email,
                    ],
                    [
                        'name' => $visitorV->name,
                        'lastName' => $visitorV->lastName,
                        'fk_docType_id' => $visitorV->fk_docType_id,
                        'documentNumber' => $visitorV->documentNumber,
                        'phone' => $visitorV->phone,
                        'visitor_type' => 'V',
                        'typeOfVisitor' => 'Virtual',
                        'fk_id_visitor' => $visitorV->id_visitorV, // ID de VisitorV para tipo 'V'

                    ]
                );
            }
        }

        // Sincronizar desde VisitorP para registros que no hayan sido cubiertos por la lógica anterior
        $visitorPRecords = VisitorP::all();
        foreach ($visitorPRecords as $visitorP) {
            $visitorV = VisitorV::where('email', $visitorP->email)
                                ->orWhere('documentNumber', $visitorP->docNumber)
                                ->first();
                                
            if (!$visitorV) {
                // Si no hay un match en VisitorV, actualiza o crea un registro con tipo 'P' (físico)
                VisitorInfo::updateOrCreate(
                    [
                        'email' => $visitorP->email,
                    ],
                    [
                        'name' => $visitorP->name,
                        'lastName' => $visitorP->lastName,
                        'fk_docType_id' => $visitorP->fk_docType_id,
                        'documentNumber' => $visitorP->docNumber,
                        'phone' => $visitorP->phone,
                        'visitor_type' => 'P',
                        'typeOfVisitor' => 'Physical',
                        'fk_id_visitor' => $visitorP->id_visitorP, // ID de VisitorP para tipo 'P'

                    ]
                );
            }
        }

        $this->info('Visitor Info synchronized successfully!');
    }
}