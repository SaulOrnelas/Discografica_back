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
        return "Disco insertado";
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
        return "Disco modificado";
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
        return "Disco eliminado";
    }
}
