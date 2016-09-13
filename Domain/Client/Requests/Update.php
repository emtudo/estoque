<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-12 21:08:29
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-12 21:14:52
 */

namespace Domain\Client\Requests;

class Update extends Store
{
    public function rules()
    {
        $id = $this->route('client');

        $rules = parent::rules();

        return array_merge($rules, [
            'cpf' => 'cpf|unique:clients,cpf,' . $id,
        ]);
    }
}
