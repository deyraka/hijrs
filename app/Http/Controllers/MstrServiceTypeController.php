<?php

namespace App\Http\Controllers;

use App\Models\MstrServiceType;
use App\Http\Resources\MstrServiceTypeResource; //add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //add this
use App\Http\Controllers\Controller; //add this

class MstrServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = MstrServiceType::all();
        return response([
            'data' => MstrServiceTypeResource::collection($services),
            'message' => 'Get All Satker Success'
        ], 200);
    }

    /**
     * Display a listing of the resource based on selected type.
     *
     * @return \Illuminate\Http\Response
     */
    public function listByType($type)
    {
        $services = MstrServiceType::where('jenis', $type)->get();
        /* Contoh dengan pagination */
        /* $services = MstrServiceType::where('jenis', $type)
                        ->paginate(3); */

        return response()->json([
            'success' => true,
            'data' => $services,
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
            'jenis'=>'required|max:1',
            'judul'=>'required|max:50',
            'deskripsi'=>'required'
        ]);
        
        if($validator->fails()){
            return response([
                'error'=>$validator->errors(),
                'message'=>'Validation error!'
            ]);
        }

        $new_service_type = MstrServiceType::create($data);
        // $get_new_satker = MstrSatker::where('id', $request->input('id'))->get();

        return response([
            'data'=> new MstrServiceTypeResource($new_service_type),
            // 'serviceType'=> $get_new_satker,
            'message'=> 'Storing Data Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MstrServiceType  $mstrServiceType
     * @return \Illuminate\Http\Response
     */
    public function show(MstrServiceType $serviceType)
    {
        return response([
            'data'=> new MstrServiceTypeResource($serviceType),
            'message'=> 'Showing Data Success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstrServiceType  $mstrServiceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MstrServiceType $serviceType)
    {
        $serviceType->update($request->all());
        return response([
            'data' => new MstrServiceTypeResource($serviceType),
            'message' => 'Updating Data Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstrServiceType  $mstrServiceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstrServiceType $serviceType)
    {
        $serviceType->delete();
        return response([
            'message' => 'Deleting Success'
        ], 200);
    }
}
