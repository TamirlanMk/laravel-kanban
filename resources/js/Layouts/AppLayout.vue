<script setup>
import {onMounted, ref, watch} from 'vue';
import {Head, router} from '@inertiajs/vue3';

import LayoutHeader from "@/Layouts/Partials/LayoutHeader.vue";
import LayoutSidebar from "@/Layouts/Partials/LayoutSidebar.vue";
import useTheme from "@/Composables/Theme/useTheme.js";

defineProps({
    title: String,
    overflow: {
        type: Boolean,
        default: false
    },
});

const showingSidebar = ref(false);

const showSidebar = () => showingSidebar.value = !showingSidebar.value;

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="min-h-[100svh] bg-gray-100 dark:bg-gray-900" :class="{'show-mobile-sidebar': showingSidebar}">
        <Head :title="title"/>

        <div class="flex flex-grow md:ps-64">
            <layout-sidebar/>

            <layout-header @logout="logout" @toggleSidebar="showSidebar" :showingSidebar/>

            <main
                :class="overflow ? 'overflow-x-auto' : ''"
                class="mt-16 w-full max-w-full"
            >
                <div class="px-4 sm:px-6 lg:px-8 py-6 sm:py-6 lg:py-8 mb-4" v-if="$slots.header">
                    <slot name="header"/>
                </div>
                <div
                    :class="overflow ? 'overflow-x-auto' : ''"
                    class="w-full touch-auto scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-transparent scrollbar-thumb-rounded-full scrollbar-track-rounded-full">
                    <slot/>
                </div>
            </main>
        </div>
    </div>
</template>

<style>
* {
    transition: color, background-color, background, fill, border-color;
    transition-duration: 100ms;

    transition-timing-function: linear;
}

.show-mobile-sidebar .sidebar {
    transform: translateX(0) !important;
}
</style>
