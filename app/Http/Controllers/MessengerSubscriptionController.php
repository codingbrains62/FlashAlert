<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessengerSubscriptionController extends Controller
{
    public function loginme(){
        return view('frontend.messengerLogin');
    }
    public function lostpass(){
        return view('frontend.msg_forgetPass');
    }
    public function attach_app(){
        return view('frontend.attachAppTut');
    }
    public function frontend_region(Request $request){
        $data['regionlist'] = DB::table('regions')->get();
        if ($request->has('search')) {
            $regionID = $request->input('RegionID');
            $organizationName = $request->input('organizationName');
            $data['orgName'] = $request->input('organizationName');
            // Construct the query for searching organizations based on the selected region and organization name
             $query = DB::table('orgs')
             ->join('regions', 'orgs.RegionID', '=', 'regions.id')// Add a join with the 'regions' table
             ->join('users', 'orgs.id', '=', 'users.OrgID') // Add a join with the 'users' table
             ->select('orgs.*', 'regions.Description as regionDescription', 'users.URLName as URLName');
            if ($regionID != 0) {
                $query->where('regions.id', $regionID);
            }
            if (!empty($organizationName)) {
                $query->where('orgs.Name', 'like', '%' . $organizationName . '%');
            }
        //Execute the query and fetch search results
         $data['searchResults'] = $query->get();
            // echo"<pre>";
            // print_r($data['searchResults']);
            // die;
        }
        return view('frontend.regionsForMsgLogin', $data);
    }

    public function subscribe(Request $request)
    {

          
            $emergencyAlerts = $request->has('EmergSub') ? 1 : 0;
            $newsReleases = $request->has('NewsSub') ? 1 : 0;
            $request->validate([
                'EmailAddress' => 'required|email',
            ]);
            $data=[
            'EmailAddress' => $request->input('EmailAddress'),
            'ResetCode' => 'abcdssdd', // 1 if checked, 0 if not
            'ResetDate' => '2023-10-10 11:55:55',
            'NPW' => 'test',
            'LastLogin' => '2023-10-10 11:55:55',
            'LastMailTest' => '2023-10-10 11:55:55',
            'DateCreated' => '2023-10-10',
            ];
             $lastid=  DB::table('publicuser')->insertGetId($data);
        
            //  dd($lastid);
        
           
        DB::table('publicusersubscription')->insert([
            'OrgID' =>$request->OrgID,
            'PublicUserID' =>$lastid,
            'EmergSub' => $emergencyAlerts, // 1 if checked, 0 if not
            'NewsSub' => $newsReleases, // 1 if checked, 0 if not
        ]);
        // Redirect or return a response as needed
        // return redirect()->route('signup')->with(['success' => 'Subscription successful.', 'data' => $data]);
        return view('frontend.subSignup', ['data' => $data]);
    }

    // public function signup(Request $request) {
    //     $data['data'] = $request->session()->get('data');
    //     return view('frontend.subSignup', $data);
    // }
    
}
