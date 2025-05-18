<script setup>
import { ref, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const page = usePage(); // Acesso às props compartilhadas, incluindo 'flash'

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

// Refs para exibir as mensagens
const successMessage = ref(null);
const errorMessage = ref(null);

// Observar mudanças nas mensagens flash
watch(() => page.props.flash.success, (newSuccessMessage) => {
    if (newSuccessMessage) {
        successMessage.value = newSuccessMessage;
        errorMessage.value = null; // Limpa mensagem de erro se houver
        form.reset(); // Limpa o formulário em caso de sucesso
        setTimeout(() => successMessage.value = null, 7000); // Limpa após 7 segundos
    }
}, { immediate: true }); // immediate: true para verificar no carregamento inicial também

watch(() => page.props.flash.error, (newErrorMessage) => {
    if (newErrorMessage) {
        errorMessage.value = newErrorMessage;
        successMessage.value = null; // Limpa mensagem de sucesso se houver
        setTimeout(() => errorMessage.value = null, 7000); // Limpa após 7 segundos
    }
}, { immediate: true });


const submitForm = () => {
    // Limpar mensagens antigas antes de nova submissão
    successMessage.value = null;
    errorMessage.value = null;

    form.post(route('contact.submit'), {
        preserveScroll: true, // Mantém a posição do scroll
        onSuccess: () => {
            // O watcher de page.props.flash.success já deve ter limpado o formulário e setado a mensagem.
            // Se não, você pode fazer form.reset() aqui também.
            // console.log('Formulário enviado com sucesso pelo Inertia!');
        },
        onError: (errors) => {
            // O Inertia já popula form.errors com os erros de validação.
            // A mensagem flash de 'error' do controller seria para erros mais genéricos (ex: falha no envio).
            // console.error('Erro ao enviar formulário:', errors);
            if (!page.props.flash.error && Object.keys(errors).length > 0) {
                // Se houver erros de validação e nenhuma mensagem flash de erro geral
                errorMessage.value = 'Por favor, corrija os erros no formulário.';
            }
        },
        onFinish: () => {
            // form.processing = false; // O useForm já faz isso.
        }
    });
};

const props = defineProps({
    contactInfo: {
        type: Object,
        required: true,
        default: () => ({
            email: 'contato@natanfiuza.dev.br',
            phone: '+55 (83) 99681-2716',
            location: 'João Pessoa, Paraíba',
            social: [
                { name: 'Github', url: 'https://github.com/natanfiuza', iconClass: 'fab fa-github' },
                { name: 'LinkedIn', url: 'https://linkedin.com/in/natanfiuza', iconClass: 'fab fa-linkedin' },
                { name: 'Twitter', url: 'https://twitter.com/natanfiuza', iconClass: 'fab fa-twitter' }, // ou fa-x-twitter
            ]
        })
    }
});
</script>

<template>
    <section id="contato" class="py-20 px-6 bg-gray-800 text-white">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold mb-4 text-center">Entre em Contato</h2>
            <p class="text-lg max-w-3xl mx-auto mb-12 text-gray-300 text-center">
                Tem alguma dúvida ou projeto em mente? Envie uma mensagem e entrarei em contato assim que possível.
            </p>

            <div v-if="successMessage"
                class="mb-6 p-4 bg-green-600/80 border border-green-500 text-white rounded-md text-center">
                {{ successMessage }}
            </div>
            <div v-if="errorMessage"
                class="mb-6 p-4 bg-red-600/80 border border-red-500 text-white rounded-md text-center">
                {{ errorMessage }}
            </div>

            <div class="flex flex-col md:flex-row gap-10 md:gap-16 bg-gray-700 p-8 md:p-12 rounded-xl shadow-2xl">
                <div class="md:w-2/5">
                    <h3 class="text-2xl font-semibold text-indigo-400 mb-6">Informações de Contato</h3>
                    <ul class="space-y-4 mb-8 text-gray-300">
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-indigo-400 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <a :href="`mailto:${contactInfo.email}`" class="hover:text-indigo-300">{{ contactInfo.email
                                }}</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-indigo-400 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                                </path>
                            </svg>
                            <span>{{ contactInfo.phone }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-indigo-400 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ contactInfo.location }}</span>
                        </li>
                    </ul>
                    <h4 class="text-xl font-semibold text-indigo-400 mb-4">Me encontre nas redes</h4>
                    <div class="flex space-x-6">
                        <a v-for="socialLink in contactInfo.social" :key="socialLink.name" :href="socialLink.url"
                            target="_blank" :aria-label="socialLink.name"
                            class="text-gray-400 hover:text-indigo-400 transition-colors">
                            <i :class="[socialLink.iconClass, 'fa-2x']"></i>
                        </a>
                    </div>
                </div>

                <div class="md:w-3/5">
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nome Completo</label>
                            <input type="text" id="name" v-model="form.name"
                                class="w-full bg-gray-800 border text-white px-4 py-2.5 rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500"
                                :class="{ 'border-red-500': form.errors.name, 'border-gray-600': !form.errors.name }"
                                placeholder="Seu nome" required>
                            <div v-if="form.errors.name" class="text-red-400 text-sm mt-1">{{ form.errors.name }}</div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail</label>
                            <input type="email" id="email" v-model="form.email"
                                class="w-full bg-gray-800 border text-white px-4 py-2.5 rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500"
                                :class="{ 'border-red-500': form.errors.email, 'border-gray-600': !form.errors.email }"
                                placeholder="seu.email@provedor.com" required>
                            <div v-if="form.errors.email" class="text-red-400 text-sm mt-1">{{ form.errors.email }}
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-1">Assunto</label>
                            <input type="text" id="subject" v-model="form.subject"
                                class="w-full bg-gray-800 border text-white px-4 py-2.5 rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500"
                                :class="{ 'border-red-500': form.errors.subject, 'border-gray-600': !form.errors.subject }"
                                placeholder="Sobre o que gostaria de falar?" required>
                            <div v-if="form.errors.subject" class="text-red-400 text-sm mt-1">{{ form.errors.subject }}
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Mensagem</label>
                            <textarea id="message" v-model="form.message" rows="5"
                                class="w-full bg-gray-800 border text-white px-4 py-2.5 rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500"
                                :class="{ 'border-red-500': form.errors.message, 'border-gray-600': !form.errors.message }"
                                placeholder="Sua mensagem..." required></textarea>
                            <div v-if="form.errors.message" class="text-red-400 text-sm mt-1">{{ form.errors.message }}
                            </div>
                        </div>
                        <div>
                            <button type="submit" :disabled="form.processing"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                {{ form.processing ? 'Enviando...' : 'Enviar Mensagem' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
