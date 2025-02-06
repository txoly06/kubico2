<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // Estatísticas principais
        $totalUsers = User::count();
        $totalProperties = Property::count();
        $propertiesByType = Property::select('type', DB::raw('count(*) as total'))
                                    ->groupBy('type')
                                    ->get();

        $mostFavoritedProperties = Property::withCount('favoritedBy')
                                           ->orderBy('favorited_by_count', 'desc')
                                           ->take(5)
                                           ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalProperties', 'propertiesByType', 'mostFavoritedProperties'));
    }
}