<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Workshop;
use App\Fee;
use App\Participant;	
use App\Member;

class ParticipantsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/
    public function listParticipant(){
        //$participants = Participant::find(1);
        $participants = DB::select("SELECT `participants`.*,`fees`.`amount` FROM `participants`, `fees`WHERE `fees`.`id` = `participants`.`fee_id`");
        return view('participants.index', compact('participants'));
    }

    public function register(){
        $workshop = Workshop::where('workshopStatus','=','Publish');
        $fees = DB::select("SELECT `fees`.`id`, `categories`.`categoryName`,`fees`.`amount` FROM `fees`, `categories` WHERE `fees`.`category_id` = `categories`.`id` AND `categories`.`categoryStatus` = 'Public'");

        return view('participants.register', compact('fees','workshop'));
    }

    public function order($fee_id){
        $workshops = Workshop::all();
        return view('participants.order',compact('workshops','fee_id'));
    }

    public function paymentOption(){
        return view('participants.payoption');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addParticipant(){
    	$workshops = Workshop::all();
        return view('participants.add',compact('workshops'));
    }

    public function grade($parent)
    {
    	//$workshop_id = $request->parent;
    	$fees = DB::select("SELECT `fees`.`id`, CONCAT(`categories`.`categoryName`,' ',`fees`.`amount`) AS categoryFee FROM `fees`, `categories` WHERE `fees`.`category_id` = `categories`.`id` AND `fees`.`workshop_id` = $parent");
    	//$data = "<select name='fee' id='fee' class='form-control'>";
    	$data="";
    	foreach($fees as $fee){
    		$data .="<option value='$fee->id'>$fee->categoryFee</option>";
    	}
    //	$data.="<select>";
    	return $data;
    }

    public function getMember($memno)
    {
    	$members = DB::select("SELECT * FROM `members` 
    		WHERE `members`.`memberNo` = '$memno'");

    	foreach ($members as $member) {
    		$data = array('member_id' => $member->member_id, 
    		'surname' => $member->memberSurname, 'othername' => $member->memberOthernames);
    	}

    	return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveParticipant(Request $request){

    	$participant = new Participant();
    	$participant->workshop_id = $request->workshop;
    	$participant->fee_id = $request->fee;
    	$participant->participantLastname = $request->Lastname;
    	$participant->participantOthername = $request->Othername;
    	$participant->participantEmail = $request->Email;
    	$participant->participantTicket = str_random(5); //$request->Ticket;
  		$participant->participantPhone = $request->Phone;

        if ($participant->save()){
            \Session::flash('message', 'Participant successfully added!');
            return redirect('participants/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailParticipant($id){
        $participant = Participant::find($id);
        return view('participants.detail',compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editParticipant($id){
        $participant = Participant::find($id);
        return view('participants.edit',compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateParticipant(Request $request, $id){

        $participant->workshop_id = $request->workshop;
    	$participant->fee_id = $request->fee;

    	if (!empty($request->Lastname)){
    		$participant->participantLastname = $request->Lastname;
    	}
    	if (!empty($request->Othername)){
    	    $participant->participantOthername = $request->Othername;
    	}
    	if (!empty($request->Email)){
    	    $participant->participantEmail = $request->Email;
    	}
    	if (!empty($request->Ticket)){
    	    $participant->participantTicket = $request->Ticket;
    	}
    	if (!empty($request->Phone)){
    		$participant->participantPhone = $request->Phone;
    	}
  		
        $Participants = Participant::find($id);
        
        if ($participant->save()){
            \Session::flash('message', 'Participant successfully updated!');
           // return redirect()->back();
            return redirect('participants/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteParticipant($id){
        $participants = Participant::find($id);
        $participants->delete();

        \Session::flash('flash_message', 'Participant successfully Deleted!');

        return redirect()->back();
    }
}
