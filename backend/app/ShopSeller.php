<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopSeller extends Model
{
    protected $table = 'shop_seller';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller_id', 'shop_id', 'url', 'primary',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function shops()
    {
        return $this->belongsTo(Shop::class, 'shop_id')->select('type');
    }
}
