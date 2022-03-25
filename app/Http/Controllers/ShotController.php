<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shot;
use App\Models\Player;


class ShotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shots = Shot::all();
        return $shots;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Player $player)
    {
        //executem la partida amb jugador, daus i resultat
        $player = $player->id;
        $dice1 = rand(1,6);
        $dice2 = rand(1,6);

        $result = (($dice1 + $dice2) === 7) ? true : false;    

        //guardem la partida
        $shot = new Shot();

        $shot->dice1 = $dice1;
        $shot->dice2 = $dice2;
        $shot->result = $result;
        $shot->total = ($dice1 + $dice2);
        $shot->player_id = $player;

        $shot->save();

        //actualitzem els estats del jugador
        $playerup = Player::find($player);
        if($result == true){
            $playerup->increStats($playerup);
        }else{
            $playerup->decreStats($playerup);
        }
        
        //retornem json

        return response()->json(compact('player','dice1','dice2','result'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        $playershots = Shot::where('player_id',$player->id)->get();

        return response()->json(compact('playershots'));
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
    public function destroy(Shot $shot, $id)
    {
        //Esborrem jugador
        $playershots = Shot::where("player_id","=","$id");
                        
        $playershots->delete();

        //Actualitzem estats del jugador
        $player = Player::find($id);
        $player->resetStats($player);

        
    }

}
