<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class PublicSubscriberController extends Controller
{
    public function SubscriberList(Request $request) {
        // Decoding the input parameters
        $decodedRegion = base64_decode($request->input('region'));
        $decodedOrgCatSelect = base64_decode($request->input('orgCatSelect'));

        // Setting default values if the decoded values are empty
        $selectedRegion = $decodedRegion ?? '0';
        $selectedorgcat = $decodedOrgCatSelect ?? '0';

        // Retrieving regions data
        $data = DB::table('regions')->orderBy('Description', 'asc')->get();

        // Query to retrieve subscriber list data with joins and ordering
        $response = DB::table('regions as r')
            ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
            ->leftjoin('orgs as o' , 'o.OrgCatID', '=', 'oc.id')
            ->join('users as u', 'o.id', '=', 'u.OrgID')
            ->orderBy('Description', 'asc')
            ->orderBy('CatagoryName', 'asc');

        // Applying conditions based on the decoded parameters
        
        if ($decodedRegion != '' && $decodedOrgCatSelect == '') {
            // Applying region filter
            $response = $response->where('o.RegionID', $decodedRegion)->paginate(25);
            // Retrieving categories for the selected region
            $category = DB::table('orgcats')->where('RegionID', $decodedRegion)->get();
        } else if ($decodedOrgCatSelect !='' &&  $decodedRegion != '') {
            // Applying region and category filters
            $response = $response->where('o.RegionID', $decodedRegion)
                ->where('o.OrgCatID', $decodedOrgCatSelect)
                ->paginate(25);
            // Retrieving categories for the selected region
            $category = DB::table('orgcats')->where('RegionID', $decodedRegion)->get();
        } else {
            // No filters applied
            $response = $response->paginate(25);
            $category = '';
        }
        // Counting the number of publicusersubscription records for each org
        $firstIdCounts = [];
        foreach ($response as $orgData) {
            $orgId = $orgData->OrgID;
            $count = DB::table('publicusersubscription')->where('OrgID', $orgId)->count();
            $firstIdCounts[$orgId] = $count;
        }
        // Returning the view with necessary data
        return view('backend.P_SubscriberList', compact('data','response','category','selectedRegion','selectedorgcat','firstIdCounts'));
    }

        public function SubscriberEmailList($id)
            {
            // Retrieve the user IDs from the PublicUserSubscription table
            $orgWiseSub = DB::table('publicusersubscription')->where('OrgID', base64_decode($id))->pluck('PublicUserID')->toArray();
            // Retrieve the email addresses from the PublicUser table with pagination
            $emailsQuery = DB::table('publicuseremail')->whereIn('PublicUserID', $orgWiseSub);
            // $emailsQuery = DB::table('publicuser')->whereIn('id', $orgWiseSub);
            $data['emails'] = $emailsQuery->paginate(50); // Change 10 to the desired number of items per page
            $data['catName'] = DB::table('orgs')->where('id', base64_decode($id))->get()->toArray();
            return view('backend.P_SubemailList', $data);
            }

        public function unsubscribeAll($id)
            {
                DB::table('publicusersubscription')->where('OrgID', $id)->delete();
            return redirect()->back()->with('success', 'Unsubscribed all subscriptions successfully.');
            }
        public function PSubCR()
            {
                $data['orgSubscription'] = DB::table('publicusersubscription')
                ->join('orgs', 'publicusersubscription.OrgID', '=', 'orgs.id')
                ->select('publicusersubscription.OrgID', 'orgs.Name', DB::raw('count(publicusersubscription.PublicUserID) as count'))
                ->groupBy('publicusersubscription.OrgID', 'orgs.Name')
                ->orderBy('orgs.Name', 'asc')
                ->get();
            return view('backend.PSub_CReport',$data);
            }

        public function PunsubList()
            {
                $data['emails'] = DB::table('publicuser')
                ->leftJoin('publicusersubscription', 'publicuser.id', '=', 'publicusersubscription.PublicUserID')
                ->whereNull('publicusersubscription.PublicUserID')
                ->orderBy('publicuser.EmailAddress', 'asc')
                ->paginate(100); // Specify the number of emails per page
            return view('backend.UnSubList', $data);
            }
        //___________________Purge Subscribers ______________________________//
        public function purgeSubs(Request $request)
            {
                $data['publicUsers21'] ='';
             if(!empty($request->input('SearchDate'))){
                $searchDate = $request->input('SearchDate');
                $formattedSearchDate = Carbon::createFromFormat('Y-m-d',$searchDate);
                $data['publicUsers21'] = DB::table('publicuser')
                 ->join('publicusersubscription', 'publicuser.id', '=', 'publicusersubscription.PublicUserID')
                 ->join('orgs', 'publicusersubscription.OrgID', '=', 'orgs.id')
                 ->join('publicuseremail', 'publicuser.id', '=', 'publicuseremail.PublicUserID')
                 ->where('publicuser.LastLogin', '<=', $formattedSearchDate)
                 ->orderBy('publicuser.LastLogin', 'desc')
                 ->select('publicuser.EmailAddress', 'orgs.name as OrgName', 'publicuser.LastLogin', 'publicuseremail.Validated', 'publicuseremail.ValidateCode')
                 ->take(10000)
                 ->get();
                 $data['count1'] = DB::table('publicuser')
                  ->where('LastLogin', '<=', $formattedSearchDate)
                  ->count();
                  $data['emailCount'] = DB::table('publicuseremail')
                  ->join('publicuser', 'publicuser.id', '=', 'publicuseremail.PublicUserID')
                  ->where('publicuser.LastLogin', '<=', $formattedSearchDate)
                  ->count();
             }
            // Retrieve PublicUserID with validated = 0
            $publicUserID = DB::table('publicuseremail')->where('validated', 0)->pluck('PublicUserID');
                // Fetch all relevant data with joins and conditions
             $data['result'] = DB::table('publicuseremail')
            ->whereIn('publicuseremail.PublicUserID', $publicUserID)
            ->leftJoin('publicusersubscription', 'publicuseremail.PublicUserID', '=', 'publicusersubscription.PublicUserID')
            ->leftJoin('orgs', 'publicusersubscription.OrgID', '=', 'orgs.id')
            ->select('publicuseremail.PublicUserID', 'publicuseremail.UserEmailAddress', 'publicuseremail.Validated', 'publicuseremail.IsPrimary', 'orgs.name')
            ->where(function ($query) {
                $query->where('publicuseremail.IsPrimary', 1)
                    ->orWhere(function ($query) {
                        $query->where('publicuseremail.IsPrimary', 0)
                            ->whereNotNull('orgs.id');
                    });
                })
            ->get();
            // Collect unique rows and count the total number of rows
            $uniqueRows = collect([]);
            $data['count'] = $data['result']->count();
            // Iterate over the result rows
            foreach ($data['result'] as $row) {
                $existingRow = $uniqueRows->where('PublicUserID', $row->PublicUserID)->first();
                if ($existingRow) {
                    // Check if org name already exists, and add if it doesn't
                    if (!$existingRow->orgs->contains('name', $row->name)) {
                        $existingRow->orgs->push((object)['name' => $row->name]);
                    }
                } else {
                // Create a new row with the first org name
                $newRow = (object)[
                    'PublicUserID' => $row->PublicUserID,
                    'UserEmailAddress' => $row->UserEmailAddress,
                    'Validated' => $row->Validated,
                    'IsPrimary' => $row->IsPrimary,
                    'orgs' => collect([(object)['name' => $row->name]])
                ];
                $uniqueRows->push($newRow);
                }
            }
            // Store the unique rows in the data array
             $data['uniqueRows'] = $uniqueRows;
            // Pass the data to the view and render it
            return view('backend.purgeSubscribers', $data);
            }

            //“Purge All Unvalidated emails” and “Purge All Accounts with Invalid primary email address”
            public function purgeUnvalidated()
            {
                // Delete unvalidated email addresses
                DB::table('publicuseremail')->where('Validated', 0)->delete();
                
                // Redirect back to the page or show a success message
                return back()->with('success', 'Unvalidated emails have been purged.');
            }
            
            public function purgeInvalidPrimaryEmails()
            {
                // Delete accounts with invalid primary email addresses
                DB::table('publicuseremail')->where('IsPrimary', 1)->where('Validated', 0)->delete();
                
                // Redirect back to the page or show a success message
                return back()->with('success', 'Accounts with invalid primary email addresses have been purged.');
            }
            //“Purge All Unvalidated emails” and “Purge All Accounts with Invalid primary email address”

       //___________________Email change tool______________________________//
       public function changeEmailT(){
        return view('backend.emailChangTool');
        }
}
