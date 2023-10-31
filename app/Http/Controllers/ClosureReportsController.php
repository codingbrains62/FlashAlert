<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClosureMail;
use stdClass;

class ClosureReportsController extends Controller
{
        public function closurereports(Request $request){
            $decodedRegion = $request->input('region');
            $decodedOrgCatSelect = $request->input('orgCatSelect');
            $selectedRegion = $decodedRegion ?? '0';
            $selectedorgcat = $decodedOrgCatSelect ?? '0';
            $firstselectbox =$request->input('firstselectbox') ?? '0';
            $companyname= $request->input('companyname') ?? '0';
            $data=DB::table('regions')->orderBy('Description', 'asc')->get();
            $response = DB::table('regions as r')
            ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
            ->leftjoin('orgs as o', 'o.OrgCatID', '=', 'oc.id')
            ->join('users as u', 'o.id', '=', 'u.OrgID')
            ->leftJoin('reports as rep', function ($join) {
                    $currentDate = now();
                    $join->on('o.id', '=', 'rep.OrgID')
                    ->where('rep.ClosureDate', '>=', DB::raw('CURDATE()'));
            })
            ->select(
                'r.Description',
                'oc.CatagoryName',
                'o.Name',
                'u.OrgID',
                DB::raw('IF(rep.ClosureDate >= CURDATE() AND rep.Note IS NOT NULL, rep.Note, "") as report_notes'),
                DB::raw('IF(rep.ClosureDate >= CURDATE(), DATE_FORMAT(rep.EffectiveDate, "%h:%i %p, %m/%d"), "") as report_effective_date')
            )->where('o.RootOrgID','=',0);
            $category='';
            if (!empty($firstselectbox)) {
             if ($firstselectbox === 'active') {
                  $response->where('rep.ClosureDate', '>=', DB::raw('CURDATE()'));
                } elseif ($firstselectbox === '1' || $firstselectbox === '2') {
                    $response->where('u.Tier', '=', $firstselectbox);
                 }
           }
            if (!empty($decodedRegion)) {
                    $response->where('o.RegionID', '=', $decodedRegion);
                    $category=DB::table('orgcats')->where('RegionID',$decodedRegion)->get();
            }
            if (!empty($decodedOrgCatSelect)) {
                $response->where('o.OrgCatID', $decodedOrgCatSelect);
                $category=DB::table('orgcats')->where('RegionID',$decodedRegion)->get();
            }
            
            $response = $response->orderBy('Description', 'asc')->orderBy('CatagoryName', 'asc')->paginate(25);
            return view('backend.closureReport',compact('data','response','category','selectedRegion','selectedorgcat','firstselectbox'));
        }
            public function closuresendmess($orgId){
                $id=base64_decode($orgId);
                $data['userMessg'] =DB::table('users')->where('OrgID',$id)->get()->toArray();
                $data['reportmass'] = DB::table('orgs')
                    ->leftJoin('reports', 'orgs.id', '=', 'reports.OrgID')
                    ->where('orgs.id', $id)
                    ->select('orgs.id', 'orgs.name', 'reports.*')
                    ->orderBy('reports.ClosureDate', 'desc')
                    ->limit(1)
                    ->get();
                return view('backend.closure-EmailMessage', $data);
            }
            public function sendclosuresmess(Request $request){
                $senderemail = $request->senderemail;
                $primaryworkemail = $request->primaryworkemail;
                $primaryhomeemail = $request->primaryhomeemail;
                $secondaryworkemail = $request->secondaryworkemail;
                $secondaryhomeemail = $request->secondaryhomeemail;
                $csubject = $request->csubject;
                $message = $request->message;
                $primaryname = $request->primaryname;
                $secondaryName = $request->secondaryName;
                
                if ($primaryworkemail != null) {
                    Mail::to($primaryworkemail)->send(new ClosureMail($senderemail, $csubject, $message, $primaryname));
                }
                if ($primaryhomeemail != null) {
                    Mail::to($primaryhomeemail)->send(new ClosureMail($senderemail, $csubject, $message, $primaryname));
                }
                if ($secondaryworkemail != null) {
                    Mail::to($secondaryworkemail)->send(new ClosureMail($senderemail, $csubject, $message, $secondaryName));
                }
                if ($secondaryhomeemail != null) {
                    Mail::to($secondaryhomeemail)->send(new ClosureMail($senderemail, $csubject, $message, $secondaryName));
                }
                return back()->with('success', '');
             }
        public function closureEmergMess($orgID)
        {
         $orgID = base64_decode($orgID);
         $data['orgCatWithOrg'] = DB::table('orgs')
             ->join('orgcats', 'orgs.OrgCatID', '=', 'orgcats.id')
             ->select('orgs.*', 'orgcats.CatagoryName as orgcat_name')
             ->where('orgs.id', $orgID)
             ->first();
             $data['childOrganizations'] = DB::table('orgs')->where('ParentOrgID', $data['orgCatWithOrg']->id)->get();
         $data['reportOptn'] = DB::table('reportoptions')->get();
         $data['notifyData'] = DB::table('users')->where('OrgID', $orgID)->get();
         //dd($data['orgCatWithOrg']);
         $faMS = DB::table('publicusersubscription')->where('OrgID', $orgID)->get();
         $data['countfaMS'] = count($faMS);
         $busspartner = DB::table('businesspartners')->where('UserId', $data['notifyData'][0]->id)->get();
         $data['busspartnergroup'] = DB::table('businesspartners')
        ->join('businesspartnergroups', 'businesspartners.GroupID', '=', 'businesspartnergroups.id')
         ->where('businesspartners.UserId', $data['notifyData'][0]->id)
         ->select('businesspartners.*', 'businesspartnergroups.*') // You can select specific columns if needed
         ->get();
         $data['countBusspartner'] = count($busspartner);
         $res= DB::table('orgs')->where('id', $orgID) ->get();
         $regionWithCities1 = DB::table('regioncities as rc')
         ->join('regions as r', 'rc.RegionID', '=', 'r.id')
         ->where('rc.RegionID', $res[0]->RegionID)
         ->orderBy('rc.CityRank', 'asc')
         ->select('rc.*', 'r.Description as Description')
         ->get();
         $regionWithCities2 = DB::table('orgregions')
             ->join('regions', 'orgregions.RegionID', '=', 'regions.id')
             ->join('defaultcities', 'defaultcities.OrgID', '=', 'orgregions.OrgID')
             ->join('regioncities', 'regions.id', '=', 'regioncities.RegionID')
             ->where('orgregions.OrgID', $orgID)
             ->orderBy('regions.id')
             ->select('regioncities.*','regions.id as RegionID', 'regions.Description')
             ->distinct()
             ->get();
             $regionWithCities = $regionWithCities1->concat($regionWithCities2);
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
             $city->CityRank = $item->CityRank; // Store CityRank for each city
             $city->isDefault = DB::table('defaultcities')
                 ->where('OrgID', $orgID)
                 ->where('CityID', $item->cid)
                 ->exists();
             $region->cities[] = $city;
         }
         // Sort cities within each region based on CityRank
        foreach ($regionData as $region) {
            usort($region->cities, function($a, $b) {
                return $a->CityRank - $b->CityRank;
            });
        }
         $data['regionWithCities'] = collect($regionData);
     
         return view('backend.closure-EmergMess', $data);
     }

    }