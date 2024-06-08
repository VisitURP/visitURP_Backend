<?php

namespace App\Http\Controllers;

use App\Models\visit;
use Illuminate\Http\Request;
use App\Models\VisitorP;
use App\Models\VisitorV;
use Carbon\Carbon;

class VisitController extends Controller
{

   // Main function to synchronize visits
   public function syncVisits()
   {
       $this->findMatches();
       $this->syncVirtualVisitors();
       $this->syncPhysicalVisitors();

       return response()->json(['message' => 'Visits synchronized successfully']);
   }



   // Function to find matches between physical and virtual visitors
   private function findMatches()
   {
       $physicalVisitors = VisitorP::orderBy('visitDate', 'desc')
           ->get()
           ->unique('docNumber');

       $virtualVisitors = VisitorV::orderBy('created_at', 'desc')
           ->get()
           ->unique('dni');

       foreach ($physicalVisitors as $pVisitor) {
           // Find the latest virtual visitor by document number (dni)
           $vVisitor = $virtualVisitors->firstWhere('dni', $pVisitor->docNumber);

           if ($vVisitor) {
               $visitData = [
                   'name' => $pVisitor->name,
                   'lastName' => $pVisitor->lastName,
                   'email' => $pVisitor->email,
                   'fk_visitorP_id' => $pVisitor->id_visitorP,
                   'fk_visitorV_id' => $vVisitor->id_visitor,
                   'fk_docType_id' => $pVisitor->fk_docType_id,
                   'docNumber' => $pVisitor->docNumber,
                   'phone' => $pVisitor->phone,
                   'visitDateP' => $pVisitor->visitDate ?? null,
                   'visitDateV' => $vVisitor->created_at ?? null,
                   'interestCareer' => $pVisitor->interestCareer,
                   'educationalInstitution' => $pVisitor->educationalInstitution,
                   'residentDistrict' => $pVisitor->residentDistrict,
                   'virtualVisit' => true,
               ];

               Visit::updateOrCreate(
                   ['docNumber' => $pVisitor->docNumber],
                   $visitData
               );
           }
       }
   }

   // Function to synchronize virtual visitors only
   private function syncVirtualVisitors()
   {
       $virtualVisitors = VisitorV::orderBy('created_at', 'desc')
           ->get()
           ->unique('dni');

       foreach ($virtualVisitors as $vVisitor) {
           
        // Check if this virtual visitor already exists in the visits table
           $existingVisit = Visit::where('docNumber', $vVisitor->dni)->first();

           if (!$existingVisit) {
               $visitData = [
                   'name' => $vVisitor->nombre,
                   'lastName' => $vVisitor->apellido,
                   'email' => $vVisitor->correo,
                   'fk_visitorP_id' => null,
                   'fk_visitorV_id' => $vVisitor->id_visitor,
                   'fk_docType_id' => null,
                   'docNumber' => $vVisitor->dni,
                   'phone' => $vVisitor->celular,
                   'visitDateP' => null, // No physical visit
                   'visitDateV' => $vVisitor->created_at, // Using created_at from visitorV
                   'interestCareer' => $vVisitor->carreraDeInteres,
                   'educationalInstitution' => null,
                   'residentDistrict' => null,
                   'virtualVisit' => true,
               ];

               Visit::create($visitData);
           }
       }
   }

   // Function to synchronize physical visitors only
   private function syncPhysicalVisitors()
   {
       $physicalVisitors = VisitorP::orderBy('visitDate', 'desc')
           ->get()
           ->unique('docNumber');

       foreach ($physicalVisitors as $pVisitor) {
          
        // Check if this physical visitor already exists in the visits table
           $existingVisit = Visit::where('docNumber', $pVisitor->docNumber)->first();

           if (!$existingVisit) {
               $visitData = [
                   'name' => $pVisitor->name,
                   'lastName' => $pVisitor->lastName,
                   'email' => $pVisitor->email,
                   'fk_visitorP_id' => $pVisitor->id_visitorP,
                   'fk_visitorV_id' => null,
                   'fk_docType_id' => $pVisitor->fk_docType_id,
                   'docNumber' => $pVisitor->docNumber,
                   'phone' => $pVisitor->phone,
                   'visitDateP' => $pVisitor->visitDate ?? null,
                   'visitDateV' => null, // No virtual visit
                   'interestCareer' => $pVisitor->interestCareer,
                   'educationalInstitution' => $pVisitor->educationalInstitution,
                   'residentDistrict' => $pVisitor->residentDistrict,
                   'virtualVisit' => false,
               ];

               Visit::create($visitData);
           }
       }
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(visit $visit)
    {
        //
    }
}
