<?php
/**
 * @author: Leandro Henrique <henrique@henriquereis.com>
 * @date:   2016-09-10 18:25:53
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-10 18:33:34
 */

namespace Domain\Client;

use Illuminate\Http\Request;

class Controller extends \Domain\Core\Http\Controller
{

    public function store(Request $request)
    {
        $client       = new Client;
        $client->name = $request->name;
        $client->save();

        return $client;
    }
}
