<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantsController extends Controller
{
    public function participantslist(Request $request){
        $id = $request->input('participants');

        // $data['org'] = DB::table('orgs')->where('RegionID', $id)->first();
        // $data['users'] = DB::table('users')->where('OrgID', $data['org']->id)->get();
        $data['region'] =DB::table('regions')->where('id', $id)->first();

        // Fetch unique organization categories (orgcat) based on the provided $id
        $data['orgcats'] = DB::table('orgcats')
            ->distinct()
            ->select('orgcats.CatagoryName as orgcatname')
            ->join('orgs', 'orgs.OrgCatID', '=', 'orgcats.id')
            ->join('users', 'orgs.id', '=', 'users.OrgID')
            ->where('orgcats.RegionID', $id) // Filter by RegionID
            ->get();
        
        // Fetch users and organizations based on the provided $id
        $data['users'] = DB::table('regions as r')
            ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
            ->leftjoin('orgs as o', 'o.OrgCatID', '=', 'oc.id')
            ->join('users as u', 'o.id', '=', 'u.OrgID')
            ->where('r.id', $id) // Filter by RegionID
            ->get([
                'o.id as org_id',
                'o.Name as name',
                'o.RegionID as regionId',
                'oc.CatagoryName as orgcatname',
                'u.id as user_id',
                'u.URL as url',
                'u.ZipCode as zipcode',
                // Add other columns you want to retrieve from both tables
            ]);
        
        // echo"<pre>";
        // print_r($data['users']);
        // die;

        return view('frontend.participants', $data);
    }
    public function feestructure(Request $request){
        $id = $request->id;
        //$id = $request->input('feeschedule');
        //dd($id);
        $data['region'] = DB::table('regions')->where('id', $id)->first();
        return view('frontend.feestructure', $data);
    }
}
