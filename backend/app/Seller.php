<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logo_url', 'name', 'description', 'shipping_id', 'payment_id', 'user_id',
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
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function shops()
    {
        return $this->hasMany(ShopSeller::class)->select(['url','primary','shop_id']);
    }

    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id')->select('type');
    }

    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function shippings()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id')->select('type');
    }
}
