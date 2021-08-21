<?php

namespace App\Exports;

use App\Lead;
use App\LeadProject;
use App\Project;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lead::all();
        // $lead_project = LeadProject::select('project_id','lead_id')->get();
        // foreach ($lead_project as $item) {
        //     $item->project_id=str_ireplace("?",'',$item->lead->name).' '.explode(" ",$item->project->name)[0];
        //     $item->lead_id='0'.optional($item->lead)->phone;

        //   }
        // return $lead_project;



        // $lead_project= LeadProject::first();

        //
        // $lead_name = LeadProject::all();


        // return  $project_name[0];


    }
}
