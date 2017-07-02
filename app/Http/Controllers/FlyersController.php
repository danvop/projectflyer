<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests\ChangeFlyerRequest;
use App\Http\Requests\FlyerRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyersController extends Controller
{
    //use Traits\AuthorizesUsers;
    public function __construct()
    {
       $this->middleware('auth', ['except' => ['show']]);
       parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FlyerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());

        flash()->success('Success', 'Your flyer has been created');
         
        return redirect()->back();//temporary
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer'));
    }
    /**
     * Apply a photo to the referenced flyer
     * @param string  $zip
     * @param string  $street
     * @param ChangeFlyerRequest $request
     */
    public function addPhoto($zip, $street, ChangeFlyerRequest $request)
    {
        $this->user = Auth::user();
        
        $photo = $this->makePhoto($request->file('photo'));
        
        Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    /**
     * Setup a new photo
     * @param  UploadedFile $file
     * @return Photo
     */
    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
