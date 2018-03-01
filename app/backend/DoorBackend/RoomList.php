<?php

namespace App\Backend;

class RoomList
{
    private $rooms = array();

    /**
     * @param mixed $room
     */
    public function getRoom($roomId)
    {
        if (!isset($this->rooms[$roomId])) {
            $room = new Room();
            $room->setRoom($roomId);
            $this->rooms[$roomId] = $room;
        }
        return $this->rooms[$roomId];

    }

    /**
     * @param mixed $room
     */
    public function setRoom($room)
    {
        $this->rooms[$room->getRoom()] = $room;
    }



    public function toArray() {
        $rooms = array();
        foreach($this->rooms as $room) {
            $rooms[] = $room->toArray();
        }
        return $rooms;

    }

}
