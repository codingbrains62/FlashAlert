<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use App\Http\Helpers\Helper;
class FAToolsController extends Controller
{
    public function fa_closurereports() {

        $data['reportOptn'] = DB::table('reportoptions')->get();
        $orgID = '368';
        $suborgs = Helper::getSubOrg($orgID);
        
        $orgCatID = 1;
        $data['orgCatWithOrg'] = DB::table('orgs')
             ->join('orgcats', 'orgs.OrgCatID', '=', 'orgcats.id')
             ->select('orgs.*', 'orgcats.CatagoryName as orgcat_name')
             ->where('orgs.id', $orgID)
             ->first();
        $data['notifyData'] = DB::table('users')->where('OrgID', $orgID)->get();
        $data['childOrganizations'] = DB::table('orgs')->where('ParentOrgID', $data['orgCatWithOrg']->id)->get();
        $faMS = DB::table('publicusersubscription')->where('OrgID', $orgID)->get();
        $data['countfaMS'] = count($faMS);
        $busspartner = DB::table('businesspartners')->where('UserId', $data['notifyData'][0]->id)->get();
        $data['countBusspartner'] = count($busspartner);
        $regionWithCities = DB::table('orgregions')
             ->join('regions', 'orgregions.RegionID', '=', 'regions.id')
             ->join('defaultcities', 'defaultcities.OrgID', '=', 'orgregions.OrgID')
             ->join('regioncities', 'regions.id', '=', 'regioncities.RegionID')
             ->orderBy('regions.id')
             ->select('regioncities.*','regions.id as RegionID', 'regions.Description')
             ->distinct()
             ->get();
    
        $regionData = [];
    
        foreach ($regionWithCities as $item) {
            $region = $regionData[$item->RegionID] ?? null;
            if (!$region) {
                $region = new stdClass();
                $region->RegionID = $item->RegionID;
                $region->Description = $item->Description;
                $region->cities = [];
                $regionData[$item->RegionID] = $region;
            }
            $city = new stdClass();
            $city->CityName = $item->CityName;
            $city->CityRank = $item->CityRank; // Assuming 'CityRank' is a column in 'regioncities'
            $region->cities[] = $city;
        }
        // Sort cities within each region based on CityRank
        foreach ($regionData as $region) {
            usort($region->cities, function($a, $b) {
                return $a->CityRank - $b->CityRank;
            });
        }
    
        $data['regionWithCities'] = collect($regionData);
        return view('backend.postclosure', $data);
    }

    public function fa_closurereportsSubmission(Request $request) {
        $decodedRegion = $request->input('region');
        $decodedOrgCatSelect = $request->input('orgCatSelect');
        $selectedRegion = $decodedRegion ?? '0';
        $selectedorgcat = $decodedOrgCatSelect ?? '0';
        $firstselectbox =$request->input('firstselectbox') ?? '0';
        $companyname= $request->input('companyname') ?? '0';
        $data=DB::table('regions')->orderBy('Description', 'asc')->get();
        $response=DB::table('regions as r')
        ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
        ->leftjoin('orgs as o' , 'o.OrgCatID', '=', 'oc.id')
        ->join('users as u', 'o.id', '=', 'u.OrgID');
        $category='';
        if (!empty($firstselectbox)) {
            if ($firstselectbox === '1') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === '2') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === 'active') {
                $response->where('u.bActivated', '=', $firstselectbox);
            }
        }if (!empty($decodedRegion)) {
            $response->where('o.RegionID', '=', $decodedRegion);
            $category=DB::table('orgcats')->where('RegionID',$decodedRegion)->get();
        }
        if (!empty($decodedOrgCatSelect)) {
            $response->where('o.OrgCatID', $decodedOrgCatSelect);
            $category=DB::table('orgcats')->where('RegionID',$decodedRegion)->get();
        }
    
       $response = $response->orderBy('Description', 'asc')->orderBy('CatagoryName', 'asc')->paginate(25);
        return view('backend.closuresforSub-Org',compact('data','response','category','selectedRegion','selectedorgcat','firstselectbox'));
    }
    
}
