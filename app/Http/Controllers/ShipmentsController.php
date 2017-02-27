<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Laracasts\Flash\Flash;

use App\Shipment;

class ShipmentsController extends Controller
{
    public function createShipment(){
        return view('admin.shipment.create');
    }
    public function storeShipment(Request $request){
        
        $shipment = new Shipment($request->all());
        $shipment->save();
        
        Flash::success('Se ha agregado con éxito');
        
        return redirect()->route('admin.config.index');
    }
    public function editShipment($id){
        
        
        return view('admin.shipment.edit', ['shipment' => Shipment::find($id)]);
    }
    public function updateShipment(Request $request, $id){
        
        $shipment = Shipment::find($id);
        $shipment->fill($request->all());
        $shipment->save();
        
        Flash::success('Se ha actualizado con éxito');
        return redirect()->route('admin.config.index');
    }
    public function destroyShipment($id){
        Shipment::destroy($id);
        Flash::success('Se ha eliminado con éxito');
        return back();
    }
}
