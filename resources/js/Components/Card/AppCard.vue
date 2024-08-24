<script setup>
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
</script>

<template>
    <div class="mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg px-4 py-4 max-w-full w-full">
        <fade-transition :isGroup="true">
            <slot/>
        </fade-transition>

        <footer v-if="$slots.footer" class="flex flex-row justify-end dark:bg-gray-800 text-end">
            <slot name="footer"/>
        </footer>
    </div>
</template>
