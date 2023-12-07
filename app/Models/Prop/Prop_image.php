<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prop_image extends Model
{
    use HasFactory;

    protected $table = "prop_images";

    protected $fillable = [
        'prop_id',
        'image',
    ];

    public $timestamps = true;
}
