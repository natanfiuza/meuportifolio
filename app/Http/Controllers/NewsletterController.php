<?php
namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email:rfc,dns', // Validação de e-mail mais robusta
                'max:255',
                Rule::unique('newsletter_subscriptions', 'email'), // Garante que o e-mail é único na tabela
            ],
        ], [
            // Mensagens customizadas de erro (opcional, mas bom para UX)
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email'    => 'Por favor, insira um endereço de e-mail válido.',
            'email.max'      => 'O e-mail não pode ter mais de 255 caracteres.',
            'email.unique'   => 'Este e-mail já está inscrito em nossa newsletter.',
        ]);

        if ($validator->fails()) {
            // O Inertia form helper ('useForm') pegará esses erros automaticamente
            // e os colocará em `form.errors.email` no frontend.
            // Podemos também enviar uma mensagem flash de erro genérica se quisermos.
            return redirect()->back()
                ->withErrors($validator)
                ->withInput() // Para repopular o campo (Inertia faz isso com 'form.email')
                ->with('newsletter_error', 'Por favor, verifique o e-mail informado.');
        }

        try {
            NewsletterSubscription::create([
                'email' => $request->input('email'),
            ]);

            return redirect()->back()->with('newsletter_success', 'Obrigado por se inscrever na nossa newsletter!');

        } catch (\Illuminate\Database\QueryException $e) {
            // Captura erros de banco de dados, como violação de constraint unique que possa ter escapado
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de erro do MySQL para 'Duplicate entry'
                return redirect()->back()
                    ->withErrors(['email' => 'Este e-mail já está inscrito em nossa newsletter.'])
                    ->withInput()
                    ->with('newsletter_error', 'Este e-mail já está inscrito.');
            }
            Log::error('Erro ao inscrever na newsletter (DB): ' . $e->getMessage());
            return redirect()->back()->with('newsletter_error', 'Ocorreu um erro ao processar sua inscrição. Tente novamente.');
        } catch (\Exception $e) {
            Log::error('Erro ao inscrever na newsletter (Geral): ' . $e->getMessage());
            return redirect()->back()->with('newsletter_error', 'Ocorreu um erro inesperado. Por favor, tente novamente.');
        }
    }
}
