<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Orgcat;
use App\Models\Org;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Session;
use App\Http\Helpers\Helper;
use App\Mail\ContactUs;
use App\Mail\AutoReply;

// For Dynamically Region menu
class RegionController extends Controller
{
        public function MenuSection()
        {
                //$regionlist['region']= Region::all()->toArray();
                $regionlist['postnewsregion']= DB::table('post_news_region')->get();
                // echo"<pre>";
                // print_r($regionlist['postnewsregion']);
                // die;
                return view('frontend.index',$regionlist);
        }
        // For Dynamically Region menu
        public function OrgCat(Request $request)
        {
                $data = Helper::MenuHeaderData();
                $data['region'] = Region::where('Description', 'LIKE', '%' . $request->regionName . '%')->get()->toArray();  //Get region data
                $regionId = $data['region'][0]['id'];            // Get Region Id
                $orgcatlist = Orgcat::where('RegionId', $regionId)->orderBy('Rank', 'ASC')->get()->toArray();          //Get orgcat list data through region id
                //Get orgcat and org count by region and orgcat id
                $arr2 = []; // Initialize $arr2 as an empty array
                foreach ($orgcatlist as $orgcat) {
                        $orglist = Org::where('OrgCatId', $orgcat['id'])->get()->toArray();
                        $orgcount = count($orglist);
                        $arr = [
                                'id' => $orgcat['id'],
                                'CatagoryName' => $orgcat['CatagoryName'],
                                'orgCount' => $orgcount
                        ];
                        $arr2[] = $arr;
                }
                //Get orgcat and org count by region and orgcat id
                $data['orgcat'] = $arr2;
                return view('frontend.region', compact('data'));
        }
        // search org by input
        // public function searchByOrgName(Request $request)
        // {
        //         $searchTerm = $request->orgName;   // Get the input value
        //         // echo $searchTerm;
        //         // die;
        //         $orgNameList = Org::where('Name', 'LIKE', '%' . $searchTerm . '%') // Search for org Name containing the orgName input value
        //                 ->get()->toArray(); //Get org list data through
        //         $arrOrgName = '';
        //         foreach ($orgNameList as $orgname) {
        //                 $orgName =  $orgname['Name'];
        //                 // print_r($orgname);
        //                 // die;
        //                 $orgNameID = $orgname['id'];
        //                 $userData=DB::table('users')->where('OrgID',$orgNameID)->get()->toArray();
        //                 $output = $userData[0]->URLName;
        //                 //$output = $this->getFirstLetters($orgname);
        //                 //$arrOrgName .= '<a href="' . url('id/' . urlencode($output)) . '">' . $orgname . '<span></span></a>';
        //                 $arrOrgName .= '<a href="' . url('id/' . $output) . '">' . $orgName . '<span></span></a>';
        //                 $count = count(explode('</a>', $arrOrgName)) - 1;
        //         }
        //         $result = [
        //                 'count' => $count,
        //                 'arrOrgName' => $arrOrgName
        //         ];
        //         return $result;
        // }

