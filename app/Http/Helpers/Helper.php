<?php

namespace App\Http\Helpers;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
class Helper {

    public static function MenuHeaderData(){
        $regionlist['region']= Region::all()->toArray();
        $regionlist['postnewsregion']= DB::table('post_news_region')->get();
        return $regionlist;
    }
    public static function regioncrud(){
        $response = DB::table('regions as r')
        ->leftjoin('zones as z', 'z.zid', '=', 'r.ZoneId')
        ->paginate(25);
        return $response ;
    }

    public static function timezone(){
        $zones=DB::table('zones')->where('CountryCode','US')->orderBy('TimeZone','asc')->get(); 
        return $zones ; 
    }

    // public static function getData($table,$id){
    //     $getData=DB::table($table)->where('id',$id)->get();
    //     return $getData;
    // }
     public static function getData($table, $id='',$order='', $asc=''){
        if($id==''){
            $getData=DB::table($table)->orderBy($order, $asc)->get();  
        }else{
        $getData=DB::table($table)->where('id',$id)->get();
        }
        return $getData;
        
    }
    public static function cityData($table, $id='',$order='', $asc=''){
        if($id==''){
            $getData=DB::table($table)->orderBy($order, $asc)->paginate(3);  
        }else{
        $getData=DB::table($table)->where('RegionID',$id)->orderBy($order, $asc)->get();
        }
        return $getData;
    }
    public static function getDataID($table, $id='', $uid=''){
        if($id=='' && $uid== ''){
         $getData=DB::table($table)->get();
        }else{
         $getData=DB::table($table)->where($uid,$id)->get();
        }
        return $getData;
    }
     public static function getOrgRegion($table, $id, $rid,$type){
        $getData=DB::table($table)->where('OrgID',$id)->where($type, $rid)->get();
        return $getData;
    }
    public static function getPartnersById($id){
        $getData=DB::table('businesspartnergroups')->where('UserID',$id)->orderBy('GroupName','asc')->get();
        return $getData;
    }

    public static function getDataID1($table, $id, $uid){
        $getData=DB::table($table)->where($uid,$id)->get();
        
        return $getData;
        
    }
    public static function getDataID2($table, $id, $uid){
        $getData=DB::table($table)->where($uid,$id)->where('IsPrimary',1)->get();
        
        return $getData;
        
    }
    public static function getSubOrg($id){
        $getData=DB::table('orgs')->where('RootOrgID',$id)->orderBy('Name','asc')->get();
        return $getData;
    }
    public static function groupmember($id){
        $getData=DB::table('orggroupmember')->where('OrgID',$id)->get();
        return $getData;
    }
}