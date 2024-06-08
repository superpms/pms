<?php

namespace app\api\package;

use app\api\Package;

class Index extends Package
{
    protected array $validate = [
        'name' => [
            'require' => false,
            'type' => 'string',
            'des' => 'name',
        ],
    ];
    protected string|int|array $method = METHOD_POST|METHOD_GET;

    public function entry(): void{
        // $name = $this->safeParams->get('name);
        $name = $this->request->params('name', 'pmsphp');
        $this->success("hello $name");
    }


}