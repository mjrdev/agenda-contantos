<?php

namespace App\Services;

use App\Models\ContactAgenda;
use App\Repositories\ContactAgendaRepository;
use Illuminate\Support\Facades\Storage;

class ContactAgendaService
{
    public function __construct(
        private ContactAgendaRepository $repository
    ) {}

    public function createContact($payload)
    {
        return $this->repository->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
        ]);
    }
    public function getContacts()
    {
        return $this->repository->all();
    }
    public function show($id)
    {
        return $this->repository->find($id);
    }
    public function deleteContact(ContactAgenda $contact)
    {
        return $this->repository->delete($contact);
    }
    public function updateContact(ContactAgenda $contact, array $payload)
    {
        return $this->repository->update($contact, $payload);
    }
}
