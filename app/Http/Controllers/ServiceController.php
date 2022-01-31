<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

/**
 * Class ServiceController
 * @package App\Http\Controllers
 */
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $services = Service::paginate();

        return view('service.index', compact('services'))
            ->with('i', (request()->input('page', 1) - 1) * $services->perPage());
    }

    public function create(){
        $service = new Service();
        return view('service.create', compact('service'));
    }

    public function store(Request $request){
        request()->validate(Service::$rules);

        $service = Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Servicio creado exitosamente.');
    }

    public function show($id){
        $service = Service::find($id);

        return view('service.show', compact('service'));
    }

    public function edit($id){
        $service = Service::find($id);

        return view('service.edit', compact('service'));
    }

    public function update(Request $request, Service $service){
        request()->validate(Service::$rules);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Servicio actualizado exitosamente');
    }

    public function destroy($id){
        $service = Service::find($id)->delete();

        return redirect()->route('services.index')
            ->with('success', 'Servicio borrado con exito');
    }
}
