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
        $search = request()->query('search');

        if ($search == '' || is_null($search)) {
            return $this->getModel()::all();
        }
        
        return $this->getModel()::where(
            'email', 'LIKE', '%'. $search. '%'
        )->orWhere('name', 'LIKE', '%'. $search. '%')
        ->orWhere('phone', 'LIKE', '%'. $search. '%')
        ->get();
    }

    public function find($id)
    {
        return $this->getModel()::find($id);
    }

    public function update(ContactAgenda $contact, array $payload)
    {
        return $contact->update($payload);
    }

    public function delete(ContactAgenda $contact)
    {
        return $contact->delete();
    }	
}
