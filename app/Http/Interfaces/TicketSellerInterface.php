<?php

namespace App\Http\Interfaces;

use Illuminate\Http\JsonResponse;

interface TicketSellerInterface
{
    public function getEvents(): array;
    public function getEventLists(int $eventId): array;
    public function getListPlaces(int $listId): array;
    public function makeReservation(string $name, array $places, int $listId): array;
}
