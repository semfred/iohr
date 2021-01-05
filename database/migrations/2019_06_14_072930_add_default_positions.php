<?php

use App\Position;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultPositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $positions = [
            [
                'name'  =>  'Operations Manager',
                'mngr'  =>  true
            ],
            [
                'name'  =>  'Admin',
                'mngr'  =>  true
            ],
            [
                'name'  =>  'HR Manager',
                'mngr'  =>  true
            ],
            [
                'name'  =>  'Accountant',
                'mngr'  =>  false,
            ],
            [
                'name'  =>  'IT',
                'mngr'  => false,
            ]
        ];

        foreach($positions as $position) {
            $pos = new Position();
            $pos->name = $position['name'];
            $pos->mngr = $position['mngr'];
            $pos->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
