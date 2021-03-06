<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\SellerScope;

class Seller extends Model
{
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SellerScope);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
