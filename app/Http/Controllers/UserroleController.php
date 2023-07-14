<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\RoleConnect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserroleController extends Controller
{
    public function index()
    {
        $userRoles = UserRole::all();
        $roleConnects = RoleConnect::all();

        $userRoleIds = [];

        foreach ($roleConnects as $roleConnect) {
            $userRoleId = $roleConnect->userrole_id;

            if (!in_array($userRoleId, $userRoleIds)) {
                $userRoleIds[] = $userRoleId;
            }
        }

        return view('userroles.index', compact('userRoles', 'roleConnects', 'userRoleIds'));
    }

    public function updateRoleConnect(Request $request)
    {
        $userRoleIds = $request->input('userRoleIds', []);
        $userId = Auth::id();
    
        // Get the existing role connects for the user
        $existingRoleConnectIds = RoleConnect::where('usertype_id', $userId)->pluck('userrole_id')->toArray();
    
        // Find the role connects to be deleted
        $roleConnectsToDelete = array_diff($existingRoleConnectIds, $userRoleIds);
    
        // Find the role connects to be added
        $roleConnectsToAdd = array_diff($userRoleIds, $existingRoleConnectIds);
    
        // Delete role connects that are no longer selected
        RoleConnect::where('usertype_id', $userId)->whereIn('userrole_id', $roleConnectsToDelete)->delete();
    
        // Create new role connects for selected options
        foreach ($roleConnectsToAdd as $userRoleId) {
            RoleConnect::create([
                'userrole_id' => $userRoleId,
                'usertype_id' => $userId,
            ]);
        }
    
        return redirect()->back()->with('success', 'Role Connect updated successfully.');
    }
    

    
}

