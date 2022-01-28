<?php

namespace App\Http\Controllers;

use App\Models\producto;
use App\Models\Imgproductos;
use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Input;
use Storage;
use Illuminate\Support\Str;
use File;

class ProductoController extends Controller
{
    // Leer Registros (Read)
    public function index()
    {
        $productos = producto::select('id', 'nombre', 'imagen')->get();

        //$ib = Bicicletas::find(3)->imagenesbicicletas;

        //dd($ib);

        // $imagenes = Bicicletas::find(3)->imagenesbicicletas;

        return view('producto.index', compact('productos'));
    }

    // Crear un Registro (Create)
    public function create()
    {
        $productos = producto::all();
        return view('producto.crear', compact('productos'));
    }

    // Proceso de Creación de un Registro
    public function store(Request $request)
    {

     $request->validate([
            'name' => 'required', 'img' => 'required|image|mimes:jpeg,png,svg|max:1024'
        ]);

         $producto = $request->all();

         if($imagen = $request->file('img')) {
             $rutaGuardarImg = 'imagen/';
             $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
             $imagen->move($rutaGuardarImg, $imagenProducto);
             $producto['img'] = "$imagenProducto";
         }

         producto::create($producto);
         return redirect()->route('producto.index');


}

    //     $productos= new producto;
    //     $productos->nombre = $request->name;
    //     $productos->imagen = date('dmyHi');
    //     // $productos->url = Str::slug($request->nombre, '-');  // Acá generamos la URL amigable a partir del nombre y la guardamos en la Base de Datos

    //     $productos->save();

    //     $ci = $request->file('img');

    //     // Validamos que el nombre y el formato de imagen esten presentes, tu puedes validar mas campos si deseas
    //     $this->validate($request, [

    //         'name' => 'required',
    //         'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

    //     ]);

    //     // Recibimos una o varias imágenes y las guardamos en la carpeta 'uploads'
    //     foreach($request->file('img') as $image)
    //         {
    //             $imagen = $image->getClientOriginalName();
    //             $formato = $image->getClientOriginalExtension();
    //             $image->move(public_path().'/uploads/', $imagen);

    //             // Guardamos el nombre de la imagen en la tabla 'img_bicicletas'
    //             DB::table('img_productos')->insert(
    //                 [
    //                     'nombre' => $imagen,
    //                     'formato' => $formato,
    //                     'productos_id' => $productos->id,
    //                     'created_at' => date("Y-m-d H:i:s"),
    //                     'updated_at' => date("Y-m-d H:i:s")
    //                 ]
    //             );

    //         }

    //     // Redireccionamos con mensaje
    //     return redirect('admin/productos')->with('message','Guardado Satisfactoriamente !');
    // }

    // Leer un Registro específico (Leer)
    public function show($id)
    {
        //
    }

    //  Actualizar un registro (Update)
    public function actualizar($id)
    {
        $productos = productos::find($id);

        $imagenes = productos::find($id)->imagenesproductos;

        return view('admin/productos.actualizar', compact('imagenes'), ['productos' => $productos]);
    }

    // Proceso de Actualización de un Registro (Update)
    public function update(ItemUpdateRequest $request, $id)
    {
        $productos= productos::find($id);
        $productos->nombre = $request->nombre;



        $productos->save();

        $ci = $request->file('img');

        // Si la variable '$ci' no esta vacia, actualizamos el registro con las nuevas imágenes
        if(!empty($ci)){

            // Validamos que el nombre y el formato de imagen esten presentes, tu puedes validar mas campos si deseas
            $this->validate($request, [

                'nombre' => 'required',
                'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            ]);

            // Recibimos una o varias imágenes y las actualizamos
            foreach($request->file('img') as $image)
                {
                    $imagen = $image->getClientOriginalName();
                    $formato = $image->getClientOriginalExtension();
                    $image->move(public_path().'/uploads/', $imagen);

                    // Actualizamos el nuevo nombre de la(s) imagen(es) en la tabla 'img_bicicletas'
                    DB::table('img_bicicletas')->insert(
                        [
                            'nombre' => $imagen,
                            'formato' => $formato,
                            'productos_id' => $productos->id,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ]
                    );

                }

        }

        // Redireccionamos con mensaje
        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('admin/productos');
    }

    // Eliminar un Registro
    public function eliminar($id)
    {
        $productos = productos::find($id);

        // Selecciono las imágenes a eliminar
        $imagen = DB::table('img_productos')->where('productos_id', '=', $id)->get();
        $imgfrm = $imagen->implode('nombre', ',');
        //dd($imgfrm);

        // Creamos una lista con los nombres de las imágenes separadas por coma
        $imagenes = explode(",", $imgfrm);

        // Recorremos la lista de imágenes separadas por coma
        foreach($imagenes as $image){

            // Elimino la(s) imagen(es) de la carpeta 'uploads'
            $dirimgs = public_path().'/uploads/'.$image;

            // Verificamos si la(s) imagen(es) existe(n) y procedemos a eliminar
            if(File::exists($dirimgs)) {
                File::delete($dirimgs);
            }

        }


        // Borramos el registro de la tabla 'productos'
        productos::destroy($id);

        // Borramos las imágenes de la tabla 'img_'
        $productos->imagenesproductos()->delete();

        // Redireccionamos con mensaje
        Session::flash('message', 'Eliminado Satisfactoriamente !');
        return Redirect::to('admin/productos');
    }

    // Eliminar imagen de un Registro
    public function eliminarimagen($id, $bid)
    {
        $productos = Imgproductos::find($id);

        $bi = $bid;

        // Elimino la imagen de la carpeta 'uploads'
        $imagen = Imgproductos::select('nombre')->where('id', '=', $id)->get();
        $imgfrm = $imagen->implode('nombre', ', ');
        //dd($imgfrm);
        Storage::delete($imgfrm);

        Imgproductos::destroy($id);

        // Redireccionamos con mensaje
        Session::flash('message', 'Imagen Eliminada Satisfactoriamente !');
        return Redirect::to('admin/productos/actualizar/'.$bi.'');
    }

    // Detalles del Producto
    public function detallesproducto($id)
    {
        // Seleccionar un registro por su 'id'
        $productos = productos::where('id','=', $id)->firstOrFail();

        // Seleccionamos las imágenes por su 'id'
        $imagenes = productos::find($id)->imagenesproductos;

        return view('admin/productos.detallesproducto', compact('productos', 'imagenes'));
    }

}
