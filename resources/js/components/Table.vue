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
                        Localidad
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Municipio
                    </th>
                    <th class="px-6 py-3" scope="col">
                        % Coincidencia
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-6 py-4">
                        Silver
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {}
</script>
