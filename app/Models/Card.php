<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'address',
        'willaya_code',
        'willaya',
        'ville',
        'zip_code',
        'card_name',
        'card_number',
        'card_cvc',
        'card_exp_mm',
        'card_exp_yy'
    ];
    use HasFactory;
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
