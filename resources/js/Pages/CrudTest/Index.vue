<script setup>
import { Head } from '@inertiajs/vue3';
import Add from '@/Icons/Add.vue';
import Delete from '@/Icons/Delete.vue';
import Edit from '@/Icons/Edit.vue';

defineProps({
    crudTest: Array|Object,
});
</script>

<template>
    <Head title="Crud Test" />

    <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    ITEM LIST
                    <span class="float-right"><Add /></span>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
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
                                    <tbody>
                                        <tr class="bg-white border-b" v-for="value, key in crudTest" :key="key">
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
                                                    <td class="p-2"><Edit /></td>
                                                    <td class="p-2"><Delete /></td>
                                                </table>
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
