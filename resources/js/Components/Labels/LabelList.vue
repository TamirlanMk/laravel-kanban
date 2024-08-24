<script setup>

import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
</script>

<template>
    <div class="inline-flex items-center justify-start gap-2 flex-wrap">
        <fade-transition :is-group="true">
            <slot/>
        </fade-transition>
    </div>
</template>

