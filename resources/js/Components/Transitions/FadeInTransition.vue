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
        enter-active-class="duration-300 ease-out delay-200 transition"
        enter-from-class="transform opacity-0"
        enter-to-class="opacity-100"
    >
        <slot/>
    </transition>

    <transition-group
        v-else
        enter-active-class="duration-300 ease-out delay-200 transition"
        enter-from-class="transform opacity-0"
        enter-to-class="opacity-100"
    >
        <slot/>
    </transition-group>
</template>
