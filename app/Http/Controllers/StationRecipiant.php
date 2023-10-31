<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReqUpdate;
class StationRecipiant extends Controller
{
    public function index(Request $request){
        $decodedRegion = $request->input('region');
        $decodedOrgCatSelect = $request->input('orgCatSelect');
        $selectedRegion = $decodedRegion ?? '0';
        $amountpaid= $request->input('yearpaid') ?? '0';
        $companyname= $request->input('companyname') ?? '0';
        $data=DB::table('regions')->orderBy('Description', 'asc')->get();
        $response=DB::table('regions as r')
        ->join('subs as oc', 'oc.RegionID', '=', 'r.id');
        if (!empty($decodedRegion)) {
            $response->where('oc.RegionID', '=', $decodedRegion);
        }
        if (!empty($amountpaid)) {
            if ($amountpaid === 'Yes') {
                $response->where('oc.DateVerified','!=','');
            } elseif ($amountpaid=== 'never') {
                $response ->where('oc.DateVerified','=','0000');
            }else{
                 $response ->where('oc.DateVerified',$request->yearpaid);
            }
        }
        if (!empty($companyname)) {
            $response->where('oc.Name', 'like', '%' . $request->companyname . '%');    
           
        }
        $response = $response->orderBy('Description', 'asc')->orderBy('CityCode','asc')->orderBy('Name','asc')->paginate(25);
        return view('backend.stationrecipients',compact('data','response','selectedRegion','amountpaid','companyname'));
    }
    public function page(){
   
      $data=DB::table('regions')->orderBy('Description', 'asc')->get();
      return view('backend.resipient_page',compact('data')); 
    }

    public function getcity(Request $request)
{
     $id=$request->id;
     $data1= DB::table('regioncities')->where('RegionID',$id)->get();
     $output = '<div style="margin-top:20px;"> Category:</div>
                 <div style="width:50%">
                 <select class="form-control" id="city" name="city">
                  <option value="">Select</option>';
                    foreach($data1 as $datas1){
                        $output .= '<option value='."$datas1->cid".'>'."$datas1->CityName".'</option>';
                    }
                '</select>
               </div>';
    return $output;
}

public function addstation(Request $request){
    try {
        $request->validate([
            'region' => 'required',
            'city' => 'required',
            'StationRecipientName' => 'required',
           
        ]);
        $data=[
            'CityCode'=>$request->CityCode,
            'Name'=>$request->StationRecipientName,
            'ContactInfo'=>$request->ContactInformation,
            'Testing'=>$request->Testing,
            'RegionID'=>$request->region,
            'CityID'=>$request->city,
            'DateVerified'=>$request->YearVerified,
        ];
        if($request->hidden==''){
        $result=DB::table('subs')->insert($data);
        $msg="Added";
        }else{
        $result=DB::table('subs')->where('id',$request->hidden)->update($data);   
        $msg="Updated";
        }
         return redirect()->route('station.recipiant')->with('success',"Station $msg Succesfully!");
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
     
        return  back()->withErrors($errors)->withInput();
    }
  }


