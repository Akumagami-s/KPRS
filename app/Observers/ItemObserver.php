<?php

namespace App\Observers;
use App\sandboxAcc;
use App\User;
use App\Notifications\NewItem;
class ItemObserver
{
    public function created(sandboxAcc $item)
    {
        $author = $item->user;
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewItem($item,$author));
        }
    }
}
