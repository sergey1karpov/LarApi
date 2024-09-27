<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\TicketSellerInterface;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="Ticket API",
 *    description="ATicket API service",
 *    version="1.0.0",
 * )
 */
class TicketSellerController extends Controller
{
    public function __construct(private readonly TicketSellerInterface $seller) {}

    /**
     * @OA\Get(
     *       path="/api/v1/events",
     *       tags={"SellerApi"},
     *       summary="Список мероприятий",
     *       @OA\Response(
     *           response="200",
     *           description="OK",
     *       )
     *   )
     * @return JsonResponse
     */
    public function getEvents(): JsonResponse
    {
        return response()->json($this->seller->getEvents());
    }

    /**
     * Get Event Lists
     * @OA\Get(
     *       path="/api/v1/events/{eventId}/lists",
     *       tags={"SellerApi"},
     *       summary="Список событий мероприятия",
     *       @OA\Parameter(
     *              name="eventId",
     *              description="Event id",
     *              required=true,
     *              in="path",
     *              @OA\Schema(
     *                  type="integer"
     *              )
     *       ),
     *       @OA\Response(
     *           response="200",
     *           description="OK",
     *       )
     *   )
     * @param int $eventId
     * @return JsonResponse
     */
    public function getEventLists(int $eventId): JsonResponse
    {
        return response()->json($this->seller->getEventLists($eventId));
    }

    /**
     * Get List places
     * @OA\Get(
     *       path="/api/v1/list/{listId}/places",
     *       tags={"SellerApi"},
     *       summary="ListPlaces",
     *       @OA\Parameter(
     *              name="listId",
     *              description="List id",
     *              required=true,
     *              in="path",
     *              @OA\Schema(
     *                  type="integer"
     *              )
     *       ),
     *       @OA\Response(
     *           response="200",
     *           description="OK",
     *       )
     *   )
     * @param int $listId
     * @return JsonResponse
     */
    public function getListPlaces(int $listId): JsonResponse
    {
        return response()->json($this->seller->getListPlaces($listId));
    }

    /**
     * Логин
     * @OA\Post(
     *     path="/api/v1/list/{listId}/reserve",
     *     tags={"SellerApi"},
     *     summary="Забронировать места события",
     *     @OA\Parameter(
     *            name="listId",
     *            description="List id",
     *            required=true,
     *            in="path",
     *            @OA\Schema(
     *                type="integer"
     *            )
     *     ),
     *     @OA\Parameter(
     *            name="name",
     *            description="Name",
     *            required=true,
     *            in="query",
     *            @OA\Schema(
     *                type="string"
     *            )
     *     ),
     *     @OA\Parameter(
     *            name="places[]",
     *            description="Places",
     *            required=true,
     *            in="query",
     *            style="form",
     *            explode=true,
     *            @OA\Schema(
     *                type="array",
     *                @OA\Items(type="integer")
     *            )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="boolean",
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="token",
     *                  type="string",
     *              ),
     *         ),
     *     )
     * )
     * @param ClientRequest $request
     * @param int $listId
     * @return JsonResponse
     */
    public function makeReservation(ClientRequest $request, int $listId): JsonResponse
    {
        return response()->json($this->seller->makeReservation($request->name, $request->places, $listId));
    }
}
