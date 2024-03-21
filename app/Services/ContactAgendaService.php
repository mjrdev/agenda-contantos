<?php

namespace App\Services;

use App\Repositories\ContactAgendaRepository;
use Illuminate\Support\Facades\Storage;

class ContactAgendaService
{
    public function __construct(
        private ContactAgendaRepository $repository
    ) {}

    public function createContact($payload)
    {
        $path = Storage::put('public', $payload['picture']);
        $url = Storage::url($path);

        return $this->repository->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'picture' => $url,
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
}
