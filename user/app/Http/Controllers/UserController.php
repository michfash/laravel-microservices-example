<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @var $users Collection
     */
    private $users;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->users = new Collection([
            "1" => "User 1",
            "2" => "User 2",
            "3" => "User 3",
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->users->toArray(), 200);
    }

    /**
     * @param int $userId
     * @return JsonResponse
     * @internal param Request $request
     */
    public function show(int $userId): JsonResponse
    {
        if (! $this->users->get($userId)){
            return new JsonResponse(
                'User not found',
                404
            );
        }

        return new JsonResponse($this->users->get($userId), 200);
    }

}
