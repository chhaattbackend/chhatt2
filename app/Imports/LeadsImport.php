<?php

namespace App\Imports;

use App\Lead;
use App\LeadProject;
use App\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row['project']);
        // $leadsource =null;
        // $leadsource =
        // $fuzoolnames=array('Islamabad','Rent','UAE','Islamabad(Karachi)','Islamabad-Interest',);
        // $replace_by=array('','','','','');
        // $project_name=trim(str_ireplace($fuzoolnames,$replace_by,$row['project']));
        $project_name = explode(" ",$row['project']);


        $project = Project::where('name', 'like', '%' .$project_name[0]. '%')->first();


        $lead = Lead::create([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'     => $row['phone'],
            'leadsource'    => $row['project'],
            'created_at'    => $row['created_at'],
            ]);

            LeadProject::create([
                'project_id'=>$project->id,
                'lead_id'=>$lead->id
            ]);

                
            return $lead;





    }
}
