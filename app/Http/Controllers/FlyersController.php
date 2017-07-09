<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPhotoRequest;
use App\Http\Requests\FlyerRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->user = Auth::user();
        $flyer = $this->user->publish(
            new Flyer($request->all())
        );

        flash()->success('Success', 'Your flyer has been created');
         
        return redirect(flyer_path($flyer));
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $user = Auth::user();
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer', 'user'));
    }
    /**
     * Apply a photo to the referenced flyer
     * @param string  $zip
     * @param string  $street
     * @param AddPhotoRequest $request
     */
    public function addPhoto($zip, $street, AddPhotoRequest $request)
    {
        $photo = Photo::fromFile($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);
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
