{{-- resources/views/emails/contact-form.blade.php --}}
@component('mail::message')
# Nova Mensagem de Contato do Site NatanFiuza.dev.br

Você recebeu uma nova mensagem através do formulário de contato.

**Nome:** {{ $formData['name'] }}

**E-mail:** [{{ $formData['email'] }}](mailto:{{ $formData['email'] }})

**Assunto:** {{ $formData['subject'] }}

---

**Mensagem:**
@component('mail::panel')
{{ $formData['message'] }}
@endcomponent

---

{{ config('app.name') }}
@endcomponent
