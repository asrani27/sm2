<?php

namespace App\Http\Controllers;

use App\Jobs\DispathcWA;
use App\Models\Nomor;
use App\Models\Riwayat;
use GuzzleHttp\Client;
use App\Models\Whatsapp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WAController extends Controller
{
    public function perbaikannomor()
    {
        $data = Nomor::get();
        $data->map(function ($item) {
            $item->nomor = str_replace('+62', '0', $item->nomor);
            $item->save();
            return $item;
        });
        $nomor = Riwayat::get();
        $nomor->map(function ($item) {
            $item->telp = str_replace('+62', '0', $item->telp);
            $item->save();
            return $item;
        });
        Session::flash('success', 'Berhasil');
        return back();
    }
    public function index()
    {
        $data = Whatsapp::get()->map(function ($item) {
            $check = Riwayat::where('whatsapp_id', $item->id)->where('status', null)->first();
            if ($check == null) {
                $item->status = true;
            } else {
                $item->status = false;
            }
            return $item;
        });

        $kontak = Nomor::count();
        return view('admin.wa.index', compact('data', 'kontak'));
    }
    public function delete($id)
    {
        Whatsapp::find($id)->riwayat->map->delete();
        Whatsapp::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function stop($id)
    {
        $data = Riwayat::where('whatsapp_id', $id)->where('status', null)->get();
        $data->map(function ($item) {
            $item->status = 'stop';
            $item->save();
            return $item;
        });
        Session::flash('success', 'Berhasil distop');
        return back();
    }
    public function create()
    {
        return view('admin.wa.create');
    }

    public function store(Request $req)
    {
        $file      = $req->file('file');
        $file_path = $file->getPathname();
        $file_mime = $file->getMimeType('video');
        $file_name = Str::random(10) . str_replace(' ', '', $file->getClientOriginalName());

        $file->storeAs('public/video', $file_name);
        $s = new Whatsapp;
        $s->isi = $req->isi;
        $s->file = $file_name;
        $s->kirim_ke = $req->kirim_ke;
        $s->save();


        $nomor      = Nomor::where('jenis', $req->kirim_ke)->get();
        foreach ($nomor as $key => $item) {

            $check = Riwayat::where('whatsapp_id', $s->id)->where('telp', $item->nomor)->first();
            if ($check == null) {
                $r = new Riwayat();
                $r->telp = $item->nomor;
                $r->whatsapp_id = $s->id;
                $r->save();
            } else {
            }
        }

        Session::flash('success', 'Berhasil disimpan');
        return redirect('/superadmin/wa');
    }
    public function edit($id)
    {
        $data = Whatsapp::find($id);
        return view('admin.wa.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $data = Whatsapp::find($id);
        $data->isi = $req->isi;
        $data->kirim_ke = $req->kirim_ke;
        $data->save();
        Session::flash('success', 'Berhasil diupdate');
        return redirect('/superadmin/wa');
    }
    public function kirim($id)
    {
        $data       = Whatsapp::find($id);
        $nomor      = Nomor::where('jenis', $data->kirim_ke)->get();
        foreach ($nomor as $n) {
            //dd($n);
            DispathcWA::dispatch($n, $data);
        }
        Session::flash('success', 'Berhasil dikirim');
        $data->update([
            'status' => 1,
        ]);
        return back();
    }

    public function status($id)
    {
        $data       = Whatsapp::find($id)->riwayat;

        return view('admin.wa.detail', compact('data'));
    }

    public function sendMessage(Request $req)
    {
        $nomor = Nomor::get();
        $file      = $req->file('file');
        $api_url   = 'http://103.178.83.190:8000/send-message';
        if ($file == null) {
            foreach ($nomor as $n) {
                $client = new Client();
                $response = $client->request("POST", $api_url, [
                    'multipart' => [
                        [
                            'name' => 'text',
                            'contents' => $req->message
                        ],
                        [
                            'name' => 'number',
                            'contents' => $n->nomor,
                        ],
                    ]
                ]);
                $code = $response->getStatusCode();
            }
            return back();
        } else {
            //dd($file);
            $file_path = $file->getPathname();
            $file_mime = $file->getMimeType('video');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/video', $file_name);
            $path = 'https://sahabatmukhyar.com/storage/video/' . $file_name;

            $client = new Client();

            foreach ($nomor as $n) {
                $response = $client->request("POST", $api_url, [
                    'form_params' => [
                        'number' => $n->nomor,
                        'video' => [
                            "url" => $path,
                        ],
                        "caption" => $req->message,
                    ]
                ]);

                $code = $response->getStatusCode();

                sleep(5);
            }
            return back();
        }
    }
}
