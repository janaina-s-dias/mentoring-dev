<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;

class EnviaEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $nome;
    private $mensagem;
    private $view;
    public function __construct($email, $nome, $tipo, $view)
    {
        $this->email = $email;
        $this->nome = $nome;
        $this->mensagem = $tipo;
        $this->view = $view;
    }
    public function build()
    {
        try{
            $nome = ['nome' => $this->nome, 'mensagem' => $this->mensagem];
            $envio = Mail::send($this->view, $nome, function($message){
                $message->to($this->email);
                $message->subject($this->mensagem.' '.$this->nome);
                $message->from('fatecpgmentoring@gmail.com');
            });
            $erros = $envio->failures();
            return $erros;
        }
        catch(\GuzzleHttp\Exception\ClientException $ex) {}
        
    }
}
