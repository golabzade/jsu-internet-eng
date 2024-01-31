<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Models\Place;

class PlaceController extends Controller
{
    public function details($id): void
    {
        $place = Place::getById($id);
        $this->view('place.php', [
            'place' => $place,
        ]);
    }
}