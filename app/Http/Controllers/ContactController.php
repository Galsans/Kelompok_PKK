<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::all();
        $search = $request->input('search'); // Bisa email atau kode booking
        $searching = Contact::with(['user'])
            ->leftJoin('users', 'users.id', '=', 'contacts.user_id') // Menghubungkan tabel users
            ->when($search, function ($query) use ($search) {
                return $query->where('users.email', 'like', "%$search%") // Gunakan LIKE untuk hasil lebih fleksibel
                    ->orWhere('contacts.subject', 'like', "%$search%");
            })
            ->orderBy('contacts.created_at', 'desc') // Sort default by terbaru
            ->select('contacts.*') // Memastikan hanya mengambil kolom dari contact
            ->get();

        return view('admin.contact.index', compact('contact', 'searching'));
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('user.comment.show', compact('contact'));
    }

    public function tanggapan($id)
    {
        $contact = Contact::where('id', $id)->get();

        // Update data reser$contact
        $contact->update([
            'status' => 'confirm',
        ]);

        return redirect()->back();
    }


    public function userIndex()
    {
        $auth = Auth::id();
        $comment = Contact::where('user_id', $auth)->get();
        return view('user.comment.index', compact('comment'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'subject' => 'string',
            'message' => 'max:500',
            'user_id' => 'exists:users,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $input = $request->all();

        $input['user_id'] = Auth::id();

        $contact = Contact::create($input);

        return redirect()->route('landing');
    }

    public function reply($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.reply', compact('contact'));
    }

    public function storeReply(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->update([
            'tanggapan' => $request->input('tanggapan')
        ]);

        return redirect()->route('admin.contact');
    }

    public function landing()
    {
        $room = Rooms::all();
        return view('landing', compact('room'));
    }
}
