<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;
use Illuminate\Support\Facades\Mail;
use App\Mail\newsReleasePreviewEmail;

class NewsReleaseController extends Controller
{
    public function postNews(Request $request)
    {

        $url = $request->fullUrl();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        //dd($lastSegment);
        // Calculate the date 60 days ago from the current date
        $daysAgo = Carbon::now()->subDays(60);
        $decodedRegion = $request->input('region');
        $decodedOrgCatSelect = $request->input('orgCatSelect');
        $searchHeadline = $request->input('searchHeadline');
        $selectedRegion = $decodedRegion ?? '0';
        $selectedorgcat = $decodedOrgCatSelect ?? '0';
        $firstselectbox = $request->input('firstselectbox') ?? '0';
        $companyname = $request->input('companyname') ?? '0';
        $data = DB::table('regions')->orderBy('Description', 'asc')->get();

        // Check if region is selected and the checkbox is checked
        $isRegionSelected = !empty($decodedRegion);
        $showAllData = $isRegionSelected && $request->has('olderThan60');

        // Calculate the date based on the checkbox and region selection
        $daysAgo = $showAllData ? null : Carbon::now()->subDays(60);

        // Your existing DB query
        $response = DB::table('regions as r')
            ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
            ->leftjoin('orgs as o', 'o.OrgCatID', '=', 'oc.id')
            ->join('users as u', 'o.id', '=', 'u.OrgID')
            ->join('pressreleases as p', 'o.id', '=', 'p.OrgID')
            ->when($isRegionSelected, function ($query) use ($decodedRegion) {
                return $query->where('o.RegionID', '=', $decodedRegion);
            })
            ->when(!empty($decodedOrgCatSelect), function ($query) use ($decodedOrgCatSelect) {
                return $query->where('o.OrgCatID', '=', $decodedOrgCatSelect);
            })
            ->when($daysAgo !== null, function ($query) use ($daysAgo) {
                return $query->where('p.EffectiveDate', '>=', $daysAgo);
            })
            ->when(!empty($searchHeadline), function ($query) use ($searchHeadline) {
                return $query->where('p.Headline', 'LIKE', '%' . $searchHeadline . '%');
            })
            ->orderBy('r.Description', 'asc')
            ->orderBy('oc.CatagoryName', 'asc')
            ->orderBy('o.Name', 'asc')
            ->orderBy('p.EffectiveDate', 'desc');

        $category='';
        if (!empty($firstselectbox)) {
            if ($firstselectbox === '1') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === '2') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === 'active') {
                $response->where('u.bActivated', '=', $firstselectbox);
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
        // Preserve checkbox state after data retrieval
        $checkboxState = $showAllData ? '1' : '';

        return view('backend.post-news-release',compact('data','response','category','selectedRegion','selectedorgcat','firstselectbox', 'checkboxState', 'searchHeadline'));
}

// ------------------------News Release Archive ----------------------------------- //
public function newsReleaseArchive(Request $request)
    {

        $url = $request->fullUrl();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        //dd($lastSegment);
        // Calculate the date 60 days ago from the current date
        $daysAgo = Carbon::now()->subDays(60);
        $decodedRegion = $request->input('region');
        $decodedOrgCatSelect = $request->input('orgCatSelect');
        $searchHeadline = $request->input('searchHeadline');
        $selectedRegion = $decodedRegion ?? '0';
        $selectedorgcat = $decodedOrgCatSelect ?? '0';
        $firstselectbox = $request->input('firstselectbox') ?? '0';
        $companyname = $request->input('companyname') ?? '0';
        $data = DB::table('regions')->orderBy('Description', 'asc')->get();

        // Check if region is selected and the checkbox is checked
        $isRegionSelected = !empty($decodedRegion);
        $showAllData = $isRegionSelected && $request->has('olderThan60');

        // Calculate the date based on the checkbox and region selection
        $daysAgo = $showAllData ? null : Carbon::now()->subDays(60);

        // Your existing DB query
        $response = DB::table('regions as r')
            ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
            ->leftjoin('orgs as o', 'o.OrgCatID', '=', 'oc.id')
            ->join('users as u', 'o.id', '=', 'u.OrgID')
            ->join('pressreleases as p', 'o.id', '=', 'p.OrgID')
            ->when($isRegionSelected, function ($query) use ($decodedRegion) {
                return $query->where('o.RegionID', '=', $decodedRegion);
            })
            ->when(!empty($decodedOrgCatSelect), function ($query) use ($decodedOrgCatSelect) {
                return $query->where('o.OrgCatID', '=', $decodedOrgCatSelect);
            })
            ->when($daysAgo !== null, function ($query) use ($daysAgo) {
                return $query->where('p.EffectiveDate', '>=', $daysAgo);
            })
            ->when(!empty($searchHeadline), function ($query) use ($searchHeadline) {
                return $query->where('p.Headline', 'LIKE', '%' . $searchHeadline . '%');
            })
            ->orderBy('r.Description', 'asc')
            ->orderBy('oc.CatagoryName', 'asc')
            ->orderBy('o.Name', 'asc')
            ->orderBy('p.EffectiveDate', 'desc');

        $category='';
        if (!empty($firstselectbox)) {
            if ($firstselectbox === '1') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === '2') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === 'active') {
                $response->where('u.bActivated', '=', $firstselectbox);
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
        // Preserve checkbox state after data retrieval
        $checkboxState = $showAllData ? '1' : '';
        return view('backend.newsReleaseArchives',compact('data','response','category','selectedRegion','selectedorgcat','firstselectbox', 'checkboxState', 'searchHeadline'));
}
// ------------------------News Release Archive ----------------------------------- //
    public function newsRelease(Request $request)
    {
        $data['selectedregion'] = $request->region;
        $data['selectedorgcat'] = $request->orgcat;
        $data['selectedorg'] = $request->org;
        if(!empty($request->org)){
            $data['orgCatWithOrg'] = DB::table('orgs')
             ->join('orgcats', 'orgs.OrgCatID', '=', 'orgcats.id')
             ->select('orgs.*', 'orgcats.CatagoryName as orgcat_name')
             ->where('orgs.id', $request->org)
             ->first();
        $data['childOrganizations'] = DB::table('orgs')->where('ParentOrgID', $data['orgCatWithOrg']->id)->get();
         $data['reportOptn'] = DB::table('reportoptions')->get();
         $data['notifyData'] = DB::table('users')->where('OrgID', $request->org)->get();
         $faMS = DB::table('publicusersubscription')->where('OrgID', $request->org)->get();
         $data['countfaMS'] = count($faMS);
         $busspartner = DB::table('businesspartners')->where('UserId', $data['notifyData'][0]->id)->get();

         $data['busspartnergroup'] = DB::table('businesspartners')
        ->join('businesspartnergroups', 'businesspartners.GroupID', '=', 'businesspartnergroups.id')
         ->where('businesspartners.UserId', $data['notifyData'][0]->id)
         ->select('businesspartners.*', 'businesspartnergroups.*') // You can select specific columns if needed
         ->get();
        //  dd($busspartner);
         $data['countBusspartner'] = count($busspartner);
        }
        $data['region'] = DB::table('regions')->get();
        $data['orgcat'] = [];
        $data['org'] = [];
        $data['regionWithCities'] = [];

        if (!empty($request->region)) {
            $data['orgcat'] = DB::table('orgcats')->where('RegionID', $request->region)->get();
        }

        if (!empty($request->orgcat) && !empty($request->region)) {
            $data['org'] = DB::table('orgs')
                ->where('RegionID', $request->region)
                ->where('OrgCatID', $request->orgcat)
                ->get();
        }
        if ($request->org) {
            $regionWithCities1 = DB::table('regioncities as rc')
                ->join('regions as r', 'rc.RegionID', '=', 'r.id')
                ->where('rc.RegionID', $request->region)
                ->orderBy('rc.CityRank', 'asc')
                ->select('rc.*', 'r.Description as Description')
                ->get();
                
            $regionWithCities2 = DB::table('orgregions')
                ->join('regions', 'orgregions.RegionID', '=', 'regions.id')
                ->join('defaultcities', 'defaultcities.OrgID', '=', 'orgregions.OrgID')
                ->join('regioncities', 'regions.id', '=', 'regioncities.RegionID')
                ->where('orgregions.OrgID', $request->org)
                ->orderBy('regions.id')
                ->select('regioncities.*', 'regions.id as RegionID', 'regions.Description')
                ->distinct()
                ->get();
            $regionWithCities = $regionWithCities1->concat($regionWithCities2);
            $regionData = [];
                foreach ($regionWithCities as $item) {
                    $region = $regionData[$item->RegionID] ?? null;
                    if (!$region) {
                        $region = new \stdClass();
                        $region->RegionID = $item->RegionID;
                        $region->Description = $item->Description;
                        $region->cities = [];
                        $regionData[$item->RegionID] = $region;
                    }
                    $city = new \stdClass();
                    $city->CityName = $item->CityName;
                    $city->CityRank = $item->CityRank;
                    $city->isDefault = DB::table('defaultcities')
                        ->where('OrgID', $request->org)
                        ->where('CityID', $item->cid)
                        ->exists();
                    $region->cities[] = $city;
                }

                foreach ($regionData as $region) {
                    usort($region->cities, function($a, $b) {
                        return $a->CityRank - $b->CityRank;
                    });
                }
                $data['regionWithCities'] = collect($regionData);
        }
        return view('backend.news-release', $data);
    }

    public function postnewsrelMail(Request $request){
        $selectedEmail = $request->email;
        $headline = $request->headline;
        $postText = $request->post_text;
        $contactInfo = $request->contact_info;
        $orgData = DB::table('orgs')->where('id', $request->orgDropdown)->get();
        $orgDropdown = $orgData[0]->Name;
        Mail::to($selectedEmail)->send(new newsReleasePreviewEmail($headline, $postText, $contactInfo, $orgDropdown)); 
         return "Preview emailed to: $selectedEmail";
    }
         
}
