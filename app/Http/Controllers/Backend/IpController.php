<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\Menu;
use DB;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $title = "Ip List";
        $slug  = "Ip List";
        $blackList= DB::table('blocklist')
            // ->groupby('ip_address')
            ->get();
            
        return view('backend.content.information.ip_list',['blackList'=>$blackList, 'slug'=>$slug, 'title'=>$title]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function blocked(Request $request, $id)
    {
        
        $status = $request->status;
        $blackList= DB::table('blocklist')
                      ->where('id', $id)
                ->update(['status' => $status]);
       return 201;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $value=Information::where('key',$slug)->first();
        $value->value=$request->value;
        $value->update();
        return redirect()->back()->with('message','Info Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information)
    {
        //
    }
}
