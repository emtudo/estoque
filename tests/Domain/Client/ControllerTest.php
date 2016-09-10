<?php
/**
 * @author: Leandro Henrique
 * @date:   2016-09-10 18:20:57
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-10 19:14:15
 */

namespace Domain\Client;

class ControllerTest extends \TestCase
{
    public function testCreate()
    {
        //Sets
        $headers = $this->getHeaders();

        $name = 'Emtudo';
        $data = [
            'name' => $name,
        ];
        $this->post('client', $data, $headers);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $name,
        ]);
        $this->seeInDatabase('clients', [
            'name' => $name,
        ]);
    }
}
