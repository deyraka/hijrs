<?php

namespace App\Http\Controllers;

use App\Models\MstrUker;
use App\Http\Resources\MstrUkerResource; // add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //add this
use App\Http\Controllers\Controller; //add this

class MstrUkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukers = MstrUker::all();
        return response([
            'uker' => MstrUkerResource::collection($ukers),
            'message' => 'Get All Uker Success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'id'=>'required|max:2',
            'deskripsi'=>'required|max:50'
        ]);
        
        if($validator->fails()){
            return response([
                'error'=>$validator->errors(),
                'message'=>'Validation error!'
            ]);
        }

        $new_uker = MstrUker::create($data);

        return response([
            'uker'=> new MstrUkerResource($new_uker),
            'message'=> 'Storing Data Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MstrUker  $uker
     * @return \Illuminate\Http\Response
     */
    public function show(MstrUker $uker)
    {
        return response([
            'uker'=> new MstrUkerResource($uker),
            'message'=> 'Showing Data Success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstrUker  $uker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MstrUker $uker)
    {
        $uker->update($request->all());
        return response([
            'uker' => new MstrUkerResource($uker),
            'message' => 'Updating Data Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstrUker  $uker
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstrUker $uker)
    {
        $uker->delete();
        return response([
            'message' => 'Deleting Success'
        ], 200);
    }
}
