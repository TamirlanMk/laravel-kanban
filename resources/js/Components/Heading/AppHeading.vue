<script setup>
defineProps({
    as: {
        type: String,
        default: 'h2',
    },
    cols: {
        required: false,
        type: Number,
    }
})
</script>

<template>
    <component
        :is="as"
        :class="{
            'font-semibold text-3xl': as === 'h1',
            'font-semibold text-2xl': as === 'h2',
            'font-semibold text-xl': as === 'h3',
            'font-semibold text-base': as === 'h4',
            'font-semibold text-sm': as === 'h5',
            'font-semibold text-xs': as === 'h6',
       }"
        class="text-gray-800 dark:text-gray-200 leading-tight text-ellipsis"
        :style="cols ? `overflow: hidden;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: ${cols};` : ''"
    >
        <slot/>
    </component>
</template>
