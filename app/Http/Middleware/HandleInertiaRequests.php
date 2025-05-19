<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // return [
        //     ...parent::share($request),
        //     'auth' => [
        //         'user' => $request->user(),
        //     ],
        // ];
        return array_merge(parent::share($request), [
            'auth'  => [
                'user' => $request->user(),
            ],
            // Adicione esta seção para mensagens flash
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error'   => fn()   => $request->session()->get('error'),   // Novas mensagens flash para a newsletter
                'newsletter_success' => fn () => $request->session()->get('newsletter_success'),
                'newsletter_error' => fn () => $request->session()->get('newsletter_error'),
            ],
            // ... (ziggy para rotas, se você usa)
        ]);

    }
}
