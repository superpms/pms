<?php

namespace app\api\command;

use pms\annotate\Inject;
use pms\app\Command;
use pms\app\inject\command\InputInject;
use pms\app\inject\command\OutputInject;
use pms\facade\CommandOutput;

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

    #[Inject(OutputInject::class)]
    protected OutputInject $output;

    public function entry(): void{
        $this->input->getArgument();
//        CommandOutput::writeLn("hello {$this->input->getArgument('name')} {$this->input->getOption('city')}");
        $this->output->writeLn("hello {$this->input->getArgument('name')} {$this->input->getOption('city')}");
    }
}