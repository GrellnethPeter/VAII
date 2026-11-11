<?php

namespace App\Models;

use Framework\Core\Model;

class Kategoria extends Model
{
    protected static ?string $tableName = 'kategorie';
    protected static ?array $fillable = ['nazov'];

    public ?int $id = null;
    public ?string $nazov = null;
}