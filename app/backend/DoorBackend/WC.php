<?php

namespace App\Backend;

class WC
{
    private $status;
    private $id;

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function toArray() {
        return array('status' => $this->status, 'id' => $this->id);

    }

}