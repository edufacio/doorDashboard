<?php


namespace App\Backend;

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
        /**
         * @var Door[] $doors
         */
        $rooms = array();
        foreach ($doors as $door) {
            $roomId = $door->getRoom();

            if (!isset($rooms[$roomId])) {
                $rooms[$roomId] = new Room();
                $rooms[$roomId]->setRoom($roomId);
            }
            $type = $door->getType();
            if ($type == TypeConstants::MAIN) {
                $rooms[$roomId]->setStatus($this->getStatusForMain($door));
            } else {
                $wc = new WC();
                $wc->setId($door->getId());
                $wc->setStatus($door->getStatus());
                $rooms[$roomId]->addWc($wc);
            }
        }
        return $rooms;
    }


    public function update($room, $type, $id, $status) {
        $door = Door::where('room', '=', $room)
            ->where('type', 'type', $type)
            ->where('type', 'id', $id)
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
