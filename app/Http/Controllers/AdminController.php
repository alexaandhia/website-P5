<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Response;
use App\Models\Answer;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }

    public function auth(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin');
            }elseif(Auth::user()->role == 'user'){
                return redirect()->route('user');
            }
         }else{
             return redirect()->back()->with('errorLogin', 'login gagal, silahkan coba lagi');  
         }
    }

    public function admin()
    {
        return view('dashboard-admin');
    }

    public function form()
    {
        return view('form-admin');
    }

    public function detail()
    {
        $tasks = Lesson::get();
        return view('detail', compact('tasks'));
    }

    public function make_account()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'nis' => 'required',
            'rombel' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $validateData['role'] = 'user';
        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);

        return redirect('/accounts')->with('successRegister', 'Registrasi berhasil! , silahkan Login');
    }

    public function accounts()
    {
        $accounts = User::get();
        return view('accounts', compact('accounts'));
    }

    public function report()
    {
        $report = Answer::with(['user', 'lesson'])->paginate(5);
        return view('report', compact('report'));
    }

    public function nilai()
    {
        $answer = Answer::with(['user', 'lesson'])->paginate(5);
        return view('nilai', compact('answer'));
    }

    public function store_nilai()
    {
        $answer = Answer::with(['user', 'lesson'])->paginate(5);
        return view('nilai', compact('answer'));
    }

    public function user()
    {
        $tasks = Lesson::get();
        return view('dashboard-user', compact('tasks'));
    }

    public function task(){
        $tasks = Lesson::get();
        return view('task', compact('tasks')); 
    }

    public function show(Lesson $lesson, $id)
{
    $lessons = Lesson::find($id);
    $lesson_id = $lessons->id; // Extract lesson_id from $lessons
    $user_id = Auth::id(); // Get the currently authenticated user's ID
    $tasks = Lesson::get();
    return view('lesson2', compact('lessons', 'tasks', 'lesson_id', 'user_id'));
}

    public function explanation()
    {
        $tasks = Lesson::get();
        return view('explanation', compact('tasks'));
    }

    public function imt()
    {
        $tasks = Lesson::get();
        return view('imt', compact('tasks'));
    }

    public function answer(Request $request, $lesson_id, $user_id)
{
    $validatedData = $request->validate([
        'kesimpulan' => 'required|string',
        'jawaban' => 'required|string',
    ]);

    $response = new Answer();
    $response->lesson_id = $lesson_id;
    $response->user_id = $user_id; // Pastikan menyimpan user_id
    $response->kesimpulan = $validatedData['kesimpulan'];
    $response->jawaban = $validatedData['jawaban'];
    $response->save();

    // Respon berhasil dengan kode 200
    return redirect('/task')->with('success', 'Pelajaran sudah terisi!');
}


    public function logout(){
        Auth::logout();
        return redirect('/')->with('successLogout', 'Logout Succeed');
    }

    public function error(){
        return view('error');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'materi' => 'required',
            'lkpd' => 'required',
            'minggu' => 'required',
        ]);

        $minggu = $request->minggu;
        $materi = $request->file('materi');
        $materiName = 'materi_'.'minggu_' .$minggu. '.' . $materi->extension(); 
        $path = public_path('assets/materi/');
        $materi->move($path, $materiName);

        $lkpd = $request->file('lkpd');
        $lkpdName = 'lkpd_'.'minggu_' .$minggu. '.' . $lkpd->extension(); 
        $path = public_path('assets/lkpd/');
        $lkpd->move($path, $lkpdName);

        Lesson::create([
            'materi'=> $materiName,
            'lkpd'=> $lkpdName,
            'minggu'=> $request->minggu,
        ]);

        return redirect()->back()->with('success', 'upload succeed!');
    }


    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
