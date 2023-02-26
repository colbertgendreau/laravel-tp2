<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Document;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->only('g-recaptcha-response');



        // good stuff
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6|max:20'
        // ]);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', 'max:10', Password::min(2)],
            'password_confirmation' => 'required|same:password',  // Pas besoin de cette ligne?
        ]);



        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        
        $etudiant = new Etudiant;
        $etudiant->users_id = $user->id;
        $etudiant->save();
        

        $to_name = $request->name;
        $to_email = $request->email;
        $body= "<a href=''>Clique pour confirmer</a>";

        Mail::send('email.mail', $data = [
            'name' => $to_name,
            'body' => $body

        ],
        function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('courriel test Laravel');
        }
    );

        return redirect()->back()->withSuccess(trans('lang.msg_1'));
        // return redirect(route('login'))->withSuccess('User enregistré');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');


        if (!Auth::validate($credentials)) :
            return redirect(route('login'))
                ->withErrors(trans('auth.failed'))  // POUR TRADUCTION
                ->withInput();
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->get('remember'));

        return redirect()->intended('dashboard')->withSuccess('Signed in');  // intended, cest pour rediriger vers la page qui voullait etre accedé
    }

    public function dashboard()
    {
        if (Auth::check()) {


            $userId = Auth::user()->id; // chercher le id de l'user


            $blogs = BlogPost::all()
                            ->where('user_id', "=", $userId);  // chercher tout les articles qui ont le meme user_id que le id de l'utilisateur

            $documents = Document::all()
                            ->where('user_id', "=", $userId);  // chercher tout les articles qui ont le meme user_id que le id de l'utilisateur


            return view('dashboard', ['blogs' => $blogs], ['documents' => $documents], ['userId' => $userId]);
            // $name = Auth::user()->name;
        }
        return redirect(route('login'))->withErrors('Vous netes pas autorisé');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect(route('login'));
    }
    
    
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
    
    public function tempPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|exists:users|email',
        ]);

        $user = User::where('email', $request->email)->get();
        $user = $user[0];
        $userId=$user->id;
        $tempPass= Str::random(25);
        $user->temp_password = $tempPass;
        $user->save();

        $link="<a href='http://localhost:8000/new-password/".$userId."/".$tempPass.
        "'>Cliquez ici pour réinitialiser votre mot de passe</a>";
        
        $to_email = $request->email;
        $to_name = $user->name;

        Mail::send('email.mail', $data = [
            'name' => $to_name,
            'body' => $link,
        ],

        function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('reinitialiser le mot de passe');
        }
        );


        return $link; // Wrong return

    }

    public function newPassword(User $user, $tempPassword)
    {
    if ($user->temp_password === $tempPassword) {
    return view ('auth.new-password');
    }
    return redirect('forgot-password')->withErrors(
    'Les identifiants ne correspondent pas ');
    }

    public function storeNewPassword(User $user, $tempPassword, Request $request)
    {
    if ($user->temp_password === $tempPassword) {
        $request->validate([
            'password' => 'required|min:6|max:20|confirmed'
        ]);

        $user->temp_password = NULL;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('login')->withSuccess(
            trans('lang.msg_success'));

    }
    return redirect('forgot-password')->withErrors(
    'Les identifiants ne correspondent pas ');
    }


}
