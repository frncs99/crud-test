<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import Back from '@/Icons/Back.vue';
import Spinner from '@/Icons/Spinner.vue';

defineProps({
    item: Array|Object,
});

const itemErrors = reactive({
    name: '',
    description: '',
    is_enabled: '',
});

const editItem = async (item) => {
    // clear errors
    itemErrors.name = itemErrors.description = itemErrors.is_enabled = '';

    // disable submit button, to prevent duplicates
    document.getElementById('itemUpdateBtn').disabled = true;

    // show spinner
    document.getElementById('itemUpdateBtnSpinner').classList.remove('hidden');
    
    await axios
        .patch(route('web.item.update', item.id), item)
        .then((res) => {
            router.visit(route('web.item.index'));
        })
        .catch((err) => {
            itemErrors.name = err.response.data.errors.name;
            itemErrors.description = err.response.data.errors.description;
            itemErrors.is_enabled = err.response.data.errors.is_enabled;
            
            // enable submit button, for resubmit
            document.getElementById('itemUpdateBtn').disabled = false;
            
            // hide spinner
            document.getElementById('itemUpdateBtnSpinner').classList.add('hidden');
        });
};
</script>

<template>
    <Head title="ITEM EDIT" />

    <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <Link :href="route('web.item.edit', item.id)">
                        <span>ITEM DETAIL ({{ item.id }})</span>
                    </Link>
                    <span class="float-right">
                        <Link title="Go back." :href="route('web.item.index')">
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
                                    <input type="text" v-model="item.name" class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500" />
                                    <div v-if="itemErrors.name">
                                        <ul class="text-red-500">
                                            <li v-for="value, key in itemErrors.name" :key="key">
                                            {{ value }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <p>DESCRIPTION</p>
                                    <input type="text" v-model="item.description" class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500" />
                                    <div v-if="itemErrors.description">
                                        <ul class="text-red-500">
                                            <li v-for="value, key in itemErrors.description" :key="key">
                                            {{ value }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <input type="checkbox" v-model="item.is_enabled" class="form-checkbox h-5 w-5 text-green-500" />
                                    <span class="ml-3">IS ENABLED</span>
                                </div>
                                
                                <div class="float-right m-4">
                                    <span class="p-2">
                                        <Link :href="route('web.item.index')">
                                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">CANCEL</button>
                                        </Link>
                                    </span>
                                    <span class="p-2">
                                        <button id="itemUpdateBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="editItem(item)">
                                            EDIT
                                            &nbsp;
                                            <Spinner id="itemUpdateBtnSpinner" class="hidden" />
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
