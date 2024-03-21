<?php

namespace App\Repositories;

use App\Models\ContactAgenda;

class ContactAgendaRepository
{
    public function __construct(
        private ContactAgenda $model
    ) {}

    public function getModel()
    {
        return $this->model;
    }
    
    public function create($payload)
    {
        return $this->getModel()::create($payload);
    }

    public function all()
    {
        return $this->getModel()::all();
    }

    public function find($id)
    {
        return $this->getModel()::find($id);
    }
}
