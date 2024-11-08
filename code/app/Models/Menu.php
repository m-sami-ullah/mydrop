<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['title','nav_id','parent','type','url','sortorder','status'];

    /**
     * Menu belongs to Nav.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nav()
    {
      // belongsTo(RelatedModel, foreignKey = nav_id, keyOnRelatedModel = id)
      return $this->belongsTo(Nav::class);
    }
}
