<?php

namespace Robbin\EloquentValueObjects\Commands;

use Illuminate\Console\Command;

class EloquentValueObjectsCommand extends Command
{
    public $signature = 'eloquent-value-objects';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
