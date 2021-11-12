<?php

namespace App\Observers;

use App\Models\ContentModel as Model;

class ContentModelObserver
{


    protected function createCid($model)
    {
        return md5(uniqid(class_basename($model)));
    }

    /**
     * Handle the form field "created" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $model->cid = $this->createCid($model);
    }


    public function created(Model $model)
    {
        /** @var Model $model */
        $content = [
            'cid' => $model['cid']
        ];
        $model->content()->create($content);
    }
}
