<script setup>
import {usePage, Link} from "@inertiajs/vue3";

const page = usePage();
const breadcrumbs = page.props.breadcrumbs;
</script>

<template>
    <ol class="breadcrumbs dark:text-gray-200">
        <li
            v-for="breadcrumb in breadcrumbs"
            class="breadcrumbs__item"
            :class="{
                'active text-indigo-700 dark:text-indigo-400': breadcrumb.current,
                'text-gray-950 dark:text-gray-200': !breadcrumb.current
            }"
        >
            <span v-if="breadcrumb.current">{{ breadcrumb.title }}</span>
            <Link v-else :href="breadcrumb.url">{{ breadcrumb.title }}</Link>
        </li>
    </ol>
</template>

<style scoped>
.breadcrumbs {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 3px 25px;
}

.breadcrumbs__item {
    position: relative;
    font-size: 14px;
    opacity: .75;
    font-weight: 500;
}

.breadcrumbs__item.active {
    opacity: 1;
}

@media (prefers-color-scheme: light) {
    .breadcrumbs__item:not(:last-child)::after {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='14' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-chevron-right'%3E%3Cpath d='m9 18 6-6-6-6'/%3E%3C/svg%3E%0A");
        color: inherit;
        position: absolute;
        right: -21px;
        top: 60%;
        transform: translateY(-50%);
    }
}

@media (prefers-color-scheme: dark) {
    .breadcrumbs__item:not(:last-child)::after {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='14' viewBox='0 0 24 24' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' stroke='%23e5e7eb'%3E%3Cpath d='m9 18 6-6-6-6'/%3E%3C/svg%3E%0A");
        position: absolute;
        right: -21px;
        top: 60%;
        transform: translateY(-50%);
    }
}
</style>
