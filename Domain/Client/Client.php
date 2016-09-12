<?php

namespace Domain\Client;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'cpf', 'birthdate'];
}
