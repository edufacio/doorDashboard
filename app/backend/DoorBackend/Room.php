<?php

namespace App\Backend;

class Room
{
    private $wcs = array();
    private $room;
    private $status;


    /**
     * @param WC $wc
     */
    public function addWc($wc)
    {
        $this->wcs[] = $wc;
    }

    /**
     * @param mixed $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



}
