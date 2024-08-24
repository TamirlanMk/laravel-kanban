<script>
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import AppText from "@/Components/Typography/AppText.vue";

export default {
    name: "LayoutSidebar",
    components: {AppText, ResponsiveNavLink}
}
</script>

<template>
    <div
        class="fixed flex-shrink-0 sidebar w-64 top-0 bottom-0 left-0 flex flex-col bg-white dark:bg-gray-800 md:fixed -translate-x-full md:translate-x-0 pt-20 transition">
        <div class="px-4">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </ResponsiveNavLink>

                <ResponsiveNavLink :href="route('boards.index')" :active="route().current('boards.index')">
                    Boards
                </ResponsiveNavLink>

                <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                    Profile
                </ResponsiveNavLink>
            </div>
        </div>

        <footer class="sidebar-footer px-4 pb-4 mt-auto">
            <div class="pt-4 pb-1 block sm:hidden">
                <div class="flex items-center">
                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover"
                             :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                    </div>

                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                </div>
            </div>

            <app-text class="hidden sm:block">
                Copyright &copy; {{ new Date().getFullYear() }}
            </app-text>
        </footer>
    </div>
</template>
