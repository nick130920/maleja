<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class producto extends Model
{
    // Instancio la tabla 'img_bicicletas' 
    protected $table = 'productos';
    
    // Declaro los campos que usaré de la tabla 'img_bicicletas' 
    protected $fillable = ['nombre', 'formato', 'productos_id'];
 
    // Relación Inversa (Opcional)
    public function imagenesprodutos()
    {
    	return $this->belongsTo('App\Models\Imgproductos');
    }
 
    
}
 