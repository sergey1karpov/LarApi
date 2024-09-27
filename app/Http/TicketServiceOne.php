<?php

namespace App\Http;

use App\Http\Interfaces\TicketSellerInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class TicketServiceOne implements TicketSellerInterface
{
    private string $base_url = 'https://leadbook.ru/test-task-api';
    private string $token = 'pmN3TQFQalcOhCwZc18KcPMWZyG2EQHz8al9sCYw';

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
        ];
    }

    /**
     * @param string $url
     * @return array
     * @throws ConnectionException
     */
    private function getRequest(string $url): array
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->base_url . $url);

            return $response->json();
        } catch (\Exception $e) {
            throw new ConnectionException($e->getMessage());
        }
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     * @throws ConnectionException
     */
    private function postRequest(string $url, array $data): array
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->asForm()
                ->post($this->base_url . $url, $data);

            return $response->json();
        } catch (\Exception $e) {
            throw new ConnectionException($e->getMessage());
        }
    }

    /**
     * @return array
     * @throws ConnectionException
     */
    public function getEvents(): array
    {
        return $this->getRequest('/shows');
    }

    /**
     * @param int $eventId
     * @return array
     * @throws ConnectionException
     */
    public function getEventLists(int $eventId): array
    {
        return $this->getRequest("/shows/{$eventId}/events");
    }

    /**
     * @param int $listId
     * @return array
     * @throws ConnectionException
     */
    public function getListPlaces(int $listId): array
    {
        return $this->getRequest("/events/{$listId}/places");
    }

    /**
     * @param string $name
     * @param array $places
     * @param int $listId
     * @return array
     * @throws ConnectionException
     */
    public function makeReservation(string $name, array $places, int $listId): array
    {
        return $this->postRequest("/events/{$listId}/reserve", [
            'name' => $name,
            'places' => $places,
        ]);
    }
}
