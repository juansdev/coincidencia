<template>
    <Navbar></Navbar>
    <div :class="'div flex flex-col items-center '+(Object.keys(results).length?'justify-start p-4':'justify-center')"
         style="height: 92vh;">
        <div v-if="!Object.keys(results).length"
             class="md:w-3/6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <Search :customParentClass="searchCustomParentClass" :results="results"
                    languageAnnyang="es-ES"
                    @results="(newResults)=>{results=newResults}"></Search>
        </div>
        <Table v-if="Object.keys(results).length">
            <Search :customParentClass="searchCustomParentClass" :results="results"
                    languageAnnyang="es-ES"
                    @results="(newResults)=>{results=newResults}"></Search>
        </Table>
    </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Search from "../components/app/Search.vue";
import Table from "../components/Table.vue";

export default {
    components: {Navbar, Search, Table},
    data: () => ({
        results: {},
        Object: Object,
        searchCustomParentClass: 'flex flex-col md:flex-row flex-wrap items-end gap-5 justify-end'
    })
}
</script>
