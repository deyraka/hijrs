<?php

namespace App\Http\Controllers;

use App\Models\MstrSatker; //add this
use App\Http\Resources\MstrSatkerResource; //add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //add this
use App\Http\Controllers\Controller; //add this

class MstrSatkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satkers = MstrSatker::all();
        return response([
            'satker' => MstrSatkerResource::collection($satkers),
            'message' => 'Get All Satker Success'
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
            'id'=>'required|max:5',
            'deskripsi'=>'required|max:50'
        ]);
        
        if($validator->fails()){
            return response([
                'error'=>$validator->errors(),
                'message'=>'Validation error!'
            ]);
        }

        $new_satker = MstrSatker::create($data);
        // $get_new_satker = MstrSatker::where('id', $request->input('id'))->get();

        return response([
            'satker'=> new MstrSatkerResource($new_satker),
            // 'satker'=> $get_new_satker,
            'message'=> 'Storing Data Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MstrSatker  $mstrSatker
     * @return \Illuminate\Http\Response
     */
    public function show(MstrSatker $satker)
    {
        return response([
            'satker'=> new MstrSatkerResource($satker),
            'message'=> 'Showing Data Success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstrSatker  $mstrSatker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MstrSatker $satker)
    {
        $satker->update($request->all());
        return response([
            'satker' => new MstrSatkerResource($satker),
            'message' => 'Updating Data Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstrSatker  $mstrSatker
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstrSatker $satker)
    {
        $satker->delete();
        return response([
            'message' => 'Deleting Success'
        ], 200);
    }
}
