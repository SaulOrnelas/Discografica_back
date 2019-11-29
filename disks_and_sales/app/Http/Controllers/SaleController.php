<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        var_dump($request->client_id);
        $client = DB::table('users')->where([
            ['id', '=', $request->client_id],
            ['user_type', '=', 'cliente'],
        ])->get();

        if(sizeof($client)==1){
            $sale =  ['user_id' => $request->user_id, 'client_id' => $request->client_id, 'created_at' => Carbon::now()];
            $id = DB::table('sales')->insertGetId($sale);
            foreach ($request->albums as $album){
                //Actualizar inventario
                DB::table('disks')->where('id', $album["disk_id"])->decrement('stock', $album["quantity"]);
                //Insertar detalle de venta
                $album["sale_id"] = $id;
                DB::table('disk_sales')->insertGetId($album);
            }
            return response()->json(["message" => "Venta realizada", "status" => true]);
        } else {
            return response()->json(["message" => "El cliente no existe", "status" => false]);
        }
    }

    public function getSales(){
        $allsales = DB::select("select sales.id as 'Id', users.name as 'Usuario', sales.client_id as 'Cliente', disk_sales.quantity as 'Cantidad', 
                                disk_sales.price as 'Precio', disks.title as 'Título', sales.created_at as 'Fecha' 
                                    from users join sales on users.id = sales.user_id 
                                    join disk_sales on sales.id = disk_sales.sale_id 
                                    join disks on disk_sales.disk_id = disks.id order by Fecha desc");
        $sales = DB::table('sales')
            ->join('disk_sales', 'sales.id', '=', 'disk_sales.sale_id')
            ->get();
        return $allsales;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
