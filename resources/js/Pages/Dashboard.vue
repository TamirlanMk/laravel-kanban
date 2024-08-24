<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppCard from "@/Components/Card/AppCard.vue";
import AppText from "@/Components/Typography/AppText.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
</script>

<template>
    <app-layout title="Dashboard">
        <template #header>
            <app-heading>Dashboard</app-heading>
        </template>
        <div class="px-4 sm:px-6 lg:px-8">
            <app-card>
                <app-text font-style="bold">
                    Kanban Laravel-Vue-Inertia project
                </app-text>
            </app-card>
        </div>
    </app-layout>
</template>
