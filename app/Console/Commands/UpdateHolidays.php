<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use App\Holiday;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:holidays {country=ph} {region=ZMB}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // env('CALENDARINDEX_TOKEN', '6f2bd927201ba4b22bb57df08db0c517e51732de')
        $this->getData($this->argument('country'), $this->argument('region'));
    }

    public function getData($country = 'PH', $region = 'ZMB')
    {
        $url = 'https://calendarific.com/api/v2/holidays?';
        $url .= 'api_key='.env('CALENDARINDEX_TOKEN', '6f2bd927201ba4b22bb57df08db0c517e51732de').'&';
        $url .= 'country='.$country.'&';
        $url .= 'year='.Carbon::now()->year;

        $c = new Client;

        $return = $c->request('GET', $url);

        $res = json_decode((string) $return->getBody(), true)['response']['holidays'];
        if(count($res)) {
            foreach($res as $holiday) {
                if(in_array('National holiday', $holiday['type']) || in_array('Observance', $holiday['type'])) {
                    $h = Holiday::updateOrCreate([
                        'name'          => array_key_exists('name', $holiday) ? $holiday['name'] : $holiday['name'],
                        'type'          => implode(', ', $holiday['type']),
                        'country'       => $country,
                        'observance'    => explode('T', $holiday['date']['iso'])[0],
                    ]);
                }

            }
        }

        echo 'Successfully pulled data from CalendarIndex API';

    }
}
