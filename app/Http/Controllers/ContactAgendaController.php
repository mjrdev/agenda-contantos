<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactAgendaRequest;
use App\Http\Requests\ContactAgendaUpdateRequest;
use App\Models\ContactAgenda;
use App\Services\ContactAgendaService;
use Illuminate\Http\Request;

class ContactAgendaController extends Controller
{
    public function __construct(
        private ContactAgendaService $service
    ) {}
    public function store(ContactAgendaRequest $request)
    {
        return $this->service->createContact($request);
    }

    public function index()
    {
        return $this->service->getContacts();
    }

    public function show(ContactAgenda $contactAgenda)
    {
        return $contactAgenda;
    }

    public function destroy(ContactAgenda $contactAgenda)
    {
        return $this->service->deleteContact($contactAgenda);
    }

    public function update(ContactAgendaUpdateRequest $request, ContactAgenda $contactAgenda)
    {
        return $this->service->updateContact($contactAgenda, $request->all());
    }
}
