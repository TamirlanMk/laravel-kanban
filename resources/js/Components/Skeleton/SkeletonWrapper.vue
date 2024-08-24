<script>
export default {
    name: "SkeletonWrapper"
}
</script>

<template>
    <div role="status" class="max-w-md w-full">
        <div class="animate-pulse space-y-2 w-full">
            <slot/>
        </div>
    </div>
</template>
