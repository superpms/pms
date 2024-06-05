<?php

namespace app\api\package;

class Index extends Common
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
    protected string $login = 'false';

    public function entry()
    {
        // $name = $this->safeParams->get('name);
        $name = $this->request->params('name', 'pmsphp');
        $this->success("hello $name");
    }


}