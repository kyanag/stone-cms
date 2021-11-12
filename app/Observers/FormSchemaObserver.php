<?php

namespace App\Observers;

use App\Models\Form;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FormSchemaObserver
{
    /**
     * Handle the form "created" event.
     *
     * @param  \App\Models\Form  $form
     * @return void
     */
    public function created(Form $form)
    {
        $table_name = $form->tableName();
        $r = Schema::create($table_name, function(Blueprint $table){
            $table->bigIncrements("id");
            $table->string("cid", 20)->comment("主键");

            $table->timestamps();
            $table->softDeletes();
        });
        var_dump($r);exit();
    }

    /**
     * Handle the form "deleted" event.
     *
     * @param  \App\Models\Form  $form
     * @return void
     */
    public function deleted(Form $form)
    {
        $table_name = $form->tableName();
        Schema::dropIfExists($table_name);
    }
}
