<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewUserPlease extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $user = User::firstOrNew(array('name'   => 'ioadmin', 'email'    =>  'admin@intelligentoutsourcing.co.uk'));
        // $user->password = bcrypt('123456');
        // $user->superuser = true;
        // $user->type = 'admin';
        // $user->verified = \Carbon\Carbon::now();
        // $user->email_verified_at = \Carbon\Carbon::now();
        // $user->save();
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
