<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Tache;
Use App\User;
use Illuminate\Support\Facades\Auth;

class TacheControlleur extends Controller
{

    // store all users
    public $users;

    public function __construct()
    {
        $this->users=User::getAllUsers();
    }
    public function test(){
        //dd("sddghs");
        return view('taches.test');
    }
    /**
     * Assign a tache to user
     * @param App\Tache @tache
     * @param App\User @user
     * @return \Illuminate\Http\Response
     */
    public function affectedto($id, User $user){
        /*
        $tache = Tache::findOrFail($id);
        $tache->affectedTo_id = $user->id;
        $tache->affectedBy_id = Auth::user()->id;*/
        dd("gflghkfh");
        //$tache->update();
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$datas = Tache::All();
        //$this->data['tache']=Tache::All();
        $userId = Auth::user()->id;
       
        $this->data['tache']=Tache::where(['affectedTo_id' => $userId])->orderBy('id','desc')->paginate(10);
        //$this->data['tache']=Tache::paginate(10);
        $this->data['users']=$this->users;
        
        /*
        $this->data['tache']=Tache::All()->reject( function ($tache){
            return $tache->done == 0;
        });*/
        return view('taches.index', $this->data);
        
    }
    /**
     * Affichage de liste de taches
     */
    public function done(){
        $this->data['tache']=Tache::where('done',1)->paginate(10);
        $this->data['users']=$this->users;
        return view('taches.index', $this->data);
    }
    /**
     * Affichage de liste de taches
     */
    public function undone(){
        $this->data['tache']=Tache::where('done',0)->paginate(10);
        $this->data['users']=$this->users;
        return view('taches.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taches.create');
    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tache = new Tache();

        $tache->creator_id=Auth::user()->id;
        $tache->affectedTo_id =Auth::user()->id;
        $tache->nom=$request->nom;
        $tache->description = $request->description;
        $tache->save();
        return redirect()->route('taches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['tache']=Tache::find($id);
        return view('taches.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tache = Tache::findOrFail($id);
        if (!isset ($request->done)) {
            $request['done'] = 0;
        }
        $tache->update($request->all());
        return redirect()->route('taches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tache=Tache::find($id);
        $tache->delete();
        return back();
    }
    /**
     * faire terminé une tache
     */
    public function makedone(Tache $tache){
        $tache->done = 1;
        $tache->update();
        return back();
    }
    /**
     * Changer status en non terminer
     */
    public function makeundone(Tache $tache){
        $tache->done = 0;
        $tache->update();
        return back();
    }
}
