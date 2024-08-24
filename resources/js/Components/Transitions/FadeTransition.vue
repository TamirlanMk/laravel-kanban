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
        enter-active-class="duration-300 ease-out transition"
        enter-from-class="transform opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="duration-200 ease-out transition"
        leave-from-class="transform opacity-100"
        leave-to-class="opacity-0"
    >
        <slot/>
    </transition>

    <transition-group
        v-else
        enter-active-class="duration-300 ease-out transition"
        enter-from-class="transform opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="duration-200 ease-out transition"
        leave-from-class="transform opacity-100"
        leave-to-class="opacity-0"
    >
        <slot/>
    </transition-group>
</template>


