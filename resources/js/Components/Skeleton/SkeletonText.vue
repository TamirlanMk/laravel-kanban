<script>
import SkeletonWrapper from "@/Components/Skeleton/SkeletonWrapper.vue";

export default {
    name: "SkeletonText",
    components: {SkeletonWrapper}
}
</script>

<template>
    <skeleton-wrapper>
        <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
        <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px]"></div>
        <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px]"></div>
        <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
    </skeleton-wrapper>
</template>
