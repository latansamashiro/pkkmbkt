<?php
namespace App\Actions\Audit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class AuditTrail
{
    // retrieved : after a record has been retrieved.
    // creating : before a record has been created.
    // created : after a record has been created.
    // updating : before a record is updated.
    // updated : after a record has been updated.
    // saving : before a record is saved (either created or updated).
    // saved : after a record has been saved (either created or updated).
    // deleting : before a record is deleted or soft-deleted.
    // deleted : after a record has been deleted or soft-deleted.
    // restoring : before a soft-deleted record is going to be restored.
    // restored : after a soft-deleted record has been restored.


    public function creating(Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'created_by_id')) {
            $model->created_by_id = auth()->id() ?? null;
        }
        if (Schema::hasColumn($model->getTable(), 'updated_by_id')) {
            $model->updated_by_id = auth()->id() ?? null;
        }
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function created(Model $model)
    {
    }

    public function updating(Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'updated_by_id')) {
            $model->updated_by_id = auth()->id() ?? null;
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function updated(Model $model)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function deleted(Model $model)
    {
        //
    }

    // /**
    //  * Handle the user "restored" event.
    //  *
    //  * @param  \App\User  $user
    //  * @return void
    //  */
    // public function restored(User $user)
    // {
    //     //
    // }

    // /**
    //  * Handle the user "force deleted" event.
    //  *
    //  * @param  \App\User  $user
    //  * @return void
    //  */
    // public function forceDeleted(User $user)
    // {
    //     //
    // }
}
