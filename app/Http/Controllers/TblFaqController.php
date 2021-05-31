<?php

namespace App\Http\Controllers;

use App\Models\TblFaq;
use Illuminate\Http\Request;
use App\Http\Resources\TblFaqResource; //add this
use Illuminate\Support\Facades\Validator; //add this
use App\Http\Controllers\Controller;  // add this


class TblFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faq = TblFaq::all();
        return response([
            'data' => TblFaqResource::collection($faq),
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
            'judul'=>'required|max:150',
            'isi'=>'required',
        ]);
        
        if($validator->fails()){
            return response([
                'error'=>$validator->errors(),
                'message'=>'Validation error!'
            ]);
        }

        $new_faq = TblFaq::create($data);

        return response([
            'data'=> new TblFaqResource($new_faq),
            'message'=> 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TblFaq  $tblFaq
     * @return \Illuminate\Http\Response
     */
    public function show(TblFaq $faq)
    {
        return response([
            'data'=> new TblFaqTResource($faq),
            'message'=> 'Success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TblFaq  $tblFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TblFaq $faq)
    {
        $faq->update($request->all());
        return response([
            'data' => new TblFaqResource($faq),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TblFaq  $tblFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblFaq $faq)
    {
        $faq->delete();
        return response([
            'message' => 'Success'
        ], 200);
    }
}