        public function searchByOrgName(Request $request)
        {
        $searchTerm = $request->orgName;

        // Search for organizations that match the search term
        $orgNameList = Org::where('Name', 'LIKE', '%' . $searchTerm . '%')->get();

        $arrOrgName = '';
        $count = 0;

        foreach ($orgNameList as $org) {
                $orgName = $org->Name;
                $orgNameID = $org->id;
                // Retrieve user data for the organization
                $userData = DB::table('users')->where('OrgID', $orgNameID)->first();
                if ($userData) {
                $output = $userData->URLName;
                $arrOrgName .= '<a href="' . url('id/' . $output) . '">' . $orgName . '<span></span></a>';
                $count++;
                }
        }
        $result = [
                'count' => $count,
                'arrOrgName' => $arrOrgName,
        ];
        if ($count === 0) {
                // Handle case when no organizations are found
                $result['arrOrgName'] = '<p>No organizations found.</p>';
        }
        return $result;
        }
        // search org by input
        public function orgList(Request $request)
        {
                $orgCatId = $request->orgCatId;
                // Retrieve organization data by orgCat ID
                $orgsName = Org::where('OrgCatID', $orgCatId)->get()->toArray();
                $OrgNameList = '';
                foreach ($orgsName as $orgname) {
                        $orgNameID = $orgname['id'];
                        $userData=DB::table('users')->where('OrgID',$orgNameID)->get()->toArray();
                        if (!empty($userData)) {
                        $output = $userData[0]->URLName;
                        $orgname =  $orgname['Name'];
                        $OrgNameList .= '<a href="' . url('id/' . $output) . '">' . $orgname . '<span></span></a>';
                        //$OrgNameList .= '<a href="' . url('id/' . urlencode($output)) . '">' . $orgname . '<span></span></a>';
                }
        }
                 //echo $OrgNameList;
                return $OrgNameList;
        }
        public function EmergencyMess($id)
        {      
                $data1=DB::table('users')->where('URLName',$id)->get();
                $data=DB::table('orgs')->where('id',$data1[0]->OrgID)->get();  
                return view('frontend.emergencymess', compact('data','data1'));
        }
        public function EmergencyMess1($id)
        {      
                $data1=DB::table('users')->where('OrgID',$id)->get();
                $data=DB::table('orgs')->where('id',$data1[0]->OrgID)->get();
                $logo=DB::table('mediafile')->where('id', $data[0]->LogoMediaFileID)->get();  
                return view('frontend.emergencymess', compact('data','data1','logo'));
        }
        //after click Post Your News page Dropdown
        public function postnews(Request $request)
        {
                $data['postnewsRegion'] = $request->url;
                $data['region'] =DB::table('regions')->where('id', $request->id)->first();
                $data['postnews'] = DB::table('post_news_region_data')->where('post_news_region_id', $request->id)->get();
                // echo"<pre>";
                // print_r($data['postnews']);
                // die;
                return view('frontend.newspost', $data);
        }
        public function submitForm(Request $request)
         {
         $request->validate([
            'firstName' => 'required',
            'email' => 'required|email',
            'description' => 'required',
        ]);
        //Mail::to($username2[0]->PrimaryWorkEmail)->send(new MyMail($username2[0]->PrimaryName, $token)); 
        Mail::to('codingbrains2@gmail.com')->send(new ContactUs(
            $request->firstName,
            $request->email,
            $request->description
        ));
         // Send the auto-reply email
                Mail::to($request->email)->send(new AutoReply([
                        'name' => $request->firstName,
                        'email' => $request->email,
                        'description' => $request->description,
                ]));
       // dd($request->all());
        // Redirect back with a success message
        return back()->with('success', 'Message sent successfully. Thank you!');
    }
       //_________________________________________Start Region Page______________________________
        public function regiondata()
        {
          return view('backend.add_region');
        }
        // Add Region
        public function addregion(Request $request)
        {
                // echo"<pre>";
                // print_r($request->all());
                // die;
            try {
                $request->validate([
                        'Description'=>'required',
                        'timezone' => 'required',
                        'website'=>'required',
                        'state'=>'required',
                       
                    ]);

                $data = [
                        'ZoneId' => $request->timezone,
                        'Description' => $request->Description,
                        'SiteURL' => $request->website,
                        'State' => $request->state,
                        //'Tier2Enabled' => $request->tier2,
                        'Tier2Enabled' =>  $request->tier2, 
                        'BundleEmergencies' => $request->memerg 
                        //'BundleEmergencies' => $request->memerg
                ];
                if ($request->hidden == '') {
                        $user = DB::table('regions')->insert($data);
                        $data = 'Created';
                } else {
                //         echo"<pre>";
                // print_r($request->all());
                // die;
                        $user = DB::table('regions')->where('id',$request->hidden)->update($data);
                         $data = "Updated";
                        // echo $request->hidden;
                        // die;
                }
               
                        return redirect()->route('region.data')->with('success', "Region $data Succesfully");
                
                       // return back()->with('failed', 'Failed! Something Went Wrong!');
                
                 } catch (\Illuminate\Validation\ValidationException $e) {
                        $errors = $e->validator->errors();
                        return back()->withErrors($errors)->withInput();
                    } catch (\Exception $e) {
                        return back()->with('failed', 'Failed! ' . $e->getMessage());
                    }
              }
        //Delete Region
        public function deleteregion($id)
        {
                $data = [
                        'id' => $id
                ];
                $user = DB::table('regions')->delete($data);
                if ($user) {
                        return back()->with('success', 'Region Deleted Succesfully');
                } else {
                        return back()->with('failed', 'Failed! Something Went Wrong!');
                }
        }
        //Edit Region
        public function editregion($id)
        {
                $dataRegion =  Helper::getData('regions', $id);
                // echo"<pre>";
                // print_r($dataRegion);
                // die;

                return view('backend.add_region', compact('dataRegion'));
        }
        //_________________________________________End Region Page______________________________
        //_________________________________________Start city Page______________________________
        // City Page
          public function city()
        {
                $response = DB::table('regions as r')
                        ->leftjoin('regioncities as z', 'z.RegionID', '=', 'r.id')
                        ->orderBy('Description', 'asc')->orderBy('CityRank', 'asc');
                $data['orgcat'] = $response->get()->toArray();
                return view('backend.city', $data);
        }
        // Edit City
        public function editcity($id)
        {
                $response = DB::table('regions as r')
                        ->join('regioncities as z', 'z.RegionID', '=', 'r.id')->orderBy('CityRank', 'asc')
                        ->orderBy('Description', 'asc');
                $data['orgcat'] = $response->get()->toArray();
                usort($data['orgcat'], function ($a, $b) {
                        return strcmp($a->Description, $b->Description);
                });
                $dataRegion = DB::table('regioncities')->where('cid', $id)->get();
                return view('backend.city', compact('dataRegion'), $data);
        }
        //Delete City
        public function deletecity($id)
        {
                $user = DB::table('regioncities')->where('cid', $id)->delete();
                if ($user) {
                        return back()->with('success', 'City Deleted Succesfully');
                } else {
                        return back()->with('failed', 'Failed! Something Went Wrong!');
                }
        }
        // Add City
        public function addcity(Request $request)
        {
                $data = [
                        'RegionID' => $request->Description,
                        'CityName' => $request->cityname,
                        'CityRank' => $request->rank,
                        'DefaultCity' => $request->dcity,
                ];
                if ($request->hidden == '') {
                        $user = DB::table('regioncities')->insert($data);
                        $data = 'Created';
                } else {
                        $user = DB::table('regioncities')->where('cid', $request->hidden)->update($data);
                        $data = "Updated";
                }
                 return redirect()->route('city.data')->with('success', "City $data Succesfully");
                
        }
         //_________________________________________End city Page______________________________
        //_________________________________________Start org Page______________________________
          public function org()
        {
                // $response = DB::table('regions as r')
                //         ->leftjoin('orgcats as z', 'z.RegionID', '=', 'r.id')
                //         ->orderBy('Description','asc');
                $response = DB::table('regions as r')
                    ->leftJoin('orgcats as z', 'z.RegionID', '=', 'r.id')
                    ->select('r.id as region_id', 'r.Description as region_description', 'z.*') 
                    ->orderBy('region_description', 'asc');
                    
                $data['orgcat'] = $response->get()->toArray();
                return view('backend.organization_category', $data);
        }
        public function addorg(Request $request)
        {
                // echo '<pre>';
                //  print_r($request->all());
                //  die;
                $data = [
                        'RegionID' => $request->region,
                        'Rank' => $request->rank,
                        'CatagoryName' => $request->name,
                        'Fee' => $request->fee,
                        'SchoolRelated' => $request->tier2,
                        'Tier2Enabled' => $request->memerg
                ];
                if ($request->hidden == '') {
                        $user = DB::table('orgcats')->insert($data);
                        $data = 'Created';
                } else {
                        $user = DB::table('orgcats')->where('id', $request->hidden)->update($data);
                        $data = "Updated";
                }
                return redirect()->route('org.data')->with('success', "Organization $data Succesfully");
        }
        public function editorg($id)
        {
                // $response = DB::table('regions as r')
                //         ->leftjoin('orgcats as z', 'z.RegionID', '=', 'r.id')
                //         ->orderBy('Description', 'asc');
                $response = DB::table('regions as r')
                    ->leftJoin('orgcats as z', 'z.RegionID', '=', 'r.id')
                    ->select('r.id as region_id', 'r.Description as region_description', 'z.*') 
                    ->orderBy('region_description', 'asc');
                $data['orgcat'] = $response->get()->toArray();
                usort($data['orgcat'], function ($a, $b) {
                        return strcmp($a->region_description, $b->region_description);
                });
                $dataRegion = DB::table('orgcats')->where('id', $id)->get();
                return view('backend.organization_category', compact('dataRegion'), $data);
        }
        public function deleteorg(Request $request, $id='')
        {
                if($id==''){
                        $user = DB::table('orgcats')->where('id', $request->id)->delete();
                        return response()->json(['status' => 200, 'url'=>route('org.data')]);
                }else{
                        $user = DB::table('orgcats')->where('id', $id)->delete();
                }
                if ($user) {
                        return back()->with('success', 'Organization Deleted Succesfully');
                } else {
                        return back()->with('failed', 'Failed! Something Went Wrong!');
                }
        }
        public function getorg(Request $request)
        {
            $response = DB::table('regions as r')
                ->join('orgcats as z', 'z.RegionID', '=', 'r.id')->where('RegionID', $request->id)
                ->orderBy('Rank', 'desc')->get();
            // $data = $response ->get();
            // return $data;
            $output = '';
            if ($response->count() > 0) {
                $output .= ' <table id="example2" class="table table-bordered table-hover">
                     <thead>
                     <tr>
                         <th>Rank</th>
                         <th>Name</th>
                         <th>Fee</th>
                         <th> School</th>
                         <th>Tier 2</th>
                         <th>
                             Action
                         </th>
                     </tr>
                     </thead>
               <tbody>
               <tr>
               <th>'.ucwords(str_replace("/", "-" , $response[0]->Description)).'</th>
               </tr>';
                foreach ($response as $emp) {
                    $output .= '<tr>
                        <td class="td-btn">
                            <input class="min-length-2" readonly value="'. $emp->Rank .'"/>
                            <form action="' . route('orgoptions.increase-rank', $emp->id) . '" method="POST">
                                <button type="submit">+</button>
                                <input type="hidden" name="_token" value="' .csrf_token() .'">
                            </form>
                            <form action="' . route('orgoptions.decrease-rank', $emp->id) . '" method="POST">
                                <button type="submit">-</button>
                                <input type="hidden" name="_token" value="' .csrf_token() .'">
                            </form>
                        </td>
                        <td>' . $emp->CatagoryName . '</td>
                        <td>' . $emp->Fee . '</td>
                        <td>'. (($emp->SchoolRelated==1) ? 'Y' : '') .'</td>
                        <td>'. (($emp->Tier2Enabled==1) ? 'Y' : '') .'</td>
                        <td>
                            <a href="' . url('IIN/edit-org/'.$emp->id) . '" id="' . $emp->id . '" class="btn btn-success btn-xs"><i class="fa fa-pencil-square"></i></a>
                            <a href="' . url('IIN/delete-org/'.$emp->id) . '" id="' . $emp->id . '" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>';                    
                }
                $output .= '</tbody></table>';
                echo $output;
        //    
            }else{
                $output .= ' <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Fee</th>
                    <th> School</th>
                    <th>Tier 2</th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>';
                echo $output;
            }
           
        }
        
        public function increaseRank(Request $request, $id){
            DB::table('orgcats')->where('id',$id)->increment('Rank');
            return redirect()->back();
        }
        
        public function decreaseRank(Request $request, $id){
            DB::table('orgcats')->where('id',$id)->decrement('Rank');
            return redirect()->back();
        }
        //_________________________________________End org Page______________________________

}
