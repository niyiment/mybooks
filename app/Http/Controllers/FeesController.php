<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Workshop;
use App\Category;
use App\Fee;

class FeesController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $fees = DB::select("SELECT `fees`.`amount`,`fees`.`id`,`workshops`.`workshopTheme`,
            `categories`.`categoryName` FROM `fees`,`workshops`,`categories` 
            WHERE `workshops`.`id` = `fees`.`workshop_id` AND 
                `categories`.id = `fees`.`category_id` ORDER BY `fees`.`workshop_id` ASC;");

        return view('fee.index', ['fees' =>$fees]);
    }

    public function listFee(){
        $fees = DB::select("SELECT `fees`.`amount`,`fees`.`id`,`workshops`.`workshopTheme`,
            `categories`.`categoryName` FROM `fees`,`workshops`,`categories` 
            WHERE `workshops`.`id` = `fees`.`workshop_id` AND 
                `categories`.id = `fees`.`category_id` ORDER BY `fees`.`workshop_id` ASC;");

        return view('fee.index', ['fees' =>$fees]);
    }
    /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     **/
    public function getFees($id)
    {
        $cities = DB::table("fees")
            ->where("state_id",$id)
            ->lists("name","id");
        return json_encode($cities);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFee(){
    	//$workshops = DB::table("workshops")->lists("workshopTheme","id");
    	$workshops = DB::table("workshops")->get();
        $categories = DB::table("categories")->get();

        return view('fee.add',compact('workshops','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveFee(Request $request){

    	$fee = new Fee();
    	$fee->workshop_id	=	$request->workshop;
        $fee->category_id	=	$request->category;
        $fee->amount		=	$request->cfee;

        if ($fee->save()){
            \Session::flash('message', 'Fee successfully added!');
            return redirect('fees/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailFee($id){
        $fee = Fee::find($id);
        return view('fee.detail',compact('fee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editFee($id){
        $fee = Fee::find($id);
        $workshops = DB::table("workshops")->get();
        $categories = DB::table("categories")->get();
        return view('fee.edit',compact('fee','workshops','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFee(Request $request, $id){
        $workshop_id   =   $request->workshop;
        $category_id   =   $request->category;
        $amount        =   $request->cfee;

        $fee = fee::find($id);
        if (!empty($workshop_id)){
            $fee->workshop_id = $workshop_id;
        }
        if (!empty($category_id)){
            $fee->category_id = $category_id;
        }
        if (!empty($amount)){
            $fee->amount = $amount;
        }
        
        if ($fee->save()){
            \Session::flash('message', 'Fee successfully updated!');
           // return redirect()->back();
            return redirect('fees/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFee($id){
        $fee = Fee::find($id);
        $fee->delete();

        \Session::flash('flash_message', 'Fee successfully Deleted!');

        return redirect()->back();
    }
}
