<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid();
            $table->string('full_name');
            $table->enum("gender", ['MALE', 'FEMALE']);
            $table->date("birthday");
            $table->float("birth_weight", 10, 2);
            $table->float("current_weight", 10, 2);
            $table->string('mother_full_name');
            $table->string('farther_full_name');
            $table->string('guardiant_full_name');
            $table->text('permenent_address');
            $table->string('home_contact_number');
            $table->string('personal_contact_number');
            $table->string('email_address');
            $table->string('emergency_informer_name');
            $table->string('emergency_informer_contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
