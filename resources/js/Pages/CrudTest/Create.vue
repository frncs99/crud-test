<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import Back from '@/Icons/Back.vue';
import Spinner from '@/Icons/Spinner.vue';

const crudTest = reactive({
    name: '',
    description: '',
    is_enabled: true,
});

const crudTestErrors = reactive({
    name: '',
    description: '',
    is_enabled: '',
});

const submitCrudTest = async () => {
    // clear errors
    crudTestErrors.name = crudTestErrors.description = crudTestErrors.is_enabled = '';

    // disable submit button, to prevent duplicates
    document.getElementById('crudTestStoreBtn').disabled = true;

    // show spinner
    document.getElementById('crudTestStoreBtnSpinner').classList.remove('hidden');
    
    await axios
        .post(route('web.crud.test.store'), crudTest)
        .then((res) => {
            router.visit(route('web.crud.test.index'));
        })
        .catch((err) => {
            crudTestErrors.name = err.response.data.errors.name;
            crudTestErrors.description = err.response.data.errors.description;
            crudTestErrors.is_enabled = err.response.data.errors.is_enabled;
            
            // enable submit button, for resubmit
            document.getElementById('crudTestStoreBtn').disabled = false;
            
            // hide spinner
            document.getElementById('crudTestStoreBtnSpinner').classList.add('hidden');
        });
};
</script>

<template>
    <Head title="Crud Test" />

    <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <Link :href="route('web.crud.test.create')">
                        <span>ITEM DETAIL</span>
                    </Link>
                    <span class="float-right">
                        <Link :href="route('web.crud.test.index')">
                            <Back />
                        </Link>
                    </span>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="relative overflow-x">
                                <div class="p-4">
                                    <p>NAME</p>
                                    <input type="text" v-model="crudTest.name" class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500" />
                                    <div v-if="crudTestErrors.name">
                                        <ul class="text-red-500">
                                            <li v-for="value, key in crudTestErrors.name" :key="key">
                                            {{ value }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <p>DESCRIPTION</p>
                                    <input type="text" v-model="crudTest.description" class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500" />
                                    <div v-if="crudTestErrors.description">
                                        <ul class="text-red-500">
                                            <li v-for="value, key in crudTestErrors.description" :key="key">
                                            {{ value }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <input type="checkbox" v-model="crudTest.is_enabled" class="form-checkbox h-5 w-5 text-green-500" />
                                    <span class="ml-3">IS ENABLED</span>
                                </div>
                                
                                <div class="float-right m-4">
                                    <span class="p-2">
                                        <Link href="/crud-test">
                                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">CANCEL</button>
                                        </Link>
                                    </span>
                                    <span class="p-2">
                                        <button id="crudTestStoreBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="submitCrudTest()">
                                            SUBMIT
                                            &nbsp;
                                            <Spinner id="crudTestStoreBtnSpinner" class="hidden" />
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
</template>
