<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../backend/DoorBackend/RoomBackend.php';


use App\Backend\RoomBackend;
use App\Backend\StatusConstants;
use App\Backend\TypeConstants;
use Illuminate\Http\Request;

class DoorController extends Controller
{

    public function getStatus()
    {
        $backend = new RoomBackend();
        return response()->json($backend->get());
    }

    public function log(Request $request)
    {
        $roomId = $request->input('room');
        if ($roomId === null) {
            $errors[] = 'mandatory param room error';
        }

        $type = $request->input('type');
        if ($type === null || !TypeConstants::isValid($type)) {
            $errors[] = 'mandatory param type error valid values: ' . TypeConstants::getValidValues();
        }

        $status = $request->input('status');
        if ($status === null || !StatusConstants::isValid($status)) {
        $errors[] = 'mandatory param status error valid values: ' . TypeConstants::getValidValues();
    }
        $id = $request->input('id');
        if ($id === null) {
            $errors[] = 'mandatory param id error';
        }

        if (empty($errors)) {
            $backend = new RoomBackend();
            return response()->json($backend->update());
        } else {
            return response()->json($errors);
        }
    }
}