<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    static public function selectCategory()
    {
        $lang = session()->get('localeDB');

        $query = Category::select(
            'id',
            DB::raw("(case when categorie$lang is null then categorie else categorie$lang
        end) as categorie")
        )
            ->orderby('categorie')
            ->get();

        return $query;
    }
}
