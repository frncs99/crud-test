<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Add from '@/Icons/Add.vue';
import Delete from '@/Icons/Delete.vue';
import Edit from '@/Icons/Edit.vue';
import { reactive } from 'vue';

defineProps({
    items: Array|Object,
    flash: Array|Object,
});

const errorMessage = reactive({
    'delete': null
});

const deleteItem = async (id) => {
    await axios
        .delete(route('web.item.destroy', id))
        .then((res) => {
            router.visit(route('web.item.index'));
        })
        .catch((err) => {
            errorMessage.delete = err.response.data
            console.error(err);
        });
};
</script>

<template>
    <Head title="ITEM" />

    <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <Link :href="route('web.item.index')">
                        <span>ITEM LIST</span>
                    </Link>
                    <span class="float-right">
                        <Link title="Add item here." :href="route('web.item.create')">
                            <Add />
                        </Link>
                    </span>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div v-if="errorMessage.delete" class="mt-8">    
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="relative overflow-x">
                            <div class="bg-red-500 text-white px-4 py-3 flex items-center justify-between" role="alert">
                                <div class="flex">
                                    <p>{{ errorMessage.delete }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="flash.message" class="mt-8">    
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="relative overflow-x">
                            <div class="bg-green-500 text-white px-4 py-3 flex items-center justify-between" role="alert">
                                <div class="flex">
                                    <p>{{ flash.message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-8">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="relative overflow-x">
                                <table class="w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs text-gray-700 uppercase">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                NAME
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                DESCRIPTION
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                IS ENABLED
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="items.length > 0">
                                        <tr class="bg-white border-b" v-for="value, key in items" :key="key">
                                            <td class="px-6 py-4">{{ value.id }}</td>
                                            <td class="px-6 py-4">{{ value.name }}</td>
                                            <td class="px-6 py-4">{{ value.description }}</td>
                                            <td class="px-6 py-4 font-bold" v-html="
                                                (value.is_enabled) ?
                                                    '<span class=\'text-green-500\'>ENABLED</span>' :
                                                    '<span class=\'text-red-500\'>DISABLED</span>'"
                                            ></td>
                                            <td class="px-6 py-4">
                                                <table>
                                                    <td class="p-2 cursor-pointer" title="Edit item here.">
                                                        <Link :href="route('web.item.edit', value.id)">
                                                            <Edit />
                                                        </Link>
                                                    </td>
                                                    <td class="p-2 cursor-pointer" title="Delete item here."><Delete @click="deleteItem(value.id)" /></td>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr class="bg-white border-b text-center">
                                            <td class="px-6 py-4" colspan="5">
                                                NO DATA FOUND.
                                                <br />
                                                Click the Add Icon in the upper right to add items.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
</template>
