<script setup>
defineProps({
    isGroup: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <transition
        v-if="!isGroup"
        enter-active-class="transition duration-500 overflow-hidden enter-active"
        enter-from-class="max-h-0 opacity-0"
        enter-to-class="max-h-[10000px] opacity-100"

        leave-active-class="transition duration-500 overflow-hidden enter-active"
        leave-from-class="max-h-[10000px] opacity-100"
        leave-to-class="max-h-0 opacity-0"
    >
        <slot/>
    </transition>

    <transition-group
        v-else
        enter-active-class="transition duration-500 overflow-hidden enter-active"
        enter-from-class="max-h-0 opacity-0"
        enter-to-class="max-h-[10000px] opacity-100"

        leave-active-class="transition duration-500 overflow-hidden enter-active"
        leave-from-class="max-h-[10000px] opacity-100"
        leave-to-class="max-h-0 opacity-0"
    >
        <slot/>
    </transition-group>
</template>
