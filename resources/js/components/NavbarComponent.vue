<template>
    <nav
        class="bg-white border-gray-200 px-2 py-5 flex flex-row items-center justify-between mx-auto dark:bg-gray-900"
        style="height: 8vh;">
        <div class="flex flex-row flex-wrap items-center">
            <svg class="w-10 h-10" fill="dodgerblue" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"
                    stroke-linecap="round"
                    stroke-linejoin="round"/>
            </svg>
            <span class="font-semibold dark:text-white">{{ title }}</span>
        </div>
        <div class="flex items-center md:order-2">
            <div class="hidden md:flex md:items-center md:space-x-3">
                <slot></slot>
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    @click="logout()">Cerrar sesión
                </button>
                <button
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                    type="button" @click="switchDarkMode()">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            clip-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="md:hidden navbar relative inline-block text-left">
                <button id="dropdownDefaultButton"
                        class="navbar-toggle inline-flex justify-center items-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-300"
                        data-dropdown-toggle="dropdown"
                        type="button"
                        @click="isOpen = !isOpen">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="h-6 w-6" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"></path>
                    </svg>
                    <svg :class="{'hidden': !isOpen, 'block': isOpen }" class="h-6 w-6" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul aria-labelledby="dropdownDefaultButton"
                        class="py-2 text-sm text-gray-700 dark:text-gray-200">
                        <li>
                            <slot></slot>
                        </li>
                        <li>
                            <button
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                @click="logout()">Cerrar sesión
                            </button>
                        </li>
                        <li>
                            <button
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                type="button" @click="switchDarkMode()">
                                Cambiar de tema
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import {consumeAPI, openSwal} from "../common/functions";

export default {
    props: ['CSRF'],
    data: () => ({
        title: document.querySelector('title').textContent,
        isOpen: false
    }),
    methods: {
        switchDarkMode() {
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        },
        async logout() {
            const useLogout = async () => await consumeAPI(this.CSRF, `logout`, 'POST').then(() => {
                window.location.href = '/';
            });
            await openSwal({
                titleSwal: 'Cerrando sesión...',
                callbackAPIs: [useLogout],
                mode: 'loading'
            });
        }
    },
    mounted: () => {
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark')
            themeToggleDarkIcon.classList.remove('hidden');
        }
    }
}
</script>
