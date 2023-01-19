<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Clients\UserHttpClient;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserHttpClient
     */
    private $userClient;

    /**
     * OrderFactory constructor.
     */
    public function __construct()
    {
        $this->userClient = new UserHttpClient();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getAllUsers()
    {
        try {
            $users_data = $this->userClient->getAllUsers();
            $users = [];

            foreach ($users_data as $userId => $user) {
                $users[$userId]['id'] = $userId;
                $users[$userId]['name'] = $user;
            }
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return view('frontend.user.index')
        ->with('usersCount', count($users))
        ->with('users', $users);
    }
}
