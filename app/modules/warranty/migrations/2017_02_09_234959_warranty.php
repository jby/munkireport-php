<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Warranty extends Migration
{
    private $tableName = 'warranty';
    private $tableNameV2 = 'warranty_v2';

    public function up()
    {
        $capsule = new Capsule();
        $migrateData = false;

        if ($capsule::schema()->hasTable($this->tableNameV2)) {
            // Migration already failed before, but didnt finish
            throw new Exception("previous failed migration exists");
        }

        if ($capsule::schema()->hasTable($this->tableName)) {
            $capsule::schema()->rename($this->tableName, $this->tableNameV2);
            $migrateData = true;
        }

        $capsule::schema()->create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->unique();
            $table->string('purchase_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('status')->nullable();
            
            $table->index('purchase_date');
            $table->index('end_date');
            $table->index('status');
        });

        if ($migrateData) {
            $capsule::select("INSERT INTO 
                $this->tableName
            SELECT
                id,
                serial_number,
                purchase_date,
                end_date,
                status
            FROM
                $this->tableNameV2");
        }
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists($this->tableName);
        if ($capsule::schema()->hasTable($this->tableNameV2)) {
            $capsule::schema()->rename($this->tableNameV2, $this->tableName);
        }
    }
}