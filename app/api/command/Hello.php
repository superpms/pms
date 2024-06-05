<?php

namespace app\api\command;

use pms\annotate\Inject;
use pms\app\Command;
use pms\app\inject\command\InputInject;

class Hello extends Command{

    protected array $validate = [
        'name'=>[
            'type'=>COMMAND_ARGUMENT_TYPE,
            'des'=>'name',
            'default'=>'pmsphp'
        ],
        'city'=>[
            'type'=>COMMAND_OPTION_TYPE,
            'des'=>'name',
            'default'=>'北京'
        ]
    ];

    #[Inject(InputInject::class)]
    protected InputInject $input;

    public function entry(): void{
        $this->input->getArguments();
    }
}