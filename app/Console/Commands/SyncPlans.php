<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Braintree_Plan;
use App\Plans;

class SyncPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'braintree:sync-plans';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync with online plans on Braintree';

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
        Plans::truncate();

        // Get plans from Braintree
        $braintreePlans = Braintree_Plan::all();
        $discount = '';
        // uncomment the line below to dump the plans when running the command
        //var_dump($braintreePlans);

        // Iterate through the plans while populating our table with the plan data
        foreach ($braintreePlans as $index => $braintreePlan) {
            switch ($index){
                case 0:
                    $discount = "0.00";
                    break;
                case 1:
                    $discount = "20.00";
                    break;
                case 2:
                    $discount = "10.00";
                    break;
            }


            Plans::create([
                'name' => $braintreePlan->name,
                'slug' => str_slug($braintreePlan->name),
                'braintree_plan' => $braintreePlan->id,
                'cost' => $braintreePlan->price,
                'trialDuration' => $braintreePlan->trialDuration,
                'trialDurationUnit' => $braintreePlan->trialDurationUnit,
                'discount' => $discount,
                'description' => $braintreePlan->description,
            ]);
        }

    }
}
