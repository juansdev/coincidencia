<template>
    <form :class="customParentClass" method="GET" @submit.prevent="onSubmit()">
        <div class="w-full md:w-auto grow">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                   for="voice-search">Buscar por nombre completo</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              fill-rule="evenodd"></path>
                    </svg>
                </div>
                <input id="voice-search"
                       v-model="cleanAndCapitalizeName"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="EJ: Juan Guillermo"
                       required type="text">
                <button class="absolute inset-y-0 right-0 flex items-center pr-3" type="button"
                        @click="activeHandleSpeech()">
                    <svg id="microphone"
                         aria-hidden="true"
                         class="w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"
                              fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="w-full md:w-auto">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="percent-match">Porcentaje
                coincidencia</label>
            <div class="flex">
                <input id="percent-match"
                       v-model="percentMatch"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       max="100"
                       min="0"
                       placeholder="EJ: 90"
                       required
                       type="number"
                       @keyup="fixedPercentMatch">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">%</span>
            </div>
        </div>
        <button
            class="inline-flex w-full md:w-auto justify-center items-center py-2.5 px-3 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="submit">
            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"></path>
            </svg>
            Buscar
        </button>
    </form>
</template>
<script>
import {consumeAPI, openSwal, openSwalVerifyStatus, swal} from "../../common/functions";
import annyang from "annyang";

export default {
    props: ['customParentClass', 'results', 'languageAnnyang', 'CSRF'],
    data: () => ({
        name: '',
        percentMatch: 0
    }),
    computed: {
        cleanAndCapitalizeName: {
            get() {
                return this.cleanAndCapitalize(this.name);
            },
            set(newValue) {
                this.name = this.cleanAndCapitalize(newValue).toLowerCase();
            }
        }
    },
    methods: {
        cleanAndCapitalize: (str) => str.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]/g, '').replace(/\s+/g, ' ').trim().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase()),
        fixedPercentMatch: function (event) {
            if (event.target.value !== '') {
                const newValue = parseInt(event.target.value);
                this.percentMatch = isNaN(newValue) ? 0 : Math.max(0, Math.min(100, newValue));
            } else this.percentMatch = ''
        },
        onSubmit: async function () {
            if (!this.name.trim())
                await swal.fire(
                    'Nombre invalido',
                    'El nombre no puede estar vacío',
                    'error'
                );
            else if (this.percentMatch === '')
                await swal.fire(
                    'El porcentaje de coincidencia no puede estar vacío',
                    '',
                    'error'
                );
            else if (this.percentMatch < 0 || this.percentMatch > 100)
                await swal.fire(
                    'Porcentaje de coincidencia invalido',
                    'El porcentaje debe encontrarse en un rango entre 0 y 100',
                    'error'
                );
            else {
                const searchLog = async () => await consumeAPI(this.CSRF, `search-log`, 'POST', {
                    name: this.name,
                    percent_match: this.percentMatch
                }).then((response) => openSwalVerifyStatus(response).then(async (statusResponse) => {
                    if (statusResponse === 'success')
                        this.$emit('results', response);
                    else this.$emit('results', {});
                }));
                await openSwal({titleSwal: 'Realizando busqueda...', callbackAPIs: [searchLog], mode: 'loading'});
            }
        },
        activeHandleSpeech: function () {
            const currentFill = document.getElementById('microphone').getAttribute('fill');
            if (currentFill === 'currentColor') {
                document.getElementById('microphone').setAttribute('fill', 'blue');
                this.name = "";
                annyang.start();
            } else {
                document.getElementById('microphone').setAttribute('fill', 'currentColor');
                annyang.abort();
                annyang.pause();
            }
        }
    },
    watch: {
        results: {
            handler(newResults) {
                if (Object.keys(this.results).length) {
                    this.name = newResults.searched_name;
                    this.percentMatch = newResults.percent_match;
                }
            },
            immediate: true,
        }
    },
    mounted() {
        annyang.setLanguage(this.languageAnnyang);
        annyang.addCallback("result", (results) => {
            const transcript = results[0];
            this.name += transcript;
        });
    }
}
</script>
