<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Grade;
use App\Models\Answer;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

use function Laravel\Prompts\search;

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

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('user');
            }
        } else {
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

        return redirect('/accounts')->with('success', 'Registrasi berhasil! , silahkan Login');
    }

public function editAccount($id)
{
    $account = User::find($id);
    return view('edit-account', compact('account'));
}

public function updateAccount(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'nis' => 'required',
        'rombel' => 'required',
        'email' => 'required',
    ]);

    $account = User::find($id);
    $account->name = $validatedData['name'];
    $account->nis = $validatedData['nis'];
    $account->rombel = $validatedData['rombel'];
    $account->email = $validatedData['email'];
    $account->save();

    return redirect()->route('accounts')->with('success', 'Akun siswa berhasil diperbarui.');
}

public function destroyAccount($id)
{
    $account = User::find($id);

    if ($account) {
        $account->delete();
        return redirect()->back()->with('success', 'Akun siswa berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Akun siswa tidak ditemukan.');
    }
}

    public function accounts(Request $request)
    {
        $search = $request->input('search');
        if ($search){
            $accounts = User::where('nis', 'LIKE', "%{$search}%")->paginate(10);
            $accounts->appends(['search' => $search]);
        }else{
            $accounts = User::get();
        }
        
        return view('accounts', compact('accounts'));
    }

    public function report(Request $request)
{
    // Ambil nilai pencarian dari request
    $search = $request->input('search');
    
    // Query data berdasarkan pencarian
    $reportQuery = Answer::with(['user', 'lesson']);
    $gradeQuery = Grade::with(['answer']);

    if ($search) {
        $reportQuery->whereHas('user', function ($query) use ($search) {
            $query->where('nis', 'LIKE', "%{$search}%");
        })->orWhereHas('lesson', function ($query) use ($search) {
            $query->where('minggu', 'LIKE', "%{$search}%");
        });

        $gradeQuery->whereHas('answer', function ($query) use ($search) {
            $query->where('jawaban', 'LIKE', "%{$search}%");
        });
    }

    // Eksekusi query dan paginasi hasilnya
    $report = $reportQuery->paginate(5);
    $grade = $gradeQuery->paginate(5);
    $user = User::get();

    // Tambahkan parameter pencarian ke link paginasi secara manual
    $report->appends(['search' => $search]);
    $grade->appends(['search' => $search]);
    
    // Kirim data ke view
    return view('report', compact('report', 'grade', 'user'));
}

public function report_detail($id)
{
    $answer = Answer::where('user_id', $id)->first();

    if (!$answer) {
        return redirect()->back()->with('back', 'Belum Mengerjakan sama sekali');
    }

    $user = $answer->user;
    $details = Grade::where('answer_id', $answer->id)->get();
    $lesson = Lesson::get();
    return view('report-detail', compact('user', 'answer', 'details', 'lesson'));
}

    public function nilai($id)
    {
        $answers = Answer::where('id', $id)->get();
        return view('nilai', compact('answers'));
    }

    public function store_nilai(Request $request, $lesson_id, $user_id)
    {
        $validatedData = $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
            'answer_id' => 'required', // Add validation rule for answer_id
        ]);

        $response = new Grade();
        $response->lesson_id = $lesson_id;
        $response->user_id = $user_id;
        $response->answer_id = $validatedData['answer_id']; // Set answer_id from form input
        $response->grade = $validatedData['grade'];
        $response->save();
        return redirect()->route('report.detail', ['id' => $user_id])->with('success', 'Nilai sudah ditambahkan');
    }

    public function user()
    {
        $tasks = Lesson::get();
        return view('dashboard-user', compact('tasks'));
    }

    public function task()
    {
        $tasks = Lesson::with('answer')->get();
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

    public function editLesson($id)
{
    $lesson = Lesson::find($id);
    $tasks = Lesson::get(); // Menyediakan variabel $tasks
    return view('edit-lesson', compact('lesson', 'tasks')); // Melewatkan variabel $tasks ke view
}

public function destroyLesson($id)
{
    $lesson = Lesson::where('id', $id)->firstOrFail();
        unlink('assets/materi/' . $lesson['materi']);
        unlink('assets/lkpd/' . $lesson['lkpd']);
        $lesson->delete();
        Lesson::where('id', $id)->delete();
        return redirect('/detail')->with('success', 'Produk telah di hapus');
}


public function store(Request $request)
{
    $request->validate([
        'materi' => 'required',
        'lkpd' => 'required',
        'minggu' => 'required',
    ]);

    $minggu = $request->minggu;
    $materi = $request->file('materi');
    $materiName = 'materi_' . 'minggu_' . $minggu . '.' . $materi->extension();
    $path = public_path('assets/materi/');
    $materi->move($path, $materiName);

    $lkpd = $request->file('lkpd');
    $lkpdName = 'lkpd_' . 'minggu_' . $minggu . '.' . $lkpd->extension();
    $path = public_path('assets/lkpd/');
    $lkpd->move($path, $lkpdName);

    Lesson::create([
        'materi' => $materiName,
        'lkpd' => $lkpdName,
        'minggu' => $request->minggu,
    ]);

    return redirect()->back()->with('success', 'upload succeed!');
}

public function updateLesson(Request $request, $id)
{
    $request->validate([
        'minggu' => 'required',
        'materi' => 'required',
        'lkpd' => 'required',
    ]);

    $lesson = Lesson::find($id);
    $lesson->minggu = $request->minggu;

    // Handle materi file
    if ($request->hasFile('materi')) {
        $materi = $request->file('materi');
        $materiName = 'materi_' . 'minggu_' . $request->minggu . '.' . $materi->extension();
        $path = public_path('assets/materi/');
        $materi->move($path, $materiName);
        $lesson->materi = $materiName;
    }

    // Handle lkpd file
    if ($request->hasFile('lkpd')) {
        $lkpd = $request->file('lkpd');
        $lkpdName = 'lkpd_' . 'minggu_' . $request->minggu . '.' . $lkpd->extension();
        $path = public_path('assets/lkpd/');
        $lkpd->move($path, $lkpdName);
        $lesson->lkpd = $lkpdName;
    }

    $lesson->save();

    return redirect()->route('detail')->with('success', 'Materi berhasil diperbarui');
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


    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('successLogout', 'Logout Succeed');
    }

    public function error()
    {
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
