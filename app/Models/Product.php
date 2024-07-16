<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'description', 'price', 'subcategory_id', 'image', 'option_id', 'id', 'stock', 'image_path'];


    //relacion (inversa)  Subcategory (1) a Product (m)
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }


    // relacion de Products (1) a Feature (m)
    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    // relacion de Products (m) a Opciones (m)
    public function options(): BelongsToMany
    {
        //using(OptionProduct::class) => lo convierte a json al momento de guardarlo/consultarlo utilizando eloquent
        return $this->belongsToMany(Option::class)->using(OptionProduct::class)->withPivot('features')->withTimestamps();
        // con el metodo ->withPivot('value'); obtengo el valor de "value" al momento de realizar
        // con el metodo -> withTimestamps(), actualizo a la ultima fecha
    }


//acceso para obtener la url de la imagen
    protected function image(): Attribute
    {
        return Attribute::make(get: fn() => Storage::url($this->image_path));
    }

    public function scopeCustomOrder($query, $orderBy)
    {

        $query->when($orderBy == 1, function ($query) {
            $query->orderBy('created_at', 'desc');
        })
            ->
            when($orderBy == 2, function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->
            when($orderBy == 3, function ($query) {
                $query->orderBy('price', 'asc');
            });

    }

    public function scopeVerifyFamily($query, $family_id)
    {
        $query->when($family_id, function ($query) use ($family_id) {
            $query->whereHas('subcategory.category', function ($query) use ($family_id) {
                $query->where('family_id', $family_id);
            });
        });
    }

    public function scopeVerifyCategory($query, $category_id)
    {
        $query->when($category_id, function ($query) use ($category_id) {
            $query->whereHas('subcategory', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            });
        });
    }


    public function scopeVerifySubcategory($query, $subcategory_id)
    {
        $query->when($subcategory_id, function ($query) use ($subcategory_id) {
            $query->where('subcategory_id', $subcategory_id);
        });
    }

    public function scopeSelectFeatures($query, $selectedFeaturesCleaned)
    {

        $query->when($selectedFeaturesCleaned, function ($query) use ($selectedFeaturesCleaned) {
            $query->whereHas('variants.features', function ($query) use ($selectedFeaturesCleaned) {
                $query->wherePivotIn('features.id', $selectedFeaturesCleaned);
            });
        });


    }

}

