<?php

namespace App\Backend;

class Room
{
    private $wcs = array();
    private $room;
    private $status;

    /**
     * @return array
     */
    public function getWcs()
    {
        return $this->wcs;
    }

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }


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
        var_dump("puto");
        $this->status = $status;
    }


    public function toArray() {
        $wcs = array();
        foreach($this->wcs as $wc) {
            $wcs[] = $wc->toArray();
        }
        return array('status' => $this->status, 'roomId' => $this->room, 'wcList' => $wcs);

    }

}
