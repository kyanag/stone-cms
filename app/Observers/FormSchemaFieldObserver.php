<?php

namespace App\Observers;

use App\Admin\Content\HighTypeManager;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class FormSchemaFieldObserver
{

    protected $typeManager;


    public function __construct(HighTypeManager $typeManager)
    {
        $this->typeManager = $typeManager;
    }

    /**
     * Handle the form field "created" event.
     *
     * @param  \App\Models\FormField  $formField
     * @return void
     */
    public function created(FormField $formField)
    {
        /** @var Form $form */
        $form = $formField->form;
        Schema::table($form->tableName(), function(Blueprint $table) use($formField){
            $this->addColumn(
                $formField->toSchemaColumn(),
                $table
            )->before("created_at");
        });
        Log::info("");
    }

    /**
     * Handle the form field "updated" event.
     *
     * @param  \App\Models\FormField  $formField
     * @return void
     */
    public function updated(FormField $formField)
    {
        /** @var Form $form */
        $form = $formField->form;
        Schema::table($form->tableName(), function(Blueprint $table) use($formField){
            $table->addColumn(
                $formField->toSchemaColumn(),
                $table
            );
        });
    }

    /**
     * Handle the form field "deleted" event.
     *
     * @param  \App\Models\FormField  $formField
     * @return void
     */
    public function deleted(FormField $formField)
    {
        /** @var Form $form */
        $form = $formField->form;
        Schema::table($form->tableName(), function(Blueprint $table) use($formField){
            $table->dropColumn($formField->title);
        });
    }


    /**
     * @param ColumnDefinition $column
     * @param Blueprint $table
     * @return ColumnDefinition
     */
    protected function addColumn(ColumnDefinition $column, Blueprint $table)
    {
        return $table->addColumn($column->get("type"), $column->get("name"), $column->getAttributes());
    }
}
