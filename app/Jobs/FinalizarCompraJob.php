<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\EnviarEmailCompra;



class FinalizarCompraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user, private $pedidos, private $token)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email,$this->user->name)->send(new EnviarEmailCompra([
            'fromName' => $this->user->name,
            'fromEmail' =>    'alessandrosilvamta@gmail.com',
            'fromSubject' =>  'Detalhes das suas compras',
            'pedidos' => $this->pedidos,
            'token' => $this->token
        ]));
    }
}
