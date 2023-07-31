<?php
  
namespace App\Http\Controllers;
   
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
  
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
    
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    function loginindex(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }
    function getUserData($id=null)
    {
        $users = $id?User::find($id):User::all();
    
        return $users;
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companynames = Company::latest()->get();

        return view('users.create',compact('companynames'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
       /*if($request['usertype']==2)
       {
        $com=Company::create($request->all());
       $comp_id= $com->id; 
       // User::create($request->all());
        User::create(array(
            'name' => $request['name'],
            'email'  => $request['email'],
            'password' => $request['password'],
            'usertype' => $request['usertype'],
            'phone' => $request['phone'],
            'company_id' => $comp_id
        ));
       
    }*/
    /*else
    {*/
      //  print_r($request->all());exit;
        //User::create($request->all());
    //}

     User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'phone' => $data['phone'],
        'usertype' => $data['usertype'],
        'company_id' => $data['company_id'],
        'api_token' => Str::random(80)
    ]);
        return redirect()->route('users.index')
                        ->with('success','User created successfully.');
    }
    function addUserData(Request $data)
    {
        $result=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'usertype' => $data['usertype'],
            'company_id' => $data['company_id'],
            'api_token' => Str::random(80)
        ]);
        if($result)
        {
            return ["Result"=>"Data has been saved"];
        }
        else{
            return ["Result"=>"Failed"];
        }
       
    }
     /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $companynames = Company::latest()->get();

        $adminscompanynames = Company::where('id',$user->company_id)->first();

        return view('users.edit',compact('user','companynames','adminscompanynames'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $user->update($request->all());
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect()->route('userroles.index')
                        ->with('success','User deleted successfully');
    }
    public function deleteUserData($id)
    {
        $user = User::find($id);

        $result=$user->delete();
    if( $result)
       {
        return["result"=>"Record has been deleted ".$id];
       }
       else
       {
        return["result"=>"Delete operation is failed ".$id];
       }
       
    }

   

 

}
