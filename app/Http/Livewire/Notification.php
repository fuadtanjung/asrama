<?php

namespace App\Http\Livewire;

use App\Postingan;
use Carbon\Carbon;
use Livewire\Component;

class Notification extends Component
{

    public $postingan;
    public $notif;

    public function mount(){
        $this->postingan = Postingan::where('updated_at','1970-11-11')->get();
        $this->notif = Postingan::where('updated_at','1970-11-11')->get()->count();
    }

    public function render()
    {
        return view('livewire.notification');
    }

   public function updateNotif(){

    $this->postingan = Postingan::where('updated_at','1970-11-11')->get();
    $this->notif = Postingan::where('updated_at','1970-11-11')->get()->count();
   }

    public function halaman()
    {
        foreach($this->postingan as $value){
            $data = Postingan::where('updated_at','1970-11-11')->first();
            $data->updated_at = Carbon::now();
            $data->update();
        }
        return redirect('postinganpembina');
    }
}
