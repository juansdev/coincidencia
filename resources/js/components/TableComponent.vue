<template>
    <div class="shadow-md sm:rounded-lg w-full">
        <div class="p-4 bg-white dark:bg-gray-900">
            <slot></slot>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3" scope="col">
                        Nombre
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Tipo persona
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Tipo cargo
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Años activo
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Departamento
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Municipio
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Localidad
                    </th>
                    <th class="px-6 py-3" scope="col">
                        % Coincidencia
                    </th>
                </tr>
                </thead>
                <tbody>
                <template v-for="(data, index) in listDataPaginate" v-key="index">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            {{ data.name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ data.person_public.type_person?.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ data.person_public.type_position.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ data.person_public.active_years }}
                        </td>
                        <td class="px-6 py-4">
                            {{ data.person_public.department.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ data.person_public.municipality?.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ data.person_public.location?.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ data.percent_match }}
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
    <nav aria-label="Paginación">
        <ul class="inline-flex items-start -space-x-px">
            <li>
                <button
                    :disabled="currentPage===1"
                    class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    @click="()=>{currentPage-=1}">
                    <span class="sr-only">Anterior</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              fill-rule="evenodd"></path>
                    </svg>
                </button>
            </li>
            <li class="flex overflow-x-scroll" style="max-width: 500px;">
                <button v-for="page in Array.from({length: availablePages}, (_, i) => i)"
                        :class="(currentPage===(page+1)?'bg-gray-50 dark:bg-gray-600':'dark:bg-gray-800 bg-white') +' px-3 py-2 leading-tight text-gray-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'"
                        @click="()=>{currentPage = page+1}">{{ page + 1 }}
                </button>
            </li>
            <li>
                <button
                    :disabled="currentPage===availablePages"
                    class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    @click="()=>{currentPage+=1}">
                    <span class="sr-only">Siguiente</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              fill-rule="evenodd"></path>
                    </svg>
                </button>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: ['listData'],
    data: () => ({
        'listDataPaginate': [],
        'currentPage': 1,
        'perPage': 10,
        'availablePages': 0
    }),
    watch: {
        currentPage: function () {
            this.listDataPaginate = this.listData.slice((this.currentPage - 1) * this.perPage, this.currentPage * this.perPage);
        },
        listData: {
            handler() {
                this.availablePages = Math.ceil(this.listData.length / 10);
                this.listDataPaginate = this.listData.slice((this.currentPage - 1) * this.perPage, this.currentPage * this.perPage);
            },
            immediate: true,
        }
    }
}
</script>
