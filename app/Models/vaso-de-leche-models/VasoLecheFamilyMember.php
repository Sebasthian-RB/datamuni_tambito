<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VasoLecheFamilyMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_document', // Documento de identidad
        'given_name', // Nombre
        'paternal_last_name', // Apellido paterno
        'maternal_last_name', // Apellido materno
        'address', // Dirección
        'education_level', // Nivel educativo
    ];}
