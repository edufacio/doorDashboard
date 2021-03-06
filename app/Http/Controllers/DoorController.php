<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../backend/DoorBackend/RoomBackend.php';
require_once __DIR__ . '/../../backend/DoorBackend/TypeConstants.php';
require_once __DIR__ . '/../../backend/DoorBackend/StatusConstants.php';

use App\Backend\RoomBackend;
use App\Backend\StatusConstants;
use App\Backend\TypeConstants;
use Illuminate\Http\Request;

class DoorController extends Controller
{

    public function getStatus()
    {
        $backend = new RoomBackend();
        $response = response();

        return $response->json($backend->get(), 200, array(
            'Access-Control-Allow-Methods' => 'HEAD, GET, POST, PUT, PATCH, DELETE',
            'Access-Control-Allow-Headers' => 'accept, content-type, x-xsrf-token, x-csrf-token',
            'Access-Control-Allow-Origin' => '*',
            'Cache-Control' => 'no-cache',
        ));
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
            $errors[] = 'mandatory param status error valid values: ' . StatusConstants::getValidValues();
        }
        $id = $request->input('id');
        if ($id === null) {
            $errors[] = 'mandatory param id error';
        }

        $response = response();
        if (empty($errors)) {
            $backend = new RoomBackend();
            return $response->json($backend->update($roomId, $type, $id, $status));
        } else {
            return $response->json(json_encode($errors));
        }
    }
}