<?php

namespace App\Http\Controllers;

use App\Models\visitXapplicant;
use Illuminate\Http\Request;
use App\Models\visit;
use App\Models\applicantURP;


class VisitXapplicantController extends Controller
{
    // Main function to synchronize visits
   public function syncVisitXapplicants()
   {
       $this->findMatches();
       return response()->json(['message' => 'VisitXApplicant synchronized successfully']);
   }

      // Function to find matches between visits and applicants
      private function findMatches()
      {
          $visits = visit::orderBy('created_at', 'desc')
              ->get()
              ->unique('docNumber');
   
        // Get unique document numbers from applicants
        $applicants = ApplicantURP::all()->keyBy('documentNumber');
   
          foreach ($visits as $perVisit) {
              // Find the corresponding applicant by document number (dni)
            $applicant = $applicants->firstWhere('documentNumber', $perVisit->docNumber);
   
              if ($applicant) {
                  $visitXaplicantData = [
                      'fk_applicant_id' => $applicant->id_applicant,
                      'fk_visit_id' => $perVisit->id_visit,
                      'fk_docType_id' => $perVisit->fk_docType_id,
                      'documentNumber' => $applicant->documentNumber,
                      'name' => $perVisit->name,
                      'lastName' => $perVisit->lastName,
                      'email' => $perVisit->email,
                      'phone' => $perVisit->phone,
                      'visitDateP' => $perVisit->visitDateP ?? null,
                      'visitDateV' => $perVisit->visitDateV ?? null,
                      'interestCareer' => $perVisit->interestCareer,
                      'educationalInstitution' => $perVisit->educationalInstitution,
                      'residentDistrict' => $perVisit->residentDistrict,
                      'meritOrder' => $applicant->meritOrder,
                      'studentCode' => $applicant->studentCode,
                      'admitted' => $applicant->admitted,
                  ];
   
                  visitXapplicant::updateOrCreate(
                      ['docNumber' => $perVisit->docNumber],
                      $visitXaplicantData
                  );
              }
          }
      }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $visitXaplicantData = visitXapplicant::get();

        $data = $visitXaplicantData->map(function($visitXaplicantData){
            return [
                   'id_visitXapplicant' => $visitXaplicantData->id_visitXapplicant,
                   'fk_applicant_id' => $visitXaplicantData->fk_applicant_id,
                   'fk_visit_id' => $visitXaplicantData->fk_visit_id,
                   'fk_docType_id' => $visitXaplicantData->fk_docType_id,
                   'docNumber' => $visitXaplicantData->docNumber,
                   'name' => $visitXaplicantData->name,
                   'lastName' => $visitXaplicantData->lastName,
                   'email' => $visitXaplicantData->email,
                   'phone' => $visitXaplicantData->phone,
                   'visitDateP' => $visitXaplicantData->visitDateP,
                   'visitDateV' => $visitXaplicantData->visitDateV,
                   'interestCareer' => $visitXaplicantData->interestCareer,
                   'educationalInstitution' => $visitXaplicantData->educationalInstitution,
                   'residentDistrict' => $visitXaplicantData->residentDistrict,
                   'meritOrder' => $visitXaplicantData->meritOrder,
                   'studentCode' => $visitXaplicantData->studentCode,
                   'admitted' => $visitXaplicantData->admitted,
            ];
        });

        //pequeña modificacion
        return response()->json(
            $data
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitXaplicantData = visitXapplicant::findOrFail($id);
        return response()->json([
            $visitXaplicantData
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitXapplicant $visitXapplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $visitXapplicant)
    {
        $request->validate([
            'fk_applicant_id' => ['required', 'max:100'],
            'fk_visit_id' => ['required', 'max:100'],
            'fk_docType_id' => ['required', 'max:100'],
            'docNumber' => ['required','max:500'],
            'name' => ['required', 'max:500'],
            'lastName' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'phone' => ['required','max:500'],
            'visitDateP' => ['required','date_format:d/m/y'], // Accept DD/MM/YY format
            'visitDateV' => ['required','date_format:d/m/y'], // Accept DD/MM/YY format
            'interestCareer' => ['required','max:500'],
            'educationalInstitution' => ['required','max:500'],
            'residentDistrict' => ['required','max:500'],
            'meritOrder' => ['required','max:500'],
            'studentCode' => ['required','max:500'],
            'admitted' => ['required'],
        ]);

        $visitXapplicant = visitXapplicant::findOrFail($visitXapplicant);
        $visitXapplicant-> fk_applicant_id = $request['fk_applicant_id'];
        $visitXapplicant-> fk_visit_id = $request['fk_visit_id'];
        $visitXapplicant-> fk_docType_id = $request['fk_docType_id'];
        $visitXapplicant-> docNumber = $request['docNumber'];
        $visitXapplicant-> name = $request['name'];
        $visitXapplicant->lastName = $request['lastName'];
        $visitXapplicant-> email = $request['email'];
        $visitXapplicant-> phone = $request['phone'];
        $visitXapplicant-> visitDateP = $request['visitDateP'];
        $visitXapplicant-> visitDateV = $request['visitDateV'];
        $visitXapplicant-> interestCareer = $request['interestCareer'];
        $visitXapplicant-> educationalInstitution = $request['educationalInstitution'];
        $visitXapplicant-> residentDistrict = $request['residentDistrict'];
        $visitXapplicant-> meritOrder = $request['meritOrder'];
        $visitXapplicant-> studentCode = $request['studentCode'];
        $visitXapplicant-> admitted = $request['admitted'];
        $visitXapplicant-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'Visit x Applicant info: ' => $visitXapplicant
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitXapplicant = visitXapplicant::findOrFail($id);
        $visitXapplicant -> delete();

        return response()->json([
            'Message' => 'VisitxApplicant deleted successfully.'
        ]);
    }
}
