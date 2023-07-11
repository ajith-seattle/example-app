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
    //    $userId = Usertype::where('id', $usertype_id)->value('usertype_id');

 $userId = Auth::id();
        // Delete existing role connects for the current user
        RoleConnect::where('usertype_id', $userId)->delete();

        // Create new role connects based on the selected checkboxes
        foreach ($userRoleIds as $userRoleId) {
            RoleConnect::create([
                'userrole_id' => $userRoleId,
                'usertype_id' => $userId,
            ]);
        }

        return redirect()->back()->with('success', 'Role Connect updated successfully.');
    }
}

