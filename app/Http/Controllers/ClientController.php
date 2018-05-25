<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use Illuminate\Support\Facades\Hash;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->phone = $request->phone;
        $client->zip_code = $request->zip_code;
        $user = self::createUser($request);
        $client->user_id = $user->id;
        $client->location = $request->location;
        $client->save();
        return redirect('clients')->with('success', 'Cliente Cadastrado com Sucesso');
    }
    private function createUser(Request $request)
    {
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('123456');
        $user->save(); 
        return $user;
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
        $client = Client::find($id);
        return view('client.edit', compact('client', 'id'));
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
        $client = Client::find($id);
        $client->phone = $request->phone;
        $client->zip_code = $request->zip_code;
        $client->location = $request->location;
        $user = User::find($client->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $client->save();
        return redirect('clients')->with('success', 'Cliente Atualizado com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->user()->delete();
        $client->delete();
        return redirect('clients')->with('success','Cliente excluído com sucesso');
    }
}