  public function editstation($id) {
    $id= base64_decode($id);
    $dataRegion = DB::table('subs')->where('id', $id)->get();
    $data=DB::table('regions')->orderBy('Description', 'asc')->get();
    $city=DB::table('regioncities')->where('RegionID', $dataRegion[0]->RegionID)->get();
    $mail=DB::table('subemail')->where('SubID', $id)->get();
    // $subftp=DB::table('subftp as sf')
    // ->join('styles as s', 'sf.StyleID', '=', 's.id')
    // ->where('sf.SubID', $id)
    // ->get();
    $subftp=DB::table('styles as s')
    ->join('subftp as sf', 'sf.StyleID', '=', 's.id')
    ->where('sf.SubID', $id)
    ->get();
    return view('backend.resipient_page', compact('dataRegion','data','city','mail','subftp'));
}

public function requpdate($id) {
    $id= base64_decode($id);
    $dataRegion = DB::table('subs')->where('id', $id)->get();
    $data=DB::table('regions')->where('id',$dataRegion[0]->RegionID)->get();
    $city=DB::table('regioncities')->where('cid', $dataRegion[0]->CityID )->get();
    $mail=DB::table('subemail')->where('SubID', $id)->get();
    $count=count($mail);
      foreach($mail as $mails){
         Mail::to($mails->Address)->send(new ReqUpdate($data[0]->SiteURL,$city[0]->CityName,$dataRegion[0]->Name,$mail));   
      }
      return back()->with('success', "$count messages dispatched.!");
    }


public function editstationemail($id) {
    $id= base64_decode($id);
    $subemail = DB::table('subemail')->where('id', $id)->get();
    $dataRegion = DB::table('subs')->where('id', $subemail[0]->SubID )->get();
    $data=DB::table('regions')->orderBy('Description', 'asc')->get();
    $city=DB::table('regioncities')->where('RegionID', $dataRegion[0]->RegionID)->get();
    $mail=DB::table('subemail')->where('SubID', $subemail[0]->SubID )->get();
    // $subftp=DB::table('subftp as sf')
    // ->join('styles as s', 'sf.StyleID', '=', 's.id')
    // ->where('sf.SubID', $subemail[0]->SubID)
    // ->get();

     $subftp=DB::table('styles as s')
    ->join('subftp as sf', 'sf.StyleID', '=', 's.id')
    ->where('sf.SubID', $subemail[0]->SubID)
    ->get();
    return view('backend.resipient_page', compact('dataRegion','data','city','mail','subemail','subftp'));
}
public function deletestation($id){
    $id= base64_decode($id);
    $data=[
        'id'=>$id
    ];
    $result=DB::table('subs')->delete($data);
    if($result){
        return redirect()->route('station.recipiant')->with('success',"Station Deleted Succesfully!");
       }
  }

public function addstationemail(Request $request){
    try {
        $request->validate([
            'email' => 'required|email',
           
           
        ]);
        $data=[
            'Address'=>$request->email,
            'EmergencyEmail'=>$request->type,
            'SubID'=>$request->subid,
        ];
        if($request->hidden==''){
        $result=DB::table('subemail')->insert($data);
        $msg="Added";
        return back()->with('success',"Email $msg Succesfully!");
        }else{
        $result=DB::table('subemail')->where('id',$request->hidden)->update($data);   
        $msg="Updated";
        return redirect()->to('IIN/edit-station/'.base64_encode($request->subid))->with('success',"Email $msg Succesfully!");
        }
        // if($result){
         //return redirect()->route('station.recipiant')->with('success',"Station $msg Succesfully!"); 
        
        //return redirect()->to('IIN/edit-station/'.base64_encode($request->subid))->with('success', "Data $msg Successfully!");

        // }
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
     
        return  back()->withErrors($errors)->withInput();
    }
  }
  public function deletestationemail($id){
    $id= base64_decode($id);
    $data=[
        'id'=>$id
    ];
    $result=DB::table('subemail')->delete($data);
    if($result){
        return back()->with('success',"Email Deleted Succesfully!");
       }
  }
  public function stationftp($id){
    $id=base64_decode($id);
    $data=DB::table('styles')->get();
    return view('backend.ftp_page',compact('data','id'));
  }
  public function editftp($id) {
   $id= base64_decode($id);
   $data=DB::table('styles')->get();
   $dataRegion=DB::table('subftp')->where('id',$id)->get();
   $style=DB::table('styles')->where('id',$dataRegion[0]->StyleID)->get();
   $id=$dataRegion[0]->SubID; 
   return view('backend.ftp_page', compact('dataRegion','style','data','id'));
}


public function addftp(Request $request){

    // echo '<pre>';
    // print_r($request->all());
    // die;
    try {
        $request->validate([
            'styleID' => 'required',
            'Address' => 'required',
            'Username' => 'required',
            'Password' => 'required',
            'FilePath' => 'required',
            'Method' => 'required',
        ]);
        $data=[
            'Address'=>$request->Address,
            'SubID'=>$request->SubID,
            'styleID'=>$request->styleID,
            'Username'=>$request->Username,
            'Password'=>$request->Password,
            'FilePath'=>$request->FilePath,
            'ActiveMode'=>$request->ActiveMode,
            'Method'=>$request->Method,
           
        ];
        if($request->hidden==''){
        $result=DB::table('subftp')->insert($data);
        $msg="Added";
        }else{
        $result=DB::table('subftp')->where('id',$request->hidden)->update($data);   
        $msg="Updated";
        }
        if($result){
        return redirect()->to('IIN/edit-station/'.base64_encode($request->SubID))->with('success', "FTP $msg Successfully!");
          
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
        return  back()->withErrors($errors)->withInput();
    }
  }

   /////////news media ///////////////////////////////////
 public function newsmediarecipients(Request $request){
    $decodedRegion = $request->input('Region');
    $selectedRegion = $decodedRegion ?? '0';
    
    $response='';
    if($request->Region!=''){
    $id=$request->Region;
    $response=DB::table('subs as s')
    ->join('regioncities as rc','s.CityID', '=', 'rc.cid')
    ->join('subemail as sm', 'sm.SubID', '=', 's.id')->where('s.RegionID',$id)
    ->orderby('CityName','asc')->orderby('Name','asc')->orderby('EmergencyEmail','desc')
    ->get();
    }
    $data=DB::table('regions')->orderBy('Description', 'asc')->get();
    return view('backend.news_media_recipients',compact('data','response','selectedRegion'));
}

//------------------------style Templates-----------------------------------------------------//
  
 public function styletemplates(){
     $data=DB::table('styles')->orderby('name','asc')->get();
     return view('backend.manage_style_templates',compact('data'));
 }
 public function styletempedit($id){
    $id= base64_decode($id);
    $data=DB::table('styles')->orderby('name','asc')->get();
    $result=DB::table('styles')->where('id',$id)->get();
    return view('backend.manage_style_templates',compact('result','data'));
}
public function styletempdel($id){
    $id= base64_decode($id);
    $data=[
        'id'=>$id
    ];
    $result=DB::table('styles')->delete($data);
    return back()->with('success',"Style Templates Deleted Succesfully!");
}


public function addstyletemp(Request $request){
    try {
        $request->validate([
            'Name' => 'required',
            'URL' => 'required',
           
        ]);
        $data=[
            'Name'=>$request->Name,
            'URL'=>$request->URL,
        ];
        if($request->hidden==''){
        $result=DB::table('styles')->insert($data);
        $msg="Added";
        return back()->with('success', "Data $msg Successfully!");
        }else{
        $result=DB::table('styles')->where('id',$request->hidden)->update($data);   
        $msg="Updated";
        return redirect()->route('style.templates')->with('success', "Data $msg Successfully!");
        }
        // if($result){
        //return back()->with('success', "Data $msg Successfully!");
        // }
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
        return  back()->withErrors($errors)->withInput();
    }
  }
}
