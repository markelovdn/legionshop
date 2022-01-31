<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = 'products.csv';
        $file = fopen($fileName, 'r');

        $carbon = new Carbon();
        $now = $carbon->now()->toDateTimeString();

        $i = 0;
        $insert = [];
        while ($data = fgetcsv($file, 1000, ';')) {
            if ($i++ == 0) continue;
            $id = $data[0];
            if (empty($id)){
                $id = null;
            }
            $insert[] = [
                'id' => $data[0],
                'name' => $data[1],
                'description' => $data[2],
                'price' => $data[3],
                'picture' => $data[4],
                'category_id' => $data[5],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        Product::upsert($insert, ['id'], ['name', 'description', 'price', 'picture', 'category_id']);
        fclose($file);
    }
}
