<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageDispatch;

class MessageDispatchController extends Controller
{
    
    public function msgdispatch(Request $request){
        $decodedRegion = $request->input('region');
        $decodedOrgCatSelect = $request->input('orgCatSelect');
        $selectedRegion = $decodedRegion ?? '0';
        $amountpaid= $request->input('yearpaid') ?? '0';
        $age= $request->input('age') ?? '0';
        $selectedorgcat = $decodedOrgCatSelect ?? '0';
        $firstselectbox =$request->input('firstselectbox') ?? '0';
        $year=DB::table('year')->get();
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
       
        $response = $response->orderBy('CatagoryName', 'asc')->orderBy('Name','asc')
        ->paginate(25);
        return view('backend.message-dispatch',compact('data','response','category','selectedRegion','selectedorgcat','amountpaid','year','firstselectbox'));

    }
  // public function mailall(Request $request)
  //   {
  //       try {
  //           $request->validate([
  //               'title' => 'required',
  //               'emailbody' => 'required',
  //               'clientemail'=>'required'
  //           ]);
  //            if (isset($_POST['clientemail']) && is_array($_POST['clientemail'])) {
  //           foreach($_POST['clientemail'] as $mails){
  //             Mail::to($mails)->send(new MessageDispatch($request->title, $request->emailbody)); 
  //           }
  //           } 
  //           return 'Emails sent successfully';
  //           } catch (\Illuminate\Validation\ValidationException $e) {
  //           $errors = $e->validator->errors();
  //           return  back()->withErrors($errors)->withInput();
  //           }
  //   }


public function mailall(Request $request)
{
    try {
        $request->validate([
            'title' => 'required',
            'emailbody' => 'required',
            'clientemail' => 'required|array'
        ]);

        $clientEmails = $request->input('clientemail');

        foreach ($clientEmails as $mail) {
            Mail::to($mail)->send(new MessageDispatch($request->title, $request->emailbody));
        }

        return response()->json(['message' => 'Emails sent successfully','url' => 'message-dispatch'], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
        return response()->json(['errors' => $errors], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
    }
}





}
