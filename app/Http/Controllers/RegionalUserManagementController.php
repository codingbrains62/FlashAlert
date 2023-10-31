<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;



class RegionalUserManagementController extends Controller
{
           // User/Org management Page
    public function usrorgmngmt(Request $request)
    {  
        $decodedRegion = $request->input('region');
        $decodedOrgCatSelect = $request->input('orgCatSelect');
        $selectedRegion = $decodedRegion ?? '0';
        $amountpaid= $request->input('yearpaid') ?? '0';
        $age= $request->input('age') ?? '0';
        $selectedorgcat = $decodedOrgCatSelect ?? '0';
        $firstselectbox =$request->input('firstselectbox') ?? '0';
        $companyname= $request->input('companyname') ?? '0';
        $searchid= $request->input('searchid') ?? '0';
        $year=DB::table('year')->get();
        $data=DB::table('regions')->orderBy('Description', 'asc')->get();
        $response=DB::table('regions as r')
        ->join('orgcats as oc', 'oc.RegionID', '=', 'r.id')
        ->leftjoin('orgs as o' , 'o.OrgCatID', '=', 'oc.id')
        ->join('users as u', 'o.id', '=', 'u.OrgID')->where('o.RootOrgID','=',0); 
        $category='';
        if (!empty($firstselectbox)) {
            if ($firstselectbox === '1') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === '2') {
                $response->where('u.Tier', '=', $firstselectbox);
            } elseif ($firstselectbox === 'off') {
                $response->where('u.bActivated', '=', $firstselectbox);
            } elseif ($firstselectbox === 'M') {
                $response->where('u.FlashAlertSubscriber', '=', 1);
            } elseif ($firstselectbox === 'NM') {
                $response->where('u.FlashAlertSubscriber', '=', 0);
            } elseif ($firstselectbox === 'S') {
                $response->where('o.ParentOrgID', '!=', 0);
            } elseif ($firstselectbox === 'T') {
                $response->where('u.DefaultNotifyTwitter', '=', 1);
            } elseif ($firstselectbox === 'F') {
                $response->where('u.DefaultNotifyFacebook', '=', 1);
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
        if (!empty($amountpaid)) {
            if ($amountpaid === 'Yes') {
                $response->where('u.AmountPaid','!=','');
            } elseif ($amountpaid=== 'never') {
                $response ->where('u.AmountPaid','=','');
            }else{
                 $response ->whereYear('u.DateLastPaid',$request->yearpaid);
        }
        }
        if (!empty($age)) {
            if ($age === 'plus') {
                $response->orderBy('DateUpdated', 'desc');
            } else {
                $response->orderBy('DateUpdated', 'asc');
            }
        }
        if (!empty($companyname)) {
            $response->where('o.Name', 'like', '%' . $request->companyname . '%');    
           
        }
        if (!empty($searchid)) {
            $response->where('u.OrgID', 'like',  $request->searchid );    
        }
        $response = $response->orderBy('Description', 'asc')->orderBy('CatagoryName', 'asc')->orderBy('Name', 'asc')
        ->paginate(25);
        return view('backend.user_orgManagement',compact('data','response','category','selectedRegion','selectedorgcat','amountpaid','age','year','firstselectbox','companyname','searchid'));
   
    } 
     public function usrorg_inform($id){
            $id=base64_decode($id);
            $response = DB::table('users')->where('OrgID', $id) ->get();
            $response1= DB::table('orgs')->where('id', $id) ->get();
            $response2= DB::table('regions')->orderby('Description', 'asc')->get();
            $response3=DB::table('regions as r')
            ->join('orgregions as oc', 'oc.RegionID', '=', 'r.id')->where('oc.OrgID',$id)->get();
            $response4= DB::table('regioncities')->where('RegionID',$response1[0]->RegionID)->orderby('CityRank', 'asc')->get();
            $response5 = DB::table('publicusersubscription')->where('OrgID', $id)->get();
            $response6 = DB::table('orggroup')->get();
            $response7 = DB::table('orggroupmember as orggrpmem')
            ->join('orggroup as orggro', 'orggrpmem.OrgGroupID', '=', 'orggro.id')
            ->where('OrgID', $id)->get();
            $logo=DB::table('mediafile')->where('id', $response1[0]->LogoMediaFileID)->get();
           
            return view('backend.uorg_inform',compact('response','response1','response2','response3','response4','response5','response6','response7','logo'));
    }

    public function emulateLogin(Request $request)
    {
        $orgID = $request->input('orgID');
        $user=DB::table('users')->where('OrgID',$orgID)->first(); 
    //dd($user);
    if ($user) {
        // Authenticate the user using their orgID
        $request->session()->put('loginId', $user->id);
        $request->session()->put('role', $user->SecurityLevel);
        // Session::setName('org_session');
        // session(['user' => $user]);
        session(['loginId' => $user->id, 'role' => $user->SecurityLevel]);
        return back();
    }
}

    public function usrorg_inform_sub($id){
        //echo $id=base64_decode($id);
        $id=base64_decode($id);
        $response = DB::table('users')->where('OrgID', $id) ->get();
        $response1= DB::table('orgs')->where('id', $id) ->get();
        $response2= DB::table('regions')->orderby('Description', 'asc')->get();
        $response3=DB::table('regions as r')
        ->join('orgregions as oc', 'oc.RegionID', '=', 'r.id')->where('oc.OrgID',$id)->get();
        $response4= DB::table('regioncities')->where('RegionID',$response1[0]->RegionID)->orderby('CityRank', 'asc')->get();
        $response5 = DB::table('publicusersubscription')->where('OrgID', $id)->get();
        $response6 = DB::table('orggroup')->get();
        $response7 = DB::table('orggroupmember as orggrpmem')
        ->join('orggroup as orggro', 'orggrpmem.OrgGroupID', '=', 'orggro.id')
        ->where('OrgID', $id)->get();
         $logo=DB::table('mediafile')->where('id', $response1[0]->LogoMediaFileID)->get();
        return view('backend.uorg_informsub',compact('response','response1','response2','response3','response4','response5','response6','response7','logo'));
    }
    
    public function addgrouppartner($id){
        $id=base64_decode($id);
        $response = DB::table('businesspartnergroups')->where('UserID', $id)->orderBY('GroupName','asc')->get();
        return view('backend.addgrouppartner',compact('response','id'));
    }
    public function editgrouppartner($id){
        $id=base64_decode($id);
        $editgroup = DB::table('businesspartnergroups')->where('id', $id)->get();
        $response = DB::table('businesspartnergroups')->where('UserID', $editgroup[0]->UserID)->orderBY('GroupName','asc')->get();
        return view('backend.addgrouppartner',compact('editgroup','id','response'));
    }
    public function deletegrouppartner($id){
      $id=base64_decode($id);
      $data=[
         'id'=>$id
      ];
      $user=DB::table('businesspartnergroups')->delete($data);
      if($user){
        return back()->with('success','Group Name Deleted Succesfully');  
       }else{
        return back()->with('failed','Something Went Wrong');
       } 
    }
    public function insertgrouppartner(Request $request){
    //    echo '<pre>';
    //    print_r($request->all());
    //    die;
    try {
        $request->validate([
            //'GroupName' => 'required|unique:businesspartnergroups,GroupName,'.$request->id,
            'GroupName' => 'required',
           
        ]);
        $OrgData=[
                'UserID'=>$request->UserID,
                'GroupName'=>$request->GroupName,
            ];
            if($request->hidden!=''){
                $user = DB::table('businesspartnergroups')->where('id',$request->hidden)->update($OrgData);
                $data = "Updated";
            }else{
            $user=DB::table('businesspartnergroups')->insert($OrgData); 
            $data = "Added";
            }
            if($user){
            return redirect()->to('IIN/addgrouppartner/'.base64_encode($request->UserID))->with('success', "Data $data Successfully!");

             //return back()->with('success',"Group Name $data Succesfully");  
            }else{
             return back()->with('failed','Something Went Wrong');
            }
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
        return  back()->withErrors($errors)->withInput();
    }
    }
    

    public function buninesspartner($id){
        $id=base64_decode($id);
        $response = DB::table('businesspartnergroups as bpgroup')
        ->join('businesspartners as bp', 'bpgroup.id', '=', 'bp.GroupID')
        ->join('businesspartnertypes as bptype', 'bp.NotifyType', '=', 'bptype.id')
        ->select('bp.id as partner_id', 'bp.UserID', 'bp.EmailAddress', 'bp.PartnerName', 'bp.NotifyType', 'bp.GroupID', 'bptype.*', 'bpgroup.*')
        ->where('bpgroup.UserID', $id)
        ->orderBy('bpgroup.GroupName', 'asc')
        ->get();
        $response1 = DB::table('businesspartnergroups')->where('UserID', $id)->orderBY('GroupName','asc')->get();
        $response3 = DB::table('users')->where('id', $id)->get();

        return view('backend.manage-partner',compact('response','response1','id','response3'));
      }

    public function editbuninesspartner($id){
       echo  $id=base64_decode($id);
       $response2 = DB::table('businesspartners')->where('id', $id)->get();
       $response = DB::table('businesspartnergroups as bpgroup')
       ->join('businesspartners as bp', 'bpgroup.id', '=', 'bp.GroupID')
       ->join('businesspartnertypes as bptype', 'bp.NotifyType', '=', 'bptype.id')
       ->select('bp.id as partner_id', 'bp.UserID', 'bp.EmailAddress', 'bp.PartnerName', 'bp.NotifyType', 'bp.GroupID', 'bptype.*', 'bpgroup.*')
       ->where('bpgroup.UserID', $response2[0]->UserID)
       ->orderBy('bpgroup.GroupName', 'asc')
       ->get();
        $response1 = DB::table('businesspartnergroups')->where('UserID', $response2[0]->UserID)->orderBY('GroupName','asc')->get();
        $response4 = DB::table('users')->where('id', $response2[0]->UserID)->get();

     return view('backend.manage-partner',compact('response','response1','response2','id','response4'));
    }

    public function deletebusinesspartner($id){
        $id=base64_decode($id);
        $data=[
           'id'=>$id
        ];
        $user=DB::table('businesspartners')->delete($data);
        if($user){
          return back()->with('success','Group Name Deleted Succesfully');  
         }else{
          return back()->with('failed','Something Went Wrong');
         } 
      }
      public function insertbusinesspartner(Request $request){
    //    echo '<pre>';
    //    print_r($request->all());
    //    die;
      try {
          $request->validate([
              'PartnerName' => 'required',
              'EmailAddress' => 'required',
              'PartnerType' => 'required',
              'GroupName' => 'required',
          ]);
          $OrgData=[
                  'UserID'=>$request->UserID,
                  'EmailAddress'=>$request->EmailAddress,
                  'PartnerName'=>$request->PartnerName,
                  'NotifyType'=>$request->PartnerType,
                  'GroupID'=>$request->GroupName,
                 
              ];
              if($request->hidden!=''){
                  $user = DB::table('businesspartners')->where('id',$request->hidden)->update($OrgData);
                  $data = "Updated";
              }else{
              $user=DB::table('businesspartners')->insert($OrgData); 
              $data = "Added";
              }
              if($user){
              return redirect()->to('IIN/buninesspartner/'.base64_encode($request->UserID))->with('success', "Data $data Successfully!");
  
               //return back()->with('success',"Group Name $data Succesfully");  
              }else{
               return back()->with('failed','Something Went Wrong');
              }
      } catch (\Illuminate\Validation\ValidationException $e) {
          $errors = $e->validator->errors();
          return  back()->withErrors($errors)->withInput();
      }
      }
   

    public function createcsv(Request $request) {
        if ($request->has('GroupID')) {
            $response = DB::table('businesspartners as bp')
            ->join('businesspartnertypes as bpt' , 'bp.NotifyType', '=', 'bpt.id')
            ->where('GroupID', $request->GroupID)->get();
        } else {
            $response = [];  
        }
        $csvData = [];
        foreach ($response as $item) {
            $csvData[] = [
                'Email' => $item->EmailAddress,
                'Name (optional)' => $item->PartnerName,
                'Emerg/News/Both' => $item->PartnerType,
            ];
        }
        if (empty($csvData)) {
            $csvData[] = [
                'Email' => '',
                'Name (optional)' => '',
                'Emerg/News/Both' => '',
            ];
        }
        $fileName = 'businesspartners.csv';
        $filePointer = fopen($fileName, 'w');
        if (!empty($csvData)) {
            $headers = array_keys($csvData[0]);
            fputcsv($filePointer, $headers);
        }
        foreach ($csvData as $row) {
            fputcsv($filePointer, $row);
        }
        fclose($filePointer);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        readfile($fileName);
    }
    
    public function staticsamplecsv() {
        $csvData = [
            ['Email', 'Name (optional)', 'Emerg/News/Both'],
            ['billw@bill.com', 'Bill Wilson', 'Emerg'],
            ['joes@joe.com', 'Joe Smith', 'Emerg'],
            ['mike@mike.com', 'Mike Delaney', 'Emerg'],
        ];
    
        $fileName = 'sample.csv';
    
        // Generate the CSV content as a string
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= implode(',', $row) . PHP_EOL;
        }
    
        // Set the appropriate headers for download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
    
        // Return the CSV content as a downloadable response
        return response($csvContent, 200, $headers);
    }
    
   



  
    public function importCSV(Request $request)
    {
        if($request->input('GroupID')==''){
          return redirect()->back()->with('failed', 'Plz Create Group First Using Manage Group Button:');
        }else{
        if ($request->hasFile('csvfile')) {
            $file = $request->file('csvfile');
            $path = $file->getRealPath();
            $header = null;
            $data = [];
            if (($handle = fopen($path, 'r')) !== false) {
                fgetcsv($handle);

                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    $partnerType = 3; // Default PartnerType value (assumed to be Other)

                    // Check for different PartnerType values based on the condition provided
                    if ($row[2] == 'Press') {
                        $partnerType = 1; // Press
                    } elseif ($row[2] == 'Emerg') {
                        $partnerType = 2; // Emergency
                    }

                    $data[] = [
                        'UserID' => $request->input('UserID'), 
                        'EmailAddress' => $row[0], 
                        'PartnerName' => $row[1], 
                        'NotifyType' => $partnerType, 
                        'GroupID' => $request->input('GroupID'), 
                    ];
                }
                fclose($handle);
               try {
                $groupid = ['GroupID' => $request->input('GroupID')];
                DB::table('businesspartners')->where($groupid)->delete();
                    DB::table('businesspartners')->insert($data);
                    return redirect()->back()->with('success', 'CSV data has been imported successfully.');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error inserting data: ' . $e->getMessage());
                }
            }
        }
        }
        return redirect()->back()->with('error', 'CSV file not found or invalid format.');
   }




    
    

    public function subcat($id){
        $id=base64_decode($id);
        $response= DB::table('orgs')->where('id',$id) ->get();
        $response1= DB::table('regions')->where('id',$response[0]->RegionID)->get();
        $response2= DB::table('orgcats')->where('id',$response[0]->OrgCatID) ->get();
        $response3= DB::table('users')->where('OrgID',$id) ->get();
        return view('backend.suborg',compact('response','response1','response2','response3'));
    }
    public function addsubcat(Request $request){
        try {
            $request->validate([
                'orgname' => 'required|unique:orgs,Name',
                'uname' => 'required|unique:users,UserName',
                'password' => 'required',
               
            ]);
            $decrypted = Hash::make($request->password);
            $OrgData=[
                    'RegionID'=>$request->RegionID,
                    'OrgCatID'=>$request->CategoryID,
                    'RootOrgID'=>$request->OrgID,
                    'ParentOrgID'=>$request->OrgID,
                    'Name'=>$request->orgname,
                ];
                $lastInsertOrgs=DB::table('orgs')->insertGetId($OrgData); 
                $user=[
                     'UserName'=>$request->uname,
                     'PasswordHash'=> $decrypted,
                     'OrgID'=>$lastInsertOrgs
                ];
                $user=DB::table('users')->insert($user); 
                if($user){
                 return redirect()->route('userorgmngmnt')->with('success','User Added Succesfully');  
                }else{
                 return back()->with('failed','Something Went Wrong');
                }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return  back()->withErrors($errors)->withInput();
        }
      }
      public function delorg($id){
        $id=base64_decode($id);
        $data=['id'=>$id];
        $delorg=DB::table('orgs')->delete($data);
        if($delorg){
        $data1=['OrgID'=>$id];
        $result=DB::table('users')->delete($data1);
        }
        if($result){
        return redirect()->route('userorgmngmnt')->with('success','Organization Deleted Succesfully');  
        }else{
        return back()->with('failed','Opps Something Went Wrong');  
        }

     }
     public function addgroup(Request $request)
     {
         try {
             $request->validate([
                 'orggroupid' => 'required',
             ]);
     
             $groupData = [
                 'OrgID' => $request->grouporg,
                 'OrgGroupID' => $request->orggroupid,
             ];
     
             if ($request->has('action') && $request->input('action') === 'delete') {
                 $deleted = DB::table('orggroupmember')->where($groupData)->delete();
                 if ($deleted) {
                     return back()->with('success', 'Group Deleted Successfully');
                 } else {
                     return back()->with('failed', 'Something Went Wrong');
                 }
             } else {
                 $inserted = DB::table('orggroupmember')->insert($groupData);
                 if ($inserted) {
                     return back()->with('success', 'Group Added Successfully');
                 } else {
                     return back()->with('failed', 'Something Went Wrong');
                 }
             }
         } catch (\Illuminate\Validation\ValidationException $e) {
             $errors = $e->validator->errors();
             return back()->withErrors($errors)->withInput();
         }
     }

    public function editorgdata(Request $request){
          // echo '<pre>';
          // print_r($request->all());
          // die;
       
        $dateString = $request->lastpaid;
        $originalFormat = 'm/d/y'; 
        $targetFormat = 'Y-m-d H:i:s'; 
        $carbonDate = Carbon::createFromFormat($originalFormat, $dateString);
        $formattedDate = $carbonDate->format($targetFormat);
        $id=$request->hidden;
        try {
               $request->validate([
                     'OrgName' => 'required',
                     'UserName' => 'required',
                     //'password' => 'required',
                     //'confirm_password' => 'required|same:password',
                     'confirm_password' => 'required_with:password|same:password',
                     'PrimaryName' => 'required',
                     'PrimaryPhone' => 'required',
                     'PrimaryWorkEmail' => 'required',
                     'orglogo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $fileName = '';
                if(isset($request->orglogo)){
                if ($request->hasFile('orglogo')) {
                    $file = $request->file('orglogo');
                      $fileSize = $file->getSize();
                      $fileMimeType = $file->getMimeType();
                      $image = Image::make($file);
                      $imageWidth = $image->width();
                      $imageHeight = $image->height();
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/images', $fileName); // Store in storage/app/public/images
                    $filePath = public_path('images/' . $fileName); // Get the full public path
                    copy(storage_path('app/public/images/' . $fileName), $filePath); // Copy from storage to public
                    $empData = ['ThumbURL' => 'https://flashalert.projects-codingbrains.com/public/images/' . $fileName,
                                'URL'=>'https://flashalert.projects-codingbrains.com/public/images/' . $fileName,
                                'FileSize'=>$fileSize,
                                'FileType'=>$fileMimeType,
                                'ImageW'=>$imageWidth,
                                'ImageH'=>$imageHeight,
                                'DateAdded'=>Carbon::now(),

                               ];
                    $data = DB::table('mediafile')->insertGetId($empData);
                    $oldImage = DB::table('mediafile')->where('id', $request->oldImage)->first();
                    if ($oldImage) {
                        $oldFilePath = $oldImage->ThumbURL;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                         DB::table('mediafile')->where('id', $request->oldImage)->delete();
                    }
                    }}else{
                        $data= $request->oldImage;
                    }
                $org=[
                'RegionID'=>$request->region,
                'OrgCatID'=>$request->category,
                'Name'=>$request->OrgName,
                'Invisible'=>$request->invisible,
                'LogoMediaFileID'=>$data
                ];
                DB::table('orgs')->where('id',$id)->update($org);
                if(!empty($request->regionValue)){
                foreach($request->regionValue as $regionVal ){
                      $regionvalu=[
                        'OrgID'=>$id,
                        'RegionID'=>$regionVal,
                      ];
                DB::table('orgregions')->where('OrgID',$id)->where('RegionID',$regionVal)->delete();
                DB::table('orgregions')->insert($regionvalu);
                }
                }else{
                DB::table('orgregions')->where('OrgID',$id)->delete();  
                }
                $decrypted = Hash::make($request->password);
                $user=[
                'TestAccount'=>$request->regionlocked,
                'Tier'=>$request->Tier,
                'bActivated'=>$request->bActivated,
                'Hibernation'=>$request->hibernation,
                'DateLastPaid'=>$formattedDate,
                'YearPaidFor'=>$request->yearpaidfor,
                'AmountPaid'=>$request->amountpaid,
                'Notes'=>$request->notes,
                'UserName'=>$request->UserName,
                'PasswordHash'=>$decrypted,
                'FlashAlertSubscriber'=>$request->optionsRadios,
                'FlashAlertNews'=>$request->optionsRadios1,
                'FacebookURL'=>$request->facebookurl,
                'TwitterUser'=>$request->TwitterUser,
                'EnableMediaMonitor'=>$request->enablemedia,
                'SecurityLevel'=>$request->SecurityLevel,
                'URLName'=>$request->URLName,
                'Address'=>$request->Address,
                'City'=>$request->City,
                'State'=>$request->State,
                'Zipcode'=>$request->Zipcode,
                'BillingEmail'=>$request->BillingEmail,
                'URL'=>$request->URL,
                'DefaultContactInfo'=>$request->DefaultContactInfo,
                'PrimaryName'=>$request->PrimaryName,
                'PrimaryPhone'=>$request->PrimaryPhone,
                'PrimaryWorkEmail'=>$request->PrimaryWorkEmail,
                'SecondaryName'=>$request->SecondaryName,
                'SecondaryWorkEmail'=>$request->SecondaryWorkEmail,
                'SecondaryPhone'=>$request->SecondaryPhone,
                ];
               $result= DB::table('users')->where('OrgID',$id)->update($user);
               if($result || $data || $org){
                return back()->with('success', 'Data Updated Successfully!');
               }else{
                return back()->with('failed', 'Something Went Wrong!');
               }
         } catch (\Illuminate\Validation\ValidationException $e) {
             $errors = $e->validator->errors();
             return back()->withErrors($errors)->withInput();
         }
    }
    public function editsuborgdata(Request $request){
      $id=$request->hidden;
       // $fileName = '';
       //  $emp = DB::table('mediafile')->where('id', $request->oldImage)->first();
       //  if ($request->hasFile('orglogo')) {
       //      $file = $request->file('orglogo');
       //      $fileName = time() . '.' . $file->getClientOriginalExtension();
       //      $file->storeAs('public/images', $fileName);
       //    //  if ($emp->ThumbURL) {
       //    //   Storage::delete('public/images/' . $emp->ThumbURL);
       //    // }
       //  } else {
       //      $fileName = $request->oldImage;
       //  }
       //  return back()->with('success', 'Data Updated Successfully!');
        try {
               $request->validate([
                     'OrgName' => 'required',
                     'UserName' => 'required',
                     'password' => 'required',
                     'confirm_password' => 'required|same:password',
                     'PrimaryName' => 'required',
                     'PrimaryPhone' => 'required',
                     'PrimaryWorkEmail' => 'required|email',
                     'orglogo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $fileName = '';
            if(isset($request->orglogo)){
                if ($request->hasFile('orglogo')) {
                    $file = $request->file('orglogo');
                      $fileSize = $file->getSize();
                      $fileMimeType = $file->getMimeType();
                      $image = Image::make($file);
                      $imageWidth = $image->width();
                      $imageHeight = $image->height();
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/images', $fileName); // Store in storage/app/public/images
                    $filePath = public_path('images/' . $fileName); // Get the full public path
                    copy(storage_path('app/public/images/' . $fileName), $filePath); // Copy from storage to public
                    $empData = ['ThumbURL' => 'https://flashalert.projects-codingbrains.com/public/images/' . $fileName,
                                'URL'=>'https://flashalert.projects-codingbrains.com/public/images/' . $fileName,
                                'FileSize'=>$fileSize,
                                'FileType'=>$fileMimeType,
                                'ImageW'=>$imageWidth,
                                'ImageH'=>$imageHeight,
                                'DateAdded'=>Carbon::now(),
                               ];
                    $data = DB::table('mediafile')->insertGetId($empData);
                    $oldImage = DB::table('mediafile')->where('id', $request->oldImage)->first();
                    if ($oldImage) {
                        $oldFilePath = $oldImage->ThumbURL;
                        if (file_exists($oldFilePath)) {
                          
                            //unlink($oldFilePath);
                             if (Storage::exists($oldFilePath)) {
                                Storage::delete($oldFilePath);
                            }
                        }
                         DB::table('mediafile')->where('id', $request->oldImage)->delete();
                    }
                  
                    }}else{
                        $data= $request->oldImage;
                    }

                $org=[
                'RegionID'=>$request->region,
                'OrgCatID'=>$request->category,
                'Name'=>$request->OrgName,
                'RootOrgID'=>$request->porganization,
                'ParentOrgID'=>$request->porganization,
                'InheritRegion'=>$request->InheritRegion,
                'CanMailNews'=>$request->CanMailNews,
                'LogoMediaFileID'=>$data
                ];
                $org= DB::table('orgs')->where('id',$id)->update($org);
                $decrypted = Hash::make($request->password);
                $user=[
                'UserName'=>$request->UserName,
                'PasswordHash'=>$decrypted,
                'FlashAlertSubscriber'=>$request->optionsRadios,
                'FlashAlertNews'=>$request->optionsRadios1,
                'EnableMediaMonitor'=>$request->MediaMonitor,
                'URLName'=>$request->URLName,
                'URL'=>$request->URL,
                'PrimaryName'=>$request->PrimaryName,
                'PrimaryPhone'=>$request->PrimaryPhone,
                'PrimaryWorkEmail'=>$request->PrimaryWorkEmail,
                ];
               $result= DB::table('users')->where('OrgID',$id)->update($user);
               if($result || $data || $org){
                return back()->with('success', 'Data Updated Successfully!');
               }else{
                return back()->with('failed', 'Something Went Wrong!');
               }
             
         } catch (\Illuminate\Validation\ValidationException $e) {
             $errors = $e->validator->errors();
             return back()->withErrors($errors)->withInput();
         }
     
    }
    public function defaultdispatch(Request $request){
        $orgid= $request->grouporg1;
        if(!empty($request->regionValue)){
        
        DB::table('defaultcities')->where('OrgID',$orgid)->delete();
        foreach($request->regionValue as $regions){
            $data=[
            'OrgID'=>$orgid,
            'CityID'=>$regions,
            ];
          DB::table('defaultcities')->insert($data);
        }
        }else{
         DB::table('defaultcities')->where('OrgID',$orgid)->delete();  
        }
        if(!empty($request->businesspartner)){
          $data=[
              'DefaultMailBusinessPartners'=>$request->businesspartner,
          ];
           DB::table('users')->where('OrgID',$orgid)->update($data);
        }else{
            $data=[
              'DefaultMailBusinessPartners'=>0,
          ];
         DB::table('users')->where('OrgID',$orgid)->update($data);  
        }
        if(!empty($request->FlashAlertSubscriber)){
          $data=[
              'FlashAlertSubscriber'=>$request->FlashAlertSubscriber,
          ];
           DB::table('users')->where('OrgID',$orgid)->update($data);
        }else{
            $data=[
              'FlashAlertSubscriber'=>0,
          ];
         DB::table('users')->where('OrgID',$orgid)->update($data);  
        }
        if(!empty($request->TwitterUser)){
         $data=[
              'DefaultNotifyTwitter'=>$request->TwitterUser,
          ];
           DB::table('users')->where('OrgID',$orgid)->update($data);
        }else{
            $data=[
              'DefaultNotifyTwitter'=>0,
          ];
         DB::table('users')->where('OrgID',$orgid)->update($data);  
        }
        if(!empty($request->FacebookUser)){
          $data=[
              'DefaultNotifyFacebook'=>$request->FacebookUser,
          ];
           DB::table('users')->where('OrgID',$orgid)->update($data);
        }else{
            $data=[
              'DefaultNotifyFacebook'=>0,
          ];
         DB::table('users')->where('OrgID',$orgid)->update($data);  
        }
        if(!empty($request->GroupName)){
        DB::table('orggroupmember')->where('OrgID',$orgid)->delete();
        foreach($request->GroupName as $group){
            $data=[
            'OrgID'=>$orgid,
            'OrgGroupID'=>$group,
            ];
          DB::table('orggroupmember')->insert($data);
        }
        }else{
         DB::table('orggroupmember')->where('OrgID',$orgid)->delete();  
        }
        return back()->with('success', 'Data Updated Successfully!');  
      }
}