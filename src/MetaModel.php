<?php

namespace LeeMason\Metable;


use Illuminate\Database\Eloquent\Model;

class MetaModel extends Model{

    use Metable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * How to treat each attribute.
     *
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'value' => 'string',
    ];

}