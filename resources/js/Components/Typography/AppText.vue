<script setup>
const props = defineProps({
    size: {
        type: String,
        default: 'sm'
    },
    weight: {
        type: String
    }
})
</script>

<template>
    <p :class="{
        'text-xs': size === 'xs',
        'text-sm': size === 'sm',
        'text-md': size === 'md',
        'text-lg': size === 'lg',
        'text-xl': size === 'xl',
        'font-bold': weight === 'bold',
        'font-medium': weight === 'medium',
        'text-base': !size,
        'font-normal': !weight,
    }" class="text-gray-900 dark:text-gray-400">
        <slot/>
    </p>
</template>

