<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Imgproductos extends Model
{
    // Instancio la tabla 'img_bicicletas' 
    protected $table = 'img_productos';
    
    // Declaro los campos que usaré de la tabla 'img_bicicletas' 
    protected $fillable = ['nombre', 'formato', 'productos_id'];
 
    // Relación Inversa (Opcional)
    public function productos()
    {
    	return $this->belongsTo('App\productos');
    }
 
    
}
 
 
