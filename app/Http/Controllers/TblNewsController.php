<?php

namespace App\Http\Controllers;

use App\Models\TblNews;
use Illuminate\Http\Request;
use App\Http\Resources\TblNewsResource; //add this
use Illuminate\Support\Facades\Validator; //add this
use App\Http\Controllers\Controller;  // add this

class TblNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = TblNews::all();
        return response([
            'data' => TblNewsResource::collection($news),
            'message' => 'Success'
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
            'url_img'=>'required|max:225',
            'judul'=>'required|max:150',
            'isi'=>'required',
        ]);
        
        if($validator->fails()){
            return response([
                'error'=>$validator->errors(),
                'message'=>'Validation error!'
            ]);
        }

        $new_news = TblNews::create($data);

        return response([
            'data'=> new TblNewsResource($new_news),
            'message'=> 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TblNews  $tblNews
     * @return \Illuminate\Http\Response
     */
    public function show(TblNews $news)
    {
        return response([
            'data'=> new TblNewsTResource($news),
            'message'=> 'Success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TblNews  $tblNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TblNews $news)
    {
        $news->update($request->all());
        return response([
            'data' => new TblFaqResource($news),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TblNews  $tblNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblNews $news)
    {
        $news->delete();
        return response([
            'message' => 'Success'
        ], 200);
    }
}
