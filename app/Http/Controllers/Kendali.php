<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class Kendali extends Controller
{
    public function halamanlogin(){
        return view('Login-aplikasi');
    }
    // public function postlogin(Request $request){
    //     if(Auth::attempt($request->only('email','password'))){
    //         return redirect('/');
    //     }
    //     return redirect('/home');
    // }
     public function postlogin(Request $request){
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required',
            'password' =>'required',
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,

        ];

        if(Auth::attempt($infologin)){
            //kalau otentikasi sukses
            // return 'sukses';
            return redirect('artikel')->with('success','Berhasil login');
        } else {
            //kalau otentikasi gagal akan kembali ke halaman login
            // return 'gagal';
            return redirect('/')->withErrors('Username dan Password yang dimasukkan tidak valid');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/')->with('success','Berhasil logout');
    }
    public function pendaftaran(){
        return view('register');
    }
    public function register(){
        return view('register');
    }
    public function create(Request $request){
        Session::flash('name',$request->name);
        Session::flash('email',$request->email);
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password' =>'required|min:6',
        ],[
            'name.required'=>'Name wajib diisi',
            'email.required'=>'Email wajib diisi',
            'email.email'=>'Silahkan masukkan email yang valid',
            'email.unique'=>'Email sudah pernah digunakan silahkan pilih email yang lain',
            'password.required'=>'Password wajib diisi',
            'password.min'=>'Password minimun diizinkan adalah 6 karakter',
        ]);

        $data =[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ];
        User::create($data);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,

        ];

        if(Auth::attempt($infologin)){
            //kalau otentikasi sukses
            // return 'sukses';
            return redirect('artikel')->with('success',Auth::user()->name.'Berhasil login');
        } else {
            //kalau otentikasi gagal akan kembali ke halaman login
            // return 'gagal';
            return redirect('/')->withErrors('Username dan Password yang dimasukkan tidak valid');
        }
    }
    public function detailArtikel($id)
    {
        $data = Berita::find($id);
    
        if (!$data) {
            abort(404, 'Artikel tidak ditemukan');
        }
    
        return view('detailArtikel', compact('data'));
    }
    //tampilan home
    public function Index(){
        return view('home');
    }
    //halaman tampilan
    public function Tampilkan(){
        $data = Berita::all();
        return view('artikel',['data'=>$data]);
    }

    public function TambahData(){
        return view('tambahArtikel');

    }

    public function simpanArtikel(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }
        Berita::create([
            'kode'=>$request->kode,
            'image'=>$imageName,
            'tanggal'=>$request->tanggal,
            'penulis'=>$request->penulis,
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        return redirect('artikel');
    }
    public function Hapus($id){
        $data =Berita::find($id);

        $data->delete();

        return redirect('artikel');
    }
    public function Edit($id){
            $data = Berita::find($id);
    
            return view('editArtikel', compact('data'));
        }
    
        public function update(Request $request, $id){

 
 // Cek apakah ada file image yang diupload
 if ($request->hasFile('images')) {
    // Ambil file gambar yang diupload
    $image = $request->file('images');
    // Buat nama gambar baru
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    // Pindahkan file gambar ke direktori yang diinginkan
    $image->move(public_path('images'), $imageName);
    if ($data->image && file_exists(public_path('images/' . $data->image))) {
        unlink(public_path('images/' . $data->image));
    }

    // Update nama gambar di database
    $data->image = $imageName;
                
            }
            $data = Berita::find($id);

            $data->tanggal = $request->tanggal;
            $data->title= $request->title;
            $data->penulis = $request->penulis;
            $data->content = $request->content;
    
            $data->save();
    
            return redirect('artikel');
    
        }
    }

