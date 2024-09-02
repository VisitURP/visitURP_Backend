<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorInfoXapplicant;
use App\Models\VisitorInfo;
use App\Models\VisitorV;
use App\Models\VisitorP;
use App\Models\Applicant;

class SyncApplicantXVisitor extends Command
{
    protected $signature = 'sync:applicantXvisitor-info';
    protected $description = 'Sync Applicant x Visitor Info to find matches';

    public function handle()
    {
        // Obtener todos los registros de VisitorInfo
        $visitorInfoRecords = VisitorInfo::all();

        foreach ($visitorInfoRecords as $visitor) {
            // Procesar solo si el campo 'visitor_type' está definido y tiene un valor válido
            switch ($visitor->visitor_type) {
                case 'V':
                    $this->processVisitorV($visitor);
                    break;
                case 'P':
                    $this->processVisitorP($visitor);
                    break;
                case 'B':
                    $this->processVisitorB($visitor);
                    break;
                default:
                    // Manejar casos donde el visitor_type no es reconocido
                    $this->warn("Unrecognized visitor_type: {$visitor->visitor_type} for VisitorInfo ID: {$visitor->id_visitorInfo}");
                    break;
            }
        }

        $this->info('Visitor x Applicant Info synchronized successfully!');
    }

    protected function processVisitorV($visitor)
    {
        $visitorV = VisitorV::find($visitor->fk_id_visitor);

        if ($visitorV) {
            $applicant = Applicant::where('documentNumber', $visitorV->documentNumber)->first();

            if ($applicant) {
                // Actualizar o crear en VisitorInfoXapplicant
                VisitorInfoXapplicant::updateOrCreate(
                    [
                        'fk_id_applicant' => $applicant->id_applicant,
                        'fk_id_visitorInfo' => $visitor->id_visitorInfo,
                    ]
                );
            }
        }
    }

    protected function processVisitorP($visitor)
    {
        $visitorP = VisitorP::find($visitor->fk_id_visitor);

        if ($visitorP) {
            $applicant = Applicant::where('documentNumber', $visitorP->docNumber)->first();

            if ($applicant) {
                // Actualizar o crear en VisitorInfoXapplicant
                VisitorInfoXapplicant::updateOrCreate(
                    [
                        'fk_id_applicant' => $applicant->id_applicant,
                        'fk_id_visitorInfo' => $visitor->id_visitorInfo,
                    ]
                );
            }
        }
    }

    protected function processVisitorB($visitor)
    {
        // Cadena concatenada en el campo fk_id_visitor
        $id_visitorVP = $visitor->fk_id_visitor;

        // Separar la cadena en un array usando '_' como delimitador
        list($id_visitorV, $id_visitorP) = explode('_', $id_visitorVP);

        $visitorV = VisitorV::find($id_visitorV);
        $visitorP = VisitorP::find($id_visitorP);

        if ($visitorV && $visitorP) {
            $applicant = Applicant::where('documentNumber', $visitorV->documentNumber)->first();
            $applicant2 = Applicant::where('documentNumber', $visitorP->docNumber)->first();

            if ($applicant && $applicant2) {
                // Actualizar o crear en VisitorInfoXapplicant
                VisitorInfoXapplicant::updateOrCreate(
                    [
                        'fk_id_applicant' => $applicant ? $applicant->id_applicant : $applicant2->id_applicant,
                        'fk_id_visitorInfo' => $visitor->id_visitorInfo,
                    ]
                );
            }
        }
    }
}

