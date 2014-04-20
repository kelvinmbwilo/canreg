<?php

class UsersController extends BaseController {

   
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $user = array(
            'email' => Input::get('username'),
            'password' => Input::get('password')
        );
        $userss = User::where('email',Input::get('username'))->first();
            
        if ($userss && $userss->password == Input::get('password')) {
            return Redirect::route('homepage')
                ->with('flash_error', 'You are successfully logged in.');
        }

        
        // authentication failure! lets go back to the login page
        return Redirect::route('home')
            ->with('flash_error', 'Your username/password combination was incorrect.')
            ->withInput();
//    
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}