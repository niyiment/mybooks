<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workshop;

class WorkshopsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listWorkshop(){
        $workshops = workshop::all();
        return view('workshop.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addWorkshop(){

        return view('workshop.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveWorkshop(Request $request){

        //$filename = public_path('certificates/a.png');
        $filename ="";
        if ($request->file('certificate')) {
            $file             = $request->file('certificate');
            $filename         = str_random(12);
            $fileExt          = $file->getClientOriginalExtension();
            $allowedExtension = ['jpg', 'jpeg', 'png'];
            $destinationPath  = public_path('certificate');
            if (!in_array($fileExt, $allowedExtension)) {
                return redirect()->back()->with('message', 'Extension not allowed');
            }
            $filename = $filename . '.' . $fileExt;
            $file->move($destinationPath, $filename);

        }

    	$workshop = new Workshop();
    	$workshop->workshopTheme		=	$request->theme;
        $workshop->workshopCPD			=	$request->cpd;
        $workshop->workshopVenue		=	$request->venue;
    $workshop->workshopStartDate = date_format(date_create($request->start_date), 'Y-m-d');
    $workshop->workshopEndDate = date_format(date_create($request->end_date), 'Y-m-d');
        $workshop->workshopOrganizer	=	$request->organizer;
        $workshop->workshopCertificate 	=	$filename;
        $workshop->workshopStartTime 	=	$request->start_time;
        $workshop->workshopEndTime 		=	$request->end_time;
        $workshop->workshopDescription  =   $request->description;
        $workshop->workshopStatus       =   $request->status;

        if ($workshop->save()){
            \Session::flash('message', 'Workshop successfully added!');
           return redirect('workshops/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailWorkshop($id){
        $workshop = Workshop::find($id);
        return view('workshop.detail',compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editWorkshop($id){
        $workshop = Workshop::find($id);
        return view('workshop.edit',compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWorkshop(Request $request, $id){

        $filename = "";
        if ($request->file('certificate')) {

          $filename = $request->file('certificate')->store('certificates');

          /*$genId = str_random(12);
          $filename = $request->file('certificate')->storeAs('certificates',$genId);*/
        }

        $Theme        =   $request->theme;
        $CPD          =   $request->cpd;
        $Venue        =   $request->venue;
        $StartDate    = date_format(date_create($request->start_date), 'Y-m-d');
        $EndDate      = date_format(date_create($request->end_date), 'Y-m-d');
        $Organizer    =   $request->organizer;
        $Certificate  =   $filename;
        $StartTime    =   $request->start_time;
        $EndTime      =   $request->end_time;

        /*//$edit = Employee::findOrFail($id);
        $edit = Employee::where('user_id', $id)->first();*/
        $workshop = Workshop::find($id);
        $workshop->workshopStatus =$request->status;
        if (!empty($Theme)){
            $workshop->workshopTheme = $Theme;
        }
        if (!empty($CPD)){
            $workshop->workshopCPD = $CPD;
        }
        if (!empty($Venue)){
            $workshop->workshopVenue = $Venue;
        }
        if (!empty($StartDate)){
            $workshop->workshopStartDate = $StartDate;
        }
        if (!empty($EndDate)){
            $workshop->workshopEndDate = $EndDate;
        }
        if (!empty($Organizer)){
            $workshop->workshopOrganizer = $Organizer;
        }
        if (!empty($Certificate)){
            $workshop->workshopCertificate = $Certificate;
        }
        
        if (!empty($StartTime)){
            $workshop->workshopStartTime = $StartTime;
        }
        if (!empty($EndTime)){
            $workshop->workshopEndTime = $EndTime;
        }
        if (!empty($request->description)){
            $workshop->workshopDescription = $request->description;
        }

        if ($workshop->save()){
            \Session::flash('message', 'Workshop successfully updated!');
           // return redirect()->back();
            return redirect('workshops/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteWorkshop($id){
        $workshop = Workshop::find($id);
        $workshop->delete();

        \Session::flash('flash_message', 'Workshop successfully Deleted!');

        return redirect()->back();
    }
}
