<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-10 18:25:53
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-11 23:17:33
 */

namespace Domain\Client;

use Domain\Client\Requests\Store;

class Controller extends \Domain\Core\Http\Controller
{
    public function store(Store $request)
    {
        $data   = $request->all();
        $client = new Client;
        $client->fill($data);
        $client->save();

        return $client;
    }
}
