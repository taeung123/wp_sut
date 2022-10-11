<?php

use Illuminate\Database\Schema\Blueprint;
use NF\Database\Connect\NFDatabase;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateContactTable extends NFDatabase
{
    private $table = 'input_contact';

    public function up()
    {
        global $wpdb;
        $table_name_with_prefix = $wpdb->prefix . $this->table;
        if (!Capsule::Schema()->hasTable($table_name_with_prefix)) {
            Capsule::Schema()->create($table_name_with_prefix, function($table){
                $table->increments('id');

                $table->timestamps();
            });
        }
    }

    public function down() {
        global $wpdb;
        $table_name_with_prefix = $wpdb->prefix . $this->table;
        if (Capsule::Schema()->hasTable($table_name_with_prefix)) {
            Capsule::Schema()->drop($table_name_with_prefix);
        }
    }
}
