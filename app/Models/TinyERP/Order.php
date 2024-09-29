<?php

namespace App\Models\TinyERP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'tinyerp_pedidos';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'numero',
        'numero_ecommerce',
        'data_pedido',
        'data_prevista',
        'nome',
        'valor',
        'id_vendedor',
        'nome_vendedor',
        'situacao',
        'codigo_rastreamento',
        'url_rastreamento',
    ];

    protected $casts = [
        'data_pedido' => 'datetime',
        'data_prevista' => 'datetime',
        'nome_vendedor' => 'array',
    ];
    
    public function setDataPedidoAttribute($value)
    {
        $this->attributes['data_pedido'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d H:i:s');
    }

    public function getDataPedidoAttribute($value)
    {
        if (empty($value)) {
            return;
        }
        
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDataPrevistaAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        $this->attributes['data_prevista'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d H:i:s');
    }

    public function getDataPrevistaAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}