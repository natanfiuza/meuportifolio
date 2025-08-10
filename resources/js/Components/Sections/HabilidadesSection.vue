<script setup>

const skills = {
    backend: {
        title: 'Backend',
        items: ['PHP (Laravel)', 'Python (Django, Flask)', 'Node.js (Express)', 'API RESTful']
    },
    frontend: {
        title: 'Frontend',
        items: ['JavaScript (ES6+)', 'Vue.js, jQuery', 'HTML5, CSS3 (Sass/SCSS)', 'Tailwind CSS, Bootstrap']
    },
    databaseDevOps: {
        title: 'Database & DevOps',
        items: ['MySQL, PostgreSQL, MS Sql', 'Docker, Git, CI/CD (GitHub Actions)', 'Linux,  Apache', 'AWS (EC2, S3)']
    }
};
</script>

<template>
    <section class="py-20 px-6 bg-gray-800 text-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Minhas Habilidades</h2>
            <p class="text-lg max-w-3xl mx-auto mb-12 text-gray-300">
                Desenvolvedor full stack com experiência em diversas tecnologias, especializado em PHP, Laravel, Python
                e JavaScript.
            </p>
            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-gray-700 p-8 rounded-xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-2xl font-semibold text-indigo-400 mb-4 backend">{{ skills.backend.title }}</h3>
                    <ul class="text-left space-y-2 text-gray-300">
                        <li v-for="item in skills.backend.items" :key="item" class="flex items-center ">
                            <svg class="w-5 h-5 text-indigo-400 mr-2 shrink-0 backend" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ item }}
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-gray-700 p-8 rounded-xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-2xl font-semibold text-indigo-400 mb-4 frontend">{{ skills.frontend.title }}</h3>
                    <ul class="text-left space-y-2 text-gray-300">
                        <li v-for="item in skills.frontend.items" :key="item" class="flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2 shrink-0 frontend" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ item }}
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-gray-700 p-8 rounded-xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-2xl font-semibold text-indigo-400 mb-4 devops">{{ skills.databaseDevOps.title }}</h3>
                    <ul class="text-left space-y-2 text-gray-300">
                        <li v-for="item in skills.databaseDevOps.items" :key="item" class="flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2 shrink-0 devops" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ item }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.backend {
   color: #6198f1;
}
.frontend {
    color: #bf84fa;
}
.devops {
    color: #5fdd82;
}
</style>
