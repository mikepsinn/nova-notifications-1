<?php


namespace Mirovit\NovaNotifications\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MarkAsReadController
{
    /**
     * @param Request $request
     * @param $notification
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(Request $request, $notification)
	{
	    $n = $request
            ->user()
            ->unreadNotifications()
            ->find($notification);
	    if(!$n){
	        throw new \Exception("Notification not found: ".print_r($notification, true));
        }
		$markRead = $n->markAsRead();

		return Response::json([
			'notification' => $request
				->user()
				->notifications()
				->find($notification),
		]);
	}
}