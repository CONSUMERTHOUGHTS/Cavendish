<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function destroy(Website $website)
    {
        $website->delete();
        return response()->json(['message' => 'Website deleted successfully'], 200);
    }
}
