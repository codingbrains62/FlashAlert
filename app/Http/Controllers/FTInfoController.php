<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FTInfoController extends Controller
{
    public function proxyContent(Request $request)
{
    $urlToProxy = $request->query('url');
    // Ensure that the URL uses HTTPS
    if (strpos($urlToProxy, 'https://') !== 0) {
        return response('Invalid URL', 400);
    }
    // Fetch the external content
    $response = Http::get($urlToProxy);
    return $response->body();
   }
    public function ftinfo(Request $request)
    {
        $data['id'] = $request->query('id');
        // $data['id'] = $request->input('dzones');
        //dd($data['id']);
        // Render the Blade views and get their content
        $data['inforightContent'] = view('frontend.inforight')->render();
        // $data['infoleftContent'] = view('frontend.infoleft')->render();
        $data['infoleftContent'] = view('frontend.infoleft', ['id' => $data['id']])->render();

        // Pass the content to the main view
        return view('frontend.fainfo',$data);
    }
    public function infoleft(Request $request)
    {
        $id = $request->query('id');
        // dd($id);
        return view('frontend.infoleft', ['id' => $id]);
    }
    public function inforight()
    {
        return view('frontend.inforight');
    }
    public function reportcwcReport(Request $request)
    {
        $id = $request->query('id');
        //dd($id);
        $data['region'] = DB::table('regions')->where('id', $id)->first();
        return view('frontend.cwcclosurereport', $data);
    }

   
    
}
