<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Door extends Model
{

    public function setRoom($room) {
        return $this->setAttribute('room', $room);
    }

    public function setType($type) {
        return $this->setAttribute('type', $type);
    }

    public function setId($id) {
        return $this->setAttribute('id', $id);
    }

    public function setStatus($status) {
        return $this->setAttribute('status', $status);
    }

    public function setTime($time) {
        return $this->setAttribute('time', $time);
    }

    public function getRoom() {
        return $this->getAttribute('room');
    }

    public function getType() {
        return $this->getAttribute('type');
    }

    public function getId() {
        return $this->getAttribute('id');
    }

    public function getStatus() {
        return $this->getAttribute('status');
    }

    public function getTime() {
        return $this->getAttribute('time');
    }

}
