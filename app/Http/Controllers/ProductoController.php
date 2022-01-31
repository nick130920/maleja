<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\producto;
use App\Models\Imgproductos;

class ProductoController extends Controller
{
    // Leer Registros (Read)
    public function index()
    {
        $productos = producto::all();
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
            'name' => 'required',
            'img' => 'required|image|mimes:jpeg,png,JPG,svg|max:1024'
        ]);
        $producto = new Producto;
        $producto->name = $request->input('name');
        $producto->description = $request->input('description');

        if ($imagen = $request->file('img')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto->image = $imagenProducto;
        }
        $producto->save();

        return redirect()->route('/productos')->with('create', 'Producto creado con exito');
    }

    // Leer un Registro específico (Leer)
    public function show($id)
    {
        $producto = producto::find($id);
        $i = 0;
        return view('producto.show', compact('producto', 'i'));
    }

    //  Actualizar un registro (Update)
    public function edit($id)
    {
        $producto = producto::find($id);
        $imagenes = producto::find($id)->imagenesproductos;
        return view('producto.editar', compact('imagenes', 'producto'));
    }

    // Proceso de Actualización de un Registro (Update)
    public function update(Request $request, $id)
    {
        $producto = producto::find($id);
        $producto->name = $request->name;
        $producto->description = $request->description;
        $imgAntigua = $producto->image;
        $saved = false;

        if ($imagen = $request->file('img')) {
            $rutaGuardarImg = 'imagen/';
            $eliminar = public_path() . '/imagen/' . $imgAntigua;
            File::delete($eliminar);
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto->image = $imagenProducto;
        }


        // Si la variable imagen' no esta vacia, actualizamos el registro con las nuevas imágenes
        /* if (!empty($imagen)) {
            // Validamos que el nombre y el formato de imagen esten presentes, tu puedes validar mas campos si deseas
            $this->validate($request, [
                'name' => 'required',
                'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            // Recibimos una o varias imágenes y las actualizamos
            foreach ($request->file('img') as $image) {
                $imagen = $image->getClientOriginalName();
                $formato = $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/', $imagen);
                $producto->image = $imagen;
                // Actualizamos el nuevo nombre de la(s) imagen(es) en la tabla 'img_bicicletas'
                $imagen_table = new Imgproducto;
                $imagen_table->nombre = $imagen;
                $imagen_table->formato = $formato;
                $imagen_table->producto_id = $producto->id;
                $saved = $imagen_table->save();

                // DB::table('img_bicicletas')->insert([
                //'nombre' => $imagen,'formato' => $formato,
                //'producto_id' => $producto->id,'created_at' => date("Y-m-d H:i:s"),
                //'updated_at' => date("Y-m-d H:i:s")]); ESTO QUE ESTA COMENTADO ES UNA MALA PRACTICA
            }
        } */
        $safe = $producto->save();

        if ($safe && $saved) {
            return  redirect()->route('/productos')->with('success', 'Producto con imagenes actualizado con éxito');
        } elseif ($safe) {
            return  redirect()->route('/productos')->with('error', 'Producto actualizado.');
        } else {
            return  redirect()->route('/productos')->with('error', 'Producto no actualizado.');
        }
    }

    // Eliminar un Registro
    public function destroy($id){
        $producto = producto::find($id);

        // Selecciono las imágenes a eliminar
        $imagen = $producto->image;

        // Recorremos la lista de imágenes separadas por coma
        /* foreach ($imagenes as $image) {

            // Elimino la(s) imagen(es) de la carpeta 'uploads'
            $dirimgs = public_path() . '/uploads/' . $image;

            // Verificamos si la(s) imagen(es) existe(n) y procedemos a eliminar
            if (File::exists($dirimgs)) {
                File::delete($dirimgs);
            }
        } */
        $eliminar = public_path() . '/imagen/' . $imagen;
        File::delete($eliminar);

        // Borramos el registro de la tabla 'productos'
        producto::destroy($id);

        // Borramos las imágenes de la tabla 'img_'
        // $producto->imagenesproductos()->delete();

        // Redireccionamos con mensaje
        return back()->with('success', 'Eliminado Satisfactoriamente !');;
    }

    // Eliminar imagen de un Registro
    public function eliminarimagen($id, $bid)
    {
        $productos = Imgproductos::find($id);

        // Elimino la imagen de la carpeta 'uploads'
        $imagen = Imgproductos::select('nombre')->where('id', '=', $id)->get();
        $imgfrm = $imagen->implode('nombre', ', ');
        //dd($imgfrm);
        Storage::delete($imgfrm);

        Imgproductos::destroy($id);

        // Redireccionamos con mensaje
        return redirect()->route('admin/productos/actualizar/' . $bid . '')->with('success', 'Imagen Eliminada Satisfactoriamente !');
    }

    // Detalles del Producto
    public function detallesproducto($id)
    {
        // Seleccionar un registro por su 'id'
        $productos = producto::where('id', '=', $id)->firstOrFail();

        // Seleccionamos las imágenes por su 'id'
        $imagenes = producto::find($id)->imagenesproductos;

        return view('admin/productos.detallesproducto', compact('producto', 'imagenes'));
    }
}
