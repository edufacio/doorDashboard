<?php

namespace App\Backend;

require_once __DIR__ . '/Room.php';
require_once __DIR__ . '/RoomList.php';
require_once __DIR__ . '/WC.php';
require_once __DIR__ . '/MainStatusConstants.php';
require_once __DIR__ . '/StatusConstants.php';

use App\Door;
use App\Models;

class RoomBackend
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $doors = Door::all();
        $list = new RoomList();
        /**
         * @var Door[] $doors
         */
        foreach ($doors as $door) {
            $room = $list->getRoom($door->getRoom());
            $type = $door->getType();
            if ($type == TypeConstants::MAIN) {
                $room->setStatus($this->getStatusForMain($door));
            } else {
                $wc = new WC();
                $wc->setId($door->getId());
                $wc->setStatus($door->getStatus());
                $room->addWc($wc);
            }

            $list->setRoom($room);
        }

        return $list->toArray();
    }

    public function update($room, $type, $id, $status)
    {
        $door = Door::where('room', $room)
            ->where('type', $type)
            ->where('id', $id)
            ->first();
        if ($door === null) {
            $door = new Door();
            $door->setRoom($room);
            $door->setType($type);
            $door->setId($id);
        }
        $door->setTime(time());
        $door->setStatus($status);
        $door->save();
        return $door;
    }

    /**
     * @param Door $door
     */
    private function getStatusForMain($door)
    {
        return $door->getStatus() == StatusConstants::OPEN && $door->getTime() > time() - env('TIME_TO_MOP') ? MainStatusConstants::IN_MANTENIENCE : MainStatusConstants::ALLOWED;
    }
}
