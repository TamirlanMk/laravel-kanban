<script setup>
import {Link} from "@inertiajs/vue3";

/**
 * Sizes: sm, md, lg, xl,
 * As: any tag, link(Inertia),
 * Variants: primary, info, warning, danger, success
 *
 **/

defineProps({
    as: {
        type: String,
        default: 'button'
    },
    size: {
        type: String,
        default: 'sm'
    },
    variant: {
        type: String,
        default: 'primary'
    },
    disabled: {
        type: Boolean,
        default: false
    },
})
</script>

<template>
    <component
        :disabled
        :is="as === 'link' ? Link : as"
        :class="{
            'px-1.5 py-1 text-[10px] font-normal leading-3': size === 'xs',
            'px-2 py-1 text-[12px] font-normal': size === 'sm',
            'px-3 py-1.5 text-base font-medium': size === 'md',
            'px-6 py-4 text-xl font-medium': size === 'lg',
            'px-8 py-4 text-2xl font-medium': size === 'xl',

            'bg-indigo-100 dark:bg-indigo-400 hover:bg-indigo-200 dark:hover:bg-indigo-500 focus:ring-indigo-400 text-gray-800 dark:text-gray-50': variant === 'primary',
            'dark:bg-gray-800 border border-gray-300 dark:border-gray-600 bg-white hover:bg-gray-100 dark:hover:bg-gray-900 dark:focus:ring-gray-600 focus:ring-gray-500 text-gray-800 dark:text-gray-300': variant === 'info',
            'bg-yellow-400 hover:bg-yellow-300 focus:ring-yellow-500 text-gray-800 dark:text-gray-300': variant === 'warning',
            'bg-red-500 hover:bg-red-600 focus:ring-red-700 text-white dark:text-gray-100': variant === 'danger',
            'bg-green-500 hover:bg-green-600 focus:ring-green-700 text-white': variant === 'success',

            'opacity-25 cursor-default': disabled
        }"
        class="inline-flex rounded-[5px] no-underline focus:ring-[2px] transition font-semibold tracking-widest uppercase"
    >
        <slot/>
    </component>
</template>

<style scoped>

</style>
