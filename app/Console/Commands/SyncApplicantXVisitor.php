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
    protected $description = 'Sync Applicant x Visitor Info to found matches';

    public function handle()
    {
        // Obtener todos los registros de VisitorInfo
        $visitorInfoRecords = VisitorInfo::all();

        foreach ($visitorInfoRecords as $visitor) {
            // Solo procesar si el campo 'documentNumber' no está vacío
            if (!empty($visitor->documentNumber)) {
                $applicant = Applicant::where('documentNumber', $visitor->documentNumber)->first();
                
                if ($applicant) {
                    // Buscar información adicional dependiendo del tipo de visitante
                    $educationalInstitution = null;
                    $residenceDistrict = null;

                    if ($visitor->visitor_type == 'V') {
                        // Si es Virtual, buscar en VisitorV
                        $visitorV = VisitorV::find($visitor->fk_id_visitor);
                        if ($visitorV) {
                            $educationalInstitution = $visitorV->educationalInstitution;
                            $residenceDistrict = $visitorV->residenceDistrict;
                        }
                    } elseif ($visitor->visitor_type == 'P') {
                        // Si es Physical, buscar en VisitorP
                        $visitorP = VisitorP::find($visitor->fk_id_visitor);
                        if ($visitorP) {
                            $educationalInstitution = $visitorP->educationalInstitution;
                            $residenceDistrict = $visitorP->residenceDistrict;
                        }
                    } elseif ($visitor->visitor_type == 'B') {
                        // Si es Both, buscar en ambas tablas y combinar los datos

                        // Cadena concatenada 
                        $id_visitorVP = $visitor->fk_id_visitor;
                        
                        // Separar la cadena en un array usando '_' como delimitador
                        $ids = explode('_', $id_visitorVP);
                        
                        // Obtener los valores individuales
                        $id_visitorV = $ids[0];
                        $id_visitorP = $ids[1];

                        $visitorV = VisitorV::find($id_visitorV);
                        $visitorP = VisitorP::find($id_visitorP);

                        if ($visitorV && $visitorP) {
                            $educationalInstitution = $visitorV->educationalInstitution ?: $visitorP->educationalInstitution;
                            $residenceDistrict = $visitorV->residenceDistrict ?: $visitorP->residenceDistrict;
                        }
                    }

                    // Si hay un registro coincidente en Applicant, actualizar o crear en VisitorInfoXapplicant
                    VisitorInfoXapplicant::updateOrCreate(
                        [
                            'fk_docType_id' => $visitor->fk_docType_id,
                            'documentNumber' => $visitor->documentNumber,  
                        ],
                        [
                            'fk_applicant_id' => $applicant->id_applicant,
                            'fk_visitorInfo_id' => $visitor->id_visitorInfo,
                            'name' => $visitor->name,
                            'lastName' => $visitor->lastName,
                            'email' => $visitor->email,
                            'phone' => $visitor->phone,
                            'educationalInstitution' => $educationalInstitution,
                            'residenceDistrict' => $residenceDistrict,
                            'studentCode' => $applicant->studentCode,
                            'admitted' => $applicant->admitted,
                        ]
                    );
                }
            }
        }

        $this->info('Visitor x Applicant Info synchronized successfully!');
    }
}
