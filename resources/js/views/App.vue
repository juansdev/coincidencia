<template>
    <HistoryComponent :listSearchHistorical="listSearchHistorical"
                      @searchHistoricalUUID="(newSearchHistoricalUUID)=>{searchHistoricalUUID=newSearchHistoricalUUID}"></HistoryComponent>
    <Navbar :CSRF="CSRF">
        <button
            aria-controls="drawer-navigation"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white md:text-white md:bg-blue-700 md:hover:bg-blue-800 md:focus:ring-4 md:focus:ring-blue-300 md:font-medium md:rounded-lg text-sm md:px-5 md:py-2.5 md:mr-2 md:dark:bg-blue-600 md:dark:hover:bg-blue-700 md:focus:outline-none md:dark:focus:ring-blue-800"
            data-drawer-show="drawer-navigation" data-drawer-target="drawer-navigation"
            type="button">
            Historial de consultas
        </button>
    </Navbar>
    <div
        :class="'div flex flex-col items-center '+(Object.keys(results).length?'justify-start gap-5 p-4':'justify-center')"
        style="min-height: 92vh;">
        <div v-if="!Object.keys(results).length"
             class="md:w-3/6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <Search :CSRF="CSRF"
                    :customParentClass="searchCustomParentClass" :results="results" languageAnnyang="es-ES"
                    @results="(newResults)=>{results=newResults}"></Search>
        </div>
        <Table v-if="Object.keys(results).length" :listData="results?.matches">
            <Search :CSRF="CSRF"
                    :customParentClass="searchCustomParentClass" :results="results" languageAnnyang="es-ES"
                    @results="(newResults)=>{results=newResults}"></Search>
        </Table>
    </div>
</template>

<script>
import Navbar from "../components/NavbarComponent.vue";
import Search from "../components/app/SearchComponent.vue";
import Table from "../components/TableComponent.vue";
import {consumeAPI, openSwal} from "../common/functions";
import HistoryComponent from "../components/HistoryComponent.vue";

export default {
    components: {Navbar, Search, Table, HistoryComponent},
    data: () => ({
        results: {},
        Object: Object,
        CSRF: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        searchCustomParentClass: 'flex flex-col md:flex-row flex-wrap items-end gap-5 justify-end',
        listSearchHistorical: [],
        searchHistoricalUUID: undefined
    }),
    watch: {
        searchHistoricalUUID: function (newSearchHistoricalUUID) {
            const getPersonPublicBySearchLog = () => consumeAPI(this.CSRF, `get_person_public_by_search_log?uuid=${newSearchHistoricalUUID}`, 'GET').then(async results => {
                this.results = results;
            });
            openSwal({
                titleSwal: 'Recuperando consulta...',
                callbackAPIs: [getPersonPublicBySearchLog],
                mode: 'loading'
            });
        }
    },
    mounted() {
        consumeAPI(this.CSRF, `search_log`, 'GET').then(async res => {
            const {data} = res;
            this.listSearchHistorical = data;
        });
    }
}
</script>
