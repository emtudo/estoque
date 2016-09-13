<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-11 23:02:12
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-12 21:03:04
 */

namespace Domain\Client\Requests;

class Store extends \Domain\Core\Http\Request
{
    public function rules()
    {
        return [
            'name'      => 'required|max:45',
            'cpf'       => 'cpf|unique:clients',
            'birthdate' => 'date|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'cpf.cpf' => 'CPF inválido!',
        ];
    }
}
