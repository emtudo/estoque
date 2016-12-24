<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-10 18:25:53
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-12-24 09:36:32
 */

namespace Domain\Client;

use Domain\Client\Requests\Store;
use Domain\Client\Requests\Update;

class Controller extends \Domain\Core\Http\Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Store $request)
    {
        $data   = $request->all();
        $client = new Client;
        $client->fill($data);
        $client->save();

        return $client;
    }

    public function update(Update $request, int $clientId)
    {
        $client = Client::find($clientId);
        $client->fill($request->all());
        $client->save();

        return $client;
    }

    public function destroy(int $clientId)
    {
        return Client::destroy($clientId);
    }

    public function show(int $clientId)
    {
        return Client::find($clientId);
    }
}
