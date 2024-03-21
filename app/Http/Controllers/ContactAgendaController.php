<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactAgendaRequest;
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

    public function show(ContactAgendaRequest $contactAgenda)
    {
        return $contactAgenda;
    }

    public function update(ContactAgendaRequest $contactAgenda, Request $request)
    {
        return $contactAgenda->update($request->all());
    }
}
