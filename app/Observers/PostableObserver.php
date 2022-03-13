<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostableObserver
{
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Traits\Postable  $postable
     * @return void
     */
    public function created(Model $postable)
    {
        $post = new Post($postable->toPostArray());
        $postable->post()->save($post);
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Traits\Postable  $postable
     * @return void
     */
    public function updated(Model $postable)
    {
        //
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Models\Traits\Postable  $postable
     * @return void
     */
    public function deleted(Model $postable)
    {
        //
    }

    /**
     * Handle the article "restored" event.
     *
     * @param  \App\Models\Traits\Postable  $postable
     * @return void
     */
    public function restored(Model $postable)
    {
        //
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param  \App\Models\Traits\Postable  $postable
     * @return void
     */
    public function forceDeleted(Model $postable)
    {
        //
    }
}
