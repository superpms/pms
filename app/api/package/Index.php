<?php

namespace app\api\package;

use pms\facade\Db;
use pms\facade\RDb;

class Index extends Common{
    protected array $validate = [
        'name' => [
            'require' => false,
            'type' => 'string',
            'des' => 'name',
        ],
    ];

    protected string|array $method = 'post,get';
    protected string $login = 'false';
    protected bool $token = false;

    public function entry(): void{
        // $name = $this->safeParams['name'];
        $name = $this->request->params('name','pmsphp');
        $this->success("hello $name");
    }

}