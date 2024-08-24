<script setup>
import {Link} from "@inertiajs/vue3";

import useTheme from "@/Composables/Theme/useTheme.js";

import {SunIcon, SunMoonIcon} from "lucide-vue-next";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";

import AppBreadcrumbs from "@/Components/Breadcrumbs/AppBreadcrumbs.vue";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";

const {isDark, toggleTheme} = useTheme();

defineProps({
    showingSidebar: {type: Boolean}
})

defineEmits(['toggleSidebar', 'logout'])
</script>

<template>
    <header>
        <nav
            class="bg-white fixed left-0 right-0 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16 flex items-center">
            <div class="max-w-[100svw] w-full px-4">
                <div class="flex items-center">
                    <div class="shrink-0 flex items-center sm:w-64">
                        <Link :href="route('dashboard')" class="flex items-center gap-4 ">
                            <ApplicationMark class="block h-9 w-auto"/>

                            <span class="font-medium text-base sm:text-xl hidden sm:block dark:text-gray-100">Laravel Kanban</span>
                        </Link>
                    </div>

                    <div class="bg-white flex flex-row items-center w-full justify-between dark:bg-gray-800 px-2">
                        <app-breadcrumbs/>
                        <div class="flex flex-row items-center">
                            <button @click="toggleTheme" class="relative w-6 h-6">
                                <fade-transition>
                                    <sun-icon size="20" v-if="isDark" class="text-gray-300 absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2"/>
                                    <sun-moon-icon size="20" v-else class="text-gray-700 absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2"/>
                                </fade-transition>
                            </button>

                            <div class="hidden md:flex md:items-center sm:ms-6">
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex gap-2 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <img class="h-8 w-8 rounded-full object-cover "
                                                     :src="$page.props.auth.user.profile_photo_url"
                                                     :alt="$page.props.auth.user.name">
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Account
                                            </div>

                                            <DropdownLink :href="route('profile.show')">
                                                Profile
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                                          :href="route('api-tokens.index')">
                                                API Tokens
                                            </DropdownLink>

                                            <div class="border-t border-gray-200 dark:border-gray-600"/>

                                            <!-- Authentication -->
                                            <form @submit.prevent="$emit('logout')">
                                                <DropdownLink as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                            <div class="flex items-center md:hidden -me-4 sm:me-3">
                                <button
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                                    @click="$emit('toggleSidebar')">
                                    <svg
                                        class="h-6 w-6"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            :class="{'hidden': showingSidebar, 'inline-flex': ! showingSidebar }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{'hidden': ! showingSidebar, 'inline-flex': showingSidebar }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
