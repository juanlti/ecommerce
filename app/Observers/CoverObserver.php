<?php

namespace App\Observers;

use App\Models\Cover;

class CoverObserver
{
    //CoverObserver es una clase  que se encarga de observar los eventos de la clase Cover cuando: se crea un nuevo objeto, se actualiza un objeto, se elimina un objeto, etc.
    /*
     * creating: Se llama antes de crear un nuevo registro en la base de datos.
       created: Se llama después de crear un nuevo registro en la base de datos.
        updating: Se llama antes de actualizar un registro existente.
        updated: Se llama después de actualizar un registro existente.
        saving: Se llama antes de guardar un modelo (tanto en creaciones como en actualizaciones).
        saved: Se llama después de guardar un modelo.
        deleting: Se llama antes de eliminar un registro.
        deleted: Se llama después de eliminar un registro.
        restoring: Se llama antes de restaurar un registro eliminado (soft delete).
        restored: Se llama después de restaurar un registro.
     */
    // para utilizar cualquier clase de observadores, se debe registrar en Providers/EventServiceProvider.php
    /* en el metodo boot, aca se registran los Observadores y los listeners
    public function boot(): void
    {

         \App\Models\Cover::observe(\App\Observers\CoverObserver::class);

    }
    */

    // ANTES DE QUE SE CREE UN OBJETO DE TIPO COVER, SE OBTIENE EL ULTIMO NUMERO DE ORDEN EN LA BD, Y SE LE SUMA +1, PARA ASIGNARLO AL NUEVO OBJETO DE COVER
    //SI NO HAY NINGUN OBJETO EN LA BD, SE ASIGNA 1
    public function creating(Cover $cover)
    {
        $cover->order = Cover::max('order') + 1;

    }


}

