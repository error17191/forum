<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {view} {--f}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a view';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $viewName = $this->argument('view');
        $isForced = $this->option('f');
        $viewPath = $this->makeViewPath($viewName);
        if(!$isForced && $this->viewExists($viewPath)){
            $this->error('View Already Exists');
            return;
        }
        $this->makeView($viewPath);
        $this->info('View Created Successfully');
    }

    function makeViewPath($viewName)
    {
        return str_replace('.', '/', $viewName) . '.blade.php';
    }

    function viewExists($viewPath)
    {
        return Storage::disk('views')->exists($viewPath);
    }

    function makeView($viewPath)
    {
        Storage::disk('views')->put($viewPath, '');
    }
}
