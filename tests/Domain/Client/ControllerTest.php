<?php
/**
 * @author: Leandro Henrique <henrique@henriquereis.com>
 * @date:   2016-09-10 18:20:57
 * @last modified by:   Leandro Henrique
 * @last modified time: 2016-09-10 18:31:23
 */

namespace Domain\Client;

class ControllerTest extends \TestCase
{
    public function testCreate()
    {
        $name = 'Emtudo';
        $data = [
            'name' => $name,
        ];
        $this->post('client', $data);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $name,
        ]);
        $this->seeInDatabase('clients', [
            'name' => $name,
        ]);
    }
}
