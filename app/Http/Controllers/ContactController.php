<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Para enviar email
use App\Mail\ContactFormMail; // Um Mailable que você criaria
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'subject.required' => 'O campo assunto é obrigatório.',
            'message.required' => 'O campo mensagem é obrigatório.',
            'message.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
        ];
        // 1. Validar os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ],$messages);

        if ($validator->fails()) {
            // Se a validação falhar, o Inertia lida com isso automaticamente
            // ao retornar para a página anterior com os erros.
            // Não é necessário fazer nada especial aqui se você está usando form helper do Inertia.
            // Se quiser ser explícito:
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // 2. Enviar o e-mail
        try {
            // Defina para quem o e-mail será enviado (seu e-mail de administrador)
            $adminEmail = env('MEU_EMAIL');
            Mail::to($adminEmail)->send(new ContactFormMail($validatedData));

            // 3. Redirecionar de volta com uma mensagem de sucesso (para Inertia)
            return redirect()->back()->with('success', 'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');

        } catch (\Exception $e) {
            // Logar o erro (opcional, mas recomendado)
            Log::error('Erro ao enviar e-mail de contato: ' . $e->getMessage());

            // Redirecionar de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Desculpe, ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente mais tarde.');
        }
    }
}
