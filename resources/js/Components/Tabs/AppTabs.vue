<script>
export default {}
</script>

<template>
    <div class="flex flex-row items-stretch w-full rounded-lg overflow-hidden">
        <div class="max-w-[20%] w-full bg-transparent">
            <slot name="links"/>
        </div>

        <div class="flex items-stretch max-w-[80%] w-full justify-stretch">
            <slot name="tabs"/>
        </div>
    </div>
</template>
