<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['title','status'];
   public function isActive()
  {
    return $this->status==1 ? '':'No';
  }

  /**
   * Nav has many Menus.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function menus()
  {
  	// hasMany(RelatedModel, foreignKeyOnRelatedModel = nav_id, localKey = id)
  	return $this->hasMany(Menu::class);
  }
}
