<?php
 
namespace App\Http\Controllers;
 
use App\Notes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
 
class NotesController extends Controller{
	public function index(){
 
        //$Notes  = Notes::all();
		$Notes  = Notes::orderBy('noted', 'DESC')->take(10)->get();
 
        return response()->json($Notes);
 
    }
 
    public function getNote($id){
 
        $Note  = Notes::find($id);
 
        return response()->json($Note);
    }
 
    public function createNote(Request $request){
		//print_r($request->all()); exit;
		//$Note = Notes::create($request->all());
        //$Note = Notes::updateOrCreate($request->all());
		$Note = Notes::updateOrCreate(
		['username' => $request->all()['username'], 'noted' => $request->all()['noted']],
		['notes' => $request->all()['notes']]
		);
 
        return response()->json($Note);
    }
	
	public function getUserNotes($username) {
		//return $username;
		$Notes  = Notes::where('username', $username)->orderBy('noted', 'DESC')->take(10)->get();
		return response()->json($Notes);
	}
 
    public function deleteNote($id){
        $Note  = Notes::find($id);
        $Note->delete();

        return response()->json('deleted');
    }
 
    public function updateNote(Request $request,$id){
        $Note  = Notes::find($id);
		//echo $request->input('notes'); exit;
        $Note->username = $request->input('username');
        $Note->noted = $request->input('noted');
        $Note->notes = $request->input('notes');
        $Note->save();
 
        return response()->json($Note);
    }
}
?>