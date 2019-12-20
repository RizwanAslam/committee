<?php

namespace App\Observers;

class CommonObserver
{
    /**
     * Handle to the Member "created" event.
     *
     * @param  \App\Member $member
     * @return void
     */
    public function created($model)
    {
        //
    }

    /**
     * Handle the Member "updated" event.
     *
     * @param  \App\Member $member
     * @return void
     */
    public function updated($model)
    {
        //
    }

    /**
     * Handle the Member "deleted" event.
     *
     * @param  \App\Member $member
     * @return void
     */
    public function deleted($model)
    {
        //
    }

    /**
     * @param $model
     */
    public function updating($model)
    {
        if (auth()->check()) {
            $model->company_id = auth()->user()->company_id;
        }
    }

    /**
     * @param $model
     */
    public function creating($model)
    {
        if (auth()->check()) {
            $model->company_id = auth()->user()->company_id;
        }
    }
}
