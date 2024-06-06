<?php

namespace app\api\package;

use app\api\Package;
use plugins\superpms\auth\action\AuthAction;

class Index extends Package
{
    protected array $validate = [
        'name' => [
            'require' => false,
            'type' => 'string',
            'des' => 'name',
        ],
    ];

    protected string $contentType = PLAIN_CONTENT_TYPE;

    protected string|array $method = 'post,get';
    protected int $login = LOGIN_TRUE;

    public function entry(): void{
        // $name = $this->safeParams->get('name);
        $name = $this->request->params('name', 'pmsphp');
        $this->success("hello $name");
    }


}