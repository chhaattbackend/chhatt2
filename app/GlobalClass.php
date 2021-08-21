<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class GlobalClass extends Model
{
    public $base_image_url='https://chhatt.s3.ap-south-1.amazonaws.com/properties/';
    public $user_image_url='https://chhatt.s3.ap-south-1.amazonaws.com/users/';
    public $columnName;
    public $search;
    public $message="";

    public function sendLeadSms($name,$email,$phone,$description,$area,$budget,$lead_type,$family_members,$property_type,$agentphone,$link,$source){
        if($source=='web'){
            $smsMessage = "$this->message\n\n" .
            "Lead Name: $name\n" .
            "Phone Number: 03... (Please sign in the Chhatt app to view the complete details)\n" .
            "Email: $email\n" .
            "Description: $description\n" .
            "$link\n" .
            "https://play.google.com/store/apps/details?id=com.res.chhatt&hl=en";
        }
        else{
            $smsMessage = "$this->message\n\n" .
            "Lead Name: $name\n" .
            "Phone Number: 03... (Please sign in the Chhatt app to view the complete details)\n" .
            "Description: $description\n" .
            "Area: $area\n" .
            "Budget: $budget\n" .
            "Lead Type: $lead_type\n" .
            "Family Members: $family_members\n" .
            "Property Type: $property_type\n\n" .
            "https://play.google.com/store/apps/details?id=com.res.chhatt&hl=en";

        }

        $encodedSMS = urlencode($smsMessage);

        $smsURL = "http://api.bizsms.pk/api-send-branded-sms.aspx?username=chhatt@bizsms.pk&pass=ch3att99&text=$encodedSMS&masking=CHHATT&destinationnum=92$agentphone&language=English%27";
        $client = new Client();
        $res = $client->get($smsURL);
        echo $res->getStatusCode(); // 200
        echo $res->getBody();
    }

    public function convert_rupee($amount){
        $length = strlen($amount);
        if($length>=6 && $length <=7){
            return round($amount/100000,2).' Lacs';
        }else if($length>=8 && $length <=9){
            return round($amount/10000000,2).' Cr.';
        }else if($length>=4 && $length <=5){
            return round($amount/1000,2).' K';
        }else{ return 0;}
    }

    public function searchRelation($variable,$relationName,$columnName,$search){
        $this->columnName=$columnName;
        $variable=$variable->whereHas($relationName, function ($query) use ($search) {
            $query->where($this->columnName, $search);
        });

        return $variable;
    }

    public function searchRelationIn($variable,$relationName,$columnName,$search){
        $this->columnName=$columnName;
        $variable=$variable->whereHas($relationName, function ($query) use ($search) {
            $query->whereIn($this->columnName, $search);
        });

        return $variable;
    }

    public function searchRelationLike($variable,$relationName,$columnName,$search){
        $this->columnName=$columnName;
        $this->search=$search;

        $variable=$variable->whereHas($relationName, function ($query) use ($search) {
            $query->where($this->columnName, 'like', '%' . $this->search . '%');
        });

        return $variable;
    }

    public function searchRelationLike2($variable,$relationName,$columnName,$search){
        $this->columnName=$columnName;
        $this->search=$search;

        $variable=$variable->orWhereHas($relationName, function ($query) use ($search) {
            $query->where($this->columnName, 'like', '%' . $this->search . '%');
        });

        return $variable;
    }

    public function storeS3($file,$path){
            $exe = $file->getClientOriginalName();
            $filename = time() . '-' . $exe;
            $file->storeAs($path,$filename,'s3');

            return $filename;
    }

    public function storeMultipleS3($files,$path,$property_id){
        foreach ($files as $key=>$file) {
            $exe = $file->getClientOriginalName();
            $filename = time() . '-' . $exe;
            $file->storeAs($path,$filename,'s3');

            PropertyImage::create([
                'property_id'=>$property_id,
                'name'=>$filename,
                'sort_order'=>$key
            ]);
        }
    }

    public function createAgencyWithUser($agency_name,$name,$mobile,$phone,$area_one_id,$area_two_id,$area_three_id,$agency_address){
        $agency_user = User::create([
            'name' => $name,
            'mobile' => $mobile,
            'phone' => $phone,
            'email' => str_ireplace(' ', '-', $agency_name . '@chhatt.com'),
            'address'=>$agency_address,
            'password'=>Hash::make('password'),
            'role_id'=>2,
            'type'=>'property'

        ]);
        $agency=Agency::create([
            'name' => $agency_name,
            'area_one_id' => $area_one_id,
            'area_two_id' => $area_two_id,
            'area_three_id' => $area_three_id,
            'user_id' => $agency_user->id

        ]);

        return $agency->id;
    }
}
