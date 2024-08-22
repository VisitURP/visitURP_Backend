<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncApplicantXVisitor extends Command
{
    protected $signature = 'sync:applicantXvisitor-info';
    protected $description = 'Sync Applicant Info from applicantURP table';

    public function handle()
    {
        // Obtener todos los registros de applicantURP
        $applicantRecords = applicantURP::all();

        foreach ($applicantRecords as $applicant) {
            // Solo procesar si el campo 'documentNumber' no está vacío
            if (!empty($applicant->documentNumber)) {
                $visitorInfo = VisitorInfo::where('email', $applicant->email)
                                          ->orWhere(function ($query) use ($applicant) {
                                              $query->whereNotNull('documentNumber')
                                                    ->where('documentNumber', $applicant->documentNumber);
                                          })
                                          ->first();
                                
                if ($visitorInfo) {
                    // Si hay un registro coincidente, actualízalo
                    $visitorInfo->update([
                        'name' => $applicant->name,
                        'lastName' => $applicant->lastName,
                        'email' => $applicant->email,
                        'fk_docType_id' => $applicant->fk_docType_id,
                        'documentNumber' => $applicant->documentNumber,
                        'phone' => $applicant->phone,
                        'typeOfVisitor' => 'Applicant'
                    ]);
                } else {
                    // Si no hay coincidencia, crea un nuevo registro
                    VisitorInfo::create([
                        'name' => $applicant->name,
                        'lastName' => $applicant->lastName,
                        'email' => $applicant->email,
                        'fk_docType_id' => $applicant->fk_docType_id,
                        'documentNumber' => $applicant->documentNumber,
                        'phone' => $applicant->phone,
                        'visitor_type' => 'A',
                        'typeOfVisitor' => 'Applicant'
                    ]);
                }
            }
        }

        $this->info('Applicant Info synchronized successfully!');
    }
}