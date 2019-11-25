<?php

namespace App\Http\Controllers;

use App\Disk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disks = Disk::all();
        return $disks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('disks')->insertGetId($request->all());
        return response()->json(["message" => "Disco insertado", "status" => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function show(Disk $disk)
    {
        return $disk;
    }

    public function search(Request $request)
    {
        if($request->exists('title')){
            $disks = DB::table('disks')
                ->where('title', 'like', '%'.$request->title.'%')
                ->get();
            if(sizeof($disks)==0){
                return response()->json(["message" => "No se encontraron coincidencias", "status" => 0]);
            }
            return $disks;
        } else {
            return response()->json(["message" => "No se recibió ningún parametro", "status" => 0]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disk $disk)
    {
        DB::table('disks')->where('id', $disk->id)->update($request->all());
        return response()->json(["message" => "Disco modificado", "status" => 1]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disk $disk)
    {
        $disk->delete();
        return response()->json(["message" => "Disco eliminado", "status" => 1]);
    }
}
