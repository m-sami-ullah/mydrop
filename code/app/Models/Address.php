<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=["customer_id", "title", "country_id","state_id", "city_id", "area_id", "postcode", "saddress"];
	
	protected $table = "addresses";


    public function getstate()
    {
        return $this->state? $this->state->name:'';
    }
    public function getcity()
    {
        return $this->city? $this->city->name:'';
    }
    public function getarea()
    {
        return $this->area? $this->area->name:'';
    }
    public function getcountry()
    {
        return $this->country? $this->country->name:'';
    }
    public function fulladdress()
    {
        return $this->postcode . ' '.$this->saddress . ' '.$this->getarea()  . ' '.$this->getcity(). ' '.$this->getstate()  ;
    }

    /**
     * Address belongs to Country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        // belongsTo(RelatedModel, foreignKey = country_id, keyOnRelatedModel = id)
        return $this->belongsTo(Country::class);
    }
    /**
     *  Address belongs to State.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        // belongsTo(RelatedModel, foreignKey = state_id, keyOnRelatedModel = id)
        return $this->belongsTo(State::class,'state_id','id');
    }
    /**
     *  Address belongs to City.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        // belongsTo(RelatedModel, foreignKey = city_id, keyOnRelatedModel = id)
        return $this->belongsTo(City::class,'city_id','id');
    }
    /**
     *  Address belongs to Area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        // belongsTo(RelatedModel, foreignKey = area_id, keyOnRelatedModel = id)
        return $this->belongsTo(Area::class,'area_id','id');
    }
    /**
     *  Address belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        // belongsTo(RelatedModel, foreignKey = customer_id, keyOnRelatedModel = id)
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
