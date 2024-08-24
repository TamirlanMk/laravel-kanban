<script setup>

</script>

<template>
    <transition
        leave-active-class="duration-100 ease-out transition"
        leave-from-class="transform opacity-100"
        leave-to-class="opacity-0"
    >
        <slot/>
    </transition>
</template>
