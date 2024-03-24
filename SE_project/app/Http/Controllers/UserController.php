<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        if (!$request->user()->roles()->where('role_id', 1)->exists()) {
            return view('home');
        }
        $data = User::with('roles')->latest()->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(Request $request): View
    {
        if (!$request->user()->roles()->where('role_id', 1)->exists()) {
            return view('home');
        }
        $roles = Role::all(); 
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'passwordconfirm' => 'required|string|same:password',
        'roles' => 'required|array', // ตรวจสอบว่ามีการเลือก role ในแบบฟอร์มหรือไม่
        'roles.*' => 'exists:roles,id', // ตรวจสอบว่า role ที่เลือกมามีในฐานข้อมูลหรือไม่
    ]);

    // สร้างผู้ใช้ใหม่
    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // กำหนด role ให้กับผู้ใช้
    $user->roles()->attach($request->roles); // ใช้ attach() เพื่อเพิ่ม role ให้กับผู้ใช้

    // Redirect ไปยังหน้าที่ต้องการพร้อมกับข้อความสำเร็จ
    return redirect()->route('users.index')
        ->with('success', 'User created successfully.');
}
    public function show($id): View
    {
        if (!auth()->user()->roles()->where('role_id', 1)->exists()) {
            return view('home');
        }
        $user = User::with('roles')->find($id); // ดึงข้อมูล user พร้อมกับ roles
        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        if (!auth()->user()->roles()->where('role_id', 1)->exists()) {
            return view('home');
        }
        $user = User::findOrFail($id);
        $roles = Role::all(); // ดึงข้อมูล role ทั้งหมด
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id', // ตรวจสอบว่า role ที่ส่งมามีอยู่จริงในฐานข้อมูลหรือไม่
    ]);

    // ดึงข้อมูลผู้ใช้งาน
    $user = User::findOrFail($id);

    // อัปเดตข้อมูลที่เป็นพื้นฐานของผู้ใช้งาน
    if ($request -> password != null){
        $this->validate($request, [
            'password' => 'required|string|min:8',
            'passwordconfirm' => 'required|string|same:password',
        ]);
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }else{
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
        ]);
    }

    // อัปเดต role ของผู้ใช้งาน
    $user->roles()->sync($request->roles); // ใช้ sync เพื่อเปลี่ยนแปลง role โดยจะลบ role เดิมออกและเพิ่ม role ใหม่ตามที่ส่งมาจากแบบฟอร์ม

    // ส่งกลับไปยังหน้าแสดงข้อมูลผู้ใช้งานพร้อมกับข้อความสำเร็จ
    return redirect()->route('users.index')->with('success', 'User updated successfully');
}
    
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
